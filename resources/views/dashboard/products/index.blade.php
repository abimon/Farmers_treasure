@extends('layouts.dashboard',['title'=>'Products'])
@section('dashboard')
<div class="container mt-3" style="min-height:80vh;">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <h4>Products</h4>
                <a href="{{route('products.create')}}" class="btn btn-primary">Add New Product</a>
            </div>
            <div class="table-responsive">
            <table class="table text-start align-middle table-striped table-hover mb-0" >
                <thead>
                    <tr style="color:black;">
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="color:black;">
                        <td>
                            {{$loop->index + 1}} <br>
                            <i class="text-info fa fa-plus-circle" type="button" id="btn-{{$product->id}}" onclick="ShowDetails(<?php echo $product->id ?>)"></i>
                            <i class="text-info fa fa-minus-circle" type="button" style="display:none;" id="btn2-{{$product->id}}" onclick="HideDetails(<?php echo $product->id ?>)"></i>
                        </td>
                        <td style="white-space:nowrap;">
                            <img src="/{{$product->cover}}" alt="" style="width:10vw; border-radius:12px;"><br>
                            {{ $product->name }}
                        </td>
                        <td>
                            <div style="height:12vh; overflow:hidden; width:50vw;" id="description-{{$product->id}}"><?php echo html_entity_decode($product->description); ?></div>

                        </td>
                        <td style="white-space:nowrap;">{{ $product->price }} Per {{$product->units}}</td>
                        <td>
                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                        <form action="{{route('products.destroy', $product->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
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
                            desc.style.height = "12vh";
                            document.getElementById("btn-" + id).style.display = "";
                            document.getElementById("btn2-" + id).style.display = "none";
                        }
                    </script>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection