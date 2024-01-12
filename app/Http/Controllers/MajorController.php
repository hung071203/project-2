<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Redirect;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => 1]);
        $majors = Major::paginate(10);

        return view('tables-basic', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mj = Major::all();
        return view('addmj', [
            'majors' => $mj
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMajorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMajorRequest $request)
    {
        if($request->m_Price < 0){
            return redirect()->route('mj')->with('error', 'Failed to create major. Please try again.');
        }
        $newPrice = $request->input('m_Name');

        $existingScholarship = Major::where('m_Name', $newPrice)->first();


        if (!$existingScholarship) {
            Major::create($request->all());
            return redirect()->route('mj')->with('success', 'Major has been created successfully!');
        } else {
            return redirect()->route('mj')->with('error', 'Failed to create major. Please try again.');
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        return view('editmj', [
        'majors' => $major
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMajorRequest  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        if ($request->m_Price < 0) {
            return redirect()->route('mj')->with('error', 'Failed to update major. Please try again.');
        }

        $newName = $request->input('m_Name');

        $existingScholarship = Major::where('m_Name', $newName)->where('id', '!=', $major->id)->first();

        if (!$existingScholarship) {
            $major->update($request->all());
            return redirect()->route('mj')->with('success', 'Major has been updated successfully!');
        } else {
            return redirect()->route('mj')->with('error', 'Major with this name already exists!');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {

        try {
            $major->delete();
            return redirect()->route('mj')->with('success', 'Major has been deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('mj')->with('error', 'Failed to delete major. Please try again.');
        }
    }

}
