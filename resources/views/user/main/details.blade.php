@extends('user.layouts.master')

@section('content')

<!-- Shop Detail Start -->
<div class="pb-5 container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div class="">
                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
            </div>
            <div id="product-carousel" class="mt-3 carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{asset('storage/'. $pizza->image)}}" alt="Image">
                    </div>
                </div>
            </div>
        </div>

        <div class="h-auto mt-5 col-lg-7 mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{$pizza->name}}</h3>
                <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">
                <input type="hidden" name="" value="{{ $pizza->id }}" id="pizzaId">
                <div class="mb-3 d-flex">
                    <div class="mr-2 text-primary">
                        {{-- <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small> --}}
                    </div>
                    <small class="pt-1">{{$pizza->view_count + 1}} <i class="fa-solid fa-eye"></i></small>
                </div>
                <h3 class="mb-4 font-weight-semi-bold">{{$pizza->price}} kyats</h3>
                <p class="mb-4">{{$pizza->description}}</p>
                <div class="pt-2 mb-4 d-flex align-items-center">
                    <div class="mr-3 input-group quantity" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="text-center border-0 form-control bg-secondary" value="1" id="orderCount">

                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="px-3 btn btn-primary" id="addCartBtn"><i class="mr-1 fa fa-shopping-cart"></i> Add To
                        Cart</button>
                </div>
                <div class="pt-2 d-flex">
                    <strong class="mr-2 text-dark">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="px-2 text-dark" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="px-2 text-dark" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="px-2 text-dark" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="px-2 text-dark" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="py-5 container-fluid">
    <h2 class="mb-4 section-title position-relative text-uppercase mx-xl-5"><span class="pr-3 bg-secondary">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($pizzaList as $list)
                <div class="product-item bg-light">
                    <div class="overflow-hidden product-img position-relative">
                        <img class="img-fluid w-100" src="{{asset('storage/'. $list->image)}}" style="height: 250px" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails', $list->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                        </div>
                    </div>
                    <div class="py-4 text-center">
                        <a class="h6 text-decoration-none text-truncate" href="">{{$list->name}}</a>
                        <div class="mt-2 d-flex align-items-center justify-content-center">
                            <h5>{{$list->price}} kyats</h5><h6 class="ml-2 text-muted"></h6>
                        </div>
                        <div class="mb-1 d-flex align-items-center justify-content-center">
                            <small class="mr-1 fa fa-star text-primary"></small>
                            <small class="mr-1 fa fa-star text-primary"></small>
                            <small class="mr-1 fa fa-star text-primary"></small>
                            <small class="mr-1 fa fa-star text-primary"></small>
                            <small class="mr-1 fa fa-star text-primary"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            </div>
        </div>
    </div>
</div>
<!-- Products End -->


@endsection

@section('scriptSource')
<script>
    $(document).ready(function() {

        //increase view count
        $.ajax({
                type : 'get',
                url : '/user/ajax/increase/viewCount',
                data : {'product_id' : $('#pizzaId').val(),},
                dataType : 'json',
            })

        //add to cart
        $('#addCartBtn').click(function() {

            $source = {
                'count' : $('#orderCount').val(),
                'pizzaId' : $('#pizzaId').val(),
                'userId' : $('#userId').val()
            };
            $.ajax({
                'type' : 'get',
                'url' : '/user/ajax/addToCart',
                'data' : $source,
                'dataType' : 'json',
                'success' : function(response) {
                    if(response.status == 'success') {
                        window.location.href = "/user/home";
                    }
                }
            })
        })
    })
</script>

@endsection
