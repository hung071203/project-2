@extends('master.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span><span class="text-muted fw-light">Scholarship /</span> Edit Scholarship</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Edit Scholarship</h5>
            <div class="card-body">
                <form id="formAuthentication" class="mb-3" action="{{ route('editSC.update', ['scholarship' => $scholarship->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                                <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Input Price</label>
                                <input type="number" class="form-control" id="defaultFormControlInput" name="sl_Price" placeholder="Please input..." aria-describedby="defaultFormControlHelp" value="{{$scholarship->sl_Price}}">
                                <div id="defaultFormControlHelp" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>


        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    <!-- / Content -->
@endsection
