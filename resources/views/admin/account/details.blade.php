@extends('admin.layouts.master')

@section('title', 'Account Information')

@section('content')
<div class="main-content">
    <div class="row col-8 offset-2">
        @if (session('accountUpdateSuccess'))
                <div class="mt-2">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check p-2"></i>{{ session('accountUpdateSuccess') }}
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
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/user-profile.png')}}" />
                                    @else
                                        <img src="{{ asset('image/female-user.jpg')}}" />
                                    @endif
                                @else
                                <img src="{{ asset('storage/'.Auth::user()->image) }}" />
                                @endif
                            </div>
                            <div class="col-5 offset-1">
                                <form action="">
                                    @csrf
                                    <div class="form-group">
                                        <h4 class="my-3 text-muted"><i class="fa-solid fa-pen me-2"></i>{{ Auth::user()->name }}</h4>
                                        <h4 class="my-3 text-muted"><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                        <h4 class="my-3 text-muted"><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                        <h4 class="my-3 text-muted"><i class="fa-solid fa-address-book me-2"></i>{{ Auth::user()->address }}</h4>
                                        <h4 class="my-3 text-muted"><i class="fa-solid fa-venus-mars me-2"></i>{{ Auth::user()->gender }}</h4>
                                        <h4 class="my-3 text-muted"><i class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 offset-6">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn btn-dark mt-2">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>Edit Account
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
