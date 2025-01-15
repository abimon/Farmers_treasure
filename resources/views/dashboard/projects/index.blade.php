@extends('layouts.dashboard',['title'=>'Products'])
@section('dashboard')
<div class="container mt-3" style="min-height:80vh;">
    <div class="d-flex justify-content-between mb-2">
        <h4>Projects</h4>
        <button href="#" data-bs-toggle="modal" data-bs-target="#addProjects" class="btn btn-primary">Add New Project</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProjects" tabindex="-1" aria-labelledby="addProjectsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('projects.store')}}" method="POST">
                    @csrf
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
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" min="{{date('Y-m-d')}}" name="deadline" required>
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
    
    <div class="container">
        @foreach ($projects as $project)
        <div class="card">
            <div class="card-body" style="color:black;">
                <h5 class="card-title text-uppercase">{{ $project->title }}</h5>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <b>Deadline</b><br>
                        {{ date_format(date_create($project->deadline),'jS F, Y')}}
                    </div>
                    <div class="col-md-4">
                        <b>Initiated by</b><br>{{$project->user->name}}
                    </div>
                    <div class="col-md-4">
                        <b>Budgeted at</b><br>Ksh {{number_format($project->milestones->sum('budget'),2)}}
                    </div>
                </div>
                <p class="card-text" style="height:8vh; overflow:hidden;" id="description-{{$project->id}}"><?php echo html_entity_decode($project->description); ?></p>
                <p class="text-info" type="button" id="btn-{{$project->id}}" onclick="ShowDetails(<?php echo $project->id ?>)">More...</p>
                <p class="text-info" type="button" style="display:none;" id="btn2-{{$project->id}}" onclick="HideDetails(<?php echo $project->id ?>)">Less...</p>
                <div class="modal-footer">
                    <a href="{{route('milestones.index', ["project_id"=>$project->id])}}" class="btn btn-sm btn-primary">Milestones</a>
                    <button data-bs-toggle="modal" data-bs-target="#addProjects{{$project->id}}" class="btn btn-sm btn-info">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteProjects{{$project->id}}" class="btn btn-sm btn-danger">Delete</button>
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

        <div class="modal fade" id="addProjects{{$project->id}}" tabindex="-1" aria-labelledby="addProjectsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit {{$project->name}} Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('projects.update',$project->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" value="{{$project->name}}" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{$project->description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="date" class="form-control" id="deadline" min="{{date('Y-m-d')}}" name="deadline" value="{{date_format(date_create($project->deadline),'Y-m-d')}}</}}" required>
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
        <div class="modal fade" id="deleteProjects{{$project->id}}" tabindex="-1" aria-labelledby="addProjectsLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete {{$project->name}} Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('projects.destroy',$project->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Are you sure you want to delete this project?</p>
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