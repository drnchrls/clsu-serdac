@extends('management.main_index')
@section('title', 'Datasets')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading">
        <input type="text" id="staff_role" value="{{  Auth::guard('staff')->user()->staff_role}}" hidden>
        <h3>
          Dataset (<span id="totalDataset"></span>)
          <a name="" id="createNewDataset" class="btn btn-success" href="#" role="button"><i class="fa fa-plus"></i></a>
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
    <table class="table table-bordered table-hover wrap w-100" id="datasets-table">
      <thead class="bg-dark text-light">
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Contributor</th>
        <th>Date</th>
        {{-- <th>File</th> --}}
        <th>Action</th>
      </thead>
    </table>
  </div>
</div>           
<div class="modal fade" id="datasetModal" aria-hidden="true">
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
          {{-- ADD-DATASET-MODAL--}}
          <div class="add-dataset-form" id="addDatasetFormDiv">
            <form action="" method=""  id="addDatasetForm" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-lg-3 mb-1 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    local_library
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Dataset Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage datasets information, add details and more.
                    </small>
                  </div>
                </div>
                <div class="col-lg-12 px-4 py-2">
                  <small class="text-muted font-netflix-light">
                    <strong><i class="fa fa-dot-circle-o text-secondary px-1"></i></strong>
                    Please refer to the notes below each input for optimal user experience.
                  </small>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="dataset_title" class="text px-2">Title<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="dataset_title" name='dataset_title' placeholder="Title" required>
                          <span class="text-danger" id="dataset_title_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="cooltextarea">
                          <label for="dataset_description" class="textarea-label px-2">Description<small class="text-danger">*</small></label>
                          <textarea id="dataset_description" name='dataset_description' placeholder="Description" cols="30" rows="4" class="textarea" required></textarea>
                          <span class="text-danger" id="dataset_description_error"></span>
                          <small class="text-info">&nbsp; *It can be the introduction/abstract of the dataset.</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="dataset_author" class="text px-2">Author<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="dataset_author" name='dataset_author' placeholder="Author" required>
                          <span class="text-danger" id="dataset_author_error"></span>
                          <small class="text-info">&nbsp; *Separate names only with comma and '&'.</small>
                          <small class="text-info">&nbsp; *Include hyphen for two-word surnames (Dela-Cruz).</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="dataset_contributor" class="text px-2">Contributor<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="dataset_contributor" name='dataset_contributor' placeholder="Contributor" required>
                          <span class="text-danger" id="dataset_contributor_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-6">
                          <div class="coolinput">
                            <label for="dataset_date" class="text px-2">Date Published<small class="text-danger">*</small></label>
                            <input type="date" class="input border p-2 rounded" id="dataset_date" name='dataset_date' placeholder="Date" required>
                            <span class="text-danger" id="dataset_date_error"></span>
                            <small class="text-info">&nbsp; *Not the date added to the library.</small>
                          </div>
                        </div>
                        <div class="col-lg-6 mt-lg-4 mt-3">
                          <input type="file" class="form-control-file input-type-file border p-1 rounded" id="dataset_file" name='dataset_file' accept=".pdf, .xlsx, .doc, .docx" required>
                          {{-- <span class="text-danger">@error ('dataset_file') {{$message}} @enderror</span> --}}
                          <small>
                            <span class="text-danger" id="dataset_file_error"></span>
                          </small>
                          <small class="text-info">&nbsp; *File can be PDF, Excel & Word document.</small>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-success mx-1" id="btnCreate">Create</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-dataset">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          {{-- EDIT-DATASET-INFORMATION-MODAL --}}
          <div class="edit-dataset-form" id="editDatasetFormDiv">
            <form action="" method="" autocomplete="off" spellcheck="false">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-lg-3 mb-1 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    local_library
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Dataset Information</h3>
                    <small class="text-muted font-netflix-light">
                     Manage datasets information, update details and more.
                    </small>
                  </div>
                </div>
                <div class="col-lg-12 px-4 py-2">
                  <small class="text-muted font-netflix-light">
                    <strong><i class="fa fa-dot-circle-o text-secondary px-1"></i></strong>
                    You can view the actual file <a href="" id="edit_dataset_file" target="_blank" rel="noopener noreferrer" class="text-info"> here <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> or 
                    <a href="" target="_blank" id="edit_dataset_link" rel="noopener noreferrer" class="text-info"> click here <i class="fa fa-external-link" aria-hidden="true"></i></a> to see how it looks in your website.
                  </small>
                </div>
                <input type="text" class="form-control no-drop" name="edit_dataset_id" id="edit_dataset_id" value="" disabled hidden>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_dataset_title" class="text px-2">Title</label>
                          <input type="text" class="input" id="edit_dataset_title" value="" required>
                          <span class="text-danger" id="edit_dataset_title_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="cooltextarea">
                          <label for="edit_dataset_description" class="textarea-label px-2">Description</label>
                          <textarea class="textarea" id="edit_dataset_description" cols="30" rows="10" value="" required></textarea>
                          <span class="text-danger" id="edit_dataset_description_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_dataset_author" class="text px-2">Author</label>
                          <input type="text" class="input" id="edit_dataset_author" value="" required>
                          <span class="text-danger" id="edit_dataset_author_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_dataset_contributor" class="text px-2">Contributor</label>
                          <input type="text" class="input" id="edit_dataset_contributor" value="" required>
                          <span class="text-danger" id="edit_dataset_contributor_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_dataset_date" class="text px-2 bg-light">Date</label>
                          <input type="date" class="input border p-2 rounded no-drop" id="edit_dataset_date" value="" disabled>
                          <small class="text-info">&nbsp; *You can't edit this field.</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 px-2 no-padding">
                    <p>
                      <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                    </p>
                    <div class="collapse" id="advanceSettings">
                      <button type="button" class="btn btn-outline-danger w-100" id="deleteDataset">
                        <i class="fa fa-trash"></i> Remove Publication
                      </button>
                      <h6 class="p-2">
                        <small class="text-danger"> *This may permanently affect data analytics of the website</small>
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-warning mx-1 text-white" id="btnUpdate">Update</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-dataset">Cancel</button>
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
  var staffRole;
    $.ajaxSetup({
    // Cross-Site Request Forgery - CSRF
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($('#staff_role').val() === 'Library Staff' ){
      var staffRole = 'libr';
          // SHOW LIST OF STAFFS TABLE
    }else{
      var staffRole = 'admin';
    }

    table = $('#datasets-table').DataTable({
          responsive:true,
          processing: true,
          // language: {
          //     processing: '<span class="fa fa-refresh fa-spin fa-3x fa-fw text-info"></span><div class="loading-text "></div>'
          // },
          serverSide: true,
          // select: true,
          // retrieve: true,
          
          ajax: {
              'url':'/' + staffRole + '/datasets',

          },
          'pageLength': 5,
          'aLengthMenu': [[5,10,20],[5,10,20],'all'],
          columns: [
              {data: 'dataset_id', name: 'dataset_id', width: '20px', class: 'text-lg-center'},
              {data: 'dataset_title', name: 'dataset_title'},
              {data: 'dataset_author', name: 'dataset_author'},
              {data: 'dataset_contributor', name: 'dataset_contributor'},
              {data: 'dataset_date', name: 'dataset_date'},
              // {data: 'dataset_file', name: 'dataset_file', orderable: false, class: 'text-lg-center'},
              {data: 'action', name: 'action', width: '130px', searchable: false, orderable: false, class: 'text-lg-center'},
          ],
          columnDefs:[
              {responsivePriority: 1, targets:0},
              {responsivePriority: 2, targets:1},
              {responsivePriority: 3, targets:-1}
          ],
          // dom: 'Bfrtip',
          // buttons: [
          //   'print'
          // ]
      });
    $('#createNewDataset').click(function (e) {
      e.preventDefault();
      // $('#saveBtn').val("create-product");
      // $('#product_id').val('');
      $('#dataset_title_error').html('');
      $('#dataset_author_error').html('');
      $('#dataset_contributor_error').html('');
      $('#dataset_file_error').html('');
      $('#dataset_date_error').html('');


      $('#addDatasetForm').trigger("reset");
      $('#modelTitle').html("Add Dataset");
      $('#addDatasetFormDiv').show();
      $('#btnCreate').show();
      $('#btnUpdate').hide();
      $('#editDatasetFormDiv').hide();
      $('#viewDatasetFormDiv').hide();
      $('#datasetModal').modal('show');
    });


    
    $('#addDatasetForm').submit(function (e) {
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
            url: '/' + staffRole + '/datasets/add',
            type: "POST",
            contentType: false,
            processData: false,
            success: function (result) {
                Swal.close();
                swal("Dataset has been added succesfully!", {
                    icon: "success",
                });
                console.log('Success:', result);
                $('#addDatasetForm').trigger("reset");
                $('#datasetModal').modal('hide');
                // table.ajax.reload();
                $('#datasets-table').DataTable().ajax.reload();
                $("#btnCreate").find(".fa-spinner").remove();
                $("#btnCreate").removeAttr("disabled");
            },
            error: function (result) {
                // alert('Error');
                // swal("Unable to create account. Something went wrong!", {
                //     icon: "error",
                // });
                $('#dataset_title_error').html('');
                $('#dataset_author_error').html('');
                $('#dataset_contributor_error').html('');
                $('#dataset_file_error').html('');
                $('#dataset_description_error').html('');
                $('#dataset_date_error').html('');
                $('#dataset_title_error').html(result.responseJSON.errors.dataset_title);
                $('#dataset_author_error').html(result.responseJSON.errors.dataset_author);
                $('#dataset_contributor_error').html(result.responseJSON.errors.dataset_contributor);
                $('#dataset_description_error').html(result.responseJSON.errors.dataset_description);
                $('#dataset_file_error').html(result.responseJSON.errors.dataset_file);
                $('#dataset_date_error').html(result.responseJSON.errors.dataset_date);

                console.log('Error: ', result);
            },
           
        });
    });
    $('body').on('click', '#editDataset', function(e) {
        e.preventDefault();
        var dataset_id = $(this).data('id');
        var dataset_file = $(this).data('file');
        var dataset_link = $(this).data('link');
        $.ajax({
            url: '/' + staffRole + '/datasets/edit/id='+dataset_id,
            method: 'GET',
            // data: {
            //     id: id,
            // },
            // cache: false,
            success: function(result) {
                
                $('#edit_dataset_title_error').html('');
                $('#edit_dataset_author_error').html('');
                $('#edit_dataset_contributor_error').html('');
                $('#edit_dataset_type_error').html('');
                $('#edit_dataset_date_error').html('');
                $('#edit_dataset_description_error').html('');

                $('#modelTitle').html("Manage Dataset");
                
                $('#edit_dataset_id').val(result.data.dataset_id);
                $('#edit_dataset_id').html(result.data.dataset_id);
                $('#edit_dataset_title').val(result.data.dataset_title);
                $('#edit_dataset_author').val(result.data.dataset_author);
                $('#edit_dataset_contributor').val(result.data.dataset_contributor);
                $('#edit_dataset_description').val(result.data.dataset_description);
                $('#edit_dataset_date').val(result.data.dataset_date);
                $('#edit_dataset_file').attr('href',dataset_file);
                $('#edit_dataset_link').attr('href',dataset_link);

                $('#addDatasetFormDiv').hide();
                $('#viewDatasetFormDiv').hide();
                $('#editDatasetFormDiv').show();
                $('#btnUpdate').show();
                $('#btnCreate').hide();
                $('#datasetModal').modal('show');
                
                console.log(result);
            },
            error: function(result){
                console.log(result);
            }
        });
    });

    $('#btnUpdate').click(function (e) {
      // e.preventDefault();
      //////////////////////////////////////
        var dataset_id = $('#edit_dataset_id').val();
        var dataset_title   = $('#edit_dataset_title').val();
        var dataset_author = $('#edit_dataset_author').val();
        var dataset_description   = $('#edit_dataset_description').val();
        var dataset_contributor = $('#edit_dataset_contributor').val();
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
                "dataset_title": dataset_title,
                "dataset_author": dataset_author,
                "dataset_description": dataset_description,
                "dataset_contributor": dataset_contributor,
                // "_token": token,
            },
            url: '/'+ staffRole +'/datasets/update/id='+dataset_id,
            type: "PUT",
            dataType: 'json',
            success: function (result) {
                Swal.close();
                console.log('Success:', result);
                $('#datasetModal').modal('hide');
                swal("Dataset has been updated succesfully!", {
                    icon: "success",
                });
                $('#datasets-table').DataTable().ajax.reload();

            },
            error: function (result) {
                // swal("Unable to update account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#edit_dataset_title_error').html('');
                $('#edit_dataset_author_error').html('');
                $('#edit_dataset_description_error').html('');
                $('#edit_dataset_contributor_error').html('');
                $('#edit_dataset_title_error').html(result.responseJSON.errors.dataset_title);
                $('#edit_dataset_author_error').html(result.responseJSON.errors.dataset_author);
                $('#edit_dataset_description_error').html(result.responseJSON.errors.dataset_description);
                $('#edit_dataset_contributor_error').html(result.responseJSON.errors.dataset_contributor);

                console.log('Error:', result);
            }
        });
    });


 // DELETE Dataset
 $('body').on('click', '#deleteDataset', function(e){
        e.preventDefault();
        var dataset_id = $('#edit_dataset_id').val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover every data connected to this dataset.",
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
                url: '/'+ staffRole +'/datasets/delete/id='+dataset_id,
                data: {id:dataset_id},
                success: function (result) {
                    Swal.close();
                    $('#datasetModal').modal('hide');
                    $('#datasets-table').DataTable().ajax.reload();
                    swal("Poof! File has been deleted!", {
                        icon: "success",
                    });
                    console.log(result);
                },
                error: function (result) {
                    Swal.close();
                    $('#datasetModal').modal('hide');
                    console.log('Error: ', result);
                }
            })
                    
        } 
        });
    });



   
    $('#btnHide').click(function (e) { 
        $('#datasetModal').modal('hide');
    });
    $('.btn-cancel-dataset').click(function (e) { 
        $('#datasetModal').modal('hide');
    });


    function updateItemCount() {
        var itemCount = table.page.info().recordsTotal;
        $('#totalDataset').text(itemCount);
    }

    updateItemCount();

    table.on('draw', function() {
        updateItemCount();
    });




// END
});
</script>
@endsection