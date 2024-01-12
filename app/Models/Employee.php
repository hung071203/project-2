<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Employee extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{

    use HasFactory;
    use Authenticatable;

    public $timestamps = false;
    protected $table = 'employees';
    protected $fillable = ['e_Name','email','e_Phone', 'password'];


    public function index(){
        $employee = DB::table('employees');
        return $employee;
    }
    public function search($obj){
        $employee = DB::table('employees')
            ->where('e_Name', 'LIKE', '%' . $obj . '%')->paginate(10);
        return $employee;
    }

    public function updatePass($pass){
//        dd($pass, session('employee.id'));
        $pass1 = bcrypt($pass);
        DB::table('employees')
            ->where('id', session('employee.id'))
            ->update([
                'password'=>$pass1
            ]);
        // Lấy session hiện tại
        $employeeSession = session('employee');
        $newPassword = $pass1;
        $employeeSession['password'] = Hash::make($newPassword);
        session(['employee' => $employeeSession]);

    }

    public function updatePass1($pass, $id){
//        dd($pass, session('employee.id'));
        $pass1 = bcrypt($pass);
        DB::table('employees')
            ->where('id', $id)
            ->update([
                'password'=>$pass1
            ]);


    }

    public function updateEm(){
//            dd($this);
        DB::table('employees')
            ->where('id', session('employee.id'))
            ->update([
                'e_Name' => $this->e_Name,
                'email' =>$this->email,
                'e_Phone' =>$this->e_Phone
            ]);
        $employeeSession = session('employee');
        $employeeSession['e_Name'] = $this->e_Name;
        $employeeSession['email'] = $this->email;
        $employeeSession['e_Phone'] = $this->e_Phone;
        session(['employee' => $employeeSession]);

    }

//    public function getAuthIdentifierName()
//    {
//        return 'e_Email';
//    }
//
//    public function getAuthIdentifier()
//    {
//        return $this->attributes['e_Email'];
//    }
//
//    public function getAuthPassword()
//    {
////        dd('123');
//        return $this->attributes['e_Pass'];
//    }
}
