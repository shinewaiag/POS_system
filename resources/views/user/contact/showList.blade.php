@extends('user.layouts.master')

@section('content')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="mb-5 col-lg-8 offset-2 table-responsive">
            <h2 class="text-center text-uppercase text-warning mb-5">Contact Us</h2>
            @if (session('sendSuccess'))
                <div class="mt-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check p-2"></i>{{ session('sendSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
            <form class="row g-3" action="{{route('contact#addList')}}" method="post">
                @csrf
                <div class="col-md-6">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" id="inputName">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                  </div>
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="inputEmail4">
                  @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Message</label>
                 <textarea  class="form-control @error('message') is-invalid @enderror" name="message" id="" cols="30" rows="10">{{old('message')}}</textarea>
                 @error('message')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane me-2"></i>Send</button>
                </div>
              </form>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection


