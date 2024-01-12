@include("master.header")
  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img
                        src="{{ asset("assets/img/elements/BKACAD.png") }}"
                        alt="Credit Card"
                        class="rounded"
                        width="130"
                        height="35"
                    />
                  </span>
{{--                  <span class="app-brand-text demo text-body fw-bolder">BKACAD</span>--}}
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome to BKACAD! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
                @if (session('error'))
                    <div class="alert alert-danger" id="myText">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" id="">
                        {{ session('success') }}
                    </div>
                @endif

              <form id="formAuthentication" class="mb-3" action="{{route('checkLogin')}}" method="POST">
                  @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email </label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email "
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="{{route('forgotPass')}}">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->




    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset("assets/vendor/libs/jquery/jquery.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/popper/popper.js")}}"></script>
    <script src="{{asset("assets/vendor/js/bootstrap.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>

    <script src="{{asset("assets/vendor/js/menu.js")}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset("assets/vendor/libs/apex-charts/apexcharts.js")}}"></script>

    <!-- Main JS -->
    <script src="{{asset("assets/js/main.js")}}"></script>

    <!-- Page JS -->
    <script src="{{asset("assets/js/dashboards-analytics.js")}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
