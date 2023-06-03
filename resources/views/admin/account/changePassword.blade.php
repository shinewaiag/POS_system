@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        @if (session('changePassword'))
                            <div class="mt-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-key me-2"></i>{{ session('changePassword') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                <input id="oldPassword" name="oldPassword" type="password"  class="form-control @if(session('noMatch')) is-invalid @endif  @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @if(session('noMatch'))
                                <div class="invalid-feedback">
                                    {{session('noMatch')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="newPassword" class="control-label mb-1">New Password</label>
                                <input id="newPassword" name="newPassword" type="password"  class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new password">
                                @error('newPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                <input id="confirmPassword" name="confirmPassword" type="password"  class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter confirm password">
                                @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key"></i>
                                    <span id="payment-button-amount">Change password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
