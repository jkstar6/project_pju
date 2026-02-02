<?php

namespace App\Http\Services\Admin\Settings;

use App\Models\User;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UsersService
{
    /**
     * Role yang valid di sistem (sesuaikan dengan middleware).
     * Spatie role bersifat case-sensitive.
     */
    private const VALID_ROLES = ['Admin', 'Teknisi', 'Survey'];

    /* Get all users */
    public function getAllUsersForDataTable()
    {
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                // tetap exclude developer jika masih ada konsepnya
                $query->where('name', RoleEnum::DEVELOPER->value);
            })
            ->orderBy('name');

        return DataTables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d M Y H:i');
            })
            ->addColumn('role', function ($row) {
                return $row->getRoleNames()->isNotEmpty()
                    ? $row->getRoleNames()->implode(', ')
                    : '-';
            })
            ->addColumn('status', function ($row) {
                if ((int) $row->is_active === 1) {
                    return '<span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">Aktif</span>';
                }
                return '<span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">Tidak Aktif</span>';
            })
            ->addColumn('aksi', function ($row) {
                $wrapperStart = '<div class="flex items-center gap-[9px] justify-center">';
                $btnEdit = '';
                $btnDelete = '';

                if (auth()->user()->can('settings-users.update')) {
                    $btnEdit = '<button type="button" title="Edit data pengguna" id="btn-modal-edit-user"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.update', $row->id) . '" data-url-get="' . route('settings.users.edit', $row->id) . '"
                        class="btn-modal-edit-user text-warning-500 dark:text-warning-400 leading-none custom-tooltip">
                            <i class="material-symbols-outlined !text-md">edit</i>
                        </button>';
                }

                if (auth()->user()->can('settings-users.delete')) {
                    $btnDelete = '<button type="button" title="Hapus data pengguna" id="btn-delete"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.destroy', $row->id) . '"
                        class="text-danger-500 leading-none custom-tooltip">
                            <i class="material-symbols-outlined !text-md">delete</i>
                        </button>';
                }

                $wrapperBottom = '</div>';

                return $wrapperStart . $btnEdit . ' ' . $btnDelete . $wrapperBottom;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get all roles (ONLY 3 ROLES)
     * Supaya dropdown role tidak muncul "user", "admin" lowercase, dsb.
     */
    public function getAllRoles()
    {
        return Role::query()
            ->whereIn('name', self::VALID_ROLES)
            ->orderByRaw("CASE name
                WHEN 'Admin' THEN 1
                WHEN 'Teknisi' THEN 2
                WHEN 'Survey' THEN 3
                ELSE 99 END")
            ->get();
    }

    /* Get user by ID */
    public function getUserById(int $id)
    {
        $user = User::with('roles')->findOrFail($id);

        // kompatibilitas untuk UI yang butuh array
        $user->role_names = $user->roles->pluck('name')->toArray();

        // single role untuk UI single select
        $user->role_name = $user->roles->first()?->name;

        return $user;
    }

    /**
     * Ambil role dari payload request yang mungkin beda-beda
     * - ideal: role (string)
     * - alternatif: role_name (string)
     * - alternatif lama: roles[] (array)
     */
    private function extractRoleName(array $data): ?string
    {
        if (!empty($data['role']) && is_string($data['role'])) {
            return $data['role'];
        }

        if (!empty($data['role_name']) && is_string($data['role_name'])) {
            return $data['role_name'];
        }

        if (!empty($data['roles']) && is_array($data['roles'])) {
            $first = $data['roles'][0] ?? null;
            if (is_string($first) && $first !== '') {
                return $first;
            }
        }

        return null;
    }

    /**
     * Validasi role hanya boleh 3 role.
     */
    private function validateRoleOrFail(?string $roleName)
    {
        if (!$roleName) {
            throw new \InvalidArgumentException('Role wajib dipilih.');
        }

        if (!in_array($roleName, self::VALID_ROLES, true)) {
            throw new \InvalidArgumentException('Role tidak valid.');
        }

        // pastikan role exist di DB (idempotent)
        Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
    }

    /* Store new user data (SINGLE ROLE ONLY) */
    public function store(array $data)
    {
        try {
            \DB::beginTransaction();

            $roleName = $this->extractRoleName($data);
            $this->validateRoleOrFail($roleName);

            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'is_active' => 1,
            ]);

            // assign role via Spatie (ini yang penting)
            $user->syncRoles([$roleName]);

            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\InvalidArgumentException $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'role' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Pengguna gagal ditambahkan. Error :' . $e->getMessage()
            ]);
        }
    }

    /* Update user data (SINGLE ROLE ONLY) */
    public function update($userId, array $data)
    {
        try {
            \DB::beginTransaction();

            $user = User::findOrFail($userId);

            $user->update([
                'name'      => $data['name'] ?? $user->name,
                'email'     => $data['email'] ?? $user->email,
                'is_active' => isset($data['is_active']) ? (int) $data['is_active'] : $user->is_active,
            ]);

            if (!empty($data['password'])) {
                $user->update([
                    'password' => bcrypt($data['password']),
                ]);
            }

            // Role wajib dipilih saat update juga (supaya tidak jadi kosong)
            $roleName = $this->extractRoleName($data);
            $this->validateRoleOrFail($roleName);

            $user->syncRoles([$roleName]);

            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil diperbarui');
        } catch (\InvalidArgumentException $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'role' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Pengguna gagal diperbarui. Error :' . $e->getMessage()
            ]);
        }
    }

    /* Delete user data */
    public function delete($userId)
    {
        try {
            \DB::beginTransaction();

            $user = User::findOrFail($userId);
            $user->delete();

            \DB::commit();
            return redirect()->route('settings.users.index')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withErrors([
                'error' => 'Pengguna gagal dihapus. Error :' . $e->getMessage()
            ]);
        }
    }
}