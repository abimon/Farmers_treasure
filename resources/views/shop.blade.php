@extends('layouts.app',['title'=>'Shop'])
@section('content')
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-3">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="volvo">Nothing</option>
                                <option value="saab">Popularity</option>
                                <option value="opel">Organic</option>
                                <option value="audi">Fantastic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#">Fruits</a>
                                                <span>({{App\Models\Product::where('category','Fruits')->count()}})</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#">Vegetables</a>
                                                <span>({{App\Models\Product::where('category','Vegetables')->count()}})</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#">Cereals</a>
                                                <span>({{App\Models\Product::where('category','Cereals')->count()}})</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#">Poutry</a>
                                                <span>({{App\Models\Product::where('category','Poutry')->count()}})</span>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Price</h4>
                                    <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                    <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <button type="submit" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Sort</button>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-3">Discounted products</h4>
                                @foreach (App\Models\Product::all() as $prod)
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="/{{$prod->cover}}" class="img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2">{{$prod->name}}</h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2">Ksh. {{$prod->price}}</h5>
                                            <h5 class="text-danger text-decoration-line-through">{{($prod->price)-($prod->discount)}}</h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            @foreach ($products as $product)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item border border-secondary border-top-0 rounded-bottom">
                                    <div class="fruite-img">
                                        <img src="/{{$product->cover}}" class="img-fluid w-100 rounded-top" alt="" style="height:40vh;object-fit:cover;">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->category}}</div>
                                    <div class="p-2">
                                        <h4 class="text-center">{{$product->name}}</h4>
                                        <p class="text-dark fw-bold text-center mb-2">Ksh. {{$product->price}} / {{$product->units}}</p>
                                        <div class="d-flex justify-content-between">
                                            <a href="/product/{{$product->id}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-eye text-primary"></i> View</a>
                                            <form action="{{route('carts.store',['product_id'=>$product->id])}}" method="post">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-12">
                            {{$products->links('custom')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
@endsection