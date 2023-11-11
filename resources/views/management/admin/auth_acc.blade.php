@extends('management.main_index')
@section('title', 'User Accounts')
@section('content')
<div class="row m-0 p-1">
  <div class="col-lg-12 px-4 pt-4">
      <div class="row m-0">
          <div class="col-md-6 dashboard-heading">
              <h3>User Accounts (<span id="totalUser"></span>)</h3>
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
<div class="row m-0 bg-white px-1 pb-3 border rounded shadow m-2">
  <div class="col-lg-12 px-lg-4 px-2 pt-4">
    <div class="users-table mx-1">
      <table class="table table-bordered table-hover wrap w-100" id="users-table">
        <thead class="bg-dark text-light">
          <tr class="text-center"> 
            <th scope="col">ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
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
</div>
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
    <div class="modal-header pt-4 bg-main pl-4">
        <h5 class="admin-modal-title"> Manage Account </h5>
        <button type="button" class="close btn btn-sm" id="btnHide">
          <span class="material-symbols-outlined pr-2 pt-1 text-light">
            cancel
          </span>
        </button>
      </div>
      <div class="modal-body pt-4 px-4 no-padding">
        <div class="container-fluid no-padding">
          {{--ACCOUNT-MODAL --}}
          <div class="user-account-form" id="editUserForm">
            <form action="" method="" autocomplete="off" spellcheck="false">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-2 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    verified_user
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Personal Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage user accounts information, update personal details and more.
                    </small>
                  </div>
                </div>
                <input type="text" name="edit_id" id="edit_id_input" class="form-control no-drop" disabled hidden>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_fname" class="text px-2">First Name</label>
                          <input type="text" name="edit_fname" id="edit_fname" class="input">
                          <span class="text-danger" id="edit_fname_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_lname" class="text px-2">Last Name</label>
                          <input type="text" name="edit_lname" id="edit_lname" class="input">
                          <span class="text-danger" id="edit_lname_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_email" class="text px-2">Email</label>
                          <input type="email" name="edit_email" id="edit_email" class="no-drop input" disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_contact" class="text px-2">Contact</label>
                          <input type="text" class="input" id="edit_contact" name='edit_contact' required>
                          <span class="text-danger" id="edit_contact_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_gender" class="text px-2">Gender</label>
                          <input type="text" name="edit_gender" id="edit_gender" class="no-drop input" disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_age" class="text px-2">Age</label>
                          <input type="text" name="edit_age" id="edit_age" class="input" required>
                          <span class="text-danger" id="edit_age_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolselect">
                          <label for="edit_occupation" class="select-label">Occupation</label>
                          <select class="select" @error('occupation') is-invalid @enderror name="edit_occupation" id="edit_occupation" value="" required>
                              <option value="Student">Student</option>
                              <option value="Employed (Full-time)">Employed (Full-time)</option>
                              <option value="Employed (Part-time)">Employed (Part-time)</option>
                              <option value="Self-employed">Self-employed</option>
                              <option value="Homemake">Homemake</option>
                              <option value="Retired">Retired</option>
                              <option value="Others">Others</option>
                          </select>
                          <span class="text-danger" id="edit_occupation_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolselect">
                          <label for="edit_educational_level" class="select-label">Educational level</label>
                          <select class="select" @error('educational_level') is-invalid @enderror name="edit_educational_level" id="edit_educational_level" value="" required>
                              <option value="No schooling">No schooling</option>
                              <option value="Elementary">Elementary</option>
                              <option value="High School">High School</option>
                              <option value="Vocational">Vocational</option>
                              <option value="College">College</option>
                              <option value="Postgraduate">Postgraduate</option>
                          </select>
                          <span class="text-danger" id="edit_educational_level_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_address" class="text px-2">Address</label>
                          <input type="text" name="edit_address" id="edit_address" class="input">
                          <span class="text-danger" id="edit_address_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-12 pt-3 px-3 no-padding">
                        <p>
                          <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                        </p>
                        <div class="collapse" id="advanceSettings">
                          <button type="button" class="btn btn-outline-danger w-100" id="deleteUser">
                            <i class="fa fa-trash"></i> Remove Account
                          </button>
                          <h6 class="p-2">
                            <small class="text-danger"> *This may permanently affect data analytics of the website</small>
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
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-auth">Cancel</button>
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

