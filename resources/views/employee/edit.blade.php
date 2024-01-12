@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Employee /</span> Edit Employee</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Edit Employee</h5>
            <div class="card-body">
                <form id="formAuthentication" class="mb-3" action="{{ route('editep.update', ['employee' => $employees->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Name</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="e_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$employees->e_Name}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Email</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="email" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$employees->email}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-8">
                    <div class="mb-3">
                        <label for="defaultFormControlInput" class="form-label">Password (<i class="fab fa-angular fa-lg text-danger me-3">Enter new password here!</i>)</label>
                        <input type="text" class="form-control" id="defaultFormControlInput" name="password" value="" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                        <div id="defaultFormControlHelp" class="form-text"></div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Phone</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="e_Phone" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$employees->e_Phone}}">
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
