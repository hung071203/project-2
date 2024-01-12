@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Students /</span> Edit Students</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Edit Students</h5>
            <div class="card-body">
                @foreach($students as $student)
                <form id="formAuthentication" class="mb-3" action="{{ route('editST.update', ['student' => $student->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">NAME STUDENT</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="s_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student ->s_Name}}" @if(session('admin')) @else readonly @endif>
                                <input type="hidden" class="form-control" id="defaultFormControlInput" name="id" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student ->s_ID}}" readonly>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            @if(session('admin'))
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="defaultFormControlInput" name="email" value="{{$student ->email}}" placeholder="EX@emial.com" aria-describedby="defaultFormControlHelp"  >
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Number Phone</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="s_Phone" value="{{$student ->s_Phone}}" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Address</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="s_Address" value="{{$student ->s_Address}}" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">Password (<i class="fab fa-angular fa-lg text-danger me-3">Enter new password here!</i>)</label>
                                    <input type="password" class="form-control" id="defaultFormControlInput" name="password" value="" placeholder="Please input..." aria-describedby="defaultFormControlHelp"  >
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">CLASS</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="class_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student -> class_Name}}" readonly>
                                <input type="hidden" class="form-control" id="defaultFormControlInput" name="class_ID" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student -> class_ID}}" readonly>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">BIRTH DATE</label>
                                <input type="date" class="form-control" id="defaultFormControlInput" name="s_BirthDate" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student -> s_BirthDate}}" @if(session('employee') || session('student')) readonly @endif>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            @if(session('admin'))
                                <div class="mb-3">
                                    <label for="defaultFormControlInput" class="form-label">START DATE</label>
                                    <input type="date" class="form-control" id="defaultFormControlInput" name="s_StartDate" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student -> s_StartDate}}" readonly>
                                    <div id="defaultFormControlHelp" class="form-text"></div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">FORM OF PAYMENT</label>
                                <select class="form-select" id="formsofpaymentSelect" name="f_ID" aria-describedby="defaultFormControlHelp">
                                <option value="">Please select...</option>
                                @foreach($formsofpayments as $form)
                                    <option value="{{ $form->id }}" @if($student->f_ID == $form->id) selected @endif>{{ $form->f_Name }}</option>
                                @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">MAJORS</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="m_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$student -> m_Name}}" readonly>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="scholarshipSelect" class="form-label">SCHOLARSHIP</label>
                                <select class="form-select" id="scholarshipSelect" name="sl_ID" aria-describedby="defaultFormControlHelp">
                                    <option value="" >Please select...</option>
                                    @foreach($scholarships as $sl)
                                        <option value="{{ $sl->id }}" @if($student->sl_ID == $sl->id) selected @endif>{{ $sl->sl_Price }}</option>
                                    @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>

                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">TOTAL AMOUNT OWED</label>
                                <input type="number" class="form-control" id="defaultFormControlInput" name="s_TotalAO" placeholder="Please input..." readonly aria-describedby="defaultFormControlHelp" value="{{$student -> s_TotalAO}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Pay Deadline</label>
                                <input type="date" class="form-control" id="defaultFormControlInput" name="s_PayDeadline" placeholder="Please input..." readonly aria-describedby="defaultFormControlHelp" value="{{$student -> s_PayDeadline}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="statusSelect" class="form-label">STATUS</label>
                                <select class="form-select" id="" name="s_Status" aria-describedby="defaultFormControlHelp">
                                    <option value="">Please select...</option>

                                        <option value="0" @if($student->s_Status == 0) selected @endif><span class="badge bg-label-success me-1">Active</span></option>
                                        <option value="1" @if($student->s_Status == 1) selected @endif><span class="badge bg-label-danger me-1">Inactive</span></option>

                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary">Update</button>
                </form>
                @endforeach
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    <!-- / Content -->
@endsection
