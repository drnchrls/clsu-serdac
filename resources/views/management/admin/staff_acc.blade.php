@extends('management.main_index')
@section('title', 'Staff Accounts')
@section('content')
<div class="row m-0 p-1">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <h3>
          Staff Accounts (<span id="totalStaff"></span>) 
          {{-- <a name="" id="createNewAccount" class="btn btn-success" href="{{route('admin.store.staffs')}}" role="button"><i class="fa fa-plus"></i></a> --}}
          <a name="" id="createNewAccount" class="btn btn-success" href="{{route('admin.store.staffs')}}" role="button"><i class="fa fa-plus"></i></a>
        </h3>
        <small class="text-muted"> You can click the <i class="fa fa-gear"> </i> icon to see more details of each records. </small>
      </div>
    </div>
  </div>
</div>
<div class="row m-0">
  <div class="col-lg-12 px-3">
    <hr class="my-2">
  </div>
</div>
<div class="row m-0 px-1 pb-3 bg-white border rounded shadow m-2">
  <div class="col-lg-12 px-lg-4 px-2 pt-4">
    <table class="table table-bordered table-hover wrap w-100" id="staffs-table">
      <thead class="bg-dark text-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Contact</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="staffModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header pt-4 bg-main pl-4">
        <h5 class="admin-modal-title" id="modelTitle"></h5>
        <button type="button" class="close btn btn-sm" id="btnHide">
          <span class="material-symbols-outlined pr-2 pt-1 text-light">
            cancel
          </span>
        </button>
      </div>
      <div class="modal-body pt-4 px-4 no-padding">
        <div class="container-fluid no-padding">
          {{-- ADD-STAFF-MODAL --}}
          <div class="add-staff-form" id="addAccountFormDiv">
            <form action="" method=""  id="addAccountForm" autocomplete="off">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-2 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    admin_panel_settings
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Personal Information</h3>
                    <small class="text-muted font-netflix-light">
                     Manage staff accounts information, add personal details and more.
                    </small>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-4 ">
                        <div class="coolinput">
                          <label for="staff_fname" class="text px-2">First Name<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="staff_fname" name='staff_fname' placeholder="Firstname" required>
                          <span class="text-danger" id="staff_fname_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-4 ">
                        <div class="coolinput">
                          <label for="staff_lname" class="text px-2">Last Name<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="staff_lname" name='staff_lname' placeholder="Lastname" required>
                          <span class="text-danger" id="staff_lname_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-4 ">
                        <div class="coolselect">
                          <label for="staff_role" class="select-label">Role<small class="text-danger">*</small></label>
                          <select name="staff_role" id="staff_role" class="select" required>
                            <option selected disabled>-- Role --</option>
                            <option value="Library Staff">Library Staff</option>
                            <option value="Service Staff">Service Staff</option>
                          </select>
                          <span class="text-danger" id="staff_role_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6 ">
                        <div class="coolinput">
                          <label for="staff_email" class="text px-2">Email<small class="text-danger">*</small></label>
                          <input type="email" class="input" id="staff_email" name='staff_email' placeholder="Enter email address" required>
                          <span class="text-danger" id="staff_email_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-6 ">
                        <div class="coolinput">
                          <label for="staff_contact" class="text px-2">Contact<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="staff_contact" name='staff_contact' placeholder="Enter contact" required>
                          <span class="text-danger" id="staff_contact_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row py-2">
                      <div class="col-lg-6">
                        <label for="staff_password" class="font-password-label">Password<small class="text-danger">*</small></label>
                        <div class="input-group border rounded bg-light">
                        <input id="staff_password" type="password" class="form-control mr-3" name='staff_password' placeholder="Enter password" required autofocus>
                            <div class="input-group-append">
                                <span id="toggle_enter_pass" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                            </div>
                        </div>
                        {{-- <span class="text-danger">@error ('staff_password') {{$message}} @enderror</span> --}}
                        <span class="text-danger" id="staff_password_error"></span>
                      </div>
                      <div class="col-lg-6 ">
                        <label for="staff_confirmation_password" class="font-password-label">Confirmation Password<small class="text-danger">*</small></label>
                        <div class="input-group border rounded bg-light">
                        <!-- <input id="staff_password" type="password" class="form-control mr-3" name='staff_password' placeholder="Enter password" required autofocus> -->
                        <input id="staff_confirmation_password" type="password" class="form-control mr-3" name='staff_confirmation_password' placeholder="Confirm password" required>
                            <div class="input-group-append">
                                <span id="toggle_confirm_entry" class="fa fa-fw fa-eye field_icon pt-2 pr-4 mr-2"></span>
                            </div>
                        </div>
                        {{-- <span class="text-danger">@error ('staff_password') {{$message}} @enderror</span> --}}
                        <span class="text-danger" id="staff_confirmation_password_error"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-success mx-1" id="btnCreate">Create</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-staff">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          {{-- STAFF-ACCOUNT-MODAL --}}
          <div class="edit-staff-form" id="editStaffForm">
            <form action="" method="" autocomplete="off" spellcheck="false">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-2 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    admin_panel_settings
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Staff Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage staff accounts information, update personal details and more.
                    </small>
                  </div>
                </div>
                <input type="text" class="form-control no-drop" name="edit_staff_id" id="edit_staff_id_input" value="" disabled hidden>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="coolinput">
                          <label for="edit_staff_fname" class="text px-2">First Name</label>
                          <input type="text" class="input" name="edit_staff_fname" id="edit_staff_fname" value="">
                          <span class="text-danger" id="edit_staff_fname_error"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="coolinput">
                          <label for="edit_staff_lname" class="text px-2">Last Name</label>
                          <input type="text" class="input" name="edit_staff_lname" id="edit_staff_lname" value="">
                          <span class="text-danger" id="edit_staff_lname_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="coolselect">
                          <label for="edit_staff_role" class="select-label">Role</label>
                          <select name="edit_staff_role" id="edit_staff_role" class="select">
                            <option value="Library Staff">Library Staff</option>
                            <option value="Service Staff">Service Staff</option>
                          </select>
                          <span class="text-danger" id="edit_staff_role_error"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="coolinput">
                          <label for="edit_staff_contact" class="text px-2">Contact</label>
                          <input type="text" class="input" name="edit_staff_contact" id="edit_staff_contact" value="">
                          <span class="text-danger" id="edit_staff_contact_error"></span>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="coolinput">
                          <label for="edit_staff_email" class="text px-2">Email</label>
                          <input type="email" class="input no-drop" name="edit_staff_email" id="edit_staff_email" value="" disabled>
                        </div>
                      </div>
                      <div class="col-lg-12 pt-3 px-3 no-padding">
                        <p>
                          <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                        </p>
                        <div class="collapse" id="advanceSettings">
                          <button type="button" class="btn btn-outline-danger w-100" id="deleteStaff">
                            <i class="fa fa-trash"></i> Remove Account
                          </button>
                          <h6 class="p-2">
                            <small class="text-danger"> *This will permanently remove the account</small>
                          </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-warning mx-1 text-white" id="btnUpdate">Update</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-staff">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    
var table;

$(document).ready(function () {
  // SET HEADER
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // SHOW LIST OF STAFFS TABLE
  table = $('#staffs-table').DataTable({
        responsive:true,
        processing: true,
        // language: {
        //    processing: '<span class="fa fa-refresh fa-spin fa-3x fa-fw datatable-spinner text-info"></span><div class="loading-text ">Loading...</div>'
        // },
        serverSide: true,
        // select: true,
        // retrieve: true,
        ajax: {
            'url': "{{ route('admin.staffs') }}",
        },
        'pageLength': 5,
        'aLengthMenu': [[5,10,20],[5,10,20],'all'],
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'staff_id', name: 'staff_id', width: '20px', class: 'text-lg-center'},
            {data: 'staff_fname', name: 'staff_fname'},
            {data: 'staff_lname', name: 'staff_lname'},
            {data: 'staff_email', name: 'staff_email'},
            {data: 'staff_role', name: 'staff_role'},
            {data: 'staff_contact', name: 'staff_contact'},
            {data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-lg-center'},
        ],
        // columnDefs:[
        //     {responsivePriority: 1, targets:-1}
        // ],
  });
      
  // TRIGGER CREATE NEW ACCOUNT MODAL
  $('#createNewAccount').click(function (e) {
      e.preventDefault();
      $('#staff_fname_error').html('');
      $('#staff_lname_error').html('');
      $('#staff_email_error').html('');
      $('#staff_role_error').html('');
      $('#staff_password_error').html('');
      $('#staff_confirmation_password_error').html('');
      $('#staff_contact_error').html('');

      $('#addAccountForm').trigger("reset");
      $('#modelTitle').html("Create New Account");
      $('#addAccountFormDiv').show();
      $('#btnCreate').show();
      $('#btnUpdate').hide();
      $('#editStaffForm').hide();
      $('#staffModal').modal('show');
  });

  $('body').on('submit','#addAccountForm',function (e) {
      e.preventDefault();
      Swal.fire({
          title: 'Please wait...',
          allowEscapeKey: false,
          allowOutsideClick: false,
          showConfirmButton: false,
          onOpen: ()=>{
              Swal.showLoading();
          },
      });
      $.ajax({
          data: $('#addAccountForm').serialize(),
          url: "{{ route('admin.store.staffs') }}",
          type: "POST",
          success: function (result) {
              Swal.close();
              swal("Account has been created succesfully!", {
                  icon: "success",
              });
              $('#addAccountForm').trigger("reset");
              $('#staffModal').modal('hide');
              $('#staffs-table').DataTable().ajax.reload();
              console.log('Success:', result);
          },
          // contentType: false,
          // processData: false,
          error: function (result) {
              Swal.close();
              $('#staff_fname_error').html('');
              $('#staff_lname_error').html('');
              $('#staff_email_error').html('');
              $('#staff_role_error').html('');
              $('#staff_password_error').html('');
              $('#staff_confirmation_password_error').html('');
              $('#staff_contact_error').html('');
              $('#staff_fname_error').html(result.responseJSON.errors.staff_fname);
              $('#staff_lname_error').html(result.responseJSON.errors.staff_lname);
              $('#staff_email_error').html(result.responseJSON.errors.staff_email);
              $('#staff_role_error').html(result.responseJSON.errors.staff_role);
              $('#staff_password_error').html(result.responseJSON.errors.staff_password);
              $('#staff_confirmation_password_error').html(result.responseJSON.errors.staff_confirmation_password);
              $('#staff_contact_error').html(result.responseJSON.errors.staff_contact);
              console.log('Error: ', result);
          }
      });
  });

  $('body').on('click', '#editStaff', function(e) {
      e.preventDefault();
      var user_id = $(this).data('id');
      $.ajax({
          url: "{{url('admin/staffs/edit')}}"+'/id='+user_id,
          method: 'GET',

          success: function(result) {
              
              $('#edit_staff_fname_error').html('');
              $('#edit_staff_lname_error').html('');
              $('#edit_staff_role_error').html('');
              $('#edit_staff_contact_error').html('');

              $('#modelTitle').html("Manage Account");
              $('#edit_staff_id_input').val(result.data.staff_id);
              $('#edit_staff_id').html(result.data.staff_id);
              $('#edit_staff_fname').val(result.data.staff_fname);
              $('#edit_staff_lname').val(result.data.staff_lname);
              $('#edit_staff_email').val(result.data.staff_email);
              $('#edit_staff_role').val(result.data.staff_role);
              $('#edit_staff_contact').val(result.data.staff_contact);
              $('#editStaffForm').show();
              $('#btnUpdate').show();
              $('#addAccountFormDiv').hide();
              $('#btnCreate').hide();
              $('#staffModal').modal('show');
              
              console.log(result);
          }
      });
  });

  $('#btnUpdate').click(function (e) {
      // e.preventDefault();
      var staff_id = $('#edit_staff_id_input').val();
      var staff_fname   = $('#edit_staff_fname').val();
      var staff_lname = $('#edit_staff_lname').val();
      var staff_role = $('#edit_staff_role').val();
      var staff_contact = $('#edit_staff_contact').val();
      // var token   = $("meta[name='csrf-token']").attr("content");
      Swal.fire({
          title: 'Please wait...',
          allowEscapeKey: false,
          allowOutsideClick: false,
          showConfirmButton: false,
          onOpen: ()=>{
              Swal.showLoading();
          },
      });
      $.ajax({
          data: {
            "staff_fname": staff_fname,
            "staff_lname": staff_lname,
            "staff_role": staff_role,
            "staff_contact": staff_contact,
            // "_token": token,
          },
          url: "{{ url('admin/staffs/update') }}"+"/id="+staff_id,
          type: "PUT",
          dataType: 'json',
          success: function (result) {
            Swal.close();
            $('#staffModal').modal('hide');
            swal("Account has been updated succesfully!", {
                icon: "success",
            });
              $('#staffs-table').DataTable().ajax.reload();
            console.log('Success:', result);
          },
          error: function (result) {
            Swal.close();
            $('#edit_staff_fname_error').html('');
            $('#edit_staff_lname_error').html('');
            $('#edit_staff_role_error').html('');
            $('#edit_staff_contact_error').html('');
            $('#edit_staff_fname_error').html(result.responseJSON.errors.staff_fname);
            $('#edit_staff_lname_error').html(result.responseJSON.errors.staff_lname);
            $('#edit_staff_role_error').html(result.responseJSON.errors.staff_role);
            $('#edit_staff_contact_error').html(result.responseJSON.errors.staff_contact);
            console.log('Error:', result);
          }
      });
  });
  
  $('#btnHide').click(function (e) { 
      $('#staffModal').modal('hide');
  });
  $('.btn-cancel-staff').click(function (e) { 
        $('#staffModal').modal('hide');
  });

  // DELETE staffs ACCOUNT
  $('body').on('click', '#deleteStaff', function(e){
      e.preventDefault();
      var user_id = $('#edit_staff_id_input').val();
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover every data connected to this account.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              Swal.fire({
                  title: 'Please wait...',
                  allowEscapeKey: false,
                  allowOutsideClick: false,
                  showConfirmButton: false,
                  onOpen: ()=>{
                      Swal.showLoading();
                  },
              });
              $.ajax({
                  type: "DELETE",
                  url: "{{url('admin/staffs/delete')}}"+"/id="+user_id,
                  data: {id:user_id},
                  success: function (result) {
                      Swal.close();
                      $('#staffModal').modal('hide');
                      $('#staffs-table').DataTable().ajax.reload();
                      swal("Poof! Staff account has been deleted!", {
                          icon: "success",
                      });
                      console.log(result);
                  },
                  error: function(result){
                      Swal.close();
                      $('#staffModal').modal('hide');
                      console.log(result);
                  }

              })

          } 
      });

  });

  function updateItemCount() {
      var itemCount = table.page.info().recordsTotal;
      $('#totalStaff').text(itemCount);
  }

  updateItemCount();

  table.on('draw', function() {
      updateItemCount();
  });

  $("#toggle_enter_pass").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#staff_password").attr("type", type);
    });
    $("#toggle_confirm_entry").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#staff_confirmation_password").attr("type", type);
    });


// END
});




</script>
@endsection
