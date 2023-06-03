<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //admin view contact page
    public function list(){
        $contacts = Contact::paginate(3);
        return view('admin.contact.list', compact('contacts'));
    }

    //user direct contact page
    public function showList(){
        return view('user.contact.showList');
    }

    //user add contact form page
    public function addList(Request $request){
        $this->contactValidationCheck($request);
        $data = $this->getContactData($request);
        Contact::create($data);
        return redirect()->route('contact#showList')->with(['sendSuccess' => 'Sent Message Successfully']);

    }

    //user contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required|min:4',
            'email' => 'required',
            'message' => 'required|min:5',
        ])->validate();
    }

    //user get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}
