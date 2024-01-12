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

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Students</h4>
            @if(session('admin'))
                <a class="btn btn-outline-primary" href="{{route('addStudent')}}">Add new Student</a>
            @endif

            @php
                $tempArray = [];

            @endphp

            @foreach($dates as $date)
                @php
                    $id = $date->s_ID;
                    $ngay = $date->i_Date;

                    if (!array_key_exists($id, $tempArray) || strtotime($ngay) > strtotime($tempArray[$id]['i_Date'])) {
                        $tempArray[$id] = ['s_ID' => $id, 'i_Date' => $ngay];
                    }
                @endphp
            @endforeach

            @php
                $arrays = array_values($tempArray);
            @endphp

{{--            @dump($arrays)--}}
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Students</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Student</th>
                        <th>Class</th>
                        <th>Birth Date</th>
                        <th>Form of Payment</th>
                        <th>Scholarship</th>
                        <th>Total amount owed</th>
                        <th>Pay deadline</th>
                        @if(session('employee')||session('admin'))<th>Status</th>  @endif
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($students as $student)

                        <tr>
                            @if(session('student'))
                                @if(session('student.id') == $student -> id)
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"><strong>{{$student -> id}}</strong></i> </td>
                                    <td class="text-danger">{{$student -> s_Name}}</td>
                                @else
                                    <td><i class="fab fa-angular fa-lg me-3"><strong>{{$student -> id}}</strong></i> </td>
                                    <td>{{$student -> s_Name}}</td>
                                @endif
                            @else
                                <td><i class="fab fa-angular fa-lg me-3"><strong>{{$student -> id}}</strong></i> </td>
                                <td>{{$student -> s_Name}}</td>
                            @endif


                            <td>{{ $student-> name_class}}_{{$student-> c_Name}}</td>
                            <td>{{$student -> s_BirthDate}}</td>
                            <td>{{$student -> f_Name}}</td>
                            <td>{{$student -> sl_Price}}$</td>
                                @php
                                    $found = false;
                                @endphp

                                @foreach($arrays as $array)
                                    @if($array['s_ID'] == $student->id)
                                        @php
                                            $found = true;
                                        @endphp

                                        @if($student->f_ID == 1)
                                            @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*10)
                                                <td>{{$student -> s_TotalAO}}$</td>
                                            @else
                                                <td>0$</td>
                                            @endif
                                        @elseif($student->f_ID == 2)
                                            @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*30)
                                                <td>{{$student -> s_TotalAO}}$</td>
                                            @else
                                                <td>0$</td>
                                            @endif
                                        @elseif($student->f_ID == 3)
                                            @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*120)
                                                <td>{{$student -> s_TotalAO}}$</td>
                                            @else
                                                <td>0$</td>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach

                                @if(!$found)
                                    <td>{{$student->s_TotalAO}}$</td>
                                @endif


                                <td>{{$student -> s_PayDeadline}}</td>
                            @if(session('employee')||session('admin'))<td>@if($student -> s_Status == 0) <span class="badge bg-label-success me-1">Active</span>@else<span class="badge bg-label-danger me-1">Inactive</span>@endif</td> @endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(session('employee')||session('admin'))
                                        <a class="dropdown-item" href="{{ route('editST', ['student' => $student->id])}}"
                                        ><i class="bx bx-edit-alt me-1" ></i> Edit</a
                                        >
                                        @foreach($arrays as $array)
                                            @if($array['s_ID'] == $student->id)
                                                {{--                                    @dd($student->f_ID)--}}
                                                @if($student->f_ID == 1)
                                                    @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*10)
                                                        <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                        ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                        >

                                                    @endif
                                                @elseif($student->f_ID == 2)
                                                    @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*30)
                                                        <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                        ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                        >

                                                    @endif
                                                @elseif($student->f_ID == 3)
                                                    @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*120)
                                                        <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                        ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                        >

                                                    @endif
                                                @endif

                                            @endif
                                        @endforeach
                                            @if(!$found)
                                                <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                >
                                            @endif
                                        @elseif(session('student'))
                                            @if(session('student.id') == $student -> id)
                                                @if(session('student.f_ID') == 1)
                                                    @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*10)
                                                        <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                        ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                        >

                                                    @endif
                                                @elseif(session('student.f_ID') == 2)
                                                    @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*30)
                                                        <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                        ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                        >

                                                    @endif
                                                @elseif(session('student.f_ID') == 3)
                                                    @if(strtotime($student -> s_PayDeadline) - strtotime(date('Y-m-d')) <= 24*60*60*120)
                                                        <a class="dropdown-item" href="{{ route('addNewIV', ['student' => $student->id])}}"
                                                        ><i class="bx bx-chat me-1" ></i>Add Invoice</a
                                                        >

                                                    @endif
                                                @endif
                                            @endif
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
                        <a class="page-link" href="{{ $students->url(1)}}">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item prev">
                        <a class="page-link" href="{{ $students->previousPageUrl()}}">
                            <i class="tf-icon bx bx-chevron-left"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $students->lastPage(); $i++)
                        <li class="page-item {{ ($students->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $students->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item next">
                        <a class="page-link" href="{{ $students->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $students->url($students->lastPage()) }}">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        <hr class="my-5" />
    </div>
    <!-- / Content -->
@endsection

