@extends('layouts.app',['title'=>'My Cart'])
@section('content')

<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">


        <div class="row g-4 justify-content-end">
            <div class="col-8">
                @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $cart)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="/{{$cart->product->cover}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->product->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{$cart->product->price}}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{$cart->quantity}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{($cart->product->price)*($cart->quantity)}}</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0">{{$sum}}</p>
                        </div>
                        <!-- <div class="mt-5 d-flex justify-content-between">
                            <input type="text" class="border-0 border-bottom rounded me-3 mb-2" placeholder="Coupon Code">
                            <button class="btn border-secondary mb-2 text-primary" type="button">Apply</button>
                        </div> -->
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <div class="">
                                <p class="mb-0">Flat rate: Ksh. {{'250.00'}}</p>
                            </div>
                        </div>
                        <!-- <p class="mb-0 text-end">Shipping to Ukraine.</p> -->
                    </div>
                    <div class="py-4 mb-4 border-top  d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4 fw-bold text-primary">Ksh. {{$sum+250}}</p>
                    </div>
                    @if($products->count() > 0)
                    <form action="{{route('orders.create')}}" method="get">
                        @csrf
                        <div class="modal-footer">
                            <button class="btn border-secondary rounded-pill px-3 py-2 text-primary text-uppercase mb-4 ms-4" type="submit">Proceed Checkout</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
@endsection