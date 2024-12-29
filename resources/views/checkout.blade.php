@extends('layouts.app',['title'=>'Checkout'])
@section('content')
<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        
        <form action="{{route('orders.store')}}" method="post">
            @csrf
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                <h1 class="mb-4">Billing details</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-item">
                                <label class="form-label my-3">Full Name<sup>*</sup></label>
                                <input type="text" name="fname" class="form-control" value="{{Auth()->user()->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-6 form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" name="address" class="form-control" placeholder="Town & Pickup Point" value="{{Auth()->user()->address}}" required>
                        </div>
                        <div class="col-md-6 form-item">
                            <label class="form-label my-3">Mobile Number<sup>*</sup></label>
                            <input type="tel" name="phone" class="form-control" value="{{Auth()->user()->phone}}" required>
                        </div>
                        <div class="col-md-6 form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" name="email" class="form-control" value="{{Auth()->user()->email}}" required>
                        </div>
                        <div class="col-md--6 form-check my-3">
                            <input type="checkbox" class="form-check-input" id="Account-1" name="saveAddress" value="1">
                            <label class="form-check-label" for="Account-1">Save Address?</label>
                        </div>
                        <hr>
                        <div class="col-md-12form-item">
                            <textarea name="text" class="form-control" name="note" spellcheck="false" cols="5" rows="11" placeholder="Order Notes (Optional)"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\Cart::where('user_id',Auth()->user()->id)->get() as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="/{{$item->product->cover}}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">{{$item->product->name}}</td>
                                    <td class="py-5">{{$item->product->price}}</td>
                                    <td class="py-5">{{$item->quantity.' '.$item->product->units}}</td>
                                    <td class="py-5">{{($item->quantity)*($item->product->price)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-start text-dark">Please use your Order ID(<b></b>) as the payment reference. Your order will not be shipped until the payment has been cleared in our account.</p>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-1">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1" name="payment_mode" value="cash" checked>
                                <label class="form-check-label" for="Delivery-1">Cash</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-1">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1" name="payment_mode" value="paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-1">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1" name="payment_mode" value="pesapal">
                                <label class="form-check-label" for="Paypal-1">Pesapal</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-1">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Payments-1" name="payment_mode" value="cheque">
                                <label class="form-check-label" for="Payments-1">Cheque</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-1">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1" name="payment_mode" value="bank">
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                        </div>
                    </div>
                    @if (App\Models\Cart::where('user_id',Auth()->user()->id)->count()>0)

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->
@endsection