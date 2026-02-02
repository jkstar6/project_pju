<?php

namespace App\Http\Services\Admin\Settings;

use App\Models\User;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UsersService
{
    /* Get all users */
    public function getAllUsersForDataTable()
    {
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', RoleEnum::DEVELOPER->value);
            })
            ->orderBy('name');

        return Datatables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d M Y H:i');
            })
            ->addColumn('role', function ($row) {
                return $row->getRoleNames()->isNotEmpty() ? $row->getRoleNames()->implode(', ') : '-';
            })
            ->addColumn('status', function ($row) {
                // konsisten pakai is_active seperti di store()
                if ((int) $row->is_active === 1) {
                    return '<span class="px-[8px] py-[3px] inline-block bg-primary-50 dark:bg-[#15203c] text-primary-500 rounded-sm font-medium text-xs">Aktif</span>';
                }
                return '<span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">Tidak Aktif</span>';
            })
            ->addColumn('aksi', function ($row) {
                $wrapperStart = '<div class="flex items-center gap-[9px] justify-center">';
                $btnEdit = '';
                $btnDelete = '';

                // Btn Edit
                if (auth()->user()->can('settings-users.update')) {
                    $btnEdit = '<button type="button" title="Edit data pengguna" id="btn-modal-edit-user"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.update', $row->id) . '" data-url-get="' . route('settings.users.edit', $row->id) . '"
                        class="btn-modal-edit-user text-warning-500 dark:text-warning-400 leading-none custom-tooltip">
                            <i class="material-symbols-outlined !text-md">
                                edit
                            </i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('settings-users.delete')) {
                    $btnDelete = '<button type="button" title="Hapus data pengguna" id="btn-delete"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.destroy', $row->id) . '"
                        class="text-danger-500 leading-none custom-tooltip">
                            <i class="material-symbols-outlined !text-md">
                                delete
                            </i>
                        </button>';
                }

                $wrapperBottom = '</div>';

                return $wrapperStart . $btnEdit . ' ' . $btnDelete . $wrapperBottom;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get all roles (except developer, superadmin, and legacy 'admin' lowercase) */
    public function getAllRoles()
    {
        return Role::query()
            ->whereNotIn('name', [
                RoleEnum::DEVELOPER->value,
                'superadmin',
                'admin', // jaga-jaga kalau masih ada duplikat lowercase
            ])
            ->orderBy('name')
            ->get();
    }

    /* Get user by ID */
    public function getUserById(int $id)
    {
        $user = User::with('roles')->findOrFail($id);

        // untuk kompatibilitas dengan JS lama (array)
        $user->role_names = $user->roles->pluck('name')->toArray();

        // ✅ single role untuk UI single select
        $user->role_name = $user->roles->first()?->name;

        return $user;
    }

    /* Store new user data (SINGLE ROLE ONLY) */
    public function store(array $data)
    {
        try {
            \DB::beginTransaction();

            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'is_active' => 1,
            ]);

            /**
             * ✅ SINGLE ROLE ONLY
             * Pastikan request mengirim "role" (string), bukan roles[]
             */
            if (!empty($data['role'])) {
                $user->syncRoles([$data['role']]);
            }

            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
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

            // Update user data (samakan dengan field tabel kamu)
            $user->update([
                'name'      => $data['name'] ?? $user->name,
                'email'     => $data['email'] ?? $user->email,
                'is_active' => isset($data['is_active']) ? (int) $data['is_active'] : $user->is_active,
            ]);

            // Update password jika diisi
            if (!empty($data['password'])) {
                $user->update([
                    'password' => bcrypt($data['password']),
                ]);
            }

            /**
             * ✅ SINGLE ROLE ONLY
             * Pastikan request mengirim "role" (string), bukan roles[]
             */
            if (!empty($data['role'])) {
                $user->syncRoles([$data['role']]);
            }

            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil diperbarui');
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
