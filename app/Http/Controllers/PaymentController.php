<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPayments;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        ProcessPayments::dispatch($id);
    }
    
}
