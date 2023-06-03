@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>

                </div>

                @if (session('createSuccess'))
                <div class="mt-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check p-2"></i>{{ session('createSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('deleteSuccess'))
                <div class="mt-2">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark p-2"></i>{{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                @if (session('updateSuccess'))
                <div class="mt-2">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check p-2"></i>{{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search key: <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('admin#list') }}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" id="" class="form-control" placeholder="Search..." value="{{request('key')}}">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>



                {{-- @if (count($categories) != 0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ( $admin as $a)
                            <tr class="tr-shadow ">
                                <td class="col-2">
                                    @if ($a->image == null)
                                        @if ($a->gender == 'male')
                                            <img style="height:100px, width:100px" src="{{ asset('image/user-profile.png') }}" class=" img-thumbnail" >
                                        @else
                                        <img style="height:100px, width:100px" src="{{ asset('image/female-user.jpg') }}" class=" img-thumbnail" >
                                        @endif
                                    @else
                                        <img style="height:100px, width:100px" src="{{ asset('storage/'. $a->image) }}" class=" img-thumbnail" >
                                    @endif
                                </td>
                                <td id="userId">{{$a->id}}</td>
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->gender}}</td>
                                <td>{{$a->phone}}</td>
                                <td>{{$a->address}}</td>
                                <td class="col-2">
                                    @if (Auth::user()->id == $a->id)
                                    {{$a->role}}
                                    @else
                                    <select name="" class="form-control statusChange" id="">
                                        <option value="user" @if($a->role == 'user') selected @endif>User</option>
                                        <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-data-feature">

                                        {{-- <a href="{{ route('admin#edit', $admin->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a> --}}

                                        @if (Auth::user()->id == $a->id)

                                        @else
                                        <a href="{{route('admin#changeRole', $a->id)}}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin#delete', $a->id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                           @endforeach

                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $admin->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>

                </div>
                {{-- @else
                <h2 class="text-secondary text-center mt-5">There are no categories!</h2>
                @endif --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script>
    $(document).ready(function(){
        //change status
        $('.statusChange').change(function() {
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $userId = $parentNode.find('#userId').html();

            $data = {
                'role' : $currentStatus,
                'userId' : $userId
                };

            $.ajax({
            type : 'get',
            url : '/admin/ajaxChange/role',
            data : $data,
            dataType : 'json',
            })
            location.reload();
        })
    })
</script>
@endsection
