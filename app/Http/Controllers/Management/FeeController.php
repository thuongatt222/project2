<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fee;

class FeeController extends Controller
{

    public $data = [];

    private $fee; // Renamed the variable to follow naming conventions

    public function __construct()
    {
        $this->fee = new Fee(); // Corrected the instantiation
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->data['fee'] = $this->fee->show();
        $this->data['year'] = $this->fee->showYear();
        $this->data['major'] = $this->fee->showMajor();
        return view('Management.Fee.fee', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $original_fee = $request->input('original_fee');
        $id_school_year = $request->input('id_school_year');
        $id_major = $request->input('id_major');
        $check = Fee::all();

        foreach ($check as $item) {
            if ($item->id_school_year == $id_school_year && $item->id_major == $id_major) {
                flash()->addError("Thêm thất bại - Dữ liệu đã tồn tại");
                return redirect()->route('fee');
            }
        }

        if ($id_school_year == null || $id_major == null) {
            flash()->addError("Thêm thất bại");
            return redirect()->route('fee');
        }
        else {
            $result = DB::table('fees')->insert([
                'school_payment_times' => '1',
                'original_fee' => $original_fee,
                'id_school_year' => $id_school_year,
                'id_major' => $id_major,
                'created_at' => now(),
            ]);
        }

        if($result){
            flash()->addSuccess('Thêm thành công');
            return redirect()->route('fee');
        }else{
            flash()->addError("Thêm thất bại");
            return redirect()->route('fee');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id = $request->input('id');
        $school_payment_times = $request->input('school_payment_times');
        $check = DB::table('fees')
            ->where('id', '=', $id)->get();
        foreach ($check as $item){
            if ($item->school_payment_times >= $school_payment_times){
                flash()->addError("Sửa thất bại");
                return redirect()->route('fee');
            }
        }

        $result = DB::table('fees')->where('id', '=', $id)->update([
            'school_payment_times' => $school_payment_times,
            'updated_at' => now(),
            ]);
        if($result){
            flash()->addSuccess('Sửa thành công');
            return redirect()->route('fee');
        }else{
            flash()->addError("Sửa thất bại");
            return redirect()->route('fee');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->input('id');
        $hasRelatedRecords = DB::table('tuitions')->where('id_fee', $id)->exists();
        if ($hasRelatedRecords) {
            flash()->addError("Xóa thất bại - Có dữ liệu liên quan");
            return redirect()->back();
        }
        $result = DB::table('fees')->where('id', '=', $id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công');
            return redirect()->route('fee');
        }else{
            flash()->addError("Xóa thất bại");
            return redirect()->route('fee');
        }
    }

    //    Search
    public function search(Request $request){
        $search = $request->input('search');
        if (empty($search)) {
            return redirect()->route('fee');
        } else {
            $this->data['fee'] = (new Fee)->search($search);
            $this->data['search'] = $search;
            $this->data['feeCount'] = $this->data['fee']->count();
            $this->data['year'] = $this->fee->showYear();
            $this->data['major'] = $this->fee->showMajor();
        }
        return view('Management.Fee.fee', $this->data);
    }

}
