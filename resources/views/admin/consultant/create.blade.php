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
                    <h2 class="pageheader-title">Create Consultant</h2>
                    <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('consultant.index') }}" class="breadcrumb-link">Consultant</a></li>
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Create Consultant</a></li>
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
                <h5 class="card-header">Create Consultant</h5>
                <div class="card-body">
                  <form method="post" action="{{ route('consultant.store') }}" id="profile_update" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Name*" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
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
                        <input id="mobile_no" type="number" name="mobile_no" class="form-control" placeholder="Mobile Number*" value="{{ old('mobile_no') }}" required>
                    </div>
                    @error('mobile_no')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-address-book"></i></span></div>
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Address*"  name="address" rows="3" required></textarea>
                    </div>
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2 input_select2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building"></i></span></div>
                        <select class="form-control select2" id="input-select" name="state" >
                            <option selected disabled>Select State</option>
                            @foreach ($State as $state)
                                <option value="{{ $state->id }}" >{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building"></i></span></div>
                          <input id="city" type="text" name="city" class="form-control" placeholder="City" value="{{ old('city') }}">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password') }}" required>
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-unlock"></i></span></div>
                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" value="{{ old('confirm_password') }}" required>
                    </div>
                    @error('confirm_password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="custom-file mb-2">
                        <input type="file" class="custom-file-input" name="image" id="image" required>
                        <label class="custom-file-label" for="customFile">Profile Image</label>
                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <br>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    <a href="{{ route('consultant.index') }}" class="btn btn-secondary mt-2">Cancel</a>
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
        $('#profile_update').validate({
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

    });
</script>
@endsection
