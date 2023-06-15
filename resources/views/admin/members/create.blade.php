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
                    <h2 class="pageheader-title">Create Members</h2>
                    <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('members.index') }}" class="breadcrumb-link">Members</a></li>
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Create Members</a></li>
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
                <h5 class="card-header">Create Members</h5>
                <div class="card-body">
                  <form method="post" action="{{ route('members.store') }}" id="add_members" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Name*" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                     @enderror
                     <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-address-book"></i></span></div>
                        <input id="name" type="text" class="form-control" name="surname" placeholder="Surname*" value="{{ old('surname') }}" required>
                    </div>
                    @error('surname')
                        <p class="text-danger">{{ $message }}</p>
                     @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                        <input id="email" type="email" name="email" placeholder="Email*" class="form-control" value="{{ old('email') }}" autocomplete="off" required>
                    </div>
                    <div id="current_email_error" class="error"></div>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                        <input id="mobile_no" type="text" name="mobile_no" class="form-control" placeholder="Mobile Number*" pattern="[0-9]+" maxlength="10" minlength="10" value="{{ old('mobile_no') }}" required>
                    </div>
                    @error('mobile_no')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-id-card-o"></i></span></div>
                          <input id="pancard_no" type="number" name="pancard_no" class="form-control" placeholder="Pan Card Number" value="{{ old('pancard_no') }}">
                    </div>
                    @error('pancard_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-bank"></i></span></div>
                          <input id="bank_act_no" type="number" name="bank_act_no" class="form-control" placeholder="Bank Acount Number" value="{{ old('bank_act_no') }}">
                    </div>
                    @error('bank_act_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary mt-2">Cancel</a>
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
        $('#add_members').validate({
            errorPlacement: function(error, element) {
                if (element.attr("name") == "name") {
                    error.insertAfter( element.parent("div"));
                } else {
                    error.insertAfter( element.parent("div"));
                }
            },
            rules: {
                    'email': {
                        remote: {
                            type: 'get',
                            url: "{{ route('unique_user_email') }}",
                            data: {
                                'email': function () {
                                    return $("input[name='email']").val();
                                }
                            },
                            dataFilter: function(data) {
                                var json = JSON.parse(data);
                                if (json.status == 1) {
                                    $('#current_email_error').text(json.message);
                                }
                                else {
                                    $('#current_email_error').text("");
                                    return 'true';
                                }
                            }
                        },
                        required: true
                    },
                    confirm_password: {
                        equalTo: "#password"
                    }
			}
        });
        $("#mobile").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                     return false;
            }
        });

    });
</script>
@endsection
