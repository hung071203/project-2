<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Hash;

class Student extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;
    public $timestamps = false;
    protected $table = 'students';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $fillable = ['email', 'password'];


    public function index(){
        $students = DB::table('students')
            ->join('classmates', 'students.class_ID', '=', 'classmates.id')
            ->join('majors','classmates.m_ID','=','majors.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->join('scholarships', 'students.sl_ID', '=', 'scholarships.id')
            ->join('forms_of_payments', 'students.f_ID', '=', 'forms_of_payments.id')
            ->select([
                'students.*',
                'classmates.class_Name AS name_class',
                'scholarships.sl_Price',
                'forms_of_payments.f_Name',
                'majors.m_Name',
                'courses.c_Name'
            ])
            ->orderBy('id', 'asc');

        return $students;
    }

    public function storeST($a){
//        DB::table('students')
//            ->where('id',$a->id)
//            ->update([
//                's_Name' => $a->s_Name,
//                'email' =>$a->email,
//                's_Phone'=> $a->s_Phone,
//                's_Address'=> $a->s_Address,
//                'password'=> encrypt($a->password),
//                'class_ID'=>$a->class_ID,
//                's_BirthDate' => $a->s_BirthDate,
//                's_StartDate'=>$a->s_StartDate,
//                'f_ID'=>$a->f_ID,
//                'sl_ID'=>$a->sl_ID
//            ]) ;
        $pass = bcrypt($a->password);
        DB::table('students')
            ->insert([
                's_Name' => $a->s_Name,
                'email' =>$a->email,
                's_Phone'=> $a->s_Phone,
                's_Address'=> $a->s_Address,
                'password'=> $pass,
                'class_ID'=>$a->class_ID,
                's_BirthDate' => $a->s_BirthDate,
                's_StartDate'=>$a->s_StartDate,
                's_TotalAO'=>0,
                's_Status' =>0,
                's_PayDeadline' => $a->s_StartDate,
                'f_ID'=>$a->f_ID,
                'sl_ID'=>$a->sl_ID
            ]) ;
    }

    public function edit(int $id){
        $student = DB::table('students')
            ->join('classmates', 'students.class_ID', '=', 'classmates.id')
            ->join('majors','classmates.m_ID','=','majors.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->join('scholarships', 'students.sl_ID', '=', 'scholarships.id')
            ->join('forms_of_payments', 'students.f_ID', '=', 'forms_of_payments.id')
            ->select([
                'students.*',
                'students.id as s_ID',
                'classmates.*',
                'classmates.id as class_ID',
                'scholarships.*',
                'forms_of_payments.*',
                'majors.*',
                'courses.*'
            ])
            ->where('students.id', $id)
            ->get();

        return $student;
    }
    public function updateStudent(){
        if (session('admin')){
            DB::table('students')
                ->where('id', $this -> id)
                ->update([
                    'f_ID' => $this -> f_ID,
                    'sl_ID' => $this -> sl_ID,
                    's_TotalAO' => $this -> s_TotalAO,
                    's_PayDeadline' => $this -> s_PayDeadline,
                    's_Status' => $this -> s_Status,
                    'email' =>$this->email,
                    's_Phone' =>$this->s_Phone,
                    's_Address'=>$this->s_Address,
                    's_Name' =>$this->s_Name,
                    's_BirthDate' => $this->s_BirthDate,
                    'password'=>bcrypt($this->password)
                ]);
        }else {
            DB::table('students')
                ->where('id', $this->id)
                ->update([
                    'f_ID' => $this->f_ID,
                    'sl_ID' => $this->sl_ID,
                    's_TotalAO' => $this->s_TotalAO,
                    's_PayDeadline' => $this->s_PayDeadline,
                    's_Status' => $this->s_Status,
                ]);
        }
    }

    public function moneyOwed(){
        DB::table('students')
            ->join('classmates', 'students.class_ID', '=', 'classmates.id')
            ->join('majors','classmates.m_ID','=','majors.id')
            ->join('scholarships', 'students.sl_ID', '=', 'scholarships.id')
            ->join('forms_of_payments', 'students.f_ID', '=', 'forms_of_payments.id')
            ->update([
                's_TotalAO' => DB::raw('
            ROUND(
                CASE
                    WHEN (forms_of_payments.id = 1) THEN ((classmates.class_TotalPrice - scholarships.sl_Price) / (1 - forms_of_payments.f_Discount / 100) / (majors.m_DOS * 12))
                    WHEN (forms_of_payments.id = 2) THEN ((classmates.class_TotalPrice - scholarships.sl_Price) / (1 - forms_of_payments.f_Discount / 100) / (majors.m_DOS * 4))
                    WHEN (forms_of_payments.id = 3) THEN ((classmates.class_TotalPrice - scholarships.sl_Price) / (1 - forms_of_payments.f_Discount / 100) / (majors.m_DOS))
                END, 2)
        ')
            ]);

    }
    public function checkTAO(){
        $check = DB::table('invoices')
            ->join('students', 'invoices.s_ID', '=', 'students.id')
            ->select([
                'students.*',
                'students.id as s_ID',
                'invoices.*'
            ])
            ->get();
        return $check;
    }

    public function checkST(int $id){
        DB::table('students')
            ->where('id', $id)
            ->update([
                's_Status'=> 1
            ]);
    }
    public function checkDateP(int $id){
        $checks = DB::table('students')
            ->join('classmates', 'students.class_ID', '=', 'classmates.id')
            ->join('majors','classmates.m_ID','=','majors.id')
            ->where('students.id', $id)
            ->select([
                'students.s_StartDate',
                'students.s_PayDeadline',
                'majors.*'
            ])
            ->get();
            //dd($check);
        foreach ($checks as $check){
            $years = floor($check->m_DOS);
            $months = ($check->m_DOS - $years) * 12;
            $date = new DateTime($check->s_StartDate);
            $date->add(new DateInterval('P' . $years . 'Y' . $months . 'M'));

            $result = $date->format('Y-m-d');
            if (strtotime($check->s_PayDeadline) > strtotime($result)){
                DB::table('students')
                    ->where('id', $id)
                    ->update([

                        's_PayDeadline' => $result
                    ]);
            }
        }


    }
    public function updateIF(){
        DB::table('students')
            ->where('id', session('student.id'))
            ->update([
                's_Name' => $this -> s_Name,
                'email' => $this -> email,
                's_Phone' => $this -> s_Phone,
                's_Address' => $this -> s_Address
            ]);
        $employeeSession = session('student');
        $employeeSession['s_Name'] = $this->s_Name;
        $employeeSession['email'] = $this->email;
        $employeeSession['s_Phone'] = $this->s_Phone;
        $employeeSession['s_Address'] = $this->s_Address;
        session(['student' => $employeeSession]);
    }

    public function updatePass($pass){
        $pass1 = bcrypt($pass);
        DB::table('students')
            ->where('id', session('student.id'))
            ->update([
                'password'=>$pass1
            ]);
        // Lấy session hiện tại
        $employeeSession = session('student');
        $newPassword = $pass1;
        $employeeSession['password'] = Hash::make($newPassword);
        session(['student' => $employeeSession]);
    }

    public function updatePass1($pass, $id){
        $pass1 = bcrypt($pass);
        DB::table('students')
            ->where('id', $id)
            ->update([
                'password'=>$pass1
            ]);

    }

    public function search($obj){
        $students = DB::table('students')
            ->join('classmates', 'students.class_ID', '=', 'classmates.id')
            ->join('majors','classmates.m_ID','=','majors.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->join('scholarships', 'students.sl_ID', '=', 'scholarships.id')
            ->join('forms_of_payments', 'students.f_ID', '=', 'forms_of_payments.id')
            ->select([
                'students.*',
                'classmates.class_Name AS name_class',
                'scholarships.sl_Price',
                'forms_of_payments.f_Name',
                'majors.m_Name',
                'courses.c_Name'
            ])
            ->where('s_Name', 'LIKE', '%' . $obj . '%')->paginate(10);

        return $students;
    }

}
