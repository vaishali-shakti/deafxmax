@extends('admin.layout.master')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-10">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Change Password </h2>
                    <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Change Password</a></li>
                        </ol>
                    </nav>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
              <div class="card mb-5 shadow-sm">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                  <form method="post" action="{{ route('change_password_post') }}" id="change_password">
                    @csrf
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                        <input id="current_password" type="password" class="form-control" name="current_password" placeholder="Current Password" required>
                    </div>
                    <div id="current_password_error" class="error mb-2">
                    </div>
                    @error('current_password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                        <input id="new_password" type="password" name="new_password" placeholder="New Password" class="form-control"  required>
                    </div>
                    @error('new_password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-unlock"></i></span></div>
                        <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"  required>
                    </div>
                    @error('confirm_password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="col-xl-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('admin_script')
<script>
    $(document).ready(function() {
        $('#change_password').validate({
            errorPlacement: function(error, element) {
                if (element.attr("name") == "name") {
                    error.insertAfter( element.parent("div"));
                } else {
                    error.insertAfter( element.parent("div"));
                }
            },
            rules: {
                    'current_password': {
                        remote: {
                            type: 'get',
                            url: "{{ route('current_auth_password') }}",
                            data: {
                                'current_password': function () {
                                    return $("input[name='current_password']").val();
                                }
                            },
                            dataFilter: function(data) {
                                var json = JSON.parse(data);
                                if (json.status == 1) {
                                    $('#current_password_error').text(json.message);
                                }
                                else {
                                    $('#current_password_error').text("");
                                    return 'true';
                                }
                            }
                        },
                        required: true
                    },
                    confirm_password: {
                    equalTo: "#new_password"
                    }
				},
        });
    });
</script>
@endsection
