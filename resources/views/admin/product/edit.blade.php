@extends('admin.layouts.master')

@section('title', 'Account Information')

@section('content')
<div class="main-content">
    <div class="row col-8 offset-2">
        @if (session('accountUpdateSuccess'))
                <div class="mt-2">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="p-2 fa-solid fa-circle-check"></i>{{ session('accountUpdateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            {{-- <a href="{{ route('product#list') }}" class="text-decoration-none"> --}}
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            {{-- </a> --}}
                        </div>
                        <div class="card-title">
                            {{-- <h3 class="text-center title-2">Product Info</h3> --}}
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">

                                <img src="{{ asset('storage/'.$product->image) }}" />

                            </div>
                            <div class="col-7">
                                <form action="">
                                    @csrf
                                    <div class="form-group">
                                        <span class="my-3 btn btn-dark "><i class="fa-solid text-danger fa-pizza-slice me-2"></i>{{ $product->name }}</span>
                                        <span class="my-3 btn btn-dark "><i class="fa-solid text-primary fa-money-bill-wave me-2"></i>{{ $product->price }} kyats</span>
                                        <span class="my-3 btn btn-dark "><i class="fa-solid text-warning fa-clock me-2"></i>{{ $product->waiting_time }} mins</span>
                                        <span class="my-3 btn btn-dark "><i class="fa-regular text-info fa-eye me-2"></i>{{ $product->view_count }}</span>
                                        <span class="my-3 btn btn-dark "><i class="fa-regular fa-clone me-2"></i>{{ $product->category_id }}</span>
                                        <span class="my-3 btn btn-dark "><i class="fa-solid text-success fa-user-clock me-2"></i>{{ $product->created_at->format('j-F-Y') }}</span>
                                        <div class="my-3 text-muted"><i class="fa-solid fa-file-lines me-2"></i>Detials</div>
                                        <div class="my-3 text-muted">{{ $product->description }}</div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 offset-5">
                                <a href="{{ route('product#updatePage', $product->id) }}">
                                    <button class="mt-2 btn btn-dark">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>Edit Product
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
