@extends('layout.main')
@section('content')
<section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">                   
                    <form action="{{ route('media.store') }}" id="product-form" class="product-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="video" />
                            <div class="card mt-2 rest-part">
                            <div class="card-body">
                                <div class="row">
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
                                            <label>Video</strong> </label> <i class="dripicons-question" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                                            <input type="file" name="data" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                        <div class="card card-footer">
                            <div class="row">
                                <div class="col-md-12" style="padding-top: 20px">
                                    <input type="submit" value="{{trans('file.submit')}}" id="submit-btn" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        $("ul#media").siblings('a').attr('aria-expanded','true');
        $("ul#media").addClass("show");
        $("ul#media #media-video-menu").addClass("active");

        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection

