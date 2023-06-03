@extends('admin.layouts.master')

@section('title', 'Contact List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Contact List</h2>

                        </div>
                    </div>
                </div>
                @if(count($contacts)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table text-center table-data2">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="myForm">
                        @foreach ($contacts as $contact)
                            <tr class="tr-shadow">
                                <td>{{$contact->id}}</td>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->message}}</td>
                                <td>{{$contact->created_at->format('j-F-Y h:m:s A')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $contacts->links() }}
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

