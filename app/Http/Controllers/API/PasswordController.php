<?php

namespace App\Http\Controllers\Api;

use Auth;
use Hash;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PasswordController
 * @package App\Controllers\Api\V1
 */
class PasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return response()->json([
            'message' => trans($response),
            'errors' => [],
        ]);
    }
    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message' => trans($response),
            'errors' => [
                'email' => trans($response),
            ],
        ], 404);
    }

    public function reset(ResetPasswordRequest $request)
    {
        if (auth('api')->user()->update(['password' => Hash::make($request->password)])) {
            return [
                'message' => 'Password reset successfully.',
                'errors' => [],
            ];
        }
    }
}
