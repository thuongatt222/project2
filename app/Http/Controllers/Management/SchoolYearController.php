<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School_year; // Corrected the import statement
use Illuminate\Support\Facades\DB;

class SchoolYearController extends Controller
{
    public $data = [];
    private $schoolYear; // Renamed the variable to follow naming conventions

    public function __construct()
    {
        $this->schoolYear = new School_year(); // Corrected the instantiation
    }

    public function index()
    {
        // Use $this->schoolYear to access the model's methods
        $this->data['schoolYears'] = $this->schoolYear->show();
        return view('Management.SchoolYear.schoolyear', $this->data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'number_course' => 'required|integer|min:1',
        ]);

        $number_course = $request->input('number_course');
        $check =  DB::table('school_years')->get();
        foreach ($check as $key) {
            $request->validate([
                'number_course' => 'numeric',
            ]);
            if($key -> number_course == $number_course){
                flash()->addError("Thêm thất bại - Đã tồn tại");
                return redirect()->back();
            }
        }
        $result = DB::table('school_years')->insert([
            'number_course' => $number_course,
            'created_at' => now()
        ]);
        if($result){
            flash()->addSuccess('Thêm thành công');
            return redirect()->route('school_year');
        }else{
            flash()->addError("Thêm thất bại");
            return redirect()->back();
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        // Show a form to edit a specific school year based on the provided ID
    }

    public function update(Request $request)
    {
        // Update a specific school year in the database based on the provided ID
        $id = $request->input('id');
        $number_course = $request->input('number_course');
        $check =  DB::table('school_years')->get();
        foreach ($check as $key) {
            if($key -> number_course == $number_course){
                flash()->addError("Sửa thất bại - Đã tồn tại");
                return redirect()->route('school_year');
            }
        }
        $result = DB::table('school_years')->where('id', '=', $id)->update([
            'number_course' => $number_course,
            'updated_at' => now()
        ]);
        if($result){
            flash()->addSuccess('Sửa thành công');
            return redirect()->route('school_year');
        }else{
            flash()->addError("Sửa thất bại");
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        // Delete a specific school year from the database based on the provided ID
        $id = $request->input('id');
        $hasRelatedRecords = DB::table('fees')->where('id_school_year', $id)->exists();
        if ($hasRelatedRecords) {
            flash()->addError("Xóa thất bại - Có dữ liệu liên quan");
            return redirect()->back();
        }
        $result = DB::table('school_years')->where('id', '=', $id)->delete();
        if($result){
            flash()->addSuccess('Xóa thành công');
            return redirect()->route('school_year');
        }else{
            flash()->addError("Xóa thất bại");
            return redirect()->route('school_year');
        }
    }

//    Search
    public function search(Request $request){
        $search = $request->input('search');
        if (empty($search)) {
            return redirect()->route('school_year');
        } else {
            $this->data['schoolYears'] = (new School_year)->search($search);
            $this->data['search'] = $search;
            $this->data['schoolYearsCount'] = $this->data['schoolYears']->count();
        }
        return view('Management.SchoolYear.schoolyear', $this->data);
    }
}