$(document).ready(function (e) {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
          
    table = $('#users-table').DataTable({
          responsive:true,
          processing: true,
          // language: {
          //     processing: '<span class="fa fa-refresh fa-spin fa-3x fa-fw datatable-spinner text-info"></span><div class="loading-text ">Loading...</div>'
          // },
          serverSide: true,
          // select: true,
          // retrieve: true,
          ajax: {
            'url': "{{ route('admin.users') }}",
            
          },
          // 'pageLength': 10,
          'aLengthMenu': [[10,20,40,80,100],[10,20,40,80,100],'all'],
          columns: [
              // {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
              {data: 'id', name: 'id', width: '20px', class: 'text-lg-center'},
              {data: 'fname', name: 'fname'},
              {data: 'lname', name: 'lname'},
              {data: 'email', name: 'email'},
              {data: 'contact', name: 'contact'},
              {data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-lg-center'},
          ],
          // columnDefs:[
          //     {responsivePriority: 1, targets:-1}
          // ]
    });
          
          
          /////////// EDIT USERS
    $('body').on('click', '#editUser', function(e) {
        e.preventDefault();
        var user_id = $(this).data('id');
        $.ajax({
            url: "{{url('admin/users/edit')}}"+"/id="+user_id,
            method: 'GET',
            success: function(result) {
                $('#edit_fname_error').html('');
                $('#edit_lname_error').html('');
                $('#edit_age_error').html('');
                $('#edit_contact_error').html('');
                $('#edit_age_error').html('');
                $('#edit_educational_level_error').html('');
                $('#edit_address_error').html('');
    
                $('#modalTitle').html('Edit Account Information');
                $('#edit_id_input').val(result.data.id);
                $('#edit_id').html(result.data.id);
                $('#edit_fname').val(result.data.fname);
                $('#edit_lname').val(result.data.lname);
                $('#edit_email').val(result.data.email);
                $('#edit_gender').val(result.data.gender);
                $('#edit_contact').val(result.data.contact);
                $('#edit_age').val(result.data.age);
                $('#edit_occupation').val(result.data.occupation);
                $('#edit_educational_level').val(result.data.educational_level);
                $('#edit_address').val(result.data.address);
                $('#btnUpdate').show();
                $('#btnClose').hide();
                $('#btnCancel').show();
                // $('#editUserForm').show();
                // $('#viewUserForm').hide();
                $('#userModal').modal('show'); 
                console.log(result);
            }
        });
    });
          
    $('#btnUpdate').click(function (e) {
        e.preventDefault();
        var id = $('#edit_id_input').val();
        var fname   = $('#edit_fname').val();
        var lname = $('#edit_lname').val();
        var email = $('#edit_email').val();
        var contact = $('#edit_contact').val();
        var occupation   = $('#edit_occupation').val();
        var gender = $('#edit_gender').val();
        var age = $('#edit_age').val();
        var educational_level = $('#edit_educational_level').val();
        var address = $('#edit_address').val();
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
              "fname": fname,
              "lname": lname,
              // "gender": gender,
              "contact": contact,
              "occupation": occupation,
              "age": age,
              "educational_level": educational_level,
              "address": address,
              // "_token": token,
            },
            url: "{{ url('admin/users/update') }}"+"/id="+id,
            type: "PUT",
            dataType: 'json',
            success: function (result) {
                Swal.close();
                console.log('Success:', result);
                $('#userModal').modal('hide'); 
                swal("Account has been updated succesfully!", {
                    icon: "success",
                });
                  $('#users-table').DataTable().ajax.reload();

            },
            error: function (result) {
                // swal("Unable to update account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#edit_fname_error').html('');
                $('#edit_lname_error').html('');
                $('#edit_age_error').html('');
                $('#edit_contact_error').html('');
                $('#edit_occupation_error').html('');
                $('#edit_educational_level_error').html('');
                $('#edit_address_error').html('');

                $('#edit_fname_error').html(result.responseJSON.errors.fname);
                $('#edit_lname_error').html(result.responseJSON.errors.lname);
                $('#edit_age_error').html(result.responseJSON.errors.age);
                $('#edit_contact_error').html(result.responseJSON.errors.contact);
                $('#edit_occupation_error').html(result.responseJSON.errors.occupation);
                $('#edit_educational_level_error').html(result.responseJSON.errors.educational_level);
                $('#edit_address_error').html(result.responseJSON.errors.address);

                console.log('Error:', result);
            }
        });
    });

          
///////////// DELETE USERS
    $('body').on('click', '#deleteUser', function(e){
        e.preventDefault();
        var user_id = $('#edit_id_input').val();
  
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
              url: "{{url('admin/users/delete')}}"+"/id="+user_id,
              data: {id:user_id},
              success: function (result) {
                  Swal.close();
                  $('#userModal').modal('hide');
                  $('#users-table').DataTable().ajax.reload();
                  swal("Poof! User account has been deleted!", {
                      icon: "success",
                  });
                  console.log(result);
              },
              error: function(result){
                  Swal.close();
                  $('#userModal').modal('hide');
                  console.log(result);
              }
            })

          } 
        });
    });
              
    $('#btnHide').click(function (e) { 
      $('#userModal').modal('hide');
    });

    $('.btn-cancel-auth').click(function (e) { 
        $('#userModal').modal('hide');
  });


    function updateItemCount() {
        var itemCount = table.page.info().recordsTotal;
        $('#totalUser').text(itemCount);
    }

    updateItemCount();

    table.on('draw', function() {
        updateItemCount();
    });    

  
// END 
});
</script>
@endsection