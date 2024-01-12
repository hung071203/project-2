<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Major extends Model
{
    use HasFactory;
    protected $fillable = ['m_Name', 'm_DOS', 'm_Price'];
    public function index()
    {
        $majors = DB::table('majors')->get();
        return $majors;
    }
    public function search($obj){
        $majors = DB::table('majors')->where('m_Name', 'LIKE', '%' . $obj . '%')->paginate(10);
        return $majors;
    }

}
