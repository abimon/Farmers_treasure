@extends('layouts.dashboard',['title'=>'Users'])
@section('dashboard')
<div class="container" style="min-height:80vh;">
    <div class="row">
        @foreach ($users as $user)
        <div class="col-md-4 p-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$user->name}}</h3>
                </div>
                <div class="card-body">
                    <div class="row" style="color:black;">
                        <div class="col-5">
                            <img src="/{{$user->avatar==null?'storage/back/img/user.png':$user->avatar}}" alt="" style="width:100%;object-fit:scale-down;">
                            @if(Auth()->user()->id==$user->id)
                            <div class="text-center mt-2"><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#change{{$user->id}}">Change</button></div>
                            <!-- Modal -->
                            <div class="modal fade" id="change{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Change Avatar</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="p-3">
                                                    <img id="out" src="/{{$user->avatar}}" style="width: 100%; object-fit:scale-down;" />
                                                    <input type="file" accept="image/*" name="avatar" id="avatar" style="display: none;" class="form-control" onchange="loadavatarFile(event)">
                                                    <div class="pt-2" id="desc">
                                                        <div class="" id="uploader">
                                                            <div class="text-center" style="font-size: xxx-large; font-weight:bolder;">
                                                                <i class="bi bi-upload"></i>
                                                            </div>
                                                            <div class="text-center text-primary">*Supported files .png .jpg .webp</div>
                                                        </div>
                                                        <div class="text-center">
                                                            <label for="avatar" class="btn btn-success text-white"
                                                                title="Upload new profile image">Browse</label>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        var loadavatarFile = function(event) {
                                                            var image = document.getElementById('out');
                                                            image.src = URL.createObjectURL(event.target.files[0]);
                                                            document.getElementById('avatar').value == image.src;
                                                            document.getElementById('uploader').style.display = 'none';
                                                        };
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-7">
                            <div><strong>Email:</strong> {{ $user->email }}</div>
                            <div><strong>Phone:</strong> {{ $user->phone }}</div>
                            <div><strong>Role:</strong> {{$user->isAdmin?'Admin':'Customer'}}</div>
                            <div><strong>Joined:</strong> {{$user->created_at->diffForHumans()}}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between m-1">
                    <form action="{{route('users.update',$user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="isAdmin" value="{{$user->isAdmin?'0':'1'}}">
                        <button type="submit" class="btn btn-info">{{$user->isAdmin?'Deny Rights':'Make Admin'}}</button>
                    </form>
                    <form action="{{route('users.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection