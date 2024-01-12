<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['c_Name','c_Inflationary'];
    public function index(){
        $course = DB::table('courses')->get();
        return $course;
    }
    public function search($obj){
        $majors = DB::table('courses')->where('c_Name', 'LIKE', '%' . $obj . '%')->paginate(10);
        return $majors;
    }
}
