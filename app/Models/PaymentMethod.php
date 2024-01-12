<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentMethod extends Model
{
    use HasFactory;
    public function index(){
        $payment = DB::table('payment_methods')
            ->get();
        return $payment;
    }
}
