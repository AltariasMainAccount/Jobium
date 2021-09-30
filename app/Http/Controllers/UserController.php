<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

private function checkPerms($perms, $class) {
    return $this->authorize($perms, $class);
}

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!checkPerms('viewAny', User::class)) {
            abort(403);
        }
        
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!checkPerms('create', User::class)) {
            abort(403);
        }
        
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!checkPerms('view', User::class)) {
            abort(403);
        }
        
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!checkPerms('update', User::class)) {
            abort(403);
        }
        
        $user = User::findOrFail($id); // try to find the user by id, fail if not found
        $user->update($request->all()); // update the user with the request data

        return $user; // return the user
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (!checkPerms('delete', User::class)) {
            abort(403);
        }
        
        $user = User::findOrFail($id); // try to find the user by id, fail if not found
        $user->delete(); // delete the user

        return 204; // return HTML response code 204
    }
}
