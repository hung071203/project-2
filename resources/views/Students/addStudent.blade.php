@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Students /</span> Add Students</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Add Students</h5>
            <div class="card-body">
                    <form id="formAuthentication" class="mb-3" action="{{ route('addST.store') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">NAME STUDENT</label>
                                    <input type="text" class="form-control" id="" name="s_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="defaultFormControlInput" name="email" placeholder="EX@emial.com" aria-describedby="defaultFormControlHelp"  >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">Number Phone</label>
                                    <input type="text" class="form-control" id="defaultFormControlInput" name="s_Phone" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="defaultFormControlInput" name="s_Address" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="defaultFormControlInput" name="password" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">CLASS</label>
                                    <select class="form-select" id="formsofpaymentSelect" name="class_ID" aria-describedby="defaultFormControlHelp">
                                        <option value="">Please select...</option>
                                        @foreach($classmates as $class)
                                            <option value="{{ $class->id }}" >{{ $class->class_Name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">BIRTH DATE</label>
                                    <input type="date" class="form-control" id="defaultFormControlInput" name="s_BirthDate" placeholder="Please input..." aria-describedby="defaultFormControlHelp" >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="defaultFormControlInput" name="s_StartDate" placeholder="Please input..." aria-describedby="defaultFormControlHelp" >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">FORM OF PAYMENT</label>
                                    <select class="form-select" id="formsofpaymentSelect" name="f_ID" aria-describedby="defaultFormControlHelp">
                                        <option value="">Please select...</option>
                                        @foreach($formsofpayments as $form)
                                            <option value="{{ $form->id }}" >{{ $form->f_Name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>


                                <div class="mb-3">
                                    <label for="scholarshipSelect" class="form-label">SCHOLARSHIP</label>
                                    <select class="form-select" id="scholarshipSelect" name="sl_ID" aria-describedby="defaultFormControlHelp">
                                        <option value="" >Please select...</option>
                                        @foreach($scholarships as $sl)
                                            <option value="{{ $sl->id }}" >{{ $sl->sl_Price }}</option>
                                        @endforeach
                                    </select>
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>

                            </div>
                        </div>
                        <button class="btn btn-outline-primary">Add new Student</button>
                    </form>
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    <!-- / Content -->
@endsection
