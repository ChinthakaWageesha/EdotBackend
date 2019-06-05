<?php

namespace App\Http\Requests\Api\Auth;

use Auth;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class ConfirmPasswordRequest
 * @package App\Http\Requests\Api\Auth
 */
class ConfirmPasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|max:255',
        ];
    }
}
