<!doctype html>
<html lang="en">


<!-- Mirrored from preview.easetemplate.com/influence/html/influence/pages/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:16:51 GMT -->
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">


  <!-- Libs CSS -->
  @includeIf('admin.layout.css')
  <title>Forgot Password - Influence Bootstrap Admin Dashboard Template</title>

</head>

<body class="bg-light">
  <!-- ============================================================== -->
  <!-- forgot password  -->
  <!-- ============================================================== -->
  <div class="min-vh-100 d-flex align-items-center">
    <div class="splash-container">
      <div class="card shadow-sm">
        <div class="card-header text-center"><img class="logo-img" src="{{ url('admin/assets/images/logo.png') }}" alt="logo"><span
            class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
          <form method="post" id="forgot_pass_form">
            @csrf
            <p>Don't worry, we'll send you an email to reset your password.</p>
            <div class="form-group mb-2">
              <input class="form-control" type="email" name="email" required="" placeholder="Your Email"
                autocomplete="off">
            </div>
            {{-- <a class="btn btn-block btn-primary btn-xl" href="../index-2.html">Reset Password</a> --}}
            <button type="submit" class="btn btn-block btn-primary btn-x">Reset Password</button>
          </form>
        </div>
        <div class="card-footer text-center">
          <span>Don't have an account? <a href="3">Sign Up</a></span>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- end forgot password  -->
  <!-- ============================================================== -->
  <!-- Libs JS -->
  @includeIf('admin.layout.js')
    <script>
        $(document).ready(function() {
            $("#forgot_pass_form").validate();
        });
    </script>
</body>
<!-- Mirrored from preview.easetemplate.com/influence/html/influence/pages/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:16:51 GMT -->
</html>
