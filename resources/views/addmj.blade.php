@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Majors /</span> Add new Majors</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Add new Majors</h5>
            <div class="card-body">
                <form id="formAuthentication" class="mb-3" action="{{route('addmj.store')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Name</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="m_Name" placeholder="Please input..." aria-describedby="defaultFormControlHelp">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Duration Of Study</label>
                                <input type="number" step="0.01" class="form-control" id="defaultFormControlInput" name="m_DOS" placeholder="Please input..." aria-describedby="defaultFormControlHelp" >
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Price $</label>
                                <input type="number" class="form-control" id="defaultFormControlInput" name="m_Price" placeholder="Please input..." aria-describedby="defaultFormControlHelp">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary">Add new</button>
                </form>
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    <!-- / Content -->
@endsection

