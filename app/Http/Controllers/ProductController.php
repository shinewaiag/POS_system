<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list() {
        $products = Product::when(request('key'), function($query){
                    $query->where('name', 'like', '%'.request('key').'%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(3);
        $products->appends(request()->all());
        return view('admin.product.pizzaList', compact('products'));
    }

    //direct pizza create page
    public function createPage() {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    //delete product
    public function delete($id) {
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Product deleted successfully']);
    }

    //edit product
    public function edit($id) {
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }

    //update product
    public function updatePage($id) {
        $product = Product::where('id', $id)->first();
        $category = Category::get();
        return view('admin.product.update', compact('product', 'category'));
    }

    //create product
    public function create(Request $request) {

        $this->productValidationCheck($request,"create");
        $data = $this->getProductInfo($request);


        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);
        $data['image'] = $fileName;
        Product::create($data);
        return redirect()->route('product#list');
    }

    //update product page
    public function update(Request $request) {
        $this->productValidationCheck($request,"update");
        $data = $this->getProductInfo($request);

        if($request->hasFile('image')){
            $oldImageName = Product::where('id',$request->id)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null) {
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->id)->update($data);
        return redirect()->route('product#list');
    }

    //get product Information
    private function getProductInfo($request){
        return [
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
        ];
    }

    //product validation check
    private function productValidationCheck($request, $action){
        $validationRules =[
            'name' => 'required|min:5|unique:products,name,'. $request->id,
            'category' => 'required',
            'description' => 'required|min:7',
            'image' => 'required|mimes:jpg,png,jpeg,webp|file',
            'price' => 'required',
            'waitingTime' => 'required',
        ];

        $validationRules['image'] = $action == 'create' ? 'required|mimes:jpg,png,jpeg,webp|file' : 'mimes:jpg,png,jpeg,webp|file';

        Validator::make($request->all(), $validationRules)->validate();
    }


}
