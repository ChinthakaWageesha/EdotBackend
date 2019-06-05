<?php

namespace App\Http\Controllers\Api;

use App\Entities\Message;
use App\User;
use App\Http\Requests\Api\Message\StoreMessageRequest;
use App\Http\Requests\Api\Message\UpdateMessageRequest;
use App\Http\Resources\Message as MessageResource;
use App\Http\Resources\MessageCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use Storage;
use DB;

class MessageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return new MessageCollection($Messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Message\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->all());

        return new MessageResource($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Message $Message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message, $id = null)
    {
        return new MessageResource($message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Message\UpdateMessageRequest  $request
     * @param  \App\Entities\Message $Message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->all());

        return new MessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->destroy();
    }
}
