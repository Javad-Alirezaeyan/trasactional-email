<?php
$pluginPath = "theme/assets/plugins/";
$themePath = "theme/";
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script >
    window.Laravel =
    <?php echo json_encode([
        'csrfToken' => csrf_token(),
        'baseUrl' => URL::to('/')
    ]); ?>
</script>
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset("theme/assets/images/favicon.png") }}">

<title>@yield('title')</title>

<link href="{{asset("theme/assets/plugins/bootstrap/css/bootstrap.min.css")}} " rel="stylesheet"/>
<link href="{{asset("theme/assets/plugins/chartist-js/dist/chartist.min.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/chartist-js/dist/chartist-init.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/css-chart/css-chart.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/morrisjs/morris.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/c3-master/c3.min.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/footable/css/footable.core.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/switchery/dist/switchery.min.css")}}" rel="stylesheet">
<link href="{{asset("theme/horizontal/css/style.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/toast-master/css/jquery.toast.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/sweetalert/sweetalert.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css")}}" rel="stylesheet">
<link href="{{asset("theme/assets/plugins/multiselect/css/multi-select.css")}}" rel="stylesheet">
<link href="{{asset("theme/horizontal/css/colors/blue.css")}}" rel="stylesheet">




