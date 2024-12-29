<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = request('project_id');
        $project=Project::findOrFail($id);

        $milestones = Milestone::where('project_id', $id)->get();
        return view('dashboard.milestone.index',compact('milestones','project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Milestone::create([
            "project_id"=>request("project_id"),
            "title"=>request("title"),
            "description"=>request("description"),
            "progress"=>0,
            "expected_completion_date"=>request("expected_completion_date"),
            "created_by"=>Auth::user()->id,
            "budget"=>request("budget"),
        ]);
        return back()->with('success','Milestone created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Milestone $milestone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milestone $milestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $project = Milestone::findOrFail($id);
        if(request('title')!=null){
            $project->title=request('title');
        }
        if(request('description')!=null){
            $project->description=request('description');
        }
        if(request('progress')!=null){
            $project->progress=request('progress');
        }
        if(request('expected_completion_date')!=null){
            $project->expected_completion_date=request('expected_completion_date');
        }
        if(request('actual_completion_date')!=null){
            $project->actual_completion_date=request('actual_completion_date');
        }
        if(request('budget')!=null){
            $project->budget=request('budget');
        }
        $project->update();
        return back()->with('success','Milestone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Milestone::destroy($id);
        return back()->with('error','Milestone deleted successfully.');
    }
}
