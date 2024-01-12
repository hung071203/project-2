@extends('master.index')
@section('content')
{{--    @dd($employee)--}}
@foreach($invoices as $invoi)
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4" id="invoice-heading"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Invoices /</span> @if(($invoi->i_Status) == 0||session('student')) Invoice Detail @else Edit Invoice @endif</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header" id="invoice-heading">@if(($invoi->i_Status) == 0||session('student')) Invoice Detail @else Edit Invoice @endif</h5>
            <div class="card-body">

                <form id="formAuthentication" class="mb-3" action="{{ route('editIV.update', ['invoice' => $invoi->i_ID])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="class_ID" name="i_ID" value="{{$invoi->i_ID}}" readonly>
                                <input type="hidden" class="form-control" id="defaultFormControlInput" name="s_ID" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$invoi->s_ID}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">NAME STUDENT</label>
                                <input type="text" class="form-control" id="class_ID" name="s_name" value="{{$invoi->name_s}}" readonly>
                                <input type="hidden" class="form-control" id="defaultFormControlInput" name="s_ID" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$invoi->s_ID}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Money</label>
                                <input type="text" class="form-control" id="class_ID" name="i_Money" value="{{$invoi->i_Money}}$" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Submission date</label>
                                <input type="text" class="form-control" id="classInput" name="i_Date" value="@if($invoi->i_Status == 0) {{$invoi->i_Date}} @else {{date('Y-m-d')}}@endif" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Paymentmenthod</label>
                                <select class="form-select" id="paymentSelect" name="pay_ID" aria-describedby="defaultFormControlHelp" @if(($invoi->i_Status) == 0 ||session('student')) disabled @endif>
                                    <option value="" >Please select...</option>
                                    @foreach($payments as $pay)
                                        <option value="{{ $pay->id }}" @if($invoi->pay_ID == $pay->id) selected @endif>{{ $pay->pay_Name }}</option>
                                    @endforeach
                                </select>
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
{{--                            @dd($invoi->e_ID, $employee)--}}
                            @if($invoi->i_Status == 0)

                                <div class="mb-3">
                                    <label for="classInput" class="form-label">Managers</label>
                                    <select class="form-select" id="defaultFormControlInput" name="e_ID" aria-describedby="defaultFormControlHelp" @if(($invoi->i_Status) == 0 ||session('student')) disabled @endif>

                                        @php $check = false; @endphp

                                        @foreach($employee as $em)
                                            <option value="{{$em->id}}" @if($em->id == $invoi->e_ID)
                                                @php $check = true; @endphp
                                                selected
                                                @endif>
                                                <span class="badge bg-label-success me-1">{{$em->e_Name}}</span>
                                            </option>
                                        @endforeach

                                        @if (!$check)
                                            <option value="" selected>
                                                <span class="badge bg-label-success me-1">Please select...</span>
                                            </option>
                                        @endif
                                    </select>
                                </div>



                            @elseif($invoi->i_Status == 1)
                                <div class="mb-3">
                                    <label for="classInput" class="form-label">Managers</label>
                                    <select class="form-select" id="defaultFormControlInput" name="e_ID" aria-describedby="defaultFormControlHelp" @if(($invoi->i_Status) == 0||session('student')) disabled @endif>

                                        @php $check = false; @endphp

                                        @foreach($employee as $em)
                                            <option value="{{$em->id}}" @if($em->id == $invoi->e_ID)
                                                @php $check = true; @endphp
                                                selected
                                                @endif>
                                                <span class="badge bg-label-success me-1">{{$em->e_Name}}</span>
                                            </option>
                                        @endforeach

                                        @if (!$check)
                                            <option value="" selected>
                                                <span class="badge bg-label-success me-1">Please select...</span>
                                            </option>
                                        @endif
                                    </select>
                                </div>


                            @if(session('employee'))
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="defaultFormControlInput" name="e_ID" value="{{session('employee.id')}}" readonly>
                                    <label for="classInput" class="form-label">New-Managers</label>
                                    <input type="text" class="form-control" id="defaultFormControlInput" name="e_name" value="{{session('employee.e_Name')}}" readonly>
                                </div>
                                @endif
                            @endif
                            <div class="mb-3">
                                <label for="statusSelect" class="form-label">STATUS</label>
                                <select class="form-select" id="defaultFormControlInput" name="i_Status" aria-describedby="defaultFormControlHelp" @if(($invoi->i_Status) == 0||session('student')) disabled @endif>
                                    <option value="">Please select...</option>c
                                    <option value="0" @if(($invoi->i_Status) == 0) selected @endif><span class="badge bg-label-success me-1">Paid</span></option>
                                    <option value="1" @if(($invoi->i_Status) == 1) selected @endif><span class="badge bg-label-danger me-1">Unpaid</span></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if(session('employee')||session('admin'))
                        @if(($invoi->i_Status) == 1)
                            <button class="btn btn-primary">Update</button>
                        @else
                        @endif
                    @endif
                </form>

                @endforeach
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>

    <!-- / Content -->
@endsection
