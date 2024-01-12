@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('error'))
            <div class="alert alert-danger" id="myText">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success" id="myText">
                {{ session('success') }}
            </div>
        @endif
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Invoices</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Invoices</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Student</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Submission date</th>
                        <th>PaymentMethod</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @php
                        $unpaidInvoices = [];
                        $paidInvoices = [];
                    @endphp

                    @foreach($invoices as $invoi)
                        @if($invoi->i_Status == 1)
                            @php
                                $paidInvoices[] = $invoi;
                            @endphp
                        @else
                            @php
                                $unpaidInvoices[] = $invoi;
                            @endphp
                        @endif
                    @endforeach

                    @foreach($paidInvoices as $invoi)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$invoi->i_ID}}</strong></td>
                            <td>{{$invoi->name_s}}</td>
                            <td>{{$invoi->s_ID}}</td>
                            <td>{{$invoi->class_name}}_{{$invoi->c_Name}}</td>
                            <td>@if($invoi->i_Status == 1) @else{{$invoi->i_Date}} @endif</td>
                            <td>{{$invoi->pay_Name}}</td>
                            <td>@if($invoi->i_Status == 0) <span class="badge bg-label-success me-1">Paid</span>@else<span class="badge bg-label-danger me-1">Unpaid</span>@endif</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($invoi->i_Status == 0||session('student'))
                                            <a class="dropdown-item" href="{{ route('editIV', ['invoice' => $invoi->i_ID])}}">
                                                <i class="bx bx-show me-1"></i> Invoice details
                                            </a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('editIV', ['invoice' => $invoi->i_ID])}}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @foreach($unpaidInvoices as $invoi)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$invoi->i_ID}}</strong></td>
                            <td>{{$invoi->name_s}}</td>
                            <td>{{$invoi->s_ID}}</td>
                            <td>{{$invoi->class_name}}_{{$invoi->c_Name}}</td>
                            <td>@if($invoi->i_Status == 1) @else{{$invoi->i_Date}} @endif</td>
                            <td>{{$invoi->pay_Name}}</td>
                            <td>@if($invoi->i_Status == 0) <span class="badge bg-label-success me-1">Paid</span>@else<span class="badge bg-label-danger me-1">Unpaid</span>@endif</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if($invoi->i_Status == 0||session('student'))
                                            <a class="dropdown-item" href="{{ route('editIV', ['invoice' => $invoi->i_ID])}}">
                                                <i class="bx bx-show me-1"></i> Invoice details
                                            </a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('editIV', ['invoice' => $invoi->i_ID])}}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $invoices->url(1)}}">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item prev">
                        <a class="page-link" href="{{ $invoices->previousPageUrl()}}">
                            <i class="tf-icon bx bx-chevron-left"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $invoices->lastPage(); $i++)
                        <li class="page-item {{ ($invoices->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $invoices->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item next">
                        <a class="page-link" href="{{ $invoices->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $invoices->url($invoices->lastPage()) }}">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        <hr class="my-5" />
    </div>
    <!-- / Content -->
@endsection
