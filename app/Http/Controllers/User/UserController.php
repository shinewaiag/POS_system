<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     //redirect admin user list page
     public function list(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list', compact('users'));
    }

    //change user role
    public function changeRole(Request $request){
        $role = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($role);
    }

    //edit user list in admin page
    public function edit($id){
        $profile = User::where('id',$id)->first();
        return view('admin.user.edit', compact('profile'));
    }

    //update user list in admin page
    public function update(Request $request,$id){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //image check
        if($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;


            if($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('user#list')->with(['accountUpdateSuccess' => 'Account updated successfully']);
    }



    //delete user list in admin page
    public function delete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account deleted successfully']);
    }

    //user home page
    public function home() {
        $product = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('product', 'categories', 'cart', 'history'));
    }


     //filter products
     public function filter($categoryId) {
        $product = Product::where('category_id',$categoryId)->orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('product', 'categories', 'cart', 'history'));
     }

     //direct pizza details
     public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
     }

     //cart list
     public function cartList() {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as product_image')
                    ->leftJoin('products', 'products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice+= $c->pizza_price * $c->qty;
        }
        return view('user.main.cart', compact('cartList', 'totalPrice'));
     }

     //direct history page
     public function history(){
        $order = Order::where('user_id', Auth::user()->id)->paginate(3);
        return view('user.main.history', compact('order'));
     }

    //change password page
    public function changePasswordPage() {
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $id = Auth::user()->id;
        $user = User::select('password')->where('id', $id)->first();
        $dbPassword = $user->password;
        if(Hash::check($request->oldPassword,$dbPassword)){
            User::where('id', $id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return back()->with(['changePassword'=> 'Password has been changed']);
        }
        return back()->with(['noMatch' => 'The old password did not match the new one']);
    }



    //user account change page
    public function accountChangePage() {
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id,Request $request) {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //image check
        if($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;


            if($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return back()->with(['accountUpdateSuccess' => 'Account updated successfully']);
    }

    //request user data
    private function getUserData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    //account validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }

     //password validation check
     private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:5|max:10',
            'newPassword' => 'required|min:5|max:10',
            'confirmPassword' => 'required|min:5|max:10|same:newPassword',
        ])->validate();
    }
}
