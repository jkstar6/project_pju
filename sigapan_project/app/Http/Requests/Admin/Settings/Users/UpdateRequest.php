<?php

namespace App\Http\Requests\Admin\Settings\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // untuk route resource: settings/users/{user}
        $userId = $this->route('user');

        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email:rfc,dns', 'unique:users,email,' . $userId],
            'is_active' => ['required', 'in:0,1'],

            // ✅ SINGLE ROLE (bukan roles[])
            'role'      => ['required', 'string', 'exists:roles,name'],

            // password optional saat update
            'password'  => ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ];
    }
}
