@extends('management.main_index')
@section('title', 'Gallery')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading">
        <h3>
          Gallery (<span id="totalGallery"></span>)
          <a name="" id="createNewGallery" class="btn btn-success" href="#" role="button"><i class="fa fa-plus"></i></a>
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
    <table class="table table-bordered table-hover wrap w-100" id="galleries-table">
      <thead class="bg-dark text-light">
        <th>ID</th>
        <th>Title</th>
        <th>Date</th>
        <th>Type</th>
        <th>Participants</th>
        <th>Image</th>
        <th>Action</th>
      </thead>
    </table>
  </div>
</div>
<div class="modal fade" id="galleryModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header pt-4 pl-4 bg-main text-light">
        <h5 class="admin-modal-title" id="modelTitle"></h5>
        <button type="button" class="close btn btn-sm" id="btnHide">
          <span class="material-symbols-outlined pr-2 pt-1 text-light">
            cancel
          </span>
        </button>
      </div>
      <div class="modal-body pt-4 px-4 no-padding">
        <div class="container-fluid no-padding">
          {{-- ADD-IMAGE-TO-GALLERY-MODAL --}}
          <div class="add-gallery-form" id="addGalleryFormDiv">
            <form action="" method=""  id="addGalleryForm" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    gallery_thumbnail
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Photo Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage photo information, add details and more.
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
                          <label for="gallery_title" class="text px-2">Title<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="gallery_title" name='gallery_title' placeholder="Title" required>
                          <span class="text-danger" id="gallery_title_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolselect">
                            <label for="gallery_type" class="select-label">Type<small class="text-danger">*</small></label>
                            <select name="gallery_type" id="gallery_type" class="select" required>
                              <option value="" selected disabled> -- Select --</option>
                              <option value="Training/Workshop">Training/Workshop</option>
                              <option value="Seminar">Seminar</option>
                              {{-- <option value="Consultancy">Consultancy</option>
                              <option value="Data Analytics">Data Analytics</option>
                              <option value="Survey Services">Survey Services</option> --}}
                            </select>
                            <span class="text-danger" id="gallery_type_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="gallery_date" class="text px-2">Date<small class="text-danger">*</small></label>
                          <input type="date" class="input border rounded p-2" id="gallery_date" name='gallery_date' required>
                          <span class="text-danger" id="gallery_date_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="gallery_participants" class="text px-2">Participants<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="gallery_participants" name='gallery_participants' placeholder="Participants" required>
                          <span class="text-danger" id="gallery_participants_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row my-3">
                      <div class="col-lg-12">
                        <input type="file" class="form-control-file border p-1 rounded" id="gallery_image" name='gallery_image' accept="image/*" required>
                        {{-- <span class="text-danger">@error ('gallery_image') {{$message}} @enderror</span> --}}
                        <small>
                          <span class="text-danger" id="gallery_image_error"></span>
                        </small>
                        <span>
                          <small class="text-info"> &nbsp; *Upload a landscape image for better quality.</small>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-success mx-1" id="btnCreate">Create</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-gallery">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          {{-- EDIT-IMAGE-INFORMATION-MODAL --}}
          <div class="edit-gallery-form" id="editGalleryFormDiv">
            <form action="" method="" id="editGalleryForm" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 d-flex mb-2">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    gallery_thumbnail
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Photo Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage photo information, add details and more.
                    </small>
                  </div>
                </div>
                <input type="text" class="form-control no-drop" name="edit_gallery_id" id="edit_gallery_id" value="" disabled hidden>
                <div class="col-lg-6 d-flex align-items-center justify-content-center overflow-hidden">
                  <div class="row">
                    <div class="col-lg-12 no-padding">
                      <div class="displayed-image d-flex justify-content-center align-items-center">
                        <img id="edit_gallery_image" src="" class="d-block w-100 shadow" alt="Image">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_gallery_title" class="text px-2">Title</label>
                          <input type="text" class="input" name="edit_gallery_title" id="edit_gallery_title" value="" required>
                          <span class="text-danger" id="edit_gallery_title_error"></span>
                        </div>   
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_gallery_participants" class="text px-2">Participants</label>
                          <input type="text" class="input" name="edit_gallery_participants" id="edit_gallery_participants" value="" required>
                          <span class="text-danger" id="edit_gallery_participants_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolselect">
                          <label for="edit_gallery_type" class="select-label">Type</label>
                          <select name="edit_gallery_type" id="edit_gallery_type" class="select" required>
                            <option value="Training/Workshop">Training/Workshop</option>
                            <option value="Seminar">Seminar</option>
                            {{-- <option value="Consultancy">Consultancy</option>
                            <option value="Data Analytics">Data Analytics</option>
                            <option value="Survey Services">Survey Services</option> --}}
                          </select>
                          <span class="text-danger" id="edit_gallery_type_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_gallery_date" class="text px-2">Date</label>
                          <input type="date" class="input border rounded p-2"  name="edit_gallery_date" id="edit_gallery_date" value="">
                          <span class="text-danger" id="edit_gallery_date_error"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 px-2 no-padding">
                    <p>
                      <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                    </p>
                    <div class="collapse" id="advanceSettings">
                      <button type="button" class="btn btn-outline-danger w-100" id="deleteGallery">
                        <i class="fa fa-trash"></i> Remove Photo
                      </button>
                      <h6 class="p-2">
                        <small class="text-danger"> *This photo will be permanently deleted.</small>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-warning mx-1 text-white" id="btnUpdate">Update</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-gallery" >Cancel</button>
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
    table = $('#galleries-table').DataTable({
        responsive:true,
        processing: true,
        // language: {
        //     processing: '<span class="fa fa-refresh fa-spin fa-3x fa-fw datatable-spinner text-info"></span><div class="loading-text ">Loading...</div>'
        // },
        serverSide: true,
        // select: true,
        // retrieve: true,
        ajax: {
            'url': "{{ route('admin.galleries') }}",

        },
        'pageLength': 5,
        'aLengthMenu': [[5,10,20],[5,10,20],'all'],
        columns: [
            {data: 'gallery_id', name: 'gallery_id', width: '20px', class: 'text-lg-center'},
            {data: 'gallery_title', name: 'gallery_title'},
            {data: 'gallery_date', name: 'gallery_date'},
            {data: 'gallery_type', name: 'gallery_type'},
            {data: 'gallery_participants', name: 'gallery_participants'},
            {data: 'gallery_image', name: 'gallery_image', searchable: false, orderable: false, class: 'text-lg-center'},
            {data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-lg-center'},
        ],

        // columnDefs:[
        //     {responsivePriority: 1, targets:-1,}
        // ]
    });


    $('#createNewGallery').click(function (e) {
      e.preventDefault();

      $('#gallery_title_error').html('');
      $('#gallery_participants_error').html('');
      $('#gallery_image_error').html('');
      $('#gallery_date_error').html('');
      $('#gallery_type_error').html('');


      $('#addGalleryForm').trigger("reset");
      $('#modelTitle').html("Add New Photo");
      $('#addGalleryFormDiv').show();
      $('#btnCreate').show();
      $('#btnUpdate').hide();
      $('#editGalleryFormDiv').hide();
      $('#viewGalleryFormDiv').hide();
      $('#galleryModal').modal('show');
      $('#no-image').show();
      $('#image-preview').attr('src','');
    });

// STORE announcement
$('#addGalleryForm').submit(function (e) {
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
            url: "{{ route('admin.store.galleries') }}",
            type: "POST",            
            contentType: false,
            processData: false,
            success: function (result) {
                Swal.close();
                swal("Photo has been added succesfully!", {
                    icon: "success",
                });
                $('#addGalleryForm').trigger("reset");
                $('#galleryModal').modal('hide');

                $('#galleries-table').DataTable().ajax.reload();
                console.log('Success:', result);
            },
            error: function (result) {
                // alert('Error');
                // swal("Unable to create account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#gallery_title_error').html('');
                $('#gallery_participants_error').html('');
                $('#gallery_image_error').html('');
                $('#gallery_date_error').html('');
                $('#gallery_type_error').html('');

                $('#gallery_title_error').html(result.responseJSON.errors.gallery_title);
                $('#gallery_participants_error').html(result.responseJSON.errors.gallery_participants);
                $('#gallery_image_error').html(result.responseJSON.errors.gallery_image);
                $('#gallery_date_error').html(result.responseJSON.errors.gallery_date);
                $('#gallery_type_error').html(result.responseJSON.errors.gallery_type);

                console.log('Error: ', result);
            },

        });
    });

    $('body').on('click', '#editGallery', function(e) {
        e.preventDefault();
        var gallery_id = $(this).data('id');
        var gallery_image = $(this).data('image');
        $.ajax({
            url: "{{url('admin/galleries/edit')}}"+'/id='+gallery_id,
            method: 'GET',
            // data: {
            //     id: id,
            // },
            // cache: false,
            success: function(result) {
                
                $('#edit_gallery_title_error').html('');
                $('#edit_gallery_participants_error').html('');
                $('#edit_gallery_type_error').html('');
                $('#edit_gallery_date_error').html('');

                $('#modelTitle').html("Edit Photo Information");
                $('#edit_gallery_id').val(result.data.gallery_id);
                $('#edit_gallery_id').html(result.data.gallery_id);
                $('#edit_gallery_title').val(result.data.gallery_title);
                $('#edit_gallery_participants').val(result.data.gallery_participants);
                $('#edit_gallery_type').val(result.data.gallery_type);
                $('#edit_gallery_date').val(result.data.gallery_date);
                $('#edit_gallery_image').attr('src',gallery_image);
                $('#addGalleryFormDiv').hide();
                $('#viewGalleryFormDiv').hide();
                $('#editGalleryFormDiv').show();
                $('#btnUpdate').show();
                $('#btnCreate').hide();
                $('#galleryModal').modal('show');
                
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
      //////////////////////////////////////
        var gallery_id = $('#edit_gallery_id').val();
        var gallery_title   = $('#edit_gallery_title').val();
        var gallery_participants = $('#edit_gallery_participants').val();
        var gallery_type   = $('#edit_gallery_type').val();
        var gallery_date = $('#edit_gallery_date').val();
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
                "gallery_title": gallery_title,
                "gallery_participants": gallery_participants,
                "gallery_type": gallery_type,
                "gallery_date": gallery_date,
                // "_token": token,
            },
            url: "{{ url('admin/galleries/update') }}"+"/id="+gallery_id,
            type: "PUT",
            dataType: 'json',
            success: function (result) {
                Swal.close();
                $('#galleryModal').modal('hide');
                swal("Photo has been updated succesfully!", {
                    icon: "success",
                });
                $('#galleries-table').DataTable().ajax.reload();
                console.log('Success:', result);
            },
            error: function (result) {
                // swal("Unable to update account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#edit_gallery_title_error').html('');
                $('#edit_gallery_participants_error').html('');
                $('#edit_gallery_type_error').html('');
                $('#edit_gallery_date_error').html('');
                $('#edit_gallery_title_error').html(result.responseJSON.errors.gallery_title);
                $('#edit_gallery_participants _error').html(result.responseJSON.errors.gallery_participants);
                $('#edit_gallery_type_error').html(result.responseJSON.errors.gallery_type);
                $('#edit_gallery_date_error').html(result.responseJSON.errors.gallery_date);
                console.log('Error:', result);
            }
        });
    });


     ///////////// VIEW GALLERY
    $('body').on('click', '#viewGallery', function (e) {
        e.preventDefault();
        var gallery_id = $(this).data('id');
        var gallery_image = $(this).data('image');
        $.ajax({
            type: "GET",
            url: "{{url('admin/galleries/view')}}"+"/id="+gallery_id,
            data: {id:gallery_id},
            dataType: 'json',
            success:function(result){
              $('#modelTitle').html('Photo Information');
              $('#view_gallery_id').val(result.gallery_id);
              $('#view_gallery_title').val(result.gallery_title);
              $('#view_gallery_participants').val(result.gallery_participants);
              $('#view_gallery_type').val(result.gallery_type);
              $('#view_gallery_date').val(result.gallery_date);
              $('#view_gallery_image').attr('src',gallery_image);
              $('#btnUpdate').hide();
              $('#btnCancel').hide();
              $('#btnClose').show();
              $('#viewGalleryFormDiv').show();
              $('#addGalleryFormDiv').hide();
              $('#editGalleryFormDiv').hide();
              $('#galleryModal').modal('show');
              console.log(result);
            }
        });
    });    

    //CLOSE MODAL
    $('.btn-cancel-gallery').click(function (e) { 
        $('#galleryModal').modal('hide');
    });
    $('#btnHide').click(function (e) { 
        $('#galleryModal').modal('hide');
    });

    // DELETE Gallery
    $('body').on('click', '#deleteGallery', function(e){
        e.preventDefault();
        var gallery_id = $('#edit_gallery_id').val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this photo!",
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
                url: "{{url('admin/galleries/delete')}}"+"/id="+gallery_id,
                data: {id:gallery_id},
                success: function (result) {
                    Swal.close();
                    $('#galleryModal').modal('hide')
                    $('#galleries-table').DataTable().ajax.reload();
                    swal("Poof! Photo has been deleted!", {
                        icon: "success",
                    });
                    console.log(result);
                },
                error: function (result) {
                    Swal.close();
                    $('#galleryModal').modal('hide')
                    console.log('Error: ', result);
                }
            })
                    
        } 
        });
    });
function updateItemCount() {
      var itemCount = table.page.info().recordsTotal;
      $('#totalGallery').text(itemCount);
  }

  updateItemCount();

  table.on('draw', function() {
      updateItemCount();
});

$('#gallery_image').on('change', function (e) {
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