<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request) {
        logger($request->all());
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at', 'desc')->get();
        }else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }

        return response()->json($data, 200);
    }

    //return pizza list
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response =  [
            'status' => 'success',
            'message' => 'completed',
        ];

        return response()->json($response, 200);
    }

    //return order
    public function order(Request $request){
        $total = 0;
         foreach($request->all() as $item){
            $data = OrderList::create([
                'user_id' => $item['userId'],
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);
            $total += $data->total;
         }
         Cart::where('user_id', Auth::user()->id)->delete();

         Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000,

         ]);
         return response()->json([
            'status' => 'true',
            'message' => 'Order Completed'
         ],200);
    }

    //clear cart
    public function clear() {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear current Product
    public function clearCurrentProduct(Request $request) {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->cartId)
            ->delete();

    }

    //increase view count
    public function increaseViewCount(Request $request) {
        $product = Product::where('id', $request->product_id)->first();
        $viewCount = [
            'view_count' => $product->view_count+1,
        ];
        Product::where('id', $request->product_id)->update($viewCount);
    }

    //get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ];
    }
}
