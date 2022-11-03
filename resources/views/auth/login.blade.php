<?php $general_setting = DB::table('general_settings')->find(1); ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="manifest" href="{{url('manifest.json')}}">
    <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('public/vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" type="text/css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
</head>
<body>
<!-- <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Please close the envato preview window from the top-right corner before accessing the demo. Thank you.</div> -->
<div class="page login-page">
    <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
            <div class="form-inner">
                <div class="logo">
                    @if($general_setting->site_logo)
                        <img src="{{url('logo', $general_setting->site_logo)}}" width="110">
                    @else
                        <span>{{$general_setting->site_title}}</span>
                    @endif
                </div>
                @if(session()->has('delete_message'))
                    <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('delete_message') }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="form-group-material">
                        <input id="login-email" type="text" name="email" required class="input-material" autocomplete="off" value="">
                        <label for="login-email" class="label-material">{{trans('file.Email')}} / {{trans('file.Phone')}}</label>
                        @if ($errors->has('email'))
                            <p>
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                        @endif
                    </div>

                    <div class="form-group-material">
                        <input id="login-password" type="password" name="password" required class="input-material" value="">
                        <label for="login-password" class="label-material">{{trans('file.Password')}}</label>
                        @if ($errors->has('password'))
                            <p>
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{trans('file.LogIn')}}</button>
                </form>
                <br><br>
                <a href="{{ route('password.request') }}" class="forgot-pass">{{trans('file.Forgot Password?')}}</a>
{{--                <p>{{trans('file.Do not have an account?')}}</p><a href="{{url('register')}}" class="signup">{{trans('file.Register')}}</a>--}}
            </div>
            <div class="copyrights text-center">
                <p>{{trans('file.Developed By')}} <span class="external">{{$general_setting->developed_by}}</span></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>




{{--<div class="container mt-5" style="max-width: 550px">--}}

{{--    <div class="alert alert-danger" id="error" style="display: none;"></div>--}}

{{--    <h3>Add Phone Number</h3>--}}

{{--    <div class="alert alert-success" id="successAuth" style="display: none;"></div>--}}

{{--    <form>--}}
{{--        <label>Phone Number:</label>--}}

{{--        <input type="text" id="number" class="form-control" placeholder="+91 ********">--}}

{{--        <div id="recaptcha-container"></div>--}}

{{--        <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>--}}
{{--    </form>--}}


{{--    <div class="mb-5 mt-5">--}}
{{--        <h3>Add verification code</h3>--}}

{{--        <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>--}}

{{--        <form>--}}
{{--            <input type="text" id="verification" class="form-control" placeholder="Verification code">--}}
{{--            <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}




{{--<script>--}}
{{--    var firebaseConfig = {--}}
{{--        apiKey: "AIzaSyCYhjlg_RW8pft7rxZkszyG5PmDY3xL0UQ",--}}
{{--        authDomain: "sruol-louk-6643a.firebaseapp.com",--}}
{{--        projectId: "sruol-louk-6643a",--}}
{{--        storageBucket: "sruol-louk-6643a.appspot.com",--}}
{{--        messagingSenderId: "147246257083",--}}
{{--        appId: "1:147246257083:web:41b8e1b46bfdc8bddaea9e",--}}
{{--        measurementId: "G-KVEJX0SFG3",--}}
{{--        databaseURL: "https://PROJECT_ID.firebaseio.com",--}}

{{--    };--}}
{{--    firebase.initializeApp(firebaseConfig);--}}
{{--</script>--}}
{{--<script type="text/javascript">--}}
{{--    window.onload = function () {--}}
{{--        render();--}}
{{--    };--}}

{{--    function render() {--}}
{{--        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');--}}
{{--        recaptchaVerifier.render();--}}
{{--    }--}}

{{--    function sendOTP() {--}}
{{--        var number = $("#number").val();--}}
{{--        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {--}}
{{--            window.confirmationResult = confirmationResult;--}}
{{--            coderesult = confirmationResult;--}}
{{--            console.log(coderesult);--}}
{{--            $("#successAuth").text("Message sent");--}}
{{--            $("#successAuth").show();--}}
{{--        }).catch(function (error) {--}}
{{--            $("#error").text(error.message);--}}
{{--            $("#error").show();--}}
{{--        });--}}
{{--    }--}}

{{--    function verify() {--}}
{{--        var code = $("#verification").val();--}}
{{--        coderesult.confirm(code).then(function (result) {--}}
{{--            var user = result.user;--}}
{{--            console.log(user);--}}
{{--            $("#successOtpAuth").text("Auth is successful");--}}
{{--            $("#successOtpAuth").show();--}}
{{--        }).catch(function (error) {--}}
{{--            $("#error").text(error.message);--}}
{{--            $("#error").show();--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}




<script>
    if ('serviceWorker' in navigator ) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/saleproposmajed/service-worker.js').then(function(registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                // registration failed :(
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
</script>

<script type="text/javascript">
    $('.admin-btn').on('click', function(){
        $("input[name='name']").focus().val('admin');
        $("input[name='password']").focus().val('admin');
    });

    $('.staff-btn').on('click', function(){
        $("input[name='name']").focus().val('staff');
        $("input[name='password']").focus().val('staff');
    });

    $('.customer-btn').on('click', function(){
        $("input[name='name']").focus().val('shakalaka');
        $("input[name='password']").focus().val('shakalaka');
    });
    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });
</script>
