<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Major;
use Illuminate\Support\Facades\Redirect;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['search' => 2]);
        $courses = Course::paginate(10);

        return view('course', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::all();
        return view('addcoures', [
            'courses' => $course
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $newPrice = $request->input('c_Name');

        $existingScholarship = Course::where('c_Name', $newPrice)->first();


        if (!$existingScholarship) {
            Course::create($request->all());
            return redirect()->route('course')->with('success', 'Course has been created successfully!');
        } else {
            return redirect()->route('course')->with('error', 'Failed to create course. Please try again.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('editcourse', [
            'courses' => $course
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $newPrice = $request->input('c_Name');

        $existingScholarship = Course::where('c_Name', $newPrice)->where('id', '!=', $course->id)->first();

        if (!$existingScholarship) {
            $course->update($request->all());
            return redirect()->route('course')->with('success', 'Course has been updated successfully!');
        } else {
            return redirect()->route('course')->with('error', 'Failed to update course. Please try again.');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            return redirect()->route('course')->with('success', 'Course has been deleted successfully!');
        }catch (\Exception $e) {
            return redirect()->route('course')->with('error', 'Failed to delete course. Please try again.');
        }
    }

}
