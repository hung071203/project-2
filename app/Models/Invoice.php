<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Invoice extends Model
{
    use HasFactory;
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ['s_ID', 'e_ID', 'i_Status', 'i_Date', 'pay_ID', 'i_Money'];


    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function index(){
        if (session('student')){
            $invoices = DB::table('invoices')
                ->join('students', 'invoices.s_ID', '=', 'students.id')
                ->join('classmates','students.class_ID','=','classmates.id')
                ->join('courses', 'classmates.c_ID', '=', 'courses.id')
                ->join('payment_methods', 'invoices.pay_ID', '=', 'payment_methods.id')
                ->select([
                    'invoices.*',
                    'invoices.id as i_ID',
                    'students.s_name AS name_s',
                    'students.*',
                    'classmates.class_name',
                    'payment_methods.pay_Name',
                    'courses.c_Name'
                ])
                ->where('students.id', session('student.id'))
                ->orderBy('i_ID', 'desc');
        }elseif (session('employee')||session('admin')){
            $invoices = DB::table('invoices')
                        ->join('students', 'invoices.s_ID', '=', 'students.id')
                        ->join('classmates','students.class_ID','=','classmates.id')
                        ->join('courses', 'classmates.c_ID', '=', 'courses.id')
                        ->join('payment_methods', 'invoices.pay_ID', '=', 'payment_methods.id')
                        ->select([
                            'invoices.*',
                            'invoices.id as i_ID',
                            'students.s_name AS name_s',
                            'students.*',
                            'classmates.class_name',
                            'payment_methods.pay_Name',
                            'courses.c_Name'
                        ])
                        ->orderBy('i_ID', 'desc');
        }

        return $invoices;
    }

    public function showST(int $id){
        $invoices = DB::table('students')
            ->where('id',$id)
            ->get();
        return $invoices;
    }
    public function store(){
        DB::table('invoices')
            ->insert([
                's_ID' => $this -> s_ID,
                'i_Money' => $this -> i_Money,
                'i_Date' => $this -> i_Date,
                'pay_ID' => $this ->pay_ID,
                'e_ID' => $this -> e_ID,
                'i_Status' => $this -> i_Status
            ]);
    }
    public function edit($ID){
        $invoi = DB::table('invoices')
            ->join('students', 'invoices.s_ID', '=', 'students.id')
            ->join('classmates','students.class_ID','=','classmates.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->join('payment_methods', 'invoices.pay_ID', '=', 'payment_methods.id')
            ->select([
                'invoices.*',
                'invoices.id as i_ID',
                'students.s_name AS name_s',
                'students.*',
                'classmates.class_name',
                'payment_methods.pay_Name',
                'courses.c_Name'
            ])
            ->where('invoices.id', $ID)
            ->get();
        return $invoi;
    }
    public function updateinvoi(){
        DB::table('invoices')
            ->where('id', $this->i_ID)
            ->update([
                'e_ID' => $this -> e_ID,
                'pay_ID' => $this -> pay_ID,
                'i_Date' => now(),
                'i_Status'=> $this ->i_Status
            ]);
    }

    public function updateDayDL(int $ID){
        DB::table('students')
            ->join('forms_of_payments', 'students.f_ID', '=', 'forms_of_payments.id')
            ->where('students.id', $ID)
            ->update([
                's_PayDeadline'=>DB::raw('
            CASE
                WHEN (forms_of_payments.id = 1) THEN DATE_ADD(s_PayDeadline, INTERVAL 1 MONTH)
                WHEN (forms_of_payments.id = 2) THEN DATE_ADD(s_PayDeadline, INTERVAL 3 MONTH)
                WHEN (forms_of_payments.id = 3) THEN DATE_ADD(s_PayDeadline, INTERVAL 12 MONTH)
                ELSE s_PayDeadline
            END
            ')
            ]);
    }
    public function search($obj){
        $invoices = DB::table('invoices')
            ->join('students', 'invoices.s_ID', '=', 'students.id')
            ->join('classmates','students.class_ID','=','classmates.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->join('payment_methods', 'invoices.pay_ID', '=', 'payment_methods.id')
            ->join('employees', 'invoices.e_ID','=','employees.id')
            ->where('students.s_Name','LIKE', '%' . $obj . '%')
            ->select([
                'invoices.*',
                'invoices.id as i_ID',
                'students.s_name AS name_s',
                'students.*',
                'classmates.class_name',
                'payment_methods.pay_Name',
                'courses.c_Name',
                'employees.*'
            ])
            ->orderBy('invoices.id','desc')
            ->paginate(10);
        return $invoices;
    }
}
