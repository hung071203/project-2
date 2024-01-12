<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use Authenticatable;
    public function index(){
        $admin = DB::table('admins')->get();
        return $admin;
    }
    public function updatePass($pass, $id){
//        dd($pass, session('employee.id'));
        $pass1 = bcrypt($pass);
        DB::table('admins')
            ->where('id', $id)
            ->update([
                'password'=>$pass1
            ]);


    }
}
