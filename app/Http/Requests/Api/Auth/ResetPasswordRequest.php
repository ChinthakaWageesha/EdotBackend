<?php

namespace App\Http\Requests\Api\Auth;

use Auth;
use App\Http\Requests\Request;
use App\Rules\Password;
use Illuminate\Validation\Rule;

/**
 * Class ResetPasswordRequest
 * @package App\Http\Requests\Api\Auth
 */
class ResetPasswordRequest extends Request
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
            'current_password' => ['required', new Password(auth('api')->user())],
            'password' => 'required|min:6|max:255',
        ];
    }
}
