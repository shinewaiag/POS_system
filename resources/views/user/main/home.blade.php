
@extends('user.layouts.master')

@section('content')

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="mb-3 section-title position-relative text-uppercase"><span class="pr-3 bg-secondary">Filter by categories</span></h5>
            <div class="p-4 bg-light mb-30">
                <form>
                    <div class="px-3 py-1 mb-3 shadow-sm d-flex align-items-center justify-content-between">
                        <label class="mt-3" for="price-all">Categories</label>
                        <span class="border text-dark badge font-weight-normal">{{count($categories)}}</span>
                    </div>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <a href="{{ route('user#home') }}" class="text-dark">
                            <label class="" for="price-1">All</label>
                        </a>
                    </div>

                    @foreach ($categories as $category)
                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <a href="{{ route('user#filter',$category->id) }}" class="text-dark">
                            <label class="" for="price-1">{{$category->name}}</label>
                        </a>
                    </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->


            <div class="">
                <button class="btn btn-warning w-100">Order</button>
            </div>

        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="pb-3 row">
                <div class="pb-1 col-12">
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div class="">
                            <a href="{{ route('user#cartList') }}">
                                <button type="button" class="btn btn-warning position-relative">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-dark">
                                        {{ count($cart) }}
                                    </span>
                                </button>
                            </a>
                            <a href="{{ route('user#history') }}" class="ms-3">
                                <button type="button" class="btn btn-warning position-relative">
                                    <i class="fa-solid fa-clock-rotate-left"></i>History
                                    <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-dark">
                                        {{ count($history) }}
                                    </span>
                                </button>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">

                                {{-- <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Ascending</a>
                                    <a class="dropdown-item" href="#">Descending</a>
                                </div> --}}
                                <select name="sorting" class="form-control" id="sortingOption">
                                    <option value="">Choose Options...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row" id="myForm">
                    @if (count($product) != 0)
                        @foreach($product as $p)
                        <div class="pb-1 col-lg-4 col-md-6 col-sm-6" >
                            <div class="mb-4 product-item bg-light" >
                                <div class="overflow-hidden product-img position-relative">
                                    <img class="img-fluid w-100" style="height:200px" src="{{ asset('storage/'. $p->image ) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails', $p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                    <div class="mt-2 d-flex align-items-center justify-content-center">
                                        <h5>{{$p->price}} kyats</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <h1 class="text-center text-muted">There are no categories!</h1>
                    @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

@section('scriptSource')
<script>
$(document).ready(function() {
    // $.ajax({
    //     type : 'get',
    //     url : 'http://127.0.0.1:8000/user/ajax/pizzaList',
    //     dataType : 'json',
    //     success : function(response) {
    //         console.log(response);
    //     }
    // })

    $('#sortingOption').change(function() {
        $eventOption = $('#sortingOption').val();

        if($eventOption == 'asc') {

            $.ajax({
                type : 'get',
                url : '/user/ajax/pizzaList',
                data : {'status' : 'asc'},
                dataType : 'json',
                success : function(response) {
                    $list = ``;
                    for($i=0; $i<response.length; $i++){
                        $list += `
                        <div class="pb-1 col-lg-4 col-md-6 col-sm-6" >
                            <div class="mb-4 product-item bg-light" >
                                <div class="overflow-hidden product-img position-relative">
                                    <img class="img-fluid w-100" style="height:200px" src="{{ asset('storage/${response[$i].image}' ) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="mt-2 d-flex align-items-center justify-content-center">
                                        <h5>${response[$i].price} kyats</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }
                    $('#myForm').html($list);
                }
            })

        } else if($eventOption == 'desc') {
            $.ajax({
                type : 'get',
                url : '/user/ajax/pizzaList',
                data : {'status' : 'desc'},
                dataType : 'json',
                success : function(response) {
                    $list = ``;
                    for($i=0; $i<response.length; $i++){
                        $list += `
                        <div class="pb-1 col-lg-4 col-md-6 col-sm-6" >
                            <div class="mb-4 product-item bg-light" >
                                <div class="overflow-hidden product-img position-relative">
                                    <img class="img-fluid w-100" style="height:200px" src="{{ asset('storage/${response[$i].image}' ) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                    </div>
                                </div>
                                <div class="py-4 text-center">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="mt-2 d-flex align-items-center justify-content-center">
                                        <h5>${response[$i].price} kyats</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                    }
                    $('#myForm').html($list);
                }
            })
        }
    })
});
</script>
@endsection

