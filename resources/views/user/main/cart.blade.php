@extends('user.layouts.master')

@section('content')




<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="mb-5 col-lg-8 table-responsive">
            <table class="table mb-0 text-center table-light table-borderless table-hover" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $c)
                    <tr>

                        <td class="align-middle img-thumbnail"><img src="{{ asset('storage/'. $c->product_image) }}" alt="" style="width: 100px;"></td>
                        <td class="align-middle">
                            {{$c->pizza_name}}
                            <input type="hidden" id="cartId" value="{{ $c->id }}">
                            <input type="hidden" id="productId" value="{{ $c->product_id }}">
                            <input type="hidden" id="userId" value="{{ $c->user_id }}">
                        </td>
                        <td class="align-middle" id="pizzaPrice">{{$c->pizza_price}} kyats</td>
                        <td class="align-middle">
                            <div class="mx-auto input-group quantity" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>

                                <input type="text" class="text-center border-0 form-control form-control-sm bg-secondary" id="qty" value="{{$c->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{ $c->pizza_price * $c->qty }} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="mb-3 section-title position-relative text-uppercase"><span class="pr-3 bg-secondary">Cart Summary</span></h5>
            <div class="mb-5 bg-light p-30">
                <div class="pb-2 border-bottom">
                    <div class="mb-3 d-flex justify-content-between">
                        <h6>Subtotal</h6>
                        <h6 id="subTotalPrice">{{$totalPrice}} kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery Fee</h6>
                        <h6 class="font-weight-medium">3000 kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="mt-2 d-flex justify-content-between">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{ $totalPrice + 3000 }} kyats</h5>
                    </div>
                    <button class="py-3 my-3 btn btn-block btn-primary font-weight-bold" id="orderBtn">Proceed To Checkout</button>
                    <button class="py-3 my-3 btn btn-block btn-danger font-weight-bold" id="clearBtn">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@section('scriptSource')
   <script src="{{ asset('user/js/cart.js') }}"></script>
   <script>
    $('#orderBtn').click(function() {

        $orderList = [];
        $random = Math.floor(Math.random() * 1000000001)

        $('#dataTable tbody tr').each(function(index,row) {
            $orderList.push({
                'userId' : $(row).find('#userId').val(),
                'productId' : $(row).find('#productId').val(),
                'qty' : $(row).find('#qty').val(),
                'total' : $(row).find('#total').text().replace('kyats','')*1,
                'order_code' :'POS'+$random,
            })
        })
        $.ajax({
                type : 'get',
                url : '/user/ajax/order',
                data : Object.assign({}, $orderList),
                dataType : 'json',
                success : function(response) {
                    if(response.status == 'true') {
                        window.location.href = "http://127.0.0.1:8000/user/home";
                    }
                }
            })
    })
    $('#clearBtn').click(function() {

        $.ajax({
                type : 'get',
                url : '/user/ajax/clear/cart',
                dataType : 'json',
            })
        $('#dataTable tbody tr').remove();
        $('#subTotalPrice').html(`0 kyats`);
        $('#finalPrice').html(`3000 kyats`);
    })

    //remove button clicking
    $('.btnRemove').click(function(){
        $parentNode = $(this).parents('tr')
        $productId = $parentNode.find('#productId').val();
        $cartId = $parentNode.find('#cartId').val();
        $.ajax({
                type : 'get',
                url : '/user/ajax/clear/current/product',
                data : {'productId' : $productId, 'cartId' : $cartId},
                dataType : 'json',
            })
        $parentNode.remove();
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row) {
            $totalPrice += Number($(row).find('#total').text().replace('kyats', ''));
        })
        $('#subTotalPrice').html(`${$totalPrice} kyats`);
        $('#finalPrice').html(`${$totalPrice+3000} kyats`);
    })
   </script>
@endsection
