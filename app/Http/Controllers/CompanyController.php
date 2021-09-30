<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

private function checkPerms($perms, $class) {
    return $this->authorize($perms, $class);
}

class CompanyController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!checkPerms('viewAny', Company::class)) {
            abort(403);
        }
        
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!checkPerms('create', Company::class)) {
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
        if (!checkPerms('view', Company::class)) {
            abort(403);
        }
        
        return Company::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!checkPerms('update', Company::class)) { 
            abort(403);
        }
        
        $company = Company::findOrFail($id); // try to find the Company by id, fail if not found
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
        if (!checkPerms('delete', Company::class)) { 
            abort(403);
        }
        
        $company = Company::findOrFail($id); // try to find the Company by id, fail if not found
        $company->delete(); // delete the Company

        return 204; // return HTML response code 204
    }
}