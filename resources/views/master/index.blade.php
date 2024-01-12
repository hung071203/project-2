
@include("master.header")
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
{{--        @dump(session('student'))--}}
      <div class="layout-container">
        <!-- Menu -->

        @include("master.menu")

          <div class="content-wrapper">
            <!-- Content -->


            @yield('content')
{{--@dump(session('admin'), session('employee'), session('student'))--}}
            @include("master.footer")
