<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>لوحة التحكم | تسجيل الدخول</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ url('admin_ar') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('admin_ar') }}/bootstrap/css/bootstrap-rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('admin_ar') }}/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('admin_ar') }}/dist/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin_ar') }}/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{ url('admin_ar') }}/dist/css/AdminLTE-rtl.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('admin_ar') }}/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo" style="font-family: 'Cairo', sans-serif;">
        <b style="font-family: 'Cairo', sans-serif;"> ETBA3LY </b>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg" style="font-family: 'Cairo', sans-serif;">تسجيل الدخول</p>
        @include('common::partials._errors')
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <form action="{{ route('post_login') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="كلمة المرور">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input name="remember" type="checkbox"> تذكرني
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">الدخول</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{ url('admin_ar') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ url('admin_ar') }}/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ url('admin_ar') }}/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
