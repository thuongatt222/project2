<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\StudentImport;

class UserController extends Controller
{

    public $data = [];

    private $user; // Renamed the variable to follow naming conventions

    public function __construct()
    {
        $this->user = new User(); // Corrected the instantiation
    }

    public function index()
    {
        $this->data['user'] = User::where('role', '!=', 1)
        ->orderBy('id', 'desc')
        ->paginate(5); 
        return view('users.index', $this->data);
    }

    public function store(Request $request)
    {
        //
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $birthday = $request->input('birthday');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');
        $cccd = $request->input('cccd');
        $role = $request->input('role');
        $password = $request->input('password');

        $check =  DB::table('users')->get();
        foreach ($check as $key) {
            if($key -> student_code == $id ||$key -> email == $email || $key -> cccd == $cccd || $key -> phone_number == $phone_number){
                flash()->addError("Thêm thất bại - Dữ liệu đã tồn tại");
                return redirect()->route('user');
            }
        }

        $result = DB::table('users')->insert([
            'student_code'=>$id,
            'name' => $name,
            'email' => $email,
            'birthday' => $birthday,
            'phone_number' => $phone_number,
            'address' => $address,
            'cccd' => $cccd,
            'password' => Hash::make($password),
            'role' => $role,
            'created_at' => now(),
        ]);
        if($result){
            flash()->addSuccess('Thêm thành công');
            return redirect()->route('user');
        }else{
            flash()->addError("Thêm thất bại");
            return redirect()->route('user');
        }
    }

    public function update(Request $request)
    {
        // Update a specific major in the database based on the provided ID
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $birthday = $request->input('birthday');
        $phone_number = $request->input('phone_number');
        $address = $request->input('address');
        $cccd = $request->input('cccd');
        $role = $request->input('role');
        $password = $request->input('password');

        $check =  DB::table('users')->get();
        foreach ($check as $key) {
            if($key -> email == $email || $key -> cccd == $cccd || $key -> phone_number == $phone_number){
                flash()->addError("Thêm thất bại -Đữ liệu đã tồn tại");
                return redirect()->route('user');
            }
        }

        $result = DB::table('users')->where('id', '=', $id)->update([
            'name' => $name,
            'email' => $email, 'birthday' => $birthday,
            'phone_number' => $phone_number,
            'address' => $address,
            'cccd' => $cccd,
            'role' => $role,
            'password' => $password,
            'updated_at' => now(),
        ]);
        if($result){
            flash()->addSuccess('Sửa thành công');
            return redirect()->route('user');
        }else{
            flash()->addError("Sửa thất bại");
            return redirect()->route('user');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        // Delete a specific major from the database based on the provided ID
        $id = $request->input('id');
        $hasRelatedRecords = DB::table('students')->where('id_user', $id)->exists();
        if ($hasRelatedRecords) {
            flash()->addError("Xóa thất bại - Có dữ liệu liên quan");
            return redirect()->back();
        }
        $result = DB::table('users')->where('id', '=', $id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công');
            return redirect()->route('user');
        }else{
            flash()->addError("Xóa thất bại");
            return redirect()->route('user');
        }
    }

//    Import , Export
    public function import(Request $request){
        $file = $request->file('fileExel');
        Excel::import(new UsersImport(), $file);
        return redirect()->back();

    }
    public function export()
    {
        return Excel::download(new UsersExport(), 'mau.xlsx');
    }

    //    Search
    public function search(Request $request){
        $search = $request->input('search');
        if (empty($search)) {
            return redirect()->route('user');
        } else {
            $this->data['user'] = (new User)->search($search);
            $this->data['search'] = $search;
            $this->data['userCount'] = $this->data['user']->count();
        }
        return view('users.index', $this->data);
    }

}
