<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\School_year;
use App\Models\Student;
use App\Models\Tuition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $student;
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->student = new Tuition();
        $this->data['debt'] = $this->student->debt()->count();
        $data = Student::select('id', 'created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('Y');
        })->sortByDesc(function ($groupedData, $year) {
            return $year;
        })->take(5);
        $years = [];
        $yearsCount = [];
        $yearss = [];
        $totals = [];
        foreach ($data as $year => $value){
            $years[] = $year;
            $yearsCount[] = count($value);
        }
        return view('home', ['years'=>$years, 'totals' => $totals, 'yearsCount' => $yearsCount, 'yearss'=>$yearss, 'data' => $this->data['debt']] );
    }
    public function chartsearch(Request $request){
        $data = DB::table('school_years')->join('fees', 'fees.id_school_year','=','school_years.id')
        ->join('tuitions', 'tuitions.id_fee','=', 'fees.id')
        ->selectRaw('number_course, SUM(tuitions.fee * tuitions.payment_times) as total')
        ->where('number_course', '>=', $request->startYear)
        ->where('number_course', '<=', $request->endYear)
        ->groupBy('number_course')
        ->orderBy('number_course', 'desc')
        ->get();
        $yearss = [];
        $totals = [];
        foreach ($data as $year){
            $yearss[] = $year->number_course;
            $totals[] = $year->total;
        }
        if($totals == null){
            flash()->addError("Không có dữ liệu trong khoảng thời gian bạn chọn!");
            return redirect()->route('home');
        }
        $data = Student::select('id', 'created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('Y');
        })->sortByDesc(function ($groupedData, $year) {
            return $year;
        })->take(5);
        $years = [];
        $yearsCount = [];
        foreach ($data as $year => $value){
            $years[] = $year;
            $yearsCount[] = count($value);
        }
        $this->student = new Student();
        $this->data['student'] = $this->student->show();
        $this->data['studentCount'] = $this->data['student']->count();
        return view('home', ['years'=>$years, 'totals' => $totals, 'yearsCount' => $yearsCount, 'yearss'=>$yearss, 'data' => $this->data['studentCount']] );
    }
}
