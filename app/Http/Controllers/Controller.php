<?php

namespace App\Http\Controllers;

use App\Models\Classmate;
use App\Models\Course;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Major;
use App\Models\Scholarship;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function home(){
        session(['search'=>0]);
        $numst = DB::table('students')->count();
        $now = Carbon::now()->subMonth();
        $month = $now->month; // Lấy tháng trước
        $year = $now->year;   // Lấy năm của tháng trước

        $numem = Invoice::where('i_Status', 0)
            ->whereMonth('i_Date', $month) // Lọc theo tháng trước
            ->whereYear('i_Date', $year)   // Lọc theo năm tháng trước
            ->sum('i_Money');

        $totalAmount = Invoice::where('i_Status', 0)->sum('i_Money');
        $tao = Invoice::where('i_Status', 1)->sum('i_Money');
        return view('home',[
            'numst'=>$numst,
            'numem'=>$numem,
            'ta'=>$totalAmount,
            'tao'=>$tao,
            'm'=>$month,
            'y'=>$year
        ]);
    }

    public function showPF(){
    return view('pages-account-settings-account');
    }
    public function savePass(Request $request){
//dd(Hash::check($request->input('password_old'), session('employee.password')), session('employee.password'));
        if (session('student')){
            if (Hash::check($request->input('password_old'), session('student.password'))){
                if ($request->input('password') == $request->input('re_Pass')){
                    $obj = new Student();
                    $obj->updatePass($request->input('password'));
                    return Redirect::route('logout')->with('success', 'password changed!');
                }else{
                    return Redirect::route('profile')->with('error', 'Change password failed!');
                }

            }else{
                return Redirect::route('profile')->with('error', 'Change password failed!');

            }
        }
        if (Hash::check($request->input('password_old'), session('employee.password'))){
            if ($request->input('password') == $request->input('re_Pass')){
                $obj = new Employee();
                $obj->updatePass($request->input('password'));
                return Redirect::route('logout')->with('success', 'password changed!');
            }else{
                return Redirect::route('profile')->with('error', 'Change password failed!');
            }

        }else{
            return Redirect::route('profile')->with('error', 'Change password failed!');

        }
    }
    public function editEm(Request $request){
//    dd($request->input('e_Email'),$request->input('e_Name'),$request->input('e_Phone'));
    if (session('student')){
        $obj = new Student();
        $obj->s_Name = $request->input('s_Name');
        $obj->email = $request->input('email');
        $obj->s_Phone = $request->input('s_Phone');
        $obj->s_Address = $request->input('s_Address');
        $obj->updateIF();
        return Redirect::route('profile')->with('success', 'Information has been changed!');

    }elseif (session('employee')) {
        $obj = new Employee();
        $obj->e_Name = $request->input('e_Name');
        $obj->email = $request->input('email');
        $obj->e_Phone = $request->input('e_Phone');
        $obj->updateEm();
        return Redirect::route('profile')->with('success', 'Information has been changed!');
        }
    }
    public function search(Request $request){
        if (session('search') == 1){
            $obj = new Major();
            $majors = $obj->search($request->search);
            return view('tables-basic', compact('majors'));
        }elseif(session('search') == 2){
            $obj = new Course();
            $courses = $obj->search($request->search);
            return view('course', compact('courses'));
        }elseif(session('search') == 3){
            $obj = new Classmate();
            $classmates = $obj->search($request->search);
            return view('Class.index', compact('classmates'));
        }elseif(session('search') == 4){
            $obj = new Student();
            $check = $obj->checkTAO();
            $obj->moneyOwed();
            $students = $obj->search($request->search);
            foreach ($students as $student){
                $obj->checkDateP($student->id);
//            dump(strtotime(date('Y-m-d')) - strtotime($student->s_PayDeadline), 24*60*60*30);
                if(strtotime(date('Y-m-d')) - strtotime($student->s_PayDeadline) > 24*60*60*30){

                    $obj->checkST($student->id);
                }
            }

            return view('Students.Students',[
                'students' => $students,
                'dates' => $check
            ]);

        }elseif(session('search') == 5){
            $obj = new Scholarship();
            $scholarships = $obj->search($request->search);
            return view('Scholarship.index', compact('scholarships'));

        }elseif(session('search') == 6){
            $obj = new Invoice();
            $invoices = $obj->search($request->search);
            return view('invoices.index',compact('invoices'));

        }elseif(session('search') == 7){
            $obj = new Employee();
            $employee = $obj->search($request->search);
            return view('employee.index',[
                'employees' => $employee
            ]);
        }

    }

}
