@extends('admin.layouts.master')

@section('title', 'Edit Profile')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Product</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <img src="{{ asset('storage/'. $product->image) }}" />


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
                                        <label for="name" class="mb-1 control-label">Name</label>
                                        <input id="name" name="name" type="text"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('name',$product->name) }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="mb-1 control-label">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="10">{{ old('description',$product->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category" class="mb-1 control-label">category</label>
                                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($category as $c)
                                            <option value="{{$c->id}}" @if ($product->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="mb-1 control-label">price</label>
                                        <input id="price" name="price" type="number"  class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('price',$product->price) }}">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="waitingTime" class="mb-1 control-label">Waiting Time</label>
                                        <input id="waitingTime" name="waitingTime" type="number"  class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('waitingTime',$product->waiting_time) }}">
                                        @error('waitingTime')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="viewCount" class="mb-1 control-label">View Count</label>
                                        <input id="viewCount" name="viewCount" type="number"  class="form-control" disabled aria-required="true" aria-invalid="false" value="{{ $product->view_count }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="created_at" class="mb-1 control-label">Created Date</label>
                                        <input id="created_at" name="created_at" type="text"  class="form-control" disabled aria-required="true" aria-invalid="false" value="{{ $product->created_at->format('j-F-Y') }}">
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
