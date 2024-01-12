<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => 7]);
        $obj = new Employee();
        $employee = $obj -> index()->paginate(10);
        return view('employee.index',[
            'employees' => $employee
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::all();
        return view('employee.add',[
            'employees' => $employee
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $newEmail = $request->input('email');
        $newPhone = $request->input('e_Phone');
        $existingEmployee = Employee::where('email', $newEmail)
            ->orWhere('e_phone', $newPhone)
            ->first();

        if (!$existingEmployee) {
            $data = $request->all();
            $data['password'] = bcrypt($request->input('password'));
            Employee::create($data);
            return redirect()->route('employee')->with('success', 'Employee added successfully!');
        }elseif ($existingEmployee->email == $newEmail) {
            return redirect()->route('employee')->with('error', 'Employee with this email already exists!');
        }elseif ($existingEmployee->e_Phone == $newPhone){
            return redirect()->route('employee')->with('error', 'Employee with this phone already exists!');
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $Employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $Employee)
    {

        return view('employee.edit',[
            'employees' => $Employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $newEmail = $request->input('email');
        $newPhone = $request->input('e_Phone');
        $newPassword = $request->input('password');

        if ($newPassword !== null) {
            $data = $request->all();
            $data['password'] = bcrypt($newPassword);
        } else {
            $data = $request->except('password');
        }

        $existingEmail = Employee::where('id', '!=', $employee->id)->where('email', $newEmail)->first();
        $existingPhone = Employee::where('id', '!=', $employee->id)->where('e_Phone', $newPhone)->first();

        if (!$existingEmail && !$existingPhone) {
            $employee->update($data);
            return redirect()->route('employee')->with('success', 'Employee updated successfully!');
        } elseif ($existingEmail) {
            return redirect()->route('employee')->with('error', 'Employee with this email already exists!');
        } elseif ($existingPhone) {
            return redirect()->route('employee')->with('error', 'Employee with this Phone already exists!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('employee')->with('success', 'Employee deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('employee')->with('error', 'Failed to delete employee. Please try again.');
        }
    }

    public function login(){
        return view('auth-login-basic');
    }

    public function checkLogin(Request $request){
        $accountEp = $request->only(['email', 'password']);
       if (session('admin')||session('employee')||session('student')){
           if (session('employee')){
               Auth::guard('employee')->logout();
               session()->forget('employee');
               return Redirect::route('login')->with('error', 'An unexpected error occurred, please log in again!');
           }
           if (session('student')){
               Auth::guard('student')->logout();
               session()->forget('student');
               return Redirect::route('login')->with('error', 'An unexpected error occurred, please log in again!');
           }
           if (session('admin')){
               Auth::guard('admin')->logout();
               session()->forget('admin');
               return Redirect::route('login')->with('error', 'An unexpected error occurred, please log in again!');
           }
       }else{
           if (Auth::guard('employee')->attempt($accountEp)){
//           dd('vao');
               $employee = Auth::guard('employee')->user();
               Auth::login($employee);
               session(['employee' => $employee]);
               return Redirect::route('home1')->with('success', 'login success!');
           } else if (Auth::guard('student')->attempt($accountEp)){
               $student = Auth::guard('student')->user();
               Auth::login($student);
               session(['student' => $student]);
               if (session('student.s_Status') == 1){

                   Auth::guard('student')->logout();
                   session()->forget('student');
                   return Redirect::route('login')->with('error', 'Account has been locked!');
               }else{
                   return redirect()->route('students')->with('success', 'login success!');
               }

           }else if (Auth::guard('admin')->attempt($accountEp)){
               $admin = Auth::guard('admin')->user();
               Auth::login($admin);
               session(['admin'=> $admin]);
               return Redirect::route('home1')->with('success', 'login success!');
           }
           else{
               return Redirect::back()->with('error','Wrong account or password!');
           }
       }
    }

    public function forgotPass(){
        return view('auth-forgot-password-basic');
    }

    public function newPass(Request $request){
        $admin = new admin();
        $a = $admin->index();

        $employee = new Employee();
        $e = $employee->index()->get();
        $student = new Student();
        $s = $student->index()->get();

        $check = false;

        if ($request->id == 1){
            foreach ($s as $st){
                if ($st->email == $request->email){
                    $check = true;
                    $pass = 123;
                    $student->updatePass1($pass, $st->id);
                    return Redirect::route('login')->with('success', 'New Password is 123');
                }
            }
        }
        elseif ($request->id == 2){
            foreach ($e as $st) {
                if ($st->email == $request->email) {
                    $check = true;
                    $pass = 123;
                    $employee->updatePass1($pass, $st->id);
                    return Redirect::route('login')->with('success', 'New Password is 123');
                }
            }

        }elseif ($request->id == 3){
            foreach ($a as $st){
                if ($st->email == $request->email){
                    $check = true;
                    $pass = 123;
                    $admin->updatePass($pass, $st->id);
                    return Redirect::route('login')->with('success', 'New Password is 123');
                }
            }
        }
        if ($check == false){
            return Redirect::route('login')->with('error', 'Password recovery failed!');

        }


    }

    public function logout(){

        if (session('employee')){
            Auth::guard('employee')->logout();
            session()->forget('employee');
            return Redirect::route('login');
        }
        if (session('student')){
            Auth::guard('student')->logout();
            session()->forget('student');
            return Redirect::route('login');
        }
        if (session('admin')){
            Auth::guard('admin')->logout();
            session()->forget('admin');
            return Redirect::route('login');
        }

    }
}
