@extends('management.main_index')
@section('title', 'Publications')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <input type="text" id="staff_role" value="{{  Auth::guard('staff')->user()->staff_role}}" hidden>
        <h3>
          Publication (<span id="totalPublication"></span>)
          <a name="" id="createNewPublication" class="btn btn-success" href="#" role="button"><i class="fa fa-plus"></i></a>
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
    <table class="table table-bordered table-hover wrap w-100" id="publications-table">
      <thead class="bg-dark text-light">
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Contributor</th>
        <th>Date</th>
        <th>Type</th>
        {{-- <th>File</th> --}}
        <th>Action</th>
      </thead>
    </table>
  </div>
</div>
<div class="modal fade" id="publicationModal" aria-hidden="true">
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
          {{-- ADD-PUBLICATION-MODAL --}}
          <div class="add-publication-form" id="addPublicationFormDiv">
            <form action="" method="" id="addPublicationForm" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-lg-3 mb-1 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    local_library
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Books & Journals Information</h3>
                    <small class="text-muted font-netflix-light">
                      Manage books & journals information, add details and more.
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
                      <div class="col-lg-6">
                        <div class="coolselect">
                          <label for="publication_type" class="select-label px-2">Type<small class="text-danger">*</small></label>
                          <select id="publication_type" name='publication_type' class="select" required>
                              <option value="" selected disabled>- Type -</option>
                              <option value="Book">Book</option>
                              <option value="Journal/Journal Article">Journal/Journal Article</option>
                              <option value="Technical Report/Research Paper">Technical Report/Research Paper</option>
                              <option value="Unclassified/Others">Unclassified/Others</option>
                          </select>
                          <span class="text-danger" id="publication_type_error"></span>
                          <small class="text-info">&nbsp; *Input fields may vary depends on the type.</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolselect">
                          <label for="publication_theme" class="select-label px-2">Theme<small class="text-danger">*</small></label>
                          <select id="publication_theme" name='publication_theme' class="select" required>
                              <option value="" selected disabled>- Theme -</option>
                              <option value="Socioeconomics">Socioeconomics</option>
                              <option value="Agriculture">Agriculture</option>
                              <option value="Horticulture">Horticulture</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="publication_title" class="text px-2">Title<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="publication_title" name='publication_title' placeholder="Title" required>
                          <span class="text-danger" id="publication_title_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="cooltextarea">
                          <label for="publication_description" class="textarea-label px-2">Description<small class="text-danger">*</small></label>
                          <textarea id="publication_description" name='publication_description' placeholder="Description" cols="30" rows="4" class="textarea" required></textarea>
                          <span class="text-danger" id="publication_description_error"></span>
                          <small class="text-info">&nbsp; *It can be the introduction/abstract of the paper.</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-row" id="form-journal">
                      <div class="col-6">
                        <div class="coolinput">
                          <label for="publication_volume" class="text px-2">Volume<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="publication_volume" name='publication_volume' placeholder="Volume">
                          <span class="text-danger" id="publication_volume_error"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="coolinput">
                          <label for="publication_issue" class="text px-2">Issue<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="publication_issue" name='publication_issue' placeholder="Issue">
                          <span class="text-danger" id="publication_issue_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="publication_author" class="text px-2">Author<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="publication_author" name='publication_author' placeholder="Author" required>
                          <span class="text-danger" id="publication_author_error"></span>
                          <small class="text-info">&nbsp; *Separate names only with comma and '&'.</small>
                          <small class="text-info">&nbsp; *Include hyphen for two-word surnames (<strong>Dela-Cruz</strong>).</small>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="publication_contributor" class="text px-2">Contributor<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="publication_contributor" name='publication_contributor' placeholder="Contributor" required>
                          <span class="text-danger" id="publication_contributor_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="publication_publisher" class="text px-2">Publisher<small class="text-danger">*</small></label>
                          <input type="text" class="input" id="publication_publisher" name='publication_publisher' placeholder="Publisher" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="publication_doi" class="text px-2">DOI</label>
                          <input type="text" class="input" id="publication_doi" name='publication_doi' placeholder="DOI">
                          <span class="text-danger" id="publication_contributor_error"></span>
                          <small class="text-info">&nbsp; *Only if available.</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="publication_date" class="text px-2">Date Published<small class="text-danger">*</small></label>
                          <input type="date" class="input border p-2 rounded" id="publication_date" name='publication_date' placeholder="Date" required>
                          <span class="text-danger" id="publication_date_error"></span>
                          <small class="text-info">&nbsp; *Not the date added to the library.</small>
                        </div>
                      </div>
                      <div class="col-lg-6 mt-lg-4 mt-3">
                        <div class="coolinput">
                          <input type="file" class="form-control-file input-type-file border p-1 rounded" id="publication_file" name='publication_file' accept=".pdf, .xlsx, .doc, .docx" required>
                          {{-- <span class="text-danger">@error ('publication_file') {{$message}} @enderror</span> --}}
                          <small>
                            <span class="text-danger" id="publication_file_error"></span>
                          </small>
                          <small class="text-info">&nbsp; *File can be PDF, Excel & Word document.</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row p-3 border-top mt-4">
                <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                  <button type="submit" class="btn btn-success mx-1" id="btnCreate">Create</button>
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-publication">Cancel</button>
                </div>
              </div>
            </form>
          </div>
          {{-- EDIT-PUBLICATION-INFORMATION-MODAL --}}
          <div class="edit-publication-form" id="editPublicationFormDiv">
            <form action="" method="" autocomplete="off" spellcheck="false">
              @csrf
              <div class="row m-0 px-2 py-3 border rounded">
                <div class="col-lg-12 mb-lg-3 mb-1 d-flex">
                  <span class="material-symbols-outlined text-main sz-90 dismissible-material">
                    local_library
                  </span>
                  <div class="px-2 py-3">
                    <h3 class="font-netflix-md text-main">Books & Journals Information</h3>
                    <small class="text-muted font-netflix-light">
                     Manage publication information, update details and more.
                    </small>
                  </div>
                </div>
                <div class="col-lg-12 px-4 py-2">
                  <small class="text-muted font-netflix-light">
                    <strong><i class="fa fa-dot-circle-o text-secondary px-1"></i></strong>
                    You can view the actual file <a href="" id="edit_publication_file" target="_blank" rel="noopener noreferrer" class="text-info"> here <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> or 
                    <a href="" target="_blank" id="edit_publication_link" rel="noopener noreferrer" class="text-info"> click here <i class="fa fa-external-link" aria-hidden="true"></i></a> to see how it looks in your website.
                  </small>
                </div>
                <input type="text" class="form-control no-drop" name="edit_publication_id" id="edit_publication_id" value="" disabled hidden>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolselect">
                          <label for="edit_publication_theme" class="select-label px-2 bg-light">Theme</label>
                          <input type="text" class="select border p-2 rounded no-drop" id="edit_publication_theme" value="" disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolselect">
                          <label for="edit_publication_type" class="select-label px-2 bg-light">Type</label>
                          <input type="text" class="select border p-2 rounded no-drop" id="edit_publication_type" value="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-12">
                        <div class="coolinput">
                          <label for="edit_publication_title" class="text px-2">Title</label>
                            <input type="text" class="input" id="edit_publication_title" value="" required>
                            <span class="text-danger" id="edit_publication_title_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="cooltextarea">
                          <label for="edit_publication_description" class="textarea-label px-2">Description</label>
                            <textarea class="form-control" id="edit_publication_description" cols="30" rows="10" class="textarea" value="" required></textarea>
                            <span class="text-danger" id="edit_publication_description_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row" id="edit-form-journal">
                      <div class="col-6">
                        <div class="coolinput">
                          <label for="edit_publication_volume" class="text px-2">Volume</label>
                          <input type="text" class="input" id="edit_publication_volume" placeholder="Volume" value="">
                          <span class="text-danger" id="edit_publication_volume_error"></span>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="coolinput">
                          <label for="edit_publication_issue" class="text px-2">Issue</label>
                          <input type="text" class="input" id="edit_publication_issue" placeholder="Issue" value="">
                          <span class="text-danger" id="edit_publication_issue_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_publication_author" class="text px-2">Author</label>
                            <input type="text" class="input" id="edit_publication_author" value="" required>
                            <span class="text-danger" id="edit_publication_author_error"></span>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_publication_contributor" class="text px-2">Contributor</label>
                          <input type="text" class="input" id="edit_publication_contributor" value="" required>
                          <span class="text-danger" id="edit_publication_contributor_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_publication_publisher" class="text px-2">Publisher</label>
                          <input type="text" class="input" id="edit_publication_publisher" value="" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="publication_doi" class="text px-2">DOI</label>
                          <input type="text" class="input" id="edit_publication_doi" value="">
                          <span class="text-danger" id="edit_publication_contributor_error"></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-lg-6">
                        <div class="coolinput">
                          <label for="edit_publication_date" class="text px-2 bg-light">Date</label>
                          <input type="date" class="input border p-2 rounded no-drop" id="edit_publication_date" value="" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 px-2 no-padding">
                    <p>
                      <a data-toggle="collapse" class="text-dark" href="#advanceSettings" aria-expanded="false"> Advanced Settings <i class="fa fa-chevron-down pl-2"></i></a>
                    </p>
                    <div class="collapse" id="advanceSettings">
                      <button type="button" class="btn btn-outline-danger w-100" id="deletePublication">
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
                  <button type="button" class="btn btn-danger mx-1 btn-cancel-publication">Cancel</button>
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
    if($('#staff_role').val() === 'Library Staff' ){
      var staffRole = 'libr';
    }else{
      var staffRole = 'admin';
    }
    // SHOW LIST OF STAFFS TABLE
    table = $('#publications-table').DataTable({
        responsive:true,
        processing: true,
        // language: {
        //     processing: '<span class="fa fa-refresh fa-spin fa-3x fa-fw text-info"></span><div class="loading-text "></div>'
        // },
        serverSide: true,
        // select: true,
        // retrieve: true,
        ajax: {
            'url': '/'+ staffRole +'/publications',

        },
        'pageLength': 5,
        'aLengthMenu': [[5,10,20],[5,10,20],'all'],
        columns: [
            {data: 'publication_id', name: 'publication_id', width: '20px', class: 'text-lg-center'},
            {data: 'publication_title', name: 'publication_title'},
            {data: 'publication_author', name: 'publication_author'},
            {data: 'publication_contributor', name: 'publication_contributor'},
            {data: 'publication_date', name: 'publication_date'},
            {data: 'publication_type', name: 'publication_type'},
            // {data: 'publication_file', name: 'publication_file', orderable: false, class: 'text-lg-center'},
            {data: 'action', name: 'action', searchable: false, orderable: false, class: 'text-lg-center'},
        ],
        // columnDefs:[
        //     {responsivePriority: 1, targets:-1,}
        // ],
    });

    $('#createNewPublication').click(function (e) {
      e.preventDefault();
      // $('#saveBtn').val("create-product");
      // $('#product_id').val('');
      $('#publication_title_error').html('');
      $('#publication_author_error').html('');
      $('#publication_contributor_error').html('');
      $('#publication_file_error').html('');
      $('#publication_date_error').html('');
      $('#publication_type_error').html('');


      $('#addPublicationForm').trigger("reset");
      $('#modelTitle').html("Add Publication");
      $('#addPublicationFormDiv').show();
      $('#btnCreate').show();
      $('#btnUpdate').hide();
      $('#editPublicationFormDiv').hide();
      $('#viewPublicationFormDiv').hide();
      $('#form-journal').hide();
      $('#publicationModal').modal('show');
    });



    $('#publication_type').on('change', function(){
        var type = $(this).val();
        if(type=='Journal/Journal Article'){
            $('#form-journal').show();
        }else{
            $('#form-journal').hide();
        }
    });

    
    $('#addPublicationForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        Swal.fire({
            // title: 'Please wait...',
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
            url: '/'+ staffRole +'/publications/add',
            type: "POST",
            contentType: false,
            processData: false,
            success: function (result) {
                Swal.close();
                swal("Publication has been added succesfully!", {
                    icon: "success",
                });
                console.log('Success:', result);
                $('#addPublicationForm').trigger("reset");
                $('#publicationModal').modal('hide');
                // table.ajax.reload();
                $('#publications-table').DataTable().ajax.reload();
            },
            error: function (result) {
                // alert('Error');
                // swal("Unable to create account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#publication_title_error').html('');
                $('#publication_author_error').html('');
                $('#publication_contributor_error').html('');
                $('#publication_file_error').html('');
                $('#publication_description_error').html('');
                $('#publication_date_error').html('');
                $('#publication_type_error').html('');
                $('#publication_title_error').html(result.responseJSON.errors.publication_title);
                $('#publication_author_error').html(result.responseJSON.errors.publication_author);
                $('#publication_contributor_error').html(result.responseJSON.errors.publication_contributor);
                $('#publication_description_error').html(result.responseJSON.errors.publication_description);
                $('#publication_file_error').html(result.responseJSON.errors.publication_file);
                $('#publication_date_error').html(result.responseJSON.errors.publication_date);
                $('#publication_type_error').html(result.responseJSON.errors.publication_type);


                console.log('Error: ', result);
            },
           
            
        });
    });
    $('body').on('click', '#editPublication', function(e) {
        e.preventDefault();
        var publication_id = $(this).data('id');
        var publication_file = $(this).data('file');
        var publication_link = $(this).data('link')
        $.ajax({
            url: '/'+ staffRole +'/publications/edit/id=' + publication_id,
            method: 'GET',
            // data: {
            //     id: id,
            // },
            // cache: false,
            success: function(result) {
                
                $('#edit_publication_title_error').html('');
                $('#edit_publication_author_error').html('');
                $('#edit_publication_contributor_error').html('');
                $('#edit_publication_type_error').html('');
                $('#edit_publication_date_error').html('');
                $('#edit_publication_description_error').html('');

                $('#modelTitle').html("Manage Publication");
                
                $('#edit_publication_id').val(result.data.publication_id);
                $('#edit_publication_id').html(result.data.publication_id);
                $('#edit_publication_title').val(result.data.publication_title);
                $('#edit_publication_author').val(result.data.publication_author);
                $('#edit_publication_contributor').val(result.data.publication_contributor);
                $('#edit_publication_type').val(result.data.publication_type);
                $('#edit_publication_theme').val(result.data.publication_theme);
                $('#edit_publication_publisher').val(result.data.publication_publisher);
                $('#edit_publication_doi').val(result.data.publication_doi);
                $('#edit_publication_description').val(result.data.publication_description);
                $('#edit_publication_date').val(result.data.publication_date);
                $('#edit_publication_file').attr('href',publication_file);
                $('#edit_publication_link').attr('href',publication_link);
                    if(result.data.publication_type=='Journal/Journal Article'){
                        $('#edit_publication_volume').val(result.data.publication_volume);
                        $('#edit_publication_issue').val(result.data.publication_issue);
                        $('#edit-form-journal').show();
                    }else{
                        $('#edit-form-journal').hide();
                    }
                $('#addPublicationFormDiv').hide();
                $('#viewPublicationFormDiv').hide();
                $('#editPublicationFormDiv').show();
                $('#btnUpdate').show();
                $('#btnCreate').hide();
                $('#publicationModal').modal('show');
                
                console.log(result);
            },
            error: function(result){
                console.log(result);
            }
        });
    });

    $('#btnUpdate').click(function (e) {

        var publication_id = $('#edit_publication_id').val();
        var publication_title   = $('#edit_publication_title').val();
        var publication_author = $('#edit_publication_author').val();
        var publication_contributor = $('#edit_publication_contributor').val();
        var publication_description   = $('#edit_publication_description').val();
        var publication_type = $('#edit_publication_type').val();
        var publication_volume   = $('#edit_publication_volume').val();
        var publication_issue = $('#edit_publication_issue').val();
        var publication_publisher   = $('#edit_publication_publisher').val();
        var publication_doi = $('#edit_publication_doi').val();
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
                "publication_title": publication_title,
                "publication_author": publication_author,
                "publication_contributor": publication_contributor,
                "publication_description": publication_description,
                "publication_volume": publication_volume,
                "publication_issue": publication_issue,
                "publication_publisher": publication_publisher,
                "publication_doi": publication_doi,

                // "_token": token,
            },
            url: '/'+ staffRole +'/publications/update/id=' + publication_id,
            type: "PUT",
            dataType: 'json',
            success: function (result) {
                Swal.close();
                console.log('Success:', result);
                $('#publicationModal').modal('hide');
                swal("Publication has been updated succesfully!", {
                    icon: "success",
                });
                $('#publications-table').DataTable().ajax.reload();

            },
            error: function (result) {
                // swal("Unable to update account. Something went wrong!", {
                //     icon: "error",
                // });
                Swal.close();
                $('#edit_publication_title_error').html('');
                $('#edit_publication_author_error').html('');
                $('#edit_publication_contributor_error').html('');
                $('#edit_publication_description_error').html('');
                $('#edit_publication_volume_error').html('');
                $('#edit_publication_issue_error').html('');
                $('#edit_publication_title_error').html(result.responseJSON.errors.publication_title);
                $('#edit_publication_author_error').html(result.responseJSON.errors.publication_author);
                $('#edit_publication_contributor_error').html(result.responseJSON.errors.publication_contributor);
                $('#edit_publication_description_error').html(result.responseJSON.errors.publication_description);
                $('#edit_publication_volume_error').html(result.responseJSON.errors.publication_volume);
                $('#edit_publication_issue_error').html(result.responseJSON.errors.publication_issue);
                console.log('Error:', result);
            }
        });
    });


 // DELETE PUBLICATION
 $('body').on('click', '#deletePublication', function(e){
        e.preventDefault();
        var publication_id = $('#edit_publication_id').val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover every data connected to this file.",
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
                url: '/'+ staffRole +'/publications/delete/id=' + publication_id,
                data: {id:publication_id},
                success: function (result) {
                    Swal.close();
                    $('#publicationModal').modal('hide')
                    $('#publications-table').DataTable().ajax.reload();
                    swal("Poof! File has been deleted!", {
                        icon: "success",
                    });
                    console.log(result);
                },
                error: function (result) {
                    Swal.close();
                    $('#publicationModal').modal('hide')
                    console.log('Error: ', result);
                }
            })
                    
        } 
        });
    });

    $('#btnHide').click(function (e) { 
        $('#publicationModal').modal('hide');
    });
    $('.btn-cancel-publication').click(function (e) { 
        $('#publicationModal').modal('hide');
    });


    function updateItemCount() {
        var itemCount = table.page.info().recordsTotal;
        $('#totalPublication').text(itemCount);
    }

    updateItemCount();

    table.on('draw', function() {
        updateItemCount();
    });




// END
});
</script>
@endsection