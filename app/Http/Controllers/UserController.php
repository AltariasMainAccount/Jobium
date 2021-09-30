<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    private function checkPerms($perms, $class) {
        return $this->authorize($perms, $class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!$this->checkPerms('viewAny', User::class)) {
            abort(403);
        }
        
        return User::with('companies')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!$this->checkPerms('create', User::class)) {
            abort(403);
        }
        
        return User::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  id  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::where('id', $id)->with('companies')->first();
        
        if (!$this->checkPerms('view', $user)) {
            abort(403);
        }
        
        return response([
            $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id); // try to find the user by id, fail if not found
        
        if (!$this->checkPerms('update', $user)) {
            abort(403);
        }

        $user->update($request->all()); // update the user with the request data

        return $user; // return the user
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  id  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::findOrFail($id); // try to find the user by id, fail if not found
        
        if (!$this->checkPerms('delete', $user)) {
            abort(403);
        }
    
        $user->delete(); // delete the user

        return 204; // return HTML response code 204
    }
}
