@extends('management.main_index')
@section('title', 'Announcement')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <h3>
          Announcement (<span id="totalAnnouncement"></span>)
          <a name="" id="createNewAnnouncement" class="btn btn-success" href="#" role="button"><i class="fa fa-plus"></i></a>
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
    <table class="table table-bordered table-hover wrap w-100" id="announcements-table">
      <thead class="bg-dark text-light">
        <th>ID</th>
        <th>Title</th>
        {{-- <th>Description</th> --}}
        <th>Image</th>
        <th>Type</th>
        <th>Links</th>
        <th>Action</th>
      </thead>
    </table>
  </div>
</div>
{{-- announcement MODAL --}}
<div class="modal fade" id="announcementModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header pt-4 pl-4 bg-main text-light">
        <h5 class="admin-modal-title" id="modelTitle"></h5>
        <button type="button" class="close btn btn-sm" id="btnHide">
          <span class="material-symbols-outlined pr-2 pt-1 text-light ">
            cancel
          </span>
        </button>
      </div>
      <div class="modal-body pt-4 px-4 no-padding">
        <div class="container-fluid no-padding">
          {{-- ADD-ANNOUNCEMENT-MODAL --}}
          <div class="add-announcement-form" id="addAnnouncementFormDiv">
            <form action="" method=""  id="addAnnouncementForm" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    campaign
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Announcement Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage announcement information, add details and more.
                    </small>
                  </div>
                </div>
                <div class="col-lg-12 px-4">
                  <small class="text-muted font-netflix-light">
                    <strong><i class="fa fa-dot-circle-o text-secondary px-1"></i></strong>
                    Please refer to the notes below each input for optimal user experience.
                  </small>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-center overflow-hidden">
                  <div class="row">
                    <div class="col-lg-12 no-padding">
                      <div class="displayed-image d-flex justify-content-center align-items-center">
                        <div id="no-image">
                          <span class="material-symbols-outlined sz-110">
                            image
                          </span>
                          <p class="text-center font-netflix text-secondary">
                            <small>Image Preview</small>
                          </p>
                        </div>
                        <img id="image-preview" src="" class="d-block w-100 shadow" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="announcement_title" class="text px-2">Title<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="announcement_title" name='announcement_title' placeholder="Title" required>
                          <span class="text-danger" id="announcement_title_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolselect">
                          <label for="announcement_type" class="select-label">Type<small class="text-danger">*</small></label>
                          <select name="announcement_type" id="announcement_type" class="select" required>
                            <option value="" selected disabled> -- Select --</option>
                            <option value="Announcement">Announcement</option>
                            <option value="Event">Event</option>
                            <option value="News">News</option>
                          </select>
                          <span class="text-danger" id="announcement_type_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="cooltextarea">
                          <label for="announcement_description" class="textarea-label px-2">Description<small class="text-danger">*</small></label>
                          <textarea cols="30" class="textarea" rows="5" id="announcement_description" name='announcement_description' placeholder="Description" required></textarea>
                          <span class="text-danger" id="announcement_description_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="announcement_links" class="text px-2">Links</label>
                          <input type="text" class="input" id="announcement_links" name='announcement_links' placeholder="Links">
                          <span class="text-danger" id="announcement_links_error"></span>
                        </div>
                        <span>
                          <small class="text-info">* Add any if there's link for further information.</small>
                        </span>
                      </div>
                    </div>
                    <div class="form-row my-3">
                      <div class="col-lg-12">
                        <input type="file" class="form-control-file border p-1 rounded" id="announcement_image" name='announcement_image' accept="image/*" required>
                        <small>
                          <span class="text-danger" id="announcement_image_error"></span>
                        </small>
                        <span>
                          <small class="text-info">*Upload a landscape image for better quality.</small>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-success mx-1" id="btnCreate">Create</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-announcement">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          {{-- EDIT-ANNOUNCEMENT-MODAL --}}
          <div class="edit-announcement-form" id="editAnnouncementFormDiv">
            <form action="" method=""  id="addAnnouncementForm" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    campaign
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Announcement Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage announcement information, update details and more.
                    </small>
                  </div>
                </div>
                <input type="text" class="form-control no-drop" name="edit_announcement_id" id="edit_announcement_id" value="" disabled hidden>
                <div class="col-lg-6 d-flex align-items-center justify-content-center overflow-hidden">
                  <div class="row">
                    <div class="col-lg-12 no-padding">
                      <div class="displayed-image d-flex justify-content-center align-items-center">
                        <img id="edit_announcement_image" src="" class="d-block w-100 shadow" alt="Image">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_announcement_title" class="text px-2">Title</label>
                          <input type="text" class="input" name="edit_announcement_title" id="edit_announcement_title" value="">
                          <span class="text-danger" id="edit_announcement_title_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolselect">
                          <label for="edit_announcement_type" class="select-label">Type</label>
                          <select name="edit_announcement_type" id="edit_announcement_type" class="select" required>
                            <option value="Announcement">Announcement</option>
                            <option value="Event">Event</option>
                            <option value="News">News</option>
                          </select>
                          <span class="text-danger" id="edit_announcement_type_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="cooltextarea">
                          <label for="edit_announcement_description" class="textarea-label px-2">Description</label>
                          <textarea name="edit_announcement_description" id="edit_announcement_description" cols="30" rows="5" class="textarea"></textarea>
                          <span class="text-danger" id="edit_announcement_description_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_announcement_links" class="text px-2">Links</label>
                          <input type="text" class="input"  name="edit_announcement_links" id="edit_announcement_links" value="">
                          <span class="text-danger" id="edit_announcement_links_error"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 px-2 no-padding">
                    <p>
                      <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                    </p>
                    <div class="collapse" id="advanceSettings">
                      <button type="button" class="btn btn-outline-danger w-100" id="deleteAnnouncement">
                        <i class="fa fa-trash"></i> Remove Announcement
                      </button>
                      <h6 class="p-2">
                        <small class="text-danger"> *This announcement will be permanently deleted.</small>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-warning mx-1 text-white" id="btnUpdate">Update</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-announcement" >Cancel</button>
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
$(document).ready(function () {
        $.ajaxSetup({
        // Cross-Site Request Forgery - CSRF
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // SHOW LIST OF STAFFS TABLE
        table = $('#announcements-table').DataTable({
            responsive:true,
            processing: true,
            // language: {
            //     processing: '<span class="fa fa-spinner fa-spin fa-3x fa-fw  text-info"></span>'
            // },
            serverSide: true,
            // select: true,
            // retrieve: true,
            ajax: {
                'url': "{{ route('admin.announcements') }}",

            },

            'pageLength': 5,
            'aLengthMenu': [[5,10,20],[5,10,20],'all'],
            columns: [
                {data: 'announcement_id', name: 'announcement_id', class: 'text-lg-center', width: '20px'},
                {data: 'announcement_title', name: 'announcement_title'},
                // {data: 'announcement_description', name: 'announcement_description'},
                {data: 'announcement_image', name: 'announcement_image', searchable: false, orderable: false, class: 'text-lg-center'},
                {data: 'announcement_type', name: 'announcement_type'},
                {data: 'announcement_links', name: 'announcement_links'},
                {data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-lg-center'},
            ],

            // columnDefs:[
            //     {responsivePriority: 1, targets:-1,}
            // ]
        });


         // TRIGGER ADD MODAL
    $('#createNewAnnouncement').click(function (e) {
      e.preventDefault();
      // $('#saveBtn').val("create-product");
      // $('#product_id').val('');
      $('#announcement_title_error').html('');
      $('#announcement_description_error').html('');
      $('#announcement_image_error').html('');
      $('#announcement_links_error').html('');
      $('#announcement_type_error').html('');


      $('#addAnnouncementForm').trigger("reset");
      $('#modelTitle').html("Add Announcement");
      $('#addAnnouncementFormDiv').show();
      $('#btnCreate').show();
      $('#btnUpdate').hide();
      $('#editAnnouncementFormDiv').hide();
      $('#viewAnnouncementFormDiv').hide();
      $('#announcementModal').modal('show');
      $('#no-image').show();
      $('#image-preview').attr('src','');
    });

    // STORE announcement
    $('#addAnnouncementForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        
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
            data: formData,
            url: "{{ route('admin.store.announcements') }}",
            type: "POST",
            success: function (result) {
                Swal.close();
                swal("Announcement has been created succesfully!", {
                    icon: "success",
                });
                console.log('Success:', result);
                $('#addAnnouncementForm').trigger("reset");
                $('#announcementModal').modal('hide');
                // table.ajax.reload();
                $('#announcements-table').DataTable().ajax.reload();

            },
            contentType: false,
            processData: false,
            error: function (result) {
                // alert('Error');
                // swal("Unable to create account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#announcement_title_error').html('');
                $('#announcement_description_error').html('');
                $('#announcement_image_error').html('');
                $('#announcement_links_error').html('');
                $('#announcement_type_error').html('');

                $('#announcement_title_error').html(result.responseJSON.errors.announcement_title);
                $('#announcement_description_error').html(result.responseJSON.errors.announcement_description);
                $('#announcement_image_error').html(result.responseJSON.errors.announcement_image);
                $('#announcement_links_error').html(result.responseJSON.errors.announcement_links);
                $('#announcement_type_error').html(result.responseJSON.errors.announcement_type);


                console.log('Error: ', result);
            }
        });
    });

         ///////////// VIEW USERS
    // $('body').on('click', '#viewAnnouncement', function (e) {
    //     e.preventDefault();
    //     var announcement_id = $(this).data('id');
    //     var announcement_image = $(this).data('image');
    //     $.ajax({
    //         type: "GET",
    //         url: "{{url('admin/announcements/view')}}"+"/id="+announcement_id,
    //         data: {id:announcement_id},
    //         // dataType: 'json',
    //         success:function(result){
    //         //   $('#modelTitle').html('Announcement Information');
    //         //   $('#view_announcement_id').val(result.announcement_id);
    //         //   $('#view_announcement_title').val(result.announcement_title);
    //         //   $('#view_announcement_description').val(result.announcement_description);
    //         //   $('#view_announcement_type').val(result.announcement_type);
    //         //   $('#view_announcement_links').val(result.announcement_links);
    //         //   $('#view_announcement_image').attr('src',announcement_image);
    //         // //   $('#view_announcement_image').html(result.announcement_image);
    //         //   $('#btnUpdate').hide();
    //         //   $('#btnCancel').hide();
    //         //   $('#btnClose').show();
    //         //   $('#viewAnnouncementFormDiv').show();
    //         //   $('#addAnnouncementFormDiv').hide();
    //         //   $('#editAnnouncementFormDiv').hide();
    //         //   $('#announcementModal').modal('show');
    //           console.log(result);
              
    //         },
    //         error: function(result){
    //             console.log('Error: ',result);
    //         }
    //     });
    // });

    $('body').on('click', '#editAnnouncement', function(e) {
        e.preventDefault();
        var announcement_id = $(this).data('id');
        var announcement_image = $(this).data('image');
        
        $.ajax({
            url: "{{url('admin/announcements/edit')}}"+'/id='+announcement_id,
            method: 'GET',
            // data: {
            //     id: id,
            // },
            // cache: false,
            success: function(result) {
                
                $('#edit_announcement_title_error').html('');
                $('#edit_announcement_description_error').html('');
                $('#edit_announcement_type_error').html('');
                $('#edit_announcement_links_error').html('');

                $('#modelTitle').html("Manage Announcement");
                $('#edit_announcement_id').val(result.data.announcement_id);
                $('#edit_announcement_id').html(result.data.announcement_id);
                $('#edit_announcement_title').val(result.data.announcement_title);
                $('#edit_announcement_description').val(result.data.announcement_description);
                $('#edit_announcement_type').val(result.data.announcement_type);
                $('#edit_announcement_links').val(result.data.announcement_links);
                $('#edit_announcement_image').attr('src',announcement_image);
                $('#addAnnouncementFormDiv').hide();
                $('#viewAnnouncementFormDiv').hide();
                $('#editAnnouncementFormDiv').show();
                $('#btnUpdate').show();
                $('#btnCreate').hide();
                $('#announcementModal').modal('show');
                $('#no-image').show();
                $('#image-preview').attr('src','');
                
                console.log(result);
            },
            error: function(result){
                console.log(result);
            }
        });
    });

     // UPDATE announcement
     $('#btnUpdate').click(function (e) {
      // e.preventDefault();
        var announcement_id = $('#edit_announcement_id').val();
        var announcement_title   = $('#edit_announcement_title').val();
        var announcement_description = $('#edit_announcement_description').val();
        var announcement_type   = $('#edit_announcement_type').val();
        var announcement_links = $('#edit_announcement_links').val();
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
                "announcement_title": announcement_title,
                "announcement_description": announcement_description,
                "announcement_type": announcement_type,
                "announcement_links": announcement_links,
                // "_token": token,
            },
            url: "{{ url('admin/announcements/update') }}"+"/id="+announcement_id,
            type: "PUT",
            dataType: 'json',
            success: function (result) {
                Swal.close();
                console.log('Success:', result);
                $('#announcementModal').modal('hide');
                swal("Announcement has been updated succesfully!", {
                    icon: "success",
                });
                $('#announcements-table').DataTable().ajax.reload();

            },
            error: function (result) {
                // swal("Unable to update account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#edit_announcement_title_error').html('');
                $('#edit_announcement_description_error').html('');
                $('#edit_announcement_type_error').html('');
                $('#edit_announcement_links_error').html('');
                $('#edit_announcement_title_error').html(result.responseJSON.errors.announcement_title);
                $('#edit_announcement_description _error').html(result.responseJSON.errors.announcement_description);
                $('#edit_announcement_type_error').html(result.responseJSON.errors.announcement_type);
                $('#edit_announcement_links_error').html(result.responseJSON.errors.announcement_links);
                console.log('Error:', result);
            }
        });
    });


    
    // CLOSE MODAL
    $('.btn-cancel-announcement').click(function (e) { 
        $('#announcementModal').modal('hide');
    });
    $('#btnHide').click(function (e) { 
        $('#announcementModal').modal('hide');
    });

    // DELETE announcement
    $('body').on('click', '#deleteAnnouncement', function(e){
        e.preventDefault();
        var announcement_id = $('#edit_announcement_id').val()

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this announcement!",
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
                url: "{{url('admin/announcements/delete')}}"+"/id="+announcement_id,
                data: {id:announcement_id},
                success: function (result) {
                    Swal.close();
                    $('#announcementModal').modal('hide');
                    $('#announcements-table').DataTable().ajax.reload();
                    swal("Poof! Announcement has been deleted!", {
                        icon: "success",
                    });
                    console.log(result);
                },
                error: function (result) {
                    Swal.close();
                    $('#announcementModal').modal('hide');;
                    console.log('Error: ', result);
                }
            })
                    
        } 
        });
    });

function updateItemCount() {
    var itemCount = table.page.info().recordsTotal;
    $('#totalAnnouncement').text(itemCount);
}

updateItemCount();

table.on('draw', function() {
    updateItemCount();
});

$('#announcement_image').on('change', function (e) {
      // Get the selected file
      var file = e.target.files[0];
      
      // Check if a file was selected
      if (file) {
        // Create a FileReader to read the selected file
        var reader = new FileReader();

        // Set up a function to run when the reader loads the file
        reader.onload = function (e) {
          // Set the source of the image preview to the data URL
          $('#image-preview').attr('src', e.target.result);
          $('#no-image').hide();
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
      }
    });
// END
});
</script>
@endsection