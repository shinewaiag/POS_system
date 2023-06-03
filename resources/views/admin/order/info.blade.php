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
                            <h2 class="title-1"></h2>

                        </div>
                    </div>
                </div>

                <a href="{{ route('order#list') }}" class="text-dark">
                    <i class="fa-solid fa-arrow-left-long me-1"></i>Back
                </a>

                <div class="row col-5">
                    <div class="mt-4 card text-muted">
                        <div class="card-body">
                            <h3 class="text-muted"><i class="fa-solid fa-receipt me-2"></i>Order Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                <div class="col">{{ $orderInfo[0]->user_name }}</div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col">{{ $orderInfo[0]->order_code }}</div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col"><i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                <div class="col">{{ $orderInfo[0]->created_at->format('F-j-Y') }}</div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Total Price</div>
                                <div class="col">{{ $order->total_price}} kyats <small class="text-warning">(Including Delivery Charges)</small></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive table-responsive-data2">

                    <table class="table text-center table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order ID</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="myForm">
                            @foreach ( $orderInfo as $oi)
                            <tr class="tr-shadow ">
                                <td></td>
                                <td>{{$oi->id}}</td>
                                <td class="col-2">
                                    <img src="{{ asset('storage/'.$oi->product_image) }}" class="img-thumbnail" alt="">
                                </td>
                                <td>{{$oi->product_name}}</td>
                                <td>{{$oi->qty}}</td>
                                <td>{{$oi->total}} kyats</td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
