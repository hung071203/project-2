<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Scholarship extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['sl_Price'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function index(){
        $schol = DB::table('scholarships') ->get();
        return $schol;
    }
    public function search($obj){
        $majors = DB::table('scholarships')->where('sl_Price', 'LIKE', '%' . $obj . '%')->paginate(10);
        return $majors;
    }

}
