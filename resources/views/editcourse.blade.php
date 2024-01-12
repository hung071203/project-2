@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Course /</span> Edit Course</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Edit Course</h5>
            <div class="card-body">
                <form id="formAuthentication" class="mb-3" action="{{ route('editcr.update', ['course' => $courses->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Name</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="c_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$courses->c_Name}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Infration</label>
                                <input type="number" step="0.01" class="form-control" id="defaultFormControlInput" name="c_Inflationary" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$courses->c_Inflationary}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">Update</button>
                </form>
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    <!-- / Content -->
@endsection
