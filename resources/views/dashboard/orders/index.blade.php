@extends("layouts.dashboard",['title'=>'Orders'])
@section('dashboard')
<div class="container mt-3" style="min-height:80vh;">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <h4>Orders</h4>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle  mb-0">
                    <thead>
                        <tr style="color:black;">
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Customer</th>
                            <th>Payment</th>
                            <th>Delivery</th>
                            <th colspan="3" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr class="{{ $order->isDelivered?'text-white bg-primary':'text-black bg-warning' }}">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $order->receipt_no }}-{{ $order->id }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->quantity }} {{ $order->product->units }}</td>
                            <td>
                                {{ $order->user->name }}
                                <div class="small">{{ $order->user->email }}</div>
                                <div class="small">{{ $order->user->phone }}</div>
                            </td>
                            <td>
                            <input type="checkbox" {{ $order->isPaid?'checked':''}} readonly>
                            </td>
                            <td>
                                <input type="checkbox" {{ $order->isDelivered?'checked':''}} readonly>
                            </td>
                            <td>
                                <form action="{{ route('orders.update', $order->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="isPaid" value="{{$order->isPaid?'0':'1'}}">
                                    <button type="submit" class="btn btn-info btn-sm">{{ $order->isPaid?'Mark Unpaid':'Mark Paid' }}</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('orders.update', $order->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="isDelivered" value="{{$order->isDelivered?'0':'1'}}">
                                    <button type="submit" class="btn btn-info btn-sm">{{ $order->isDelivered?'Mark Undelivered':'Mark Delivered' }}</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection