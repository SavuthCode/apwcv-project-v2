<?php $general_setting = DB::table('general_settings')->find(1); ?>
    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="{{url('manifest.json')}}">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-datepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/jquery-timepicker/jquery.timepicker.min.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/awesome-bootstrap-checkbox.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('vendor/bootstrap/css/bootstrap-select.min.css') ?>" type="text/css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo asset('vendor/font-awesome/css/font-awesome.min.css') ?>" type="text/css">
    <!-- Drip icon font-->
    <link rel="stylesheet" href="<?php echo asset('vendor/dripicons/webfont.css') ?>" type="text/css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="<?php echo asset('css/grasp_mobile_progress_circle-1.0.0.min.css') ?>" type="text/css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') ?>" type="text/css">
    <!-- virtual keybord stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('vendor/keyboard/css/keyboard.css') ?>" type="text/css">
    <!-- date range stylesheet-->
    <link rel="stylesheet" href="<?php echo asset('vendor/daterange/css/daterangepicker.min.css') ?>" type="text/css">
    <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/style.default.css') ?>" id="theme-stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/dropzone.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/style.css') ?>">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery/jquery.timepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/popper.js/umd/popper.min.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/bootstrap/js/bootstrap-select.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/keyboard/js/jquery.keyboard.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/keyboard/js/jquery.keyboard.extension-autocomplete.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/grasp_mobile_progress_circle-1.0.0.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery.cookie/jquery.cookie.js') ?>">
    </script>
    <script type="text/javascript" src="<?php echo asset('vendor/chart.js/Chart.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/charts-custom.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/front.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/moment.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/knockout-3.4.2.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/daterange/js/daterangepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/dropzone.js') ?>"></script>

    <!-- table sorter js-->
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/pdfmake.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/vfs_fonts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.buttons.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.bootstrap4.min.js') ?>">"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.colVis.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.html5.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/buttons.print.min.js') ?>"></script>

    <script type="text/javascript" src="<?php echo asset('vendor/datatable/sum().js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('vendor/datatable/dataTables.checkboxes.min.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo asset('css/custom-'.$general_setting->theme) ?>" type="text/css" id="custom-style">
</head>

{{--<style>--}}
{{--    .switch {--}}
{{--        position: relative;--}}
{{--        display: inline-block;--}}
{{--        width: 48px;--}}
{{--        height: 23px;--}}
{{--    }--}}

{{--    .switch input {--}}
{{--        opacity: 0;--}}
{{--        width: 0;--}}
{{--        height: 0;--}}
{{--    }--}}

{{--    .slider {--}}
{{--        position: absolute;--}}
{{--        cursor: pointer;--}}
{{--        top: 0;--}}
{{--        left: 0;--}}
{{--        right: 0;--}}
{{--        bottom: 0;--}}
{{--        /*background-color: #ccc;*/--}}
{{--        -webkit-transition: .4s;--}}
{{--        transition: .4s;--}}
{{--    }--}}

{{--    .slider:before {--}}
{{--        position: absolute;--}}
{{--        content: "";--}}
{{--        height: 15px;--}}
{{--        width: 15px;--}}
{{--        left: 4px;--}}
{{--        bottom: 4px;--}}
{{--        background-color: white;--}}
{{--        -webkit-transition: .4s;--}}
{{--        transition: .4s;--}}
{{--    }--}}

{{--    input:checked + .slider {--}}
{{--        background-color: #377dff;--}}
{{--    }--}}

{{--    input:focus + .slider {--}}
{{--        box-shadow: 0 0 1px #377dff;--}}
{{--    }--}}

{{--    input:checked + .slider:before {--}}
{{--        -webkit-transform: translateX(26px);--}}
{{--        -ms-transform: translateX(26px);--}}
{{--        transform: translateX(26px);--}}
{{--    }--}}

{{--    /* Rounded sliders */--}}
{{--    .slider.round {--}}
{{--        border-radius: 34px;--}}
{{--    }--}}

{{--    .slider.round:before {--}}
{{--        border-radius: 50%;--}}
{{--    }--}}

{{--</style>--}}
@yield("css")
<body onload="myFunction()">
<div id="loader"></div>
<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li><a href="{{url('/admin')}}"> <i class="dripicons-meter"></i><span>{{ __('file.dashboard') }}</span></a></li>
                <?php
                $role = DB::table('roles')->find(Auth::user()->role_id);

                $category_permission_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                        ['permissions.name', 'category'],
                        ['role_id', $role->id] ])->first();

                $index_permission = DB::table('permissions')->where('name', 'image-index')->first();
                $image_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();

                $index_permission = DB::table('permissions')->where('name', 'video-index')->first();
                $video_permission_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_permission->id],
                    ['role_id', $role->id]
                ])->first();

                $book_barcode = DB::table('permissions')->where('name', 'book-index')->first();
                $book_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $book_barcode->id],
                    ['role_id', $role->id]
                ])->first();
                ?>
                @if($category_permission_active || $image_permission_active || $video_permission_active || $book_active)
                    <li><a href="#product" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-list"></i><span>{{__('file.Media')}}</span><span></a>
                        <ul id="product" class="collapse list-unstyled ">
                            @if($category_permission_active)
                                <li id="category-menu"><a href="{{route('category.index')}}">{{__('file.category')}}</a></li>
                            @endif
                                @if($image_permission_active)
                                    <li id="image-menu"><a href="{{route('image.index')}}">{{__('file.Image')}}</a></li>--}}
{{--                                        <?php--}}
{{--                                        $add_permission = DB::table('permissions')->where('name', 'image-create')->first();--}}
{{--                                        $add_permission_active = DB::table('role_has_permissions')->where([--}}
{{--                                            ['permission_id', $add_permission->id],--}}
{{--                                            ['role_id', $role->id]--}}
{{--                                        ])->first();--}}
{{--                                        ?>--}}
{{--                                        @if($add_permission_active)--}}
{{--                                            <li id="product-create-menu"><a href="{{route('image.create')}}">{{__('file.add_image')}}</a></li>--}}
{{--                                        @endif--}}
                                @endif
                                @if($video_permission_active)
                                    <li id="video-menu"><a href="{{route('video.index')}}">{{__('file.Video')}}</a></li>
                                @endif
                            @if($book_active)
                                <li id="printBarcode-menu"><a href="">{{__('file.Book')}}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                <?php
                $user_index_permission_active = DB::table('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->where([
                        ['permissions.name', 'users-index'],
                        ['role_id', $role->id] ])->first();

                $index_employee = DB::table('permissions')->where('name', 'employees-index')->first();
                $index_employee_active = DB::table('role_has_permissions')->where([
                    ['permission_id', $index_employee->id],
                    ['role_id', $role->id]
                ])->first();
                ?>
                @if($user_index_permission_active || $index_employee_active)
                    <li><a href="#people" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user"></i><span>{{trans('file.People')}}</span></a>
                        <ul id="people" class="collapse list-unstyled ">

                            @if($user_index_permission_active)
                                <li id="user-list-menu"><a href="{{route('user.index')}}">{{trans('file.User List')}}</a></li>
                                    <?php $user_add_permission_active = DB::table('permissions')
                                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                                    ->where([
                                        ['permissions.name', 'users-add'],
                                        ['role_id', $role->id] ])->first();
                                    ?>
                                @if($user_add_permission_active)
                                    <li id="user-create-menu"><a href="{{route('user.create')}}">{{trans('file.Add User')}}</a></li>
                                @endif
                            @endif

                            @if($index_employee_active)
                                    <li id="employee-menu"><a href="{{route('employees.index')}}">{{trans('file.Employee')}}</a></li>
                                    <?php
                                    $employee_add_permission = DB::table('permissions')->where('name', 'employees-add')->first();
                                    $employee_add_permission_active = DB::table('role_has_permissions')->where([
                                        ['permission_id', $employee_add_permission->id],
                                        ['role_id', $role->id]
                                    ])->first();
                                    ?>
                                @if($employee_add_permission_active)
{{--                                    <li id="customer-create-menu"><a href="">{{trans('file.Add Employee')}}</a></li>--}}
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif



{{--                <?php--}}
{{--                $profit_loss_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'profit-loss'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $best_seller_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'best-seller'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $warehouse_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'warehouse-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $warehouse_stock_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'warehouse-stock-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $product_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'product-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $daily_sale_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'daily-sale'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $monthly_sale_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'monthly-sale'],--}}
{{--                        ['role_id', $role->id]])->first();--}}
{{--                $daily_purchase_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'daily-purchase'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $monthly_purchase_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'monthly-purchase'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $purchase_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'purchase-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $sale_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'sale-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $payment_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'payment-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $product_qty_alert_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'product-qty-alert'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $user_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'user-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}

{{--                $customer_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'customer-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $supplier_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'supplier-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                $due_report_active = DB::table('permissions')--}}
{{--                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')--}}
{{--                    ->where([--}}
{{--                        ['permissions.name', 'due-report'],--}}
{{--                        ['role_id', $role->id] ])->first();--}}
{{--                ?>--}}
{{--                @if($profit_loss_active || $best_seller_active || $warehouse_report_active || $warehouse_stock_report_active || $product_report_active || $daily_sale_active || $monthly_sale_active || $daily_purchase_active || $monthly_purchase_active || $purchase_report_active || $sale_report_active || $payment_report_active || $product_qty_alert_active || $user_report_active || $customer_report_active || $supplier_report_active || $due_report_active)--}}
{{--                    <li><a href="#report" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-document-remove"></i><span>{{trans('file.Reports')}}</span></a>--}}
{{--                        <ul id="report" class="collapse list-unstyled ">--}}
{{--                            @if($profit_loss_active)--}}
{{--                                <li id="profit-loss-report-menu">--}}
{{--                                    {!! Form::open(['route' => 'report.profitLoss', 'method' => 'post', 'id' => 'profitLoss-report-form']) !!}--}}
{{--                                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />--}}
{{--                                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />--}}
{{--                                    <a id="profitLoss-link" href="">{{trans('file.Summary Report')}}</a>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($best_seller_active)--}}
{{--                                <li id="best-seller-report-menu">--}}
{{--                                    <a href="{{url('report/best_seller')}}">{{trans('file.Best Seller')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($product_report_active)--}}
{{--                                <li id="product-report-menu">--}}
{{--                                    {!! Form::open(['route' => 'report.product', 'method' => 'get', 'id' => 'product-report-form']) !!}--}}
{{--                                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />--}}
{{--                                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />--}}
{{--                                    <input type="hidden" name="warehouse_id" value="0" />--}}
{{--                                    <a id="report-link" href="">{{trans('file.Product Report')}}</a>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($daily_sale_active)--}}
{{--                                <li id="daily-sale-report-menu">--}}
{{--                                    <a href="{{url('report/daily_sale/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Sale')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($monthly_sale_active)--}}
{{--                                <li id="monthly-sale-report-menu">--}}
{{--                                    <a href="{{url('report/monthly_sale/'.date('Y'))}}">{{trans('file.Monthly Sale')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($daily_purchase_active)--}}
{{--                                <li id="daily-purchase-report-menu">--}}
{{--                                    <a href="{{url('report/daily_purchase/'.date('Y').'/'.date('m'))}}">{{trans('file.Daily Purchase')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($monthly_purchase_active)--}}
{{--                                <li id="monthly-purchase-report-menu">--}}
{{--                                    <a href="{{url('report/monthly_purchase/'.date('Y'))}}">{{trans('file.Monthly Purchase')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($sale_report_active)--}}
{{--                                <li id="sale-report-menu">--}}
{{--                                    {!! Form::open(['route' => 'report.sale', 'method' => 'post', 'id' => 'sale-report-form']) !!}--}}
{{--                                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />--}}
{{--                                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />--}}
{{--                                    <input type="hidden" name="warehouse_id" value="0" />--}}
{{--                                    <a id="sale-report-link" href="">{{trans('file.Sale Report')}}</a>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($payment_report_active)--}}
{{--                                <li id="payment-report-menu">--}}
{{--                                    {!! Form::open(['route' => 'report.paymentByDate', 'method' => 'post', 'id' => 'payment-report-form']) !!}--}}
{{--                                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />--}}
{{--                                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />--}}
{{--                                    <a id="payment-report-link" href="">{{trans('file.Payment Report')}}</a>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($purchase_report_active)--}}
{{--                                <li id="purchase-report-menu">--}}
{{--                                    {!! Form::open(['route' => 'report.purchase', 'method' => 'post', 'id' => 'purchase-report-form']) !!}--}}
{{--                                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />--}}
{{--                                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />--}}
{{--                                    <input type="hidden" name="warehouse_id" value="0" />--}}
{{--                                    <a id="purchase-report-link" href="">{{trans('file.Purchase Report')}}</a>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($warehouse_report_active)--}}
{{--                                <li id="warehouse-report-menu">--}}
{{--                                    <a id="warehouse-report-link" href="">{{trans('file.Warehouse Report')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($warehouse_stock_report_active)--}}
{{--                                <li id="warehouse-stock-report-menu">--}}
{{--                                    <a href="{{route('report.warehouseStock')}}">{{trans('file.Warehouse Stock Chart')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($product_qty_alert_active)--}}
{{--                                <li id="qtyAlert-report-menu">--}}
{{--                                    <a href="{{route('report.qtyAlert')}}">{{trans('file.Product Quantity Alert')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($user_report_active)--}}
{{--                                <li id="user-report-menu">--}}
{{--                                    <a id="user-report-link" href="">{{trans('file.User Report')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($customer_report_active)--}}
{{--                                <li id="customer-report-menu">--}}
{{--                                    <a id="customer-report-link" href="">{{trans('file.Customer Report')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($supplier_report_active)--}}
{{--                                <li id="supplier-report-menu">--}}
{{--                                    <a id="supplier-report-link" href="">{{trans('file.Supplier Report')}}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if($due_report_active)--}}
{{--                                <li id="due-report-menu">--}}
{{--                                    {!! Form::open(['route' => 'report.dueByDate', 'method' => 'post', 'id' => 'due-report-form']) !!}--}}
{{--                                    <input type="hidden" name="start_date" value="{{date('Y-m').'-'.'01'}}" />--}}
{{--                                    <input type="hidden" name="end_date" value="{{date('Y-m-d')}}" />--}}
{{--                                    <a id="due-report-link" href="">{{trans('file.Due Report')}}</a>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}

                <li><a href="#setting" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-gear"></i><span>{{trans('file.settings')}}</span></a>
                    <ul id="setting" class="collapse list-unstyled ">
                        <?php
                        $send_notification_permission = DB::table('permissions')->where('name', 'send-notification')->first();
                        $send_notification_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $send_notification_permission->id],
                            ['role_id', $role->id]
                        ])->first();

                        $general_setting_permission = DB::table('permissions')->where('name', 'general-setting')->first();
                        $general_setting_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $general_setting_permission->id],
                            ['role_id', $role->id]
                        ])->first();

                        $backup_database_permission = DB::table('permissions')->where('name', 'backup-database')->first();
                        $backup_database_permission_active = DB::table('role_has_permissions')->where([
                            ['permission_id', $backup_database_permission->id],
                            ['role_id', $role->id]
                        ])->first();
                        ?>


                        @if($role->id <= 1)
                            <li id="role-menu"><a href="{{route('role.index')}}">{{trans('file.Role Permission')}}</a></li>
                            <li id="permission-menu"><a href="{{route('permission.index')}}">{{trans('file.Permission')}}</a></li>
                            <li id="banner-menu"><a href="{{route('banners.index')}}">{{trans('file.Banner')}}</a></li>
                            <li id="contact-menu"><a href="{{route('contacts.index')}}">{{trans('file.Contact')}}</a></li>
                        @endif

                        @if($send_notification_permission_active)
                            <li id="notification-menu">
                                <a href="" id="send-notification">{{trans('file.Send Notification')}}</a>
                            </li>
                        @endif
                        <li id="user-menu"><a href="{{route('user.profile', ['id' => Auth::id()])}}">{{trans('file.User Profile')}}</a></li>
                        @if($backup_database_permission_active)
                            <li><a href="{{route('setting.backup')}}">{{trans('file.Backup Database')}}</a></li>
                        @endif
                        @if($general_setting_permission_active)
                            <li id="general-setting-menu"><a href="{{route('setting.general')}}">{{trans('file.General Setting')}}</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- navbar-->
<header class="header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
                <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                <span class="brand-big">
                @if($general_setting->site_logo)
                                    <a href="{{url('/admin')}}"><img src="{{url('logo', $general_setting->site_logo)}}" width="50"></a>
                                    @else
                                      <a href="{{url('/admin')}}"><h1 class="d-inline">{{$general_setting->site_title}}</h1></a>
                                    @endif
              </span>

                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <li class="nav-item">
                        <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-web"></i> <span>{{__('file.language')}}</span> <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                            <li>
                                <a href="{{ url('language_switch/kh') }}" class="btn btn-link"> ខ្មែរ</a>
                            </li>
                            <li>
                                <a href="{{ url('language_switch/en') }}" class="btn btn-link"> English</a>
                            </li>
                        </ul>
                    </li>
                    {{--                @if(Auth::user()->role_id != 5)--}}
                    {{--                <li class="nav-item">--}}
                    {{--                    <a class="dropdown-item" href="{{ url('read_me') }}" target="_blank"><i class="dripicons-information"></i> {{trans('file.Help')}}</a>--}}
                    {{--                </li>--}}
                    {{--                @endif--}}
                    <li class="nav-item">
                        <a rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-item"><i class="dripicons-user"></i> <span>{{ucfirst(Auth::user()->first_name)}}-{{ucfirst(Auth::user()->last_name)}}</span> <i class="fa fa-angle-down"></i>
                        </a>
                                          <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                              <li>
                                                <a href="{{route('user.profile', ['id' => Auth::id()])}}"><i class="dripicons-user"></i> {{trans('file.profile')}}</a>
                                              </li>
                                              @if($general_setting_permission_active)
                                              <li>
                                                <a href=""><i class="dripicons-gear"></i> {{trans('file.settings')}}</a>
                                              </li>
                                              @endif
{{--                                              <li>--}}
{{--                                                <a href="{{url('my-transactions/'.date('Y').'/'.date('m'))}}"><i class="dripicons-swap"></i> {{trans('file.My Transaction')}}</a>--}}
{{--                                              </li>--}}
{{--                                              @if(Auth::user()->role_id != 5)--}}
{{--                                              <li>--}}
{{--                                                <a href="{{url('holidays/my-holiday/'.date('Y').'/'.date('m'))}}"><i class="dripicons-vibrate"></i> {{trans('file.My Holiday')}}</a>--}}
{{--                                              </li>--}}
{{--                                              @endif--}}
{{--                                              @if($empty_database_permission_active)--}}
{{--                                              <li>--}}
{{--                                                <a onclick="return confirm('Are you sure want to delete? If you do this all of your data will be lost.')" href="{{route('setting.emptyDatabase')}}"><i class="dripicons-stack"></i> {{trans('file.Empty Database')}}</a>--}}
{{--                                              </li>--}}
{{--                                              @endif--}}
                                              <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();"><i class="dripicons-power"></i>
                                                    {{trans('file.logout')}}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                              </li>
                                          </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="page">

    <div style="display:none" id="content" class="animate-bottom">
        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                                  <p>&copy; {{$general_setting->site_title}} | {{trans('file.Developed')}} {{trans('file.By')}} <span class="external">{{$general_setting->developed_by}}</span></p>
                </div>
            </div>
        </div>
    </footer>
</div>
@yield('scripts')

<script>
    $(document).on('change', '.status', function () {
        var id = $(this).attr("id");
        var route = $(this).attr("data-href");
        if ($(this).prop("checked") == true) {
            var status = 1;
        } else if ($(this).prop("checked") == false) {
            var status = 0;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: route,
            method: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function () {
                toastr.success('Status updated successfully');
                location.reload();
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.openPopup').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.modal-body').load(dataURL,function(){
                $('#myModal').modal({show:true});
            });
        });

        $('.btnModal').on('click',function(){
            var dataURL = $(this).attr('data-href');
            $('.myCustomizeModal').load(dataURL,function(){
                $('.myCustomizeModal').modal({show:true});
            });

        });


        $('.btnModalConfirm').on('click',function(){

            var msg = $(this).attr("message");
            var url = $(this).attr("data-href");
            $("#btn_confirm_modal").attr("data-url",url);
            $('#confirm_modal_msg').html(msg);
            $('#confirm_modal').modal({show:true});

        });


        $("#btn_confirm_modal").click(function(){
            var url = $(this).attr("data-url");
            window.location.href = url;
        })
    });
</script>



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


    if ($(window).outerWidth() > 1199) {
        $('nav.side-navbar').removeClass('shrink');
    }
    function myFunction() {
        setTimeout(showPage, 150);
    }
    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    $("div.alert").delay(3000).slideUp(750);

    function confirmDelete() {
        if (confirm("Are you sure want to delete?")) {
            return true;
        }
        return false;
    }



    $("a#add-expense").click(function(e){
        e.preventDefault();
        $('#expense-modal').modal();
    });

    $("a#send-notification").click(function(e){
        e.preventDefault();
        $('#notification-modal').modal();
    });

    $("a#add-account").click(function(e){
        e.preventDefault();
        $('#account-modal').modal();
    });

    $("a#account-statement").click(function(e){
        e.preventDefault();
        $('#account-statement-modal').modal();
    });

    $("a#profitLoss-link").click(function(e){
        e.preventDefault();
        $("#profitLoss-report-form").submit();
    });

    $("a#report-link").click(function(e){
        e.preventDefault();
        $("#product-report-form").submit();
    });

    $("a#purchase-report-link").click(function(e){
        e.preventDefault();
        $("#purchase-report-form").submit();
    });

    $("a#sale-report-link").click(function(e){
        e.preventDefault();
        $("#sale-report-form").submit();
    });

    $("a#payment-report-link").click(function(e){
        e.preventDefault();
        $("#payment-report-form").submit();
    });

    $("a#warehouse-report-link").click(function(e){
        e.preventDefault();
        $('#warehouse-modal').modal();
    });

    $("a#user-report-link").click(function(e){
        e.preventDefault();
        $('#user-modal').modal();
    });

    $("a#customer-report-link").click(function(e){
        e.preventDefault();
        $('#customer-modal').modal();
    });

    $("a#supplier-report-link").click(function(e){
        e.preventDefault();
        $('#supplier-modal').modal();
    });

    $("a#due-report-link").click(function(e){
        e.preventDefault();
        $("#due-report-form").submit();
    });

    $(".daterangepicker-field").daterangepicker({
        callback: function(startDate, endDate, period){
            var start_date = startDate.format('YYYY-MM-DD');
            var end_date = endDate.format('YYYY-MM-DD');
            var title = start_date + ' To ' + end_date;
            $(this).val(title);
            $('#account-statement-modal input[name="start_date"]').val(start_date);
            $('#account-statement-modal input[name="end_date"]').val(end_date);
        }
    });

    $('.selectpicker').selectpicker({
        style: 'btn-link',
    });
</script>
</body>
</html>
