<?php

namespace App\Http\Controllers;

use App\Models\Classmate;
use App\Models\Employee;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\FormsOfPayment;
use App\Models\Scholarship;
use App\Http\Controllers\FormsOfPaymentController;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => 4]);
//        dd(session('search'));
        $obj = new Student();
        $check = $obj->checkTAO();
        $obj->moneyOwed();
        $students = $obj ->index()->paginate(10);
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $scholships = new Scholarship();
        $scholship = $scholships->index();
        $formsofpayments = new FormsOfPayment();
        $forms = $formsofpayments ->index() ;
        $class = new Classmate();
        $a = $class->index()->get();
        return view('Students.addStudent', ['classmates'=>$a,'scholarships' => $scholship , 'formsofpayments' => $forms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $newEmail = $request->input('email');
        $newPhone = $request->input('s_Phone');
        $existingst = Student::where('email', $newEmail)
            ->orWhere('s_Phone', $newPhone)
            ->first();


        if (strtotime($request->s_BirthDate) < strtotime($request->s_StartDate) && strtotime($request->s_StartDate) - strtotime($request->s_BirthDate) >= 60*60*24*365*15) {
            if (!$existingst){
                $student = new  Student();
                $student->storeST($request);
                return  Redirect::route('students')->with('success', 'Add student success');
            }elseif ($existingst->email == $newEmail) {
                return redirect()->route('students')->with('error', 'Student with this email already exists!');
            }elseif ($existingst->s_Phone == $newPhone){
                return redirect()->route('students')->with('error', 'Student with this phone already exists!');
            }
        }else{
            return redirect()->route('students')->with('error', 'Add Student Failure!');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Student $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $students, Request $request)
    {
        $obj = new Student();

        $students = $obj->edit($request->student);
        $scholships = new Scholarship();
        $scholship = $scholships->index();
        $formsofpayments = new FormsOfPayment();
        $forms = $formsofpayments ->index() ;



        return view('Students.editStudents',[
            'students' => $students , 'scholarships' => $scholship , 'formsofpayments' => $forms
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $students)
    {
        $students->id = $request->id;
        $students->f_ID = $request->f_ID;
        $students->sl_ID = $request->sl_ID;
        $students->s_TotalAO = $request->s_TotalAO;
        $students->s_PayDeadline = $request->s_PayDeadline;
        $students->s_Status = $request->s_Status;
        if (session('admin')) {
            $students->email = $request->email;
            $students->s_Phone = $request->s_Phone;
            $students->s_Address = $request->s_Address;
            $students->password = $request->password;
            $students->s_StartDate = $request->s_StartDate;
            $students->s_BirthDate = $request->s_BirthDate;
            $students->s_Name = $request->s_Name;
            if (strtotime($request->s_BirthDate) >= strtotime($request->s_StartDate) || strtotime($request->s_StartDate) - strtotime($request->s_BirthDate) <= 60 * 60 * 24 * 365 * 15) {
                return redirect()->route('students')->with('error', 'Edit False!');
            }
        }

        $existingstByEmail = Student::where('id', '!=', $students->id)->where('email', $request->email)->first();
        $existingstByPhone = Student::where('id', '!=', $students->id)->where('s_Phone', $request->s_Phone)->first();
        $existingstByPassword = Student::where('id', '!=', $students->id)->where('password', bcrypt($request->password))->first();

        if (!$existingstByEmail && !$existingstByPhone && !$existingstByPassword) {
            $students->updateStudent();
            return redirect()->route('students')->with('success', 'Update student success');
        } elseif ($existingstByEmail) {
            return redirect()->route('students')->with('error', 'Student with this email already exists!');
        } elseif ($existingstByPhone) {
            return redirect()->route('students')->with('error', 'Student with this phone already exists!');
        } elseif ($existingstByPassword) {
            return redirect()->route('students')->with('error', 'Student with this password already exists!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $students)
    {
        //
    }


}
