<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Job::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return Job::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param id $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return Job::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  id $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $job = Job::findOrFail($id); // try to find the Job by id, fail if not found
        $job->update($request->all()); // update the Job with the request data

        return $job; // return the Job
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  id $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $job = Job::findOrFail($id); // try to find the Job by id, fail if not found
        $job->delete(); // delete the Job

        return 204; // return HTML response code 204
    }
}