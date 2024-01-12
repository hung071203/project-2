@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Class /</span> Edit Class</h4>
        {{--        @dd($courses)--}}
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Edit Class</h5>
            <div class="card-body">
                @foreach($classmate as $class)
                <form id="formAuthentication" class="mb-3" action="{{route('editclass.update',['class'=>$class->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Name Class</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="class_Name" value="{{$class->class_Name}}" placeholder="Please input..." aria-describedby="defaultFormControlHelp">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Majors</label>
                                <select class="form-select" id="studentSelect" name="m_ID" aria-describedby="defaultFormControlHelp">
                                    @foreach($mjs as $mj)
                                        <option value="{{ $mj->id}}" @if($class->m_ID == $mj->id) selected @endif >{{ $mj->m_Name }}</option>
                                    @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Courses</label>
                                <select class="form-select" id="studentSelect" name="c_ID" aria-describedby="defaultFormControlHelp">

                                    @foreach($courses as $course)
                                        <option value="{{ $course->id}}" @if($class->c_ID == $course->id) selected @endif >{{ $course->c_Name}}</option>
                                    @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>


                    <button class="btn btn-primary">Update</button>
                </form>
                @endforeach
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    <!-- / Content -->
@endsection

