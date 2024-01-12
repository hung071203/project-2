<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FormsOfPayment extends Model
{
    use HasFactory;
    public function index(){
        $forms = DB::table('forms_of_payments')
            ->get();
        return $forms;
    }
}
