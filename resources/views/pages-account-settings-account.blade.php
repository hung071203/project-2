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

                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                      <li></li>
{{--                      <li class="nav-item">--}}
{{--                          <a class="nav-link " href="{{route('changePass')}}"><i class='bx bxs-lock-alt'></i> Change Password</a>--}}
{{--                      </li>--}}

                  </ul>
                    @if(session('employee'))
                        <div class="card mb-4">
                                            <h5 class="card-header">Profile Details</h5>
                                            <!-- Account -->
                                            <div class="card-body">

                                            </div>
                                            <hr class="my-0" />
                                            <div class="card-body">

                                              <form id="formAccountSettings" method="POST" action="{{route('editEm')}}">
                                                  @csrf
                                                  @method('PUT')
                                                  <div class="row">
                                                  <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Name</label>
                                                    <input
                                                      class="form-control"
                                                      type="text"
                                                      id="firstName"
                                                      name="e_Name"
                                                      value="{{session('employee.e_Name')}}"

                                                      autofocus
                                                    />
                                                  </div>

                                                  <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input
                                                      class="form-control"
                                                      type="text"
                                                      id="email"
                                                      name="email"
                                                      value="{{session('employee.email')}}"
                                                      placeholder="john.doe@example.com"
                                                      readonly
                                                    />
                                                  </div>
                                                  <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                      <input
                                                        type="text"
                                                        id="phoneNumber"
                                                        name="e_Phone"
                                                        value="{{session('employee.e_Phone')}}"
                                                        class="form-control"
                                                        placeholder=""
                                                      />
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="mt-2">
                                                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                </div>
                                              </form>

                                            </div>
                                            <!-- /Account -->
                                          </div>

                            <div class="card mb-4">
                                <h5 class="card-header">Change Password</h5>
                                <!-- Account -->
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">

                                    <form id="formAccountSettings" method="POST" action="{{route('changePass')}}" onsubmit="">
                                        <div class="row">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Old Password</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    id="firstName"
                                                    name="password_old"
                                                    value=""

                                                    autofocus
                                                />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">New password</label>
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    id="email"
                                                    name="password"
                                                    value=""
                                                    placeholder="password"
                                                />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="phoneNumber">ReEnter new password</label>
                                                <div class="input-group input-group-merge">
                                                    <input
                                                        type="text"
                                                        id="phoneNumber"
                                                        name="re_Pass"
                                                        value=""
                                                        class="form-control"
                                                        placeholder=""
                                                    />
                                                </div>

                                            </div>
                                            <div class=" alert-danger" id="">Note: If you change your password successfully, you'll have to login again!</div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        </div>
                                    </form>

                                </div>
                    @elseif(session('student'))
                                    <div class="card mb-4">
                                        <h5 class="card-header">Profile Details</h5>
                                        <!-- Account -->
                                        <div class="card-body">

                                        </div>
                                        <hr class="my-0" />
                                        <div class="card-body">

                                            <form id="formAccountSettings" method="POST" action="{{route('editEm')}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="firstName" class="form-label">Name</label>
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="firstName"
                                                            name="s_Name"
                                                            value="{{session('student.s_Name')}}"

                                                            autofocus
                                                        />
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label for="email" class="form-label">E-mail</label>
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="email"
                                                            name="email"
                                                            value="{{session('student.email')}}"
                                                            placeholder="john.doe@example.com"
                                                            readonly
                                                        />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <input
                                                                type="text"
                                                                id="phoneNumber"
                                                                name="s_Phone"
                                                                value="{{session('student.s_Phone')}}"
                                                                class="form-control"
                                                                placeholder=""
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="phoneNumber">Address</label>
                                                        <div class="input-group input-group-merge">
                                                            <input
                                                                type="text"
                                                                id="phoneNumber"
                                                                name="s_Address"
                                                                value="{{session('student.s_Address')}}"
                                                                class="form-control"
                                                                placeholder=""
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- /Account -->
                                    </div>

                                    <div class="card mb-4">
                                        <h5 class="card-header">Change Password</h5>
                                        <!-- Account -->
                                        <div class="card-body">

                                        </div>
                                        <hr class="my-0" />
                                        <div class="card-body">

                                            <form id="formAccountSettings" method="POST" action="{{route('changePass')}}" onsubmit="">
                                                <div class="row">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3 col-md-6">
                                                        <label for="firstName" class="form-label">Old Password</label>
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="firstName"
                                                            name="password_old"
                                                            value=""

                                                            autofocus
                                                        />
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label for="email" class="form-label">New password</label>
                                                        <input
                                                            class="form-control"
                                                            type="text"
                                                            id="email"
                                                            name="password"
                                                            value=""
                                                            placeholder="password"
                                                        />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="phoneNumber">ReEnter new password</label>
                                                        <div class="input-group input-group-merge">
                                                            <input
                                                                type="text"
                                                                id="phoneNumber"
                                                                name="re_Pass"
                                                                value=""
                                                                class="form-control"
                                                                placeholder=""
                                                            />
                                                        </div>

                                                    </div>
                                                    <div class="alert alert-danger" id="">Note: If you change your password successfully, you'll have to login again!</div>

                                                </div>
                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                                </div>
                                            </form>

                                        </div>
                    @endif


                </div>
              </div>
            </div>
            <!-- / Content -->

@endsection
