@extends('admin.layouts.master')

@section('title', 'User List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>
                </div>
                @if (session('deleteSuccess'))
                <div class="mt-2">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark p-2"></i>{{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (session('accountUpdateSuccess'))
                <div class="mt-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark p-2"></i>{{ session('accountUpdateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                @if (count($users) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table text-center table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="myForm">
                        @foreach ($users as $user)
                            <tr class="tr-shadow ">
                                <td class="col-2">
                                    @if ($user->image == null)
                                        @if ($user->gender == 'male')
                                            <img src="{{ asset('image/user-profile.png')}}" />
                                        @else
                                            <img src="{{ asset('image/female-user.jpg')}}" />
                                        @endif
                                        @else
                                        <img src="{{ asset('storage/'.$user->image) }}" />
                                    @endif
                                </td>
                                <td id="userId">{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td class="col-2">
                                    <select name="" class="form-control statusChange" id="">
                                        <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                        <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('user#edit', $user->id)}}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('user#delete', $user->id)}}">
                                            <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
                @else
                <h2 class="mt-5 text-center text-secondary">There are no lists!</h2>
                @endif
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
            $parentNode = $(this).parents("tr");
            $userId = $parentNode.find('#userId').html();

            $data = {
                'role' : $currentStatus,
                'userId' : $userId
                };

            $.ajax({
                type : 'get',
                url : '/user/change/role',
                data : $data,
                dataType : 'json',
            })
            location.reload();
        })
    })
</script>
@endsection
