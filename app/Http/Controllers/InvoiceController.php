<?php

namespace App\Http\Controllers;

use App\Models\classmate;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Scholarship;
use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => 6]);
        $obj = new invoice();
        $invoices = $obj ->index()->paginate(10);
        return view('invoices.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $obj = new invoice();
        $invoices = $obj ->index();
        $student = $obj->showST($request ->student);
        $classmateModel = new Classmate();
        $class = $classmateModel->index();
        $empoloyees = new Employee();
        $empoloyee = $empoloyees->index();
        $payments = new PaymentMethod();
        $payment = $payments->index();

        return view("invoices.add",[
            'student' =>$student,
            'invoices' => $invoices , 'classmate' => $class ,
            'employee' => $empoloyee , 'payments'=> $payment
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreinvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreinvoiceRequest $request)
    {

        $obj = new invoice();
        $obj -> s_ID = $request -> s_ID;
        $obj -> e_ID = $request -> e_ID;
        $obj -> i_Status = $request -> i_Status;
        $obj -> i_Date = $request -> i_Date;
        $obj -> pay_ID = $request -> pay_ID;
        $obj -> i_Money = $request -> i_Money;
        if ($request -> i_Status == 0){
            $obj->updateDayDL($request->s_ID);
        }
        if (!$obj -> store()){
            return Redirect::route('invoice')->with('success', 'Add success!');
        }else{
            return Redirect::route('invoice') ->with('error', 'Add failse!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(invoice $invoice, Request $request)
    {
        $id = $invoice->id;
        $invoices = $invoice->edit($id);
        $payments = new PaymentMethod();
        $payment = $payments->index();
        $empoloyees = new Employee();
        $empoloyee = $empoloyees->index()->get();
        return view("invoices.edit",[
            'invoices' => $invoices  ,
            'employee' => $empoloyee,
            'payments'=> $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateinvoiceRequest  $request
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateinvoiceRequest $request, invoice $invoice)
    {
        if ($request->i_Status == null){
            return Redirect::route('invoice') ->with('error', 'Update failse!');
        }
        $invoice->i_ID = $request->i_ID;
        $invoice->pay_ID = $request->pay_ID;
        $invoice->e_ID = $request->e_ID;
        $invoice->i_Status = $request -> i_Status;
        if ($request -> i_Status == 0){
            $invoice->updateDayDL($request->s_ID);
        }
        if (!$invoice->updateinvoi()){
            return Redirect::route('invoice')->with('success', 'Update success!');
        }else{
            return Redirect::route('invoice') ->with('error', 'Update failse!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoice $invoice)
    {
        //
    }
}
