<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classmate extends Model
{
    use HasFactory;

    public function index()
    {
        $class = DB::table('classmates')
            ->join('majors', 'classmates.m_ID', '=', 'majors.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->select([
                'classmates.*',
                'majors.m_Name',
                'courses.c_Name'
            ])
            ->orderBy('classmates.id');

        return $class;
    }

    public function checkClass($check){
        $class = DB::table('classmates')
            ->where('m_ID', $check->m_ID)
            ->where('c_ID', $check->c_ID)
            ->first();
        if ($class){
            return true;
        }else{
            return false;
        }
    }

    public function storeCl($obj){
        DB::table('classmates')
            ->insert([
                'class_Name' => $obj-> class_Name,
                'class_TotalPrice'=> 0,
                'c_ID'=>$obj->c_ID,
                'm_ID'=>$obj->m_ID
            ]);
    }

    public function editClass($id){
        $class = DB::table('classmates')
            ->join('majors', 'classmates.m_ID', '=', 'majors.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->where('classmates.id', $id)
            ->select([
                'classmates.*',
                'majors.m_Name',
                'courses.c_Name'
            ])
        ->get();

        return $class;
    }

    public function updatecl($a){
        DB::table('classmates')
            ->where('id',$a->class)
            ->update([
                'class_Name'=>$a->class_Name,
                'm_ID'=>$a->m_ID,
                'c_ID'=>$a->c_ID
            ]);
    }

    public function price()
    {
        DB::table('classmates')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->join('majors', 'classmates.m_ID', '=', 'majors.id')
            ->update([
                'classmates.class_TotalPrice' => DB::raw('majors.m_Price * (1 + courses.c_Inflationary / 100)')
            ]);
    }
    public function search($obj){
        $class = DB::table('classmates')
            ->join('majors', 'classmates.m_ID', '=', 'majors.id')
            ->join('courses', 'classmates.c_ID', '=', 'courses.id')
            ->select([
                'classmates.*',
                'majors.m_Name',
                'courses.c_Name'
            ])
            ->where('classmates.class_Name', 'LIKE', '%' . $obj . '%')->paginate(10);

        return $class;
    }

}
