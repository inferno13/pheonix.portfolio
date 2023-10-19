<?php

namespace App\Http\Requests\Admin;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('isAdmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'min:8', 'max:25', 'unique:users,username'],
            'role' => ['required', 'in:' . implode(',', $this->user()->getRoleNames())],
            'email' => ['required', 'email', 'unique:users,email']
        ];
    }
}
