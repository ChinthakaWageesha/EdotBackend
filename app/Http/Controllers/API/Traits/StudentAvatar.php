<?php

namespace App\Http\Controllers\Api\Traits;

use Storage;
use App\Student;
use App\Http\Requests\Api\User\StoreAvatarRequest;

/**
 * Class UserAvatar
 * @package App\Http\Controllers\Api\V1\Traits
 */
trait StudentAvatar
{
    /**
     * Returns the profile picture data.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function getAvatar(Student $student)
    {
        if(empty($student->avatar_path)) {
            abort(404);
        }

        return ImageResponse::output($student->avatar_path);
    }

    /**
     * @api {post} /student/{id}/avatar Update avatar
     * @apiSuccessExample {json} Success Response
     *  HTTP/1.1 200 OK
     *  {
     *      "message": "avatar updated"
     *  }
     */

    public function updateAvatar(StoreAvatarRequest $request, Student $student)
    {
        $data = $request->all();
        // save the file
        if($request->hasFile('file')) {
            $disk = Storage::disk('public');

            $path = $request->file->store('students/' . $student->id, 'public');
            $url = $disk->url($path);
            $student->update(['avatar_path' => $path, 'avatar_url' => $url]);
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
