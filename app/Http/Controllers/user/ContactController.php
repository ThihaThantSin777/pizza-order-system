<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function getContactList()
    {
        $data = Contact::paginate(4);
        $status = count($data) == 0 ? 0 : 1;
        return view('admin.contact.list')->with(['data' => $data, 'status' => $status]);

    }

    public function contactSearch(Request $request)
    {
        $search = $request->table_search;
        $data = Contact::orWhere('name', 'like', '%' . $request->table_search . '%')
            ->orWhere('email', $request->table_search)
            ->orWhere('message', $request->table_search)
            ->orWhere('user_id', $request->table_search)
            ->paginate(4);
        $data->appends($request->all());
        $empty = count($data) == 0 ? 0 : 1;
        return view('admin.contact.list')->with(['data' => $data, 'status' => $empty]);

    }
    public function createContact(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ],
        );

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }
        $data = $this->getData($request);
        Contact::create($data);
        return back()->with(['status' => 'Message Send!']);
    }
    private function getData($request)
    {

        return [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}
