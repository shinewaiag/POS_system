<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change Password Page
    public function changePasswordPage() {
        return view('admin.account.changePassword');
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
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['changePassword'=> 'Password has been changed']);
        }
        return back()->with(['noMatch' => 'The old password did not match the new one']);

    }

    //details page
    public function details() {
        return view('admin.account.details');
    }

    //direct admin page
    public function edit() {
        return view('admin.account.edit');
    }

    //update account
    public function update($id, Request $request) {
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
        return redirect()->route('admin#details')->with(['accountUpdateSuccess' => 'Account updated successfully']);
    }

    //admin list
    public function list() {
        $admin = User::when(request('key'), function($query){
                        $query->orWhere('name', 'like', '%'.request('key').'%')
                              ->orWhere('email', 'like', '%'.request('key').'%')
                              ->orWhere('gender', 'like', '%'.request('key').'%')
                              ->orWhere('phone', 'like', '%'.request('key').'%')
                              ->orWhere('address', 'like', '%'.request('key').'%');
                        })
                        ->where('role', 'admin')
                        ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list', compact('admin'));
    }

    //delete admin account
    public function delete($id) {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account deleted successfully']);
    }

    //admin change Role
    public function changeRole($id) {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }

    //admin change role with ajax
    public function ajaxChangeRole(Request $request){
        $role = [
            'role' => $request->role,
        ];
        User::where('id',$request->userId)->update($role);
    }

    //role change
    public function change($id, Request $request) {
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }

    //request user data
    private function requestUserData($request) {
        return [
            'role' => $request->role
        ];
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
            'image' => 'mimes:png,jpg,jpeg|file',
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
