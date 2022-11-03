@extends('layout.main') @section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h4>{{trans('file.Add Contact')}}</h4>
                        </div>
                        <div class="card-body">
                            <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                            {!! Form::open(['route' => 'contacts.store', 'method' => 'post', 'files' => true]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans('file.name')}} *</strong> </label>
                                        <input type="text" name="name" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('file.Email')}} *</label>
                                        <input type="email" name="email" placeholder="example@example.com" required class="form-control">
                                        @if($errors->has('email'))
                                            <span>
                                       <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('file.mobile_number')}} *</label>
                                        <input type="text" name="mobile_number" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('file.subject')}}</label>
                                        <input type="text" name="subject" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-4">
                                        <input type="submit" value="{{trans('file.submit')}}" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#setting").siblings('a').attr('aria-expanded','true');
        $("ul#setting").addClass("show");
        $("ul#setting #contact-menu").addClass("active");
    </script>
@endsection
