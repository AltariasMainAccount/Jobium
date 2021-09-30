<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    // Check the permissions
    private function checkPerms($perms, $class) {
        return $this->authorize($perms, $class);
    }

    /**
    * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!$this->checkPerms('viewAny', Company::class)) {
            abort(403);
        }
        
        return Company::with('users')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!$this->checkPerms('create', Company::class)) {
            abort(403);
        }
        
        return Company::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param id $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $company = Company::where('id', $id)->with('users')->first();
        
        if (!$this->checkPerms('view', $company)) {
            abort(403);
        }
        
        return response([
            $company
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $company = Company::findOrFail($id); // try to find the Company by id, fail if not found
        
        if (!$this->checkPerms('update', $company)) { 
            abort(403);
        }

        $company->update($request->all()); // update the Company with the request data

        return $company; // return the Company
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  id $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $company = Company::findOrFail($id); // try to find the Company by id, fail if not found
        
        if (!$this->checkPerms('delete', $company)) { 
            abort(403);
        }
        
        $company->delete(); // delete the Company

        return 204; // return HTML response code 204
    }
}