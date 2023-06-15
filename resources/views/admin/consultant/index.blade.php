@extends('admin.layout.master')
@section('content')
    <div class="container-fluid  dashboard-content">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="page-header">
            <h2 class="pageheader-title">Consultant</h2>
                <div class="page-breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Home</a></li>
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Consultant</a></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card shadow-sm mb-5">
            <div class="card-header d-flex pb-0 justify-content-between">
                <div class="col-md-4 d-flex  align-items-center"><h5>Consultant
                    </h5>
                </div>
                <div class="col-md-4">
                    <div class="csv-button float-right">
                        <a href="{{route('consultant.create')}}" class="btn btn-primary mb-2">Add Consultant</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered data_table">
                  <thead>
                    <tr>
                        <td>Sr. No.</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Mobile No</td>
                        <td>Address</td>
                        <td>State</td>
                        <td>City</td>
                        <td>Image</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   @endsection
@section('admin_script')
         <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.data_table').DataTable({
                    processing: true,
                    serverSide: true,
                    orderable:false,
                    "bInfo": false,
                        oLanguage: {
                            sLengthMenu: "_MENU_",
                        },
                        language: {
                        paginate: {
                        next: '<i class="fa fa-angle-right">',
                        previous: '<i class="fa fa-angle-left">'
                        }
                    },
                    ajax: "{{ route('consultant.index') }}",
                    columns: [
                        {
                            data: '',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'mobile_no',
                            name: 'mobile_no'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'state',
                            name: 'state'
                        },
                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'image',
                            name: 'image'
                        },
                        {
                            data: 'active_toggle',
                            name: 'active_toggle'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    order:[],
                });

                $(document).on('click', ".delete_btn", function(event) {
                  swal.fire({
                      title: 'Are you sure?',
                      text: "You won't be able to revert this!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonClass: "btn btn-danger",
                      cancelButtonClass: "btn btn-primary",
                      confirmButtonText: 'Yes, delete it!',
                      inputValidator: (value) => {
                          if (!value) {
                              return 'You need to write something!'
                          }
                      }
                  }).then((result) => {
                      if (result.isConfirmed) {
                          var url = $(this).attr('data-url');
                          var token = '<?php echo csrf_token(); ?>';
                          $.ajax({
                              type: 'POST',
                              url: url,
                              data: {
                                  _token: token,
                                  _method: 'DELETE',
                              },
                              success: function(data) {
                                  if (data.status == 1) {
                                      table.draw();
                                      toastr_success(" Consultant Deleted Successfully!");
                                  } else {
                                    toastr_error("Some Thing Went Wrong!");
                                      return false;
                                  }
                              }
                          });
                      }
                    });
                });

                $(document).on('change', "#consultant_switch", function() {
                var mode= $(this).prop('checked');
                var id= $(this).attr('data-id');
                if(mode == true){
                    status = 0;
                }else{
                    status = 1;
                }
                $.ajax({
                        type: "GET",
                        url: "{{ route('consultant_status_change') }}",
                        data: {
                                'status': status,
                                'id': id,
                        },
                        success: function(data) {
                            if(data.status == 1){
                                    table.draw();
                                    toastr_success("Consultant status change successfully!");
                            }
                            else{
                                toastr_error("Some Thing Went Wrong!");
                            }
                        }
                    });
                });
            });

     </script>
@endsection


