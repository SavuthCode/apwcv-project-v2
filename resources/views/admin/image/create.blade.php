@extends('layout.main')
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="media-form" class="media-form">
                        <input type="hidden" name="type" value="image" />
                        <div class="card mt-2 rest-part">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>{{trans('file.category')}} *</strong> </label>
                                        <div class="input-group">
                                            <select
                                                class="form-control selectpicker"
                                                name="category_id"
                                                required>
                                                <option value="{{old('category_id')}}" selected disabled>---Select---</option>
                                                @foreach($lims_category_list as $category)
                                                    <option value="{{$category->id}}">{{$category->title_kh}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label class="control-label">Title</label>
                                        <input type="text" name="title" placeholder="title" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                                            <div id="imageUpload" class="dropzone"></div>
                                            <span class="validation-msg" id="image-error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-footer">
                            <div class="row">
                                <div class="col-md-12" style="padding-top: 20px">
                                    <input type="button" value="{{trans('file.submit')}}" id="submit-btn" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        $("ul#product").siblings('a').attr('aria-expanded','true');
        $("ul#product").addClass("show");
        $("ul#product #product-image-menu").addClass("active");

        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".dropzone").sortable({
            items:'.dz-preview',
            cursor: 'grab',
            opacity: 0.5,
            containment: '.dropzone',
            distance: 20,
            tolerance: 'pointer',
            stop: function () {
                var queue = myDropzone.getAcceptedFiles();
                newQueue = [];
                $('#imageUpload .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {
                    var name = el.innerHTML;
                    queue.forEach(function(file) {
                        if (file.name === name) {
                            newQueue.push(file);
                        }
                    });
                });
                myDropzone.files = newQueue;
            }
        });

        myDropzone = new Dropzone('div#imageUpload', {
            addRemoveLinks: true,
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFilesize: 12,
            paramName: 'data',
            clickable: true,
            method: 'POST',
            url: '{{route('image.store')}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function () {
                var myDropzone = this;
                $('#submit-btn').on("click", function (e) {
                    e.preventDefault();
                    if ( $("#media-form").valid() ) {
                        tinyMCE.triggerSave();
                        if(myDropzone.getAcceptedFiles().length) {
                            myDropzone.processQueue();
                        }
                        else {
                            $.ajax({
                                type:'POST',
                                url:'{{route('image.store')}}',
                                data: $("#media-form").serialize(),
                                success:function(response){
                                    //console.log(response);
                                    location.href = '../image';
                                },
                                error:function(response) {
                                    if(response.responseJSON.errors.name) {
                                        $("#name-error").text(response.responseJSON.errors.name);
                                    }
                                    else if(response.responseJSON.errors.code) {
                                        $("#code-error").text(response.responseJSON.errors.code);
                                    }
                                },
                            });
                        }
                    }
                });

                this.on('sending', function (file, xhr, formData) {
                    // Append all form inputs to the formData Dropzone will POST
                    var data = $("#media-form").serializeArray();
                    $.each(data, function (key, el) {
                        formData.append(el.name, el.value);
                    });
                });
            },
            error: function (file, response) {
                console.log(response);
                if(response.errors.name) {
                    $("#name-error").text(response.errors.name);
                    this.removeAllFiles(true);
                }
                else if(response.errors.code) {
                    $("#code-error").text(response.errors.code);
                    this.removeAllFiles(true);
                }
                else {
                    try {
                        var res = JSON.parse(response);
                        if (typeof res.message !== 'undefined' && !$modal.hasClass('in')) {
                            $("#success-icon").attr("class", "fas fa-thumbs-down");
                            $("#success-text").html(res.message);
                            $modal.modal("show");
                        } else {
                            if ($.type(response) === "string")
                                var message = response; //dropzone sends it's own error messages in string
                            else
                                var message = response.message;
                            file.previewElement.classList.add("dz-error");
                            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                            _results = [];
                            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                                node = _ref[_i];
                                _results.push(node.textContent = message);
                            }
                            return _results;
                        }
                    } catch (error) {
                        console.log(error);
                    }
                }
            },
            successmultiple: function (file, response) {
                location.href = '../image';
                //console.log(file, response);
            },
            completemultiple: function (file, response) {
                console.log(file, response, "completemultiple");
            },
            reset: function () {
                console.log("resetFiles");
                this.removeAllFiles(true);
            }
        });
    </script>
@endsection

