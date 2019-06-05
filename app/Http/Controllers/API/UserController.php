<?php

namespace App\Http\Controllers\Api;

use Hash;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\ManageUserRequest;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\Api\Traits\UserAvatar;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    use UserAvatar;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\User\StoreUserRequest  $request
     * @return \App\Http\Resources\User
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        if ($request->has('first_name')) {
            $data['name'] = $request->first_name .' '. $request->last_name;
        }

        $user = User::create($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \App\Http\Resources\User
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\User\UpdateUserRequest  $request
     * @param  \App\User $user
     * @return \App\Http\Resources\User
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();

        // save the file
        if($request->hasFile('avatar')) {
            $disk = Storage::disk('public');

            $path = $request->file->store('avatars/' . $user->id, 'public');
            $url = $disk->url($path);
            $data = array_merge($data, ['avatar_path' => $path, 'avatar_url' => $url]);
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        if ($request->has('first_name')) {
            $data['name'] = $request->first_name;
        }

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \App\Http\Resources\User
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return [
                'message' => 'User successfully deleted.',
                'errors' => [],
            ];
        }

        abort(500, 'Error deleting user.');
    }
}
