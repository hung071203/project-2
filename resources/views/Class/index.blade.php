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
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Class</h4>
        @if(session('admin'))
            <a class="btn btn-outline-primary" href="{{route('addclass')}}">Add new Class</a>
        @endif
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Class</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Class name</th>
                        <th>Course</th>
                        <th>Major</th>
                        <th>Total price</th>
                        @if(session('admin'))
                            <th>Action</th>
                        @endif
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($classmates as $class)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$class->id}}</strong></td>
                                <td>{{$class->class_Name}}</td>
                                <td>{{$class->c_Name}}</td>
                                <td>{{$class->m_Name}}</td>
                                <td>{{$class->class_TotalPrice}}$</td>
                                @if(session('admin'))
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('editclass', ['class' => $class->id]) }}"
                                                ><i class="bx bx-edit-alt me-1" ></i> Edit</a
                                                >


                                            </div>
                                        </div>
                                    </td>
                                @endif
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
                    <a class="page-link" href="{{ $classmates->url(1)}}">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev">
                    <a class="page-link" href="{{ $classmates->previousPageUrl()}}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                @for ($i = 1; $i <= $classmates->lastPage(); $i++)
                    <li class="page-item {{ ($classmates->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $classmates->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item next">
                    <a class="page-link" href="{{ $classmates->nextPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last">
                    <a class="page-link" href="{{ $classmates->url($classmates->lastPage()) }}">
                        <i class="tf-icon bx bx-chevrons-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <hr class="my-5" />
    </div>
    <!-- / Content -->
@endsection
