@extends('admin.layouts.master')

@section('title', 'Edit Profile')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin#list') }}">
                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left text-black" onclick="history.back()"></i>
                        </div>
                    </a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#change',$account->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($account->image == null)
                                    @if ($account->gender == 'male')
                                        <img src="{{ asset('image/user-profile.png')}}" />
                                    @else
                                        <img src="{{ asset('image/female-user.jpg')}}" />
                                    @endif
                                    @else
                                    <img src="{{ asset('storage/'. $account->image) }}" />
                                    @endif



                                </div>
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" disabled name="name" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('name',$account->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role" class="control-label mb-1">role</label>
                                        <select name="role" id="" class="form-control @error('role') is-invalid @enderror">
                                            <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                        </select>
                                        {{-- <input id="role" disabled name="role" type="role"  class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('role',$account->role) }}"> --}}
                                        @error('role')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="control-label mb-1">email</label>
                                        <input id="email" disabled name="email" type="email"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('email',$account->email) }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="control-label mb-1">phone</label>
                                        <input id="phone" disabled name="phone" type="number"  class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('phone',$account->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="control-label mb-1">Gender</label>
                                        <select name="gender" disabled id="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if ($account->gender == 'male') selected  @endif>Male</option>
                                            <option value="female" @if ($account->gender == 'female') selected  @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">address</label>
                                        <textarea name="address" disabled class="form-control" id="address" cols="30" rows="10">{{ old('address',$account->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>



                                    <div class="">
                                        <button class="btn btn-dark" type="submit">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Change
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
