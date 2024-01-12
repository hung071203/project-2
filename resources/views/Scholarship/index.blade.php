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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Scholarship</h4>

        <!-- Basic Bootstrap Table -->
        <a class="btn btn-outline-primary" href="{{route('addSC')}}">Add new Scholarship</a>
        <div class="card">
            <h5 class="card-header">Scholarship</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($scholarships as $scholarship)<tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$scholarship->id}}</strong></td>
                        <td>{{$scholarship -> sl_Price}}$</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('editSC', ['scholarship' => $scholarship->id]) }}"
                                    ><i class="bx bx-edit-alt me-1" ></i> Edit</a
                                    >
                                    <form method="post" action="{{ route('destroySC', ['scholarship' => $scholarship->id]) }}" class="dropdown-item">
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

                    </tr> @endforeach


                    </tbody>
                </table>

            </div>
        </div>

            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $scholarships->url(1)}}">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item prev">
                        <a class="page-link" href="{{ $scholarships->previousPageUrl()}}">
                            <i class="tf-icon bx bx-chevron-left"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $scholarships->lastPage(); $i++)
                        <li class="page-item {{ ($scholarships->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $scholarships->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item next">
                        <a class="page-link" href="{{ $scholarships->nextPageUrl() }}">
                            <i class="tf-icon bx bx-chevron-right"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $scholarships->url($scholarships->lastPage()) }}">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <hr class="my-5" />
    </div>
    <!-- / Content -->
@endsection
