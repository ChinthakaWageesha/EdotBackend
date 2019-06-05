<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

/**
 * Class StoreAvatarRequest
 * @package App\Http\Requests\Api\User
 */
class StoreAvatarRequest extends Request
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
            // 'size'      => 'required|integer',
            // 'mime_type' => 'required',
            'file'      => 'file|image|mimes:jpeg,png,gif',
        ];
    }
}
