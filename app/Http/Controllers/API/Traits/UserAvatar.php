<?php

namespace App\Http\Controllers\Api\Traits;

use Storage;
use App\User;
// use App\Helpers\ImageResponse;
use App\Http\Requests\Api\User\StoreAvatarRequest;

/**
 * Class UserAvatar
 * @package App\Http\Controllers\Api\V1\Traits
 */
trait UserAvatar
{
    /**
     * Returns the profile picture data.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function getAvatar(User $user)
    {
        if(empty($user->avatar_path)) {
            abort(404);
        }

        return ImageResponse::output($user->avatar_path);
    }

    /**
     * @api {post} /users/{id}/avatar Update avatar
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "message": "avatar updated"
     *  }
     */

    public function updateAvatar(StoreAvatarRequest $request, User $user)
    {
        $data = $request->all();
        // save the file
        if($request->hasFile('file')) {
            $disk = Storage::disk('public');

            $path = $request->file->store('avatars/' . $user->id, 'public');
            $url = $disk->url($path);
            $user->update(['avatar_path' => $path, 'avatar_url' => $url]);
            return [
                'message' => 'avatar updated',
                'avatar_url' => $url
            ];
        }

        return [
            'message' => 'failed to update',
            'avatar_url' => ""
        ];
    }
}
