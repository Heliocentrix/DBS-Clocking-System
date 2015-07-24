<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Job;

use App\Http\Requests\NewJobRequest;

class AdminJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = 'jobs';
        $jobs = Job::all();
        return View('backend.jobs.jobList', compact('page', 'jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(NewJobRequest $request)
    {
        $job = new Job;
        $job->fill($request->all());
        $job->save();
        return \Redirect::back()->with('success', 'The job '.$job->number.' has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
            //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */

    //THATS CALLED JUST TO CHANGE THE ACTIVE STATUS
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->active = !$job->active;
        $job->save();
        return \Redirect::back()->with('success', 'The job '.$job->number.' status has been changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();
        return \Redirect::back()->with('success', 'The job '.$job->number.' has been deleted.');
    }
}