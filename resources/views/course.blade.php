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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Courses </h4>
        @if(session('admin'))
        <a class="btn btn-outline-primary" href="{{route('addcr')}}">Add new Course</a>
        @endif
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Course</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Inflationary</th>
                        @if(session('admin'))
                        <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($courses as $course)<tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$course->id}}</strong></td>
                        <td>{{$course -> c_Name}}</td>
                        <td>
                            {{$course -> c_Inflationary}}%
                        </td>
                        @if(session('admin'))
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('editcr', ['course' => $course->id]) }}"
                                    ><i class="bx bx-edit-alt me-1" ></i> Edit</a
                                    >
                                    <form method="post" action="{{ route('destroy.cr', ['course' => $course->id]) }}" class="dropdown-item">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bx bx-trash me-1 btn btn-icon me-2 btn-label-secondary" onclick="confirmDelete(this)">Delete</button>
                                    </form>

                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                                    <script>
                                        function confirmDelete(button) {
                                            Swal.fire({
                                                title: 'Confirm deletion?',
                                                text: 'Are you sure?',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'OK',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    const form = button.closest('form');
                                                    if (form) {
                                                        form.submit();
                                                    }
                                                }
                                            });
                                        }
                                    </script>

                                </div>
                            </div>
                        </td>
                        @endif
                    </tr> @endforeach


                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item first">
                    <a class="page-link" href="{{ $courses->url(1)}}">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev">
                    <a class="page-link" href="{{ $courses->previousPageUrl()}}">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                @for ($i = 1; $i <= $courses->lastPage(); $i++)
                    <li class="page-item {{ ($courses->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $courses->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item next">
                    <a class="page-link" href="{{ $courses->nextPageUrl() }}">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last">
                    <a class="page-link" href="{{ $courses->url($courses->lastPage()) }}">
                        <i class="tf-icon bx bx-chevrons-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <hr class="my-5" />
    </div>
    <!-- / Content -->
@endsection
