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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Majors Tables</h4>
    @if(session('admin'))
    <a class="btn btn-outline-primary" href="{{route('addmj')}}">Add new Major</a>
    @endif
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Majors</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Duration of study</th>
                    <th>Price</th>
                    @if(session('admin'))
                    <th>Action</th>
                    @endif
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($majors as $major)<tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$major->id}}</strong></td>
                    <td>{{$major -> m_Name}}</td>
                    <td>{{$major -> m_DOS}} years</td>
                    <td>
                        {{$major -> m_Price}}$
                    </td>
                    @if(session('admin'))
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('editmj', ['major' => $major->id]) }}"
                                ><i class="bx bx-edit-alt me-1" ></i> Edit</a
                                >
                                <form method="post" action="{{ route('destroymj', ['major' => $major->id]) }}" class="dropdown-item">
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
                <a class="page-link" href="{{ $majors->url(1)}}">
                    <i class="tf-icon bx bx-chevrons-left"></i>
                </a>
            </li>
            <li class="page-item prev">
                <a class="page-link" href="{{ $majors->previousPageUrl()}}">
                    <i class="tf-icon bx bx-chevron-left"></i>
                </a>
            </li>
            @for ($i = 1; $i <= $majors->lastPage(); $i++)
                <li class="page-item {{ ($majors->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $majors->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item next">
                <a class="page-link" href="{{ $majors->nextPageUrl() }}">
                    <i class="tf-icon bx bx-chevron-right"></i>
                </a>
            </li>
            <li class="page-item last">
                <a class="page-link" href="{{ $majors->url($majors->lastPage()) }}">
                    <i class="tf-icon bx bx-chevrons-right"></i>
                </a>
            </li>
        </ul>
    </nav>
    <hr class="my-5" />
</div>
<!-- / Content -->
@endsection
{{--<div class="container-xxl flex-grow-1 container-p-y">--}}
{{--    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>--}}

{{--    <!-- Basic Bootstrap Table -->--}}
{{--    <div class="card">--}}
{{--        <h5 class="card-header">Majors</h5>--}}
{{--        <div class="table-responsive text-nowrap">--}}
{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>ID</th>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Price</th>--}}
{{--                    <th>Actions</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody class="table-border-bottom-0">--}}
{{--                <tr>--}}
{{--                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>--}}
{{--                    <td>Albert Cook</td>--}}
{{--                    <td>--}}

{{--                    </td>--}}
{{--                    <td><span class="badge bg-label-primary me-1">Active</span></td>--}}
{{--                    <td>--}}
{{--                        <div class="dropdown">--}}
{{--                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">--}}
{{--                                <i class="bx bx-dots-vertical-rounded"></i>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu">--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-edit-alt me-1"></i> Edit</a--}}
{{--                                >--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-trash me-1"></i> Delete</a--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>React Project</strong></td>--}}
{{--                    <td>Barry Hunter</td>--}}
{{--                    <td>--}}
{{--                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Lilian Fuller"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Sophia Wilkerson"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Christina Parker"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </td>--}}
{{--                    <td><span class="badge bg-label-success me-1">Completed</span></td>--}}
{{--                    <td>--}}
{{--                        <div class="dropdown">--}}
{{--                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">--}}
{{--                                <i class="bx bx-dots-vertical-rounded"></i>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu">--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-edit-alt me-2"></i> Edit</a--}}
{{--                                >--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-trash me-2"></i> Delete</a--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> <strong>VueJs Project</strong></td>--}}
{{--                    <td>Trevor Baker</td>--}}
{{--                    <td>--}}
{{--                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Lilian Fuller"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Sophia Wilkerson"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Christina Parker"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </td>--}}
{{--                    <td><span class="badge bg-label-info me-1">Scheduled</span></td>--}}
{{--                    <td>--}}
{{--                        <div class="dropdown">--}}
{{--                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">--}}
{{--                                <i class="bx bx-dots-vertical-rounded"></i>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu">--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-edit-alt me-2"></i> Edit</a--}}
{{--                                >--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-trash me-2"></i> Delete</a--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>Bootstrap Project</strong>--}}
{{--                    </td>--}}
{{--                    <td>Jerry Milton</td>--}}
{{--                    <td>--}}
{{--                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Lilian Fuller"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Sophia Wilkerson"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                            <li--}}
{{--                                data-bs-toggle="tooltip"--}}
{{--                                data-popup="tooltip-custom"--}}
{{--                                data-bs-placement="top"--}}
{{--                                class="avatar avatar-xs pull-up"--}}
{{--                                title="Christina Parker"--}}
{{--                            >--}}
{{--                                <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </td>--}}
{{--                    <td><span class="badge bg-label-warning me-1">Pending</span></td>--}}
{{--                    <td>--}}
{{--                        <div class="dropdown">--}}
{{--                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">--}}
{{--                                <i class="bx bx-dots-vertical-rounded"></i>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu">--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-edit-alt me-2"></i> Edit</a--}}
{{--                                >--}}
{{--                                <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                ><i class="bx bx-trash me-2"></i> Delete</a--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/ Basic Bootstrap Table -->--}}

{{--    <hr class="my-5" />--}}
{{--</div>--}}
{{--<!-- / Content -->--}}
