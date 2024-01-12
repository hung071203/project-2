<?php

namespace App\Http\Controllers;

use App\Models\classmate;
use App\Http\Requests\StoreclassmateRequest;
use App\Http\Requests\UpdateclassmateRequest;
use App\Models\Course;
use App\Models\Major;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClassmateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        session(['search' => 3]);
        $classmate = new Classmate();
        $classmate->price();

        $classmates = $classmate->index()->paginate(10);

        return view('Class.index', compact('classmates'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mj = new Major();
        $mjs = $mj ->index();
        $course = new Course();
        $courses=$course->index();
        return view('Class.addClass',[
            'mjs'=>$mjs,
            'courses'=>$courses
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreclassmateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassmateRequest $request)
    {
        $newClass = $request->input('class_Name');
        $m_ID = $request->input('m_ID');
        $c_ID = $request->input('c_ID');

        if ($m_ID != $c_ID) {
            $existingClassmate = Classmate::where('class_Name', $newClass)->first();

            if (!$existingClassmate) {
                $check = new Classmate();
                $check->storeCl($request);
                return Redirect::route('class')->with('success', 'Class added successfully!');
            } else {
                return redirect()->route('class')->with('error', 'Failed to add class. Please try again.');
            }
        } else {
            return redirect()->route('class')->with('error', 'Failed to add class. Please try again.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\classmate  $classmate
     * @return \Illuminate\Http\Response
     */
    public function show(classmate $classmate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\classmate  $classmate
     * @return \Illuminate\Http\Response
     */
    public function edit(classmate $classmate, Request $request)
    {
        //
        $value = $classmate->editClass($request->class);
        $mj = new Major();
        $mjs = $mj ->index();
        $course = new Course();
        $courses=$course->index();
        return view('Class.edit',[
            'classmate'=>$value,
            'mjs'=>$mjs,
            'courses'=>$courses
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateclassmateRequest  $request
     * @param  \App\Models\classmate  $classmate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassmateRequest $request, Classmate $classmate)
    {
        $new_m_ID = $request->input('m_ID');
        $new_c_ID = $request->input('c_ID');

        $existingClassmate = Classmate::where('id', '!=', $classmate->id)
            ->where('c_ID', $new_c_ID)
            ->where('m_ID', $new_m_ID)
            ->first();

        if ($existingClassmate) {
            return redirect()->route('class')->with('error', 'Classmate with this combination of m_ID and c_ID already exists!');
        }

        $classmate->updatecl($request);
        return redirect()->route('class')->with('success', 'Classmate updated successfully!');
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\classmate  $classmate
     * @return \Illuminate\Http\Response
     */
    public function destroy(classmate $classmate)
    {
        //
    }
    public function getClass($student_id)
    {
        // Tìm thông tin lớp của học sinh dựa trên $student_id
        $studentClass = Student::where('s_ID', $student_id)->pluck('class_ID')->first();

        // Trả về dữ liệu lớp dưới dạng JSON
        if (!is_null($studentClass)) {
            // Trả về dữ liệu lớp dưới dạng JSON
            return response()->json(['class' => $studentClass]);
        } else {
            // Trả về một phản hồi rỗng hoặc thông báo lỗi nếu không tìm thấy thông tin lớp.
            return response()->json(['class' => null]);
        }
    }
}
