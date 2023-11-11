<html>
    <head>
        @include('layouts.stylesheet')
        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    </head>
    <style>
        /* Create Slider */
        .drop-container {
        position: relative;
        display: flex;
        gap: 10px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 300px;
        padding: 20px;
        border-radius: 10px;
        border: 2px dashed #555;
        color: #444;
        cursor: pointer;
        transition: background .2s ease-in-out, border .2s ease-in-out;
        }

        .drop-container:hover {
        background: #eee;
        border-color: #111;
        }

        .drop-container:hover .drop-title {
        color: #222;
        }

        .drop-title {
        color: #444;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        transition: color .2s ease-in-out;
        }

        
        
    </style>
    <body>
        <h1>Modal be like</h1>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
          Create Slider <p>Total Visitors: {{ $visitorCount }}</p>
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg p-1">
                                    <div class="form-row p-2">
                                        <div class="col-lg-12">
                                            <label for="images" class="drop-container" id="dropcontainer">
                                                <span class="drop-title">Drop files here</span>
                                                or
                                                <input type="file" id="images" accept="image/*" required>
                                              </label>
                                          {{-- <label for="slider_image">Image</label>
                                          <input type="file" class="form-control-file" id="slider_image" name='slider_image' accept="image/*" required>
                                          <span class="text-danger">@error ('slider_image') {{$message}} @enderror</span>
                                          <span class="text-danger" id="slider_image_error"></span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg p-1">
                                    <div class="form-group">
                                        <div class="form-row p-2">
                                          <div class="col-lg-12 my-2">
                                            <label for="slider_title text-muted">Title</label>
                                            <input type="text" class="form-control" id="slider_title" name='slider_title' placeholder="Title" required>
                                            <span class="text-danger" id="slider_title_error"></span>
                                          </div>
                                        </div>
                                        <div class="form-row p-2">
                                          <div class="col-lg-12 my-2">
                                            <label for="slider_description text-muted">Description</label>
                                            <textarea cols="20" class="form-control" rows="6" id="slider_description" name='slider_description' placeholder="Description" required></textarea>
                                            <span class="text-danger" id="slider_description_error"></span>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
       
        <script>
            $('#exampleModal').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Use above variables to manipulate the DOM
                
            });

           

        </script>
        
    
    </body>
</html>