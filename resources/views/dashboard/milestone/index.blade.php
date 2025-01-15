@extends('layouts.dashboard',['title'=>'{{$project->name}} Milestones'])
@section('dashboard')
<div class="container mt-3" style="min-height:80vh;">
    <a href="{{route('projects.index')}}">
        <i class="fa fa-chevron-left"></i>
        Back to Projects
    </a>
    <div class="d-flex justify-content-between">
        <h4>{{$project->name}} Milestones</h4>
        <button href="#" data-bs-toggle="modal" data-bs-target="#addmilestones" class="btn btn-primary">Add Milestone</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addmilestones" tabindex="-1" aria-labelledby="addmilestonesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Milestone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('milestones.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="expected_completion_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" min="{{date('Y-m-d')}}" max="{{date_format(date_create($project->deadline),'Y-m-d')}}" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="expected_completion_date" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="expected_completion_date" min="{{date('Y-m-d')}}" max="{{date_format(date_create($project->deadline),'Y-m-d')}}" name="expected_completion_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="budget" class="form-label">Budgeted Amount(Kshs)</label>
                            <input type="number" class="form-control" id="budget" name="budget" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Assign to</label>
                            <select name="assignedto" id="" class="form-select">
                                @foreach (App\Models\User::where('isAdmin',true)->select('name','id')->get() as $user)
                                    <option value="{{$user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-3 mb-3">
        @foreach ($milestones as $milestone)
        <div class="card">
            <div class="card-body" style="color:black;">
                <h5 class="card-title text-uppercase">{{ $milestone->title }}</h5>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <b>Start Date</b><br>{{date_format(date_create($milestone->start_date),'jS F, Y')}}
                    </div>
                    <div class="col-md-4">
                        <b>Deadline</b><br>{{date_format(date_create($milestone->expected_completion_date),'jS F, Y')}}
                    </div>
                    <div class="col-md-4">
                        <b>Initiated by</b><br>{{$milestone->user->name}}
                    </div>
                    <div class="col-md-4">
                        <b>Assigned to</b><br> {{$milestone->to->name}}
                    </div>
                    <div class="col-md-4">
                        <b>Budgeted at</b><br>Ksh {{number_format($milestone->budget,2)}}
                    </div>
                </div>
                <div class="progress mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?php echo $milestone->progress ?>%">{{$milestone->progress}}%</div>
                </div>
                <p class="card-text" style="height:8vh; overflow:hidden;" id="description-{{$milestone->id}}">{{$milestone->description}}</p>
                <p class="text-info" type="button" id="btn-{{$milestone->id}}" onclick="ShowDetails(<?php echo $milestone->id ?>)">More...</p>
                <p class="text-info" type="button" style="display:none;" id="btn2-{{$milestone->id}}" onclick="HideDetails(<?php echo $milestone->id ?>)">Less...</p>
                <div class="modal-footer">
                    <form action="{{route('milestones.update',$milestone->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="progress" value="100">
                        <button class="btn btn-sm btn-info">Completed</button>
                    </form>
                    <button data-bs-toggle="modal" data-bs-target="#addmilestones{{$milestone->id}}" class="btn btn-sm btn-primary">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteProjects{{$milestone->id}}" class="btn btn-sm btn-danger">Delete</button>
                </div>
            </div>
        </div>
        <hr>
        <script>
            function ShowDetails(id) {
                console.log(id);
                var desc = document.getElementById("description-" + id);
                desc.style.height = "";
                document.getElementById("btn-" + id).style.display = "none";
                document.getElementById("btn2-" + id).style.display = "";
            }

            function HideDetails(id) {
                var desc = document.getElementById("description-" + id);
                desc.style.height = "8vh";
                document.getElementById("btn-" + id).style.display = "";
                document.getElementById("btn2-" + id).style.display = "none";
            }
        </script>
        <div class="modal fade" id="addmilestones{{$milestone->id}}" tabindex="-1" aria-labelledby="addmilestonesLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update {{$milestone->title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('milestones.update',$milestone->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$milestone->title}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{$milestone->description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Assign to</label>
                                <select name="assignedto" id="" class="form-select">
                                    @foreach (App\Models\User::where('isAdmin',true)->select('name','id') as $user)
                                        <option {{$milestone->assignedto==$user->id?'selected':''}} value="{{$user->id }}" >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="expected_completion_date" class="form-label">Deadline</label>
                                <input type="date" class="form-control" id="expected_completion_date" min="{{date('Y-m-d')}}" max="{{date_format(date_create($project->deadline),'Y-m-d')}}" name="expected_completion_date" value="{{$milestone->expected_completion_date}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="budget" class="form-label">Budgeted Amount(Kshs)</label>
                                <input type="number" value="{{$milestone->budget}}" class="form-control" id="budget" name="budget" required>
                            </div>
                            <div class="mb-3">
                                <label for="progress" class="form-label">Progress(%)</label>
                                <input type="number" value="{{$milestone->progress}}" class="form-control" id="progress" name="progress" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteProjects{{$milestone->id}}" tabindex="-1" aria-labelledby="addProjectsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete {{$milestone->title}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('milestones.destroy',$milestone->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Are you sure you want to delete this milestone?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection