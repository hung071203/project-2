<?php

namespace App\Http\Controllers;

use App\Models\FormsOfPayment;
use App\Http\Requests\StoreFormsOfPaymentRequest;
use App\Http\Requests\UpdateFormsOfPaymentRequest;

class FormsOfPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFormsOfPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormsOfPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormsOfPayment  $formsOfPayment
     * @return \Illuminate\Http\Response
     */
    public function show(FormsOfPayment $formsOfPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormsOfPayment  $formsOfPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(FormsOfPayment $formsOfPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFormsOfPaymentRequest  $request
     * @param  \App\Models\FormsOfPayment  $formsOfPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormsOfPaymentRequest $request, FormsOfPayment $formsOfPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormsOfPayment  $formsOfPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormsOfPayment $formsOfPayment)
    {
        //
    }
}
