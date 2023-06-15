<!doctype html>
<html lang="en">


<!-- Mirrored from preview.easetemplate.com/influence/html/influence/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:16:50 GMT -->
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ url('admin/assets/images/favicon.ico') }}" type="image/x-icon">

  <!-- Libs CSS -->
  @includeIf('admin.layout.css')
  <title>Login - Influence Bootstrap Admin Dashboard Template</title>
</head>

<body class="bg-light">
  <!-- ============================================================== -->
  <!-- login page  -->
  <!-- ============================================================== -->
  <div class="min-vh-100 d-flex align-items-center">
    <div class="splash-container">
      <div class="card shadow-sm">
        <div class="card-header text-center">
          <a href="../index-2.html"><img class="logo-img" src="{{ url('admin/assets/images/logo.png') }}" alt="logo"></a><span
            class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            @error('error')
                <p class="text-danger">{{ $message }}</p>
            @enderror
          <form action="{{ route('login_submit') }}" method="post" id="login_form">
            @csrf
            <div class="form-group mb-2">
              <input class="form-control" id="username" type="email" name="email" placeholder="Username" autocomplete="off" required>
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group mb-2">
              <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
            </div>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group">
              <label class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="remember"><span class="custom-control-label">Remember
                  Me</span>
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
          </form>
        </div>
        <div class="card-footer bg-white p-0  ">
          {{-- <div class="card-footer-item card-footer-item-bordered border-right d-inline-block  ">
            <a href="sign-up.html" class="footer-link">Create An Account</a></div> --}}
          <div class="card-footer-item card-footer-item-bordered d-inline-block ">
            <a href="{{ route('forgot_password') }}" class="footer-link">Forgot Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- end login page  -->
  <!-- ============================================================== -->
  <!-- Libs JS -->
  @includeIf('admin.layout.js')
  <script>
    $(document).ready(function() {
        $("#login_form").validate();
    });
    </script>
</body>


<!-- Mirrored from preview.easetemplate.com/influence/html/influence/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:16:50 GMT -->
</html>
