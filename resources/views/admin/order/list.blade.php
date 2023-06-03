@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>

                <form action="{{ route('order#Status') }}" method="get">
                @csrf
                    <div class="mb-3 input-group">
                        <select class="form-select col-2 me-1" name="orderStatus" id="inputGroupSelect02">
                            <option value="all" >All</option>
                            <option value="0" @if(request('orderStatus')==0) selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus')==1) selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus')==2) selected @endif>Reject</option>
                        </select>
                        <button class="btn btn-dark input-group-text" type="submit">Search</button>
                    </div>
                </form>

                @if (count($orders) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table text-center table-data2">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Order Code</th>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="myForm">
                           @foreach ( $orders as $order)
                            <tr class="tr-shadow ">
                                <td id="orderId">{{$order->id}}</td>
                                <td>
                                    <a href="{{ route('order#info',$order->order_code) }}">{{$order->order_code}}</a>
                                </td>
                                <td>{{$order->user_id}}</td>
                                <td>{{$order->user_name}}</td>
                                <td>{{$order->created_at->format('F-j-Y')}}</td>
                                <td>{{$order->total_price}} kyats</td>
                                <td>
                                    <select name="status" class="form-control statusChange">
                                        <option value="0" @if ($order->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if ($order->status == 1) selected @endif>Accept</option>
                                        <option value="2" @if ($order->status == 2) selected @endif>Reject</option>
                                    </select>
                                </td>
                                <td>
                                </td>
                            </tr>
                           @endforeach

                        </tbody>
                    </table>
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
        // $('#orderStatus').change(function(){
        //     $status = $('#orderStatus').val();
        //     $.ajax({
        //         type : 'get',
        //         url : 'http://127.0.0.1:8000/order/ajax/status',
        //         data : {
        //             'status' : $status,
        //         },
        //         dataType : 'json',
        //         success : function(response) {
        //             $list = ``;
        //             for($i=0; $i<response.length; $i++){

        //                 $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        //                 $dbDate = new Date(response[$i].created_at);
        //                 $finalDate = $months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();

        //                 if(response[$i].status == 0){
        //                     $statusMessage = `
        //                     <select name="status" class="form-control statusChange">
        //                         <option value="0" selected>Pending</option>
        //                         <option value="1">Accept</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `;
        //                 }else if(response[$i].status == 1){
        //                     $statusMessage = `
        //                     <select name="status" class="form-control statusChange">
        //                         <option value="0" >Pending</option>
        //                         <option value="1" selected>Accept</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `;
        //                 }else{
        //                     $statusMessage = `
        //                     <select name="status" class="form-control statusChange">
        //                         <option value="0" >Pending</option>
        //                         <option value="1" >Accept</option>
        //                         <option value="2" selected>Reject</option>
        //                     </select>
        //                     `;
        //                 }

        //                 $list += `
        //                 <tr class="tr-shadow ">
        //                         <td id="orderId">${response[$i].id}</td>
        //                         <td>${response[$i].user_id}</td>
        //                         <td>${response[$i].user_name}</td>
        //                         <td>${$finalDate}</td>
        //                         <td>${response[$i].order_code}</td>
        //                         <td>${response[$i].total_price}</td>
        //                         <td>${$statusMessage}</td>
        //                         <td>
        //                         </td>
        //                 </tr>
        //                 `;
        //             }
        //             $('#myForm').html($list);
        //         }
        //     })
        // })

        //change status
        $('.statusChange').change(function() {
            $currentStatus = $(this).val();
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('#orderId').html();

            $data = {
                'status' : $currentStatus,
                'order_id' : $orderId
                };
                console.log($data);

            $.ajax({
                type : 'get',
                url : 'http://127.0.0.1:8000/order/ajax/change/status',
                data : $data,
                dataType : 'json',
                success : function(response) {

                }
            })
        })
    })
</script>
@endsection
