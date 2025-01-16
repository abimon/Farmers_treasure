@extends('layouts.dashboard',['title'=>'Financial records'])
@section('dashboard')
<div class="container-fluid pt-4 px-4" style="min-height:80vh;">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0">Finance Records</h6>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecord"><i class="fa fa-plus"></i> Add Record</button>
    </div>
    <!-- //modal -->
    <!-- Modal -->
    <div class="modal fade" id="addRecord" tabindex="-1" aria-labelledby="addRecordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordLabel">Add Finance Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('finances.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- form -->
                        <div class="mb-3">
                            <label for="project" class="form-label">Project</label>
                            <select class="form-select" id="project" name="project_id">
                                @foreach (App\Models\Project::select('name','id')->get() as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="revenue">Revenue</option>
                                <option value="expense">Expense</option>
                                <option value="sale">Sales</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-0" style="white-space:nowrap;">
            <thead>
                <tr class="text-dark">
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Project</th>
                    <th scope="col">Sales</th>
                    <th scope="col">Revenue</th>
                    <th scope="col">Expense</th>
                    <th scope="col">Logged By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{date_format($record->created_at,'jS F, Y')}}</td>
                    <td>{{$record->description}}</td>
                    @if ($record->type=='sale')
                    <td>{{$record->amount}}</td>
                    <td></td>
                    <td></td>
                    @elseif($record->type=='revenue')
                    <td></td>
                    <td>{{$record->amount}}</td>
                    <td></td>
                    @else
                    <td></td>
                    <td></td>
                    <td>{{$record->amount}}</td>
                    @endif
                    <td>{{$record->user->name}}</td>
                    <td><a class="btn btn-sm btn-primary" href="" data-bs-toggle="modal" data-bs-target="#Record{{$record->id}}">Detail</a></td>
                </tr>
                <div class="modal fade" id="Record{{$record->id}}" tabindex="-1" aria-labelledby="addRecordLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRecordLabel">Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><b>Project:</b> {{$record->project->name}}</p>
                                <p><b>Type:</b> @if($record->type=='sale') Sale @elseif($record->type=='revenue') Revenue @else Expense @endif</p>
                                <p><b>Description:</b> {{$record->description}}</p>
                                <p><b>Amount: Ksh. {{$record->amount}}</b></p>
                                <p><b>Logged By:</b> {{$record->user->name}}</p>
                                <p><b>Logged At:</b> {{date_format($record->created_at,'jS F, Y')}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                
                                <button type="button" class="btn btn-danger" href="{{route('finances.destroy', $record->id)}}" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <?php
                $rev = $records->where('type', 'revenue')->sum('amount');
                $exp = $records->where('type', 'expense')->sum('amount');
                $sales = $records->where('type', 'sale')->sum('amount');
                $balance = $rev - $exp;
                ?>
                <tr style="color:black; font-weight:bold;">
                    <td></td>
                    <td colspan="4"></td>
                    <td class="text-end"><b>Total Revenue</b></td>
                    <td class="text-end">{{number_format($rev,2)}}</td>
                </tr>
                <tr style="color:black; font-weight:bold;">
                    <td></td>
                    <td colspan="4"></td>
                    <td class="text-end"><b>Total Expenses</b></td>
                    <td class="text-end" style="color:red;">-{{number_format($exp,2)}}</td>
                </tr>
                <tr style="color:black; font-weight:bold;">
                    <td></td>
                    <td colspan="4"></td>
                    <td class="text-end"><b>Balance</b></td>
                    <td colspan="3" class="text-end  {{$balance<=0?'text-danger':''}}" style="text-decoration-line: underline;text-decoration-style: double;">{{number_format($balance,2)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection