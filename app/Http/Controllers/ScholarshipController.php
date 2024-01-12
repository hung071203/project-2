<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Http\Requests\StoreScholarshipRequest;
use App\Http\Requests\UpdateScholarshipRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => 5]);
        $scholarships = Scholarship::paginate(10);
        return view('Scholarship.index', compact('scholarships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schol = Scholarship::all();
        return view('Scholarship.addSC', [
            'scholarships' => $schol
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScholarshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScholarshipRequest $request)
    {
        if($request->sl_Price < 0){
            return redirect()->route('scholarship')->with('error', 'Scholarships create failse');
        }
        $newPrice = $request->input('sl_Price');

        $existingScholarship = Scholarship::where('sl_Price', $newPrice)->first();


        if (!$existingScholarship) {
            Scholarship::create($request->all());
            return Redirect::route('scholarship')->with('success', 'New scholarships have been added!');
        } else {
            return redirect()->route('scholarship')->with('error', 'Scholarships already exist with this value!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function show(Scholarship $scholarship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function edit(Scholarship $scholarship)
    {
        //
        return view('Scholarship.editSC', [
            'scholarship' => $scholarship
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScholarshipRequest  $request
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScholarshipRequest $request, Scholarship $scholarship)
    {
        if($request->sl_Price < 0){
            return redirect()->route('scholarship')->with('error', 'Scholarships update failse');
        }

        $newPrice = $request->input('sl_Price');
        $originalPrice = $scholarship->getOriginal('sl_Price');

        if ($newPrice != $originalPrice && Scholarship::where('sl_Price', $newPrice)->exists()) {
            return redirect()->route('scholarship')->with('error', 'Scholarship with this price already exists!');
        }

        $scholarship->update($request->all());

        return Redirect::route('scholarship')->with('success', 'Update success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scholarship  $scholarship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scholarship $scholarship)
    {
        //
        try {
            $scholarship->delete();

            return redirect()->route('scholarship')->with('success', 'Delete Success!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                return redirect()->route('scholarship')->with('error', 'This scholarship cannot be removed.');
            } else {
                \Log::error($e);
                return redirect()->route('scholarship')->with('error', 'An error occurred while deleting the scholarship.');
            }
        }
    }
}
