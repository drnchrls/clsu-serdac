@extends('management.main_index')
@section('title', 'Sliders')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <h3>
          Slider (<span id="totalSlider"></span>)
          <a name="" id="createNewSlider" class="btn btn-success" href="#" role="button"><i class="fa fa-plus"></i></a>
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
<div class="row m-0 bg-white px-1 pb-3 border rounded shadow m-2">
  <div class="col-lg-12 px-lg-4 px-2 pt-4">
    <table class="table table-bordered table-hover wrap w-100" id="sliders-table">
      <thead class="bg-dark text-light">
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Action</th>     
      </thead>
    </table>
  </div>
</div>
{{-- SLIDER MODALS --}}
<div class="modal fade" id="sliderModal" aria-hidden="true">
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
            {{-- ADD-SLIDER-MODAL --}}
            <div class="add-slider-form" id="addSliderFormDiv">
              <form action="" method="" spellcheck="false"  id="addSliderForm" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row m-0 px-2 py-3 border rounded">
                  <div class="col-lg-12 d-flex">
                    <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                      view_carousel
                    </span>
                    <div class="px-2 py-3">
                      <h3 class="font-netflix-md text-main">Carousel Information</h3>
                      <small class="text-muted font-netflix-light">
                        Manage carousel information, add details and more.
                      </small>
                    </div>
                  </div>
                  <div class="col-lg-12 px-4">
                    <small class="text-muted font-netflix-light">
                      <strong><i class="fa fa-dot-circle-o text-secondary px-1"></i></strong>
                      Please refer to the notes below each input for optimal user experience.
                    </small>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center justify-content-center overflow-hidden mt-2">
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
                            <label for="slider_title" class="text px-2">Title<small class="text-danger">*</small></label>
                            <input type="text" placeholder="Insert title here" id="slider_title" name="slider_title" class="input" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-lg-12">
                          <div class="cooltextarea">
                            <label for="slider_description" class="textarea-label px-2">Description<small class="text-danger">*</small></label>
                            <textarea cols="30" class="textarea" rows="5" id="slider_description" name='slider_description' placeholder="Insert description here..." required></textarea>
                            <span class="text-danger" id="slider_description_error"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-row my-3">
                        <div class="col-lg-12">
                          {{-- <label for="slider_image">Image</label> --}}
                          <input type="file" class="form-control-file border p-1 rounded" id="slider_image" name='slider_image' accept="image/*" required>
                          {{-- <span class="text-danger">@error ('slider_image') {{$message}} @enderror</span> --}}
                          <small>
                            <span class="text-danger" id="slider_image_error"></span>
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
                    <button type="button" class="btn btn-danger mx-1 btn-cancel-slider">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
            {{-- EDIT-SLIDER-MODAL --}}
            <div class="edit-slider-form" id="editSliderFormDiv">
              <form action="" method="" autocomplete="off" spellcheck="false">
                @csrf
                <div class="row m-0 px-2 py-3 border rounded">
                  <div class="col-lg-12 mb-2 d-flex">
                    <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                      view_carousel
                    </span>
                    <div class="px-2 py-3">
                      <h3 class="font-netflix-md text-main">Carousel Information</h3>
                      <small class="text-muted font-netflix-light">
                        Manage carousel information, update details and more.
                      </small>
                    </div>
                  </div>
                  <input type="text" class="form-control no-drop" name="edit_slider_id" id="edit_slider_id_input" value="" disabled hidden>
                  <div class="col-lg-6 d-flex align-items-center justify-content-center overflow-hidden">
                    <div class="row m-0">
                      <div class="col-lg-12 no-padding">
                        <div class="displayed-image d-flex justify-content-center align-items-center">
                          <img id="edit_slider_image" src="" class="d-block w-100 shadow" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <div class="coolinput">
                            <label for="edit_slider_title" class="text px-2">Title<span class="text-danger">*</span></label>
                            <input type="text" class="input" name="edit_slider_title" id="edit_slider_title" value="" required>
                            <span class="text-danger" id="edit_slider_title_error"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12">
                          <div class="cooltextarea">
                            <label for="edit_slider_description" class="textarea-label px-2">Description<span class="text-danger">*</span></label>
                            <textarea name="edit_slider_description" id="edit_slider_description" cols="30" rows="4" class="textarea" required></textarea>
                            <span class="text-danger" id="edit_slider_description_error"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12 px-2 no-padding">
                      <p>
                        <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                      </p>
                      <div class="collapse" id="advanceSettings">
                        <button type="button" class="btn btn-outline-danger w-100" id="deleteSlider">
                          <i class="fa fa-trash"></i> Remove Slider
                        </button>
                        <h6 class="p-2">
                          <small class="text-danger"> *This slider will be permanently deleted.</small>
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row p-3 border-top mt-4">
                  <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                    <button type="submit" class="btn btn-warning mx-1 text-white" id="btnUpdate">Update</button>
                    <button type="button" class="btn btn-danger mx-1 btn-cancel-slider" >Cancel</button>
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
        // Cross-Site Request Forgery - CSRF
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // SHOW LIST OF STAFFS TABLE
    table = $('#sliders-table').DataTable({
        responsive:true,
        processing: true,
        // language: {
        //     processing: '<span class="fa fa-refresh fa-spin fa-3x fa-fw datatable-spinner text-info"></span><div class="loading-text ">Loading...</div>'
        // },
        serverSide: true,
        // select: true,
        // retrieve: true,
        ajax: {
            'url': "{{ route('admin.sliders') }}",

        },

        'pageLength': 5,
        'aLengthMenu': [[5,10,20],[5,10,20],'all'],
        columns: [
            {data: 'slider_id', name: 'slider_id', width: '20px', class: 'text-lg-center'},
            {data: 'slider_title', name: 'slider_title'},
            {data: 'slider_description', name: 'slider_description'},
            {data: 'slider_image', name: 'slider_image', searchable: false, orderable: false, class: 'text-lg-center'},
            {data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-lg-center'},
        ],

        // columnDefs:[
        //     {responsivePriority: 1, targets:-1,}
        // ]
    });

    // TRIGGER ADD MODAL
    $('#createNewSlider').click(function (e) {
      e.preventDefault();
      $('#slider_title_error').html('');
      $('#slider_description_error').html('');
      $('#slider_image_error').html('');


      $('#addSliderForm').trigger("reset");
      $('#modelTitle').html("Create Slider");
      $('#addSliderFormDiv').show();
      // $('#btnCreate').show();
      // $('#btnUpdate').hide();
      $('#editSliderFormDiv').hide();
      $('#sliderModal').modal('show');
      $('#no-image').show();
      $('#image-preview').attr('src','');
    });

    // STORE SLIDER
    $('#addSliderForm').submit(function (e) {
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
            url: "{{ route('admin.store.sliders') }}",
            type: "POST",
            success: function (result) {
                Swal.close();
                swal("Slider has been created succesfully!", {
                    icon: "success",
                });
                $('#addSliderForm').trigger("reset");
                $('#sliderModal').modal('hide');
                // table.ajax.reload();
                $('#sliders-table').DataTable().ajax.reload();
                console.log('Success:', result);
            },
            contentType: false,
            processData: false,
            error: function (result) {
                // alert('Error');
                // swal("Unable to create account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#slider_title_error').html('');
                $('#slider_description_error').html('');
                $('#slider_image_error').html('');

                $('#slider_title_error').html(result.responseJSON.errors.slider_title);
                $('#slider_description_error').html(result.responseJSON.errors.slider_description);
                $('#slider_image_error').html(result.responseJSON.errors.slider_image);


                console.log('Error: ', result);
            }
        });
    });

    // TRIGGER EDIT MODAL
    $('body').on('click', '#editSlider', function(e) {
      e.preventDefault();
      var slider_id = $(this).data('id');
      var slider_image = $(this).data('image');
      $.ajax({
        url: "{{url('admin/sliders/edit')}}"+'/id='+slider_id,
        method: 'GET',
        success: function(result) {
            
            $('#edit_slider_title_error').html('');
            $('#edit_slider_description_error').html('');
            $('#edit_slider_image_error').html('');

            $('#modelTitle').html("Manage Slider");
            // $('#edit_slider_id').html(result.data.slider_id);
            $('#edit_slider_id_input').val(result.data.slider_id);
            $('#edit_slider_title').val(result.data.slider_title);
            $('#edit_slider_description').val(result.data.slider_description);
            $('#edit_slider_image').attr('src', slider_image);
            $('#editSliderFormDiv').show();
            // $('#btnUpdate').show();
            $('#addSliderFormDiv').hide();
            // $('#btnCreate').hide();
            $('#sliderModal').modal('show');
            
            console.log(result);
        },
        error: function(result){
          console.log('Error: ',result);
        }
      });
    });


    // UPDATE SLIDER
    $('#btnUpdate').click(function (e) {
      // e.preventDefault();

      var slider_id = $('#edit_slider_id_input').val();
      var slider_title   = $('#edit_slider_title').val();
      var slider_description = $('#edit_slider_description').val();
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
          "slider_title": slider_title,
          "slider_description": slider_description,
          // "_token": token,
        },
        url: "{{ url('admin/sliders/update') }}"+"/id="+slider_id,
        type: "PUT",
        dataType: 'json',
        success: function (result) {
          Swal.close();
          $('#sliderModal').modal('hide');
          swal("Slider has been updated succesfully!", {
              icon: "success",
          });
          $('#sliders-table').DataTable().ajax.reload();
          console.log('Success:', result);
        },
        error: function (result) {
          // swal("Unable to update account. Something went wrong!", {
          //     icon: "error",
          // });
          Swal.close();
          $('#edit_slider_title_error').html('');
          $('#edit_slider_description_error').html('');
          $('#edit_slider_title_error').html(result.responseJSON.errors.slider_title);
          $('#edit_slider_description _error').html(result.responseJSON.errors.slider_description);
          console.log('Error:', result);
        }
      });
    });


    // CLOSE MODAL
    $('#btnHide').click(function (e) { 
        $('#sliderModal').modal('hide');
    });
    $('.btn-cancel-slider').click(function (e) { 
        $('#sliderModal').modal('hide');
    });


    // DELETE SLIDER
    $('body').on('click', '#deleteSlider', function(e){
      e.preventDefault();
        var slider_id = $('#edit_slider_id_input').val();

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this slider!",
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
              url: "{{url('admin/sliders/delete')}}"+"/id="+slider_id,
              data: {id:slider_id},
              success: function (result) {
                  Swal.close();
                  $('#sliderModal').modal('hide');
                  $('#sliders-table').DataTable().ajax.reload();
                  swal("Poof! Slider has been deleted!", {
                    icon: "success",
                  });
                  console.log(result);
              },
              error: function (result) {
                 Swal.close();
                $('#sliderModal').modal('hide');
                 console.log('Error: ', result);
              }
              })
                
            } 
        });
      });



  function updateItemCount() {
      var itemCount = table.page.info().recordsTotal;
      $('#totalSlider').text(itemCount);
  }

  updateItemCount();

  table.on('draw', function() {
      updateItemCount();
  });
  
  $('#slider_image').on('change', function (e) {
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