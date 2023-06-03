<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList() {
        $products = Product::get();
        $users = User::get();
        $data = [
            'products' => $products,
            'users' => $users
        ];
        return response()->json($data, 200);
    }

    //view category list
    public function categoryList() {
        $categories = Category::get();
        return response()->json($categories, 200);
    }


    //create category
    public function createCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now(),
        ];
        $response = Category::create($data);
        return response()->json($response, 200);

    }

    //create contact list
    public function createContact(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Contact::create($data);
        return response()->json($response, 200);
    }


    //delete category
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->id)->first();
        if(isset($data))
        {
            Category::where('id', $request->id)->delete();
            return response()->json(['status' => 'true','message' => 'delete success'],200);
        }
        return response()->json(['status' => 'false','message' => 'Not found'],404);

    }

    //view category details
    public function categoryDetails(Request $request)
    {
        $data = Category::where('id', $request->id)->first();
        if(isset($data))
        {
            return response()->json(['status' => 'true', 'category' => $data],200);
        }
        return response()->json(['status' => 'false','message' => 'Not found'],404);
    }

    //category update
    public function categoryUpdate(Request $request)
    {
        $id = $request->id;
        $dbSource = Category::where('id', $id)->first();
        if(isset($dbSource)){
            $data = $this->getCategoryData($request);
            Category::where('id',$id)->update($data);
            $response = Category::where('id', $id)->first();
            return response()->json(['status' => 'true', 'message' => 'success', 'category' => $response],200);
        }
        return response()->json(['status' => 'false','message' => 'Not found'],404);
    }

    //get category data
    private function getCategoryData($request) {
        return [
            'name' => $request->name,
            'created_at'  => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
