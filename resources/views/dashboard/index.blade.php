@extends('layouts.dashboard',['title' => 'Index'])
@section('dashboard')
<div class="" style="min-height:80vh;">
@if (Auth()->user()->isAdmin)
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Sale</p>
                    <h6 class="mb-0">Ksh. {{App\Models\POrder::whereDate('p_orders.created_at',date('Y-m-d'))->join('products','products.id','=','p_orders.product_id')->selectRaw('SUM(p_orders.quantity * products.price) as total')->value('total')}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sale</p>
                    <h6 class="mb-0">Ksh. {{number_format(App\Models\POrder::join('products','products.id','=','p_orders.product_id')->selectRaw('SUM(p_orders.quantity * products.price) as total')->value('total'),2)}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Revenue</p>
                    <h6 class="mb-0">Ksh. {{number_format(App\Models\Finance::whereDate('created_at',date('Y-m-d'))->where('type','revenue')->sum('amount'),0)}}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">Ksh. {{number_format(App\Models\Finance::where('type','revenue')->sum('amount'),0)}}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->
<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Messages</h6>
                    <a href="">Show All</a>
                </div>
                @foreach (App\Models\Message::where('status','pending')->get() as $message)
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="/storage/back/img/user.png" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">{{$message->name}}</h6>
                            <small>{{$message->created_at->diffForHumans()}}</small>
                        </div>
                        <span>{{$message->message}}</span>
                        <div class="d-flex align-items-end mt-2">
                            <a href="/message/read/{{$message->id}}" class="fa fa-reply"></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                    <!-- <a href="">Show All</a> -->
                </div>
                <div id="calender"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <!-- <a href="">Show All</a> -->
                </div>
                <form class="d-flex mb-2" action="{{route('tasks.store')}}" method="post">
                    @csrf
                    <input class="form-control bg-transparent" type="text" name="title" placeholder="Enter task">
                    <button type="submit" class="btn btn-primary ms-2">Add</button>
                </form>
                @foreach (App\Models\Task::where('user_id',Auth()->user()->id)->get() as $task)
                <div class="d-flex align-items-center border-bottom py-2">
                    <form action="{{route('tasks.update',$task->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input class="form-check-input m-0" name='status' value="{{$task->isCompleted?'0':'1'}}" type="checkbox" {{$task->isCompleted?'checked':''}} onchange="this.form.submit()">
                    </form>
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>
                                @if($task->isCompleted)
                                <del>{{$task->title}}</del>
                                @else
                                <strong>{{$task->title}}</strong>
                                @endif
                            </span>
                            <form action="{{route('tasks.destroy',$task->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm text-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Widgets End -->
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Today's Orders</h6>
            <a href="{{route('orders.index')}}">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0" style="white-space:nowrap;">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Address</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Order::whereDate('created_at',date('Y-m-d'))->take(10)->latest()->get() as $order)

                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>{{date_format($order->created_at,'j F, Y')}}</td>
                        <td>{{$order->receipt_no}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->address}}</td>
                        <td style="text-transform:capitalize;">{{$order->payment_mode}}</td>
                        <td><a class="btn btn-sm btn-primary" href="{{route('orders.show',$order->receipt_no)}}">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->
@endif
</div>
@endsection