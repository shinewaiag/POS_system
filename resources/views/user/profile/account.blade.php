
@extends('user.layouts.master')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Profile</h3>
                        </div>
                        <hr>

                        @if (session('accountUpdateSuccess'))
                            <div class="mt-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-check p-2"></i>{{ session('accountUpdateSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('user#accountChange',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                        <img  src="{{ asset('image/user-profile.png')}}" class="img-thumbnail shadow-sm" />
                                    @else
                                        <img  src="{{ asset('image/female-user.jpg')}}" class="img-thumbnail shadow-sm" />
                                    @endif
                                    @else
                                    <img  src="{{ asset('storage/'. Auth::user()->image) }}" class="img-thumbnail shadow-sm" />
                                    @endif

                                    <div class="mt-5">
                                        <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror"">
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" name="name" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('name',Auth::user()->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="control-label mb-1">email</label>
                                        <input id="email" name="email" type="email"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('email',Auth::user()->email) }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="control-label mb-1">phone</label>
                                        <input id="phone" name="phone" type="number"  class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('phone',Auth::user()->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="control-label mb-1">Gender</label>
                                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected  @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected  @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30" rows="10">{{ old('address',Auth::user()->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role" class="control-label mb-1">role</label>
                                        <input id="role" disabled name="role" type="role"  class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('role',Auth::user()->role) }}">
                                        @error('role')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <button class="btn btn-dark" type="submit">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Update
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
