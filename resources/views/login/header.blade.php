<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>اطبع لي</title>
        <link rel="stylesheet" href="{{url('/front/css/bootstrap.minRTL.css')}}">
        <link rel="stylesheet" href="{{url('/front/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{url('/front/css/fontawesome.min.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('/front/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{url('/front/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{url('/front/css/animate.css')}}">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="{{url('/front/css/jquery.rateyo.css')}}" rel="stylesheet">
        @if(App()->getLocale() == 'en')
            <link rel="stylesheet" href="{{url('/front/css/style.css')}}">
        @else
            <link rel="stylesheet" href="{{url('/front/css/styleRTL.css')}}">
        @endif
        <link rel="stylesheet" href="{{url('/front/css/hover-min.css')}}">
        <link rel="shortcut icon" href="{{url('/front/imgs/Logo.png')}}" type="image/ico" />
        <link rel="stylesheet" href="{{url('/front/css/uploadfile.css')}}" />
        @stack('css')
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></sc  ript>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        