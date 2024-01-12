@extends('master.index')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img
                                        src="{{asset("assets/img/icons/unicons/student.png")}}"
                                        alt="chart success"
                                        class="rounded"
                                    />
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Number of students</span>
                            <h3 class="card-title mb-2">{{$numst}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{asset("assets/img/icons/unicons/money2.png")}}" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="d-block mb-1">Total amount owed of student</span>
                            <h3 class="card-title text-nowrap mb-2">{{$tao}}$</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img
                                        src="{{asset("assets/img/icons/unicons/money3.png")}}"
                                        alt="Credit Card"
                                        class="rounded"
                                    />

                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Month's revenue(<strong>{{$m}}/{{$y}}</strong>)</span>
                            <h3 class="card-title mb-2">{{$numem}}$</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{asset("assets/img/icons/unicons/money.png")}}" alt="Credit Card" class="rounded" />
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Total revenue</span>
                            <h3 class="card-title mb-2">{{$ta}}$</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection
