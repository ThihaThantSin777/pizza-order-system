<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userView()
    {
        $userData = User::where('role', 'user')->paginate(4);
        $status = count($userData) == 0 ? 0 : 1;
        return view('admin.user.userlist')->with(['user_data' => $userData, 'status' => $status]);
    }
    public function adminView()
    {
        $adminData = User::where('role', 'admin')->paginate(4);
        $status = count($adminData) == 0 ? 0 : 1;
        return view('admin.user.adminlist')->with(['admin_data' => $adminData, 'status' => $status]);
    }

    public function userSearch(Request $req)
    {
        $key = $req->table_search;
        $data = $this->search('user', $req);

        $status = count($data) == 0 ? 0 : 1;

        return view('admin.user.userlist')->with(['user_data' => $data, 'status' => $status]);
    }

    public function adminSearch(Request $req)
    {
        $key = $req->table_search;
        $data = $this->search('admin', $req);

        $status = count($data) == 0 ? 0 : 1;

        return view('admin.user.adminlist')->with(['admin_data' => $data, 'status' => $status]);
    }

    public function confrimDelete($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.user.confirm_user_delete')->with(['comfirm_delte_data' => $data]);
    }

    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin#user#list')->with(['ds' => "1 user is deleted"]);

    }

    public function confrimAdminDelete($id)
    {
        $data = User::where('id', $id)->first();
        return view('admin.user.confirm_admin_delete')->with(['comfirm_delte_data' => $data]);
    }

    public function adminDelete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin#admin#list')->with(['ds' => "1 admin is deleted"]);

    }

    private function search($role, $request)
    {
        $data = User::where('role', $role)
            ->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->table_search . '%')
                    ->orWhere('email', 'like', '%' . $request->table_search . '%')
                    ->orWhere('phone', 'like', '%' . $request->table_search . '%')
                    ->orWhere('address', 'like', '%' . $request->table_search . '%');
            })->paginate(4);

        return $data;

    }

}
