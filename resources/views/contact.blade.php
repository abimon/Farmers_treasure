@extends('layouts.app',['title'=>'Contact Us'])
@section('content')
<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Get in touch</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="/message" class="" method="POST">
                        @csrf
                        <input name="name" type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name">
                        <input name="email" type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
                        <input name="phone_number" type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Phone Number">
                        <textarea name="message" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message"></textarea>
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <!-- <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">123 Street New York.USA</p>
                        </div>
                    </div> -->
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">info@farmerstreasure.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mobile</h4>
                            <p class="mb-2">+254 728 886 217</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection