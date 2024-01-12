@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Invoices /</span> Add Invoices</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Add Invoices</h5>
            <div class="card-body">
                <form id="formAuthentication" class="mb-3" action="{{ route('storeNewIV') }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">NAME STUDENT</label>
                                @foreach($student as $st)
                                    <input type="text" class="form-control" id="class_ID" name="s_Name" placeholder="Enter the amount here ..." value="{{$st->s_Name}}" readonly>
                                    <input type="hidden" class="form-control" id="class_ID" name="s_ID" placeholder="Enter the amount here ..." value="{{$st->id}}" readonly>

                               <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Money</label>
                                <input type="text" class="form-control" id="class_ID" name="i_Money" placeholder="Enter the amount here ..." value="{{$st->s_TotalAO}}" readonly>
                            </div> @endforeach
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Submission date</label>
                                <input type="date" class="form-control" id="classInput" name="i_Date" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Paymentmenthod</label>
                                <select class="form-select" id="studentSelect" name="pay_ID" aria-describedby="defaultFormControlHelp">
                                    @foreach($payments as $pay)
                                        @php
                                            $selected = (isset($invoi->pay_ID) && $invoi->pay_ID == $pay->id) ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $pay->id}}" {{ $selected }}>{{ $pay->pay_Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if(session('employee'))
                            <div class="mb-3">
                                <label for="classInput" class="form-label">Managers</label>
                                <input type="text" class="form-control" id="class_ID" name="mn" placeholder="......" value="{{session('employee.e_Name')}}"  readonly>
                                <input type="hidden" class="form-control" id="class_ID" name="e_ID" placeholder="......"  value="{{session('employee.id')}}" readonly>

                            </div>
                            @endif
                         @if(session('employee')||session('admin'))
                                <div class="mb-3">
                                    <label for="statusSelect" class="form-label">STATUS</label>
                                    <select class="form-select" id="" name="i_Status" aria-describedby="defaultFormControlHelp">
                                        <option value="0" @if(isset($invoi->i_Status) == 0) selected @endif><span class="badge bg-label-success me-1">Paid</span></option>
                                        <option value="1" @if(isset($invoi->i_Status) == 1) selected @endif><span class="badge bg-label-danger me-1">Unpaid</span></option>
                                    </select>
                                </div>
                            @elseif(session('student'))
                                <input type="hidden" class="form-control" id="class_ID" name="i_Status" placeholder="......"  value="1" readonly>
                         @endif
                        </div>
                    </div>

                    <button class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>

    <!-- / Content -->
@endsection
