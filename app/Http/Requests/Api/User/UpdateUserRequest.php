<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Backend\Access\User
 */
class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'first_name' => 'required|max:255',
            // 'last_name' => 'required|max:255', // not required in mobile app
            // 'email' =>  'required|email|max:255|unique:users,email',
            // 'password' => 'required|min:6',
        ];
    }
}
