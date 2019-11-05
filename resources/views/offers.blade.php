@include('login.header')
@include('login.neworder')
<nav class="navbar navbar-expand-lg navbar-light nav-order">
    <div class="container">
        @if(auth()->user()->avatar)
            <a class="navbar-brand" href="{{ url('/index') }}"><img src="{{url('/front/imgs/logo2.png')}}" alt="logo"></a>
        @endif
        <div class="" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="dropdown-menu">
                            <h6 class="mb-15 text-center">الاشعارات</h6>
                            <div class="mr-10px">
                                @php
                                    $notifications = \App\Notifications::query()->where('user_id',auth()->user()->id)->get();
                                    $orders = \App\MyOrders::query()->where('user_id',auth()->user()->id)->orderBy('id','desc')->get();

                                @endphp

                                @foreach ($orders as $ord)
                                    @foreach ($notifications as $not)
                                        @if ($ord->id == $not->order_id)
                                            <a class="dropdown-item" href="#">
                                                <div class="media">
                                                    <img src="{{ url('front/') }}/imgs/writting_icon.png" class="mr-3 bg-image" alt="...">
                                                    <div class="media-body">
                                                        <p class="mt-0">رقم الطلب : {{ $ord->id }} - {{ $ord->order_type->type }}</p>
                                                        <p>حالة الطلب :  {{ $ord->order_status->status }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item active">
                    <a href="#" class="nav-link btn btn-primary chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#newPrint">
                        انشاء طلب<i class="fas fa-print hvr-icon"></i>
                    </a>

                </li>
                <li class="nav-item active">
                    <a href="{{ url('/logout') }}" class="nav-link btn btn-primary hvr-shutter-out-horizontal hvr-icon-pulse-grow">
                        تسجيل الخروج<i class="fas fa-sign-in-alt hvr-icon"></i>
                    </a>
                </li>

                <li class="nav-item active">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="text-center profile">
                            @if(auth()->user()->avatar !== 'users/default.png')
                                <img src="{{ auth()->user()->avatar }}" class="" alt="">
                            @else
                                <img src="{{ url('/storage/'.auth()->user()->avatar) }}" class="" alt="">
                            @endif
                            <h6>{{ auth()->user()->name }}</h6>
                            <a href="{{ url('/editProfile#goodProfile') }}" class="edit-profile"><i class="far fa-edit"></i> تعديل الملف الشخصي</a>
                        </div>
                        <a href="{{ url('/index#home') }}">الرئيسية</a>
                        {{--<a href="{{ url('/index#about') }}">من نحن</a>--}}
                        <a href="{{ url('/index#services') }}">خدماتنا</a>
                        <a href="{{ url('/index#how_print') }}">كيفية الطباعة</a>
                        <a href="{{ url('/index#testmonials') }}">أراء العملاء</a>
                        <a href="{{ url('/myOrders#sec_1') }}">طلباتي</a>
                        <a href="{{ url('/get/offers#off_1') }}">العروض</a>
                        <a href="{{ url('/index#contact') }}">تواصل معنا</a>
                        <a href="#" class="nav-link btn btn-primary chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#newPrint">
                            انشاء طلب<i class="fas fa-print hvr-icon"></i>
                        </a>
                        <!--
                                                   <a href="#" class="nav-link btn chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-container="body" data-toggle="popover" data-placement="bottom" data-content="من فضلك قم بتسجيل الدخول اولا .">
                                                    انشاء طلب<i class="fas fa-print hvr-icon"></i>
                                                   </a>
                        -->
                        <a href="#" class="nav-link btn btn-primary hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#sign_in">
                            تسجيل الدخول<i class="fas fa-sign-in-alt hvr-icon"></i>
                        </a>
                    </div>
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars menu trans-2s"></i></span>
                </li>


            </ul>
        </div>
    </div>
</nav>
<!-- END navbar -->
                    <!-- END navbar -->
        <nav aria-label="breadcrumb" class="text-center bg-breadcrumb">
            <h4>العروض</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/index') }}" class="f-color">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">عروض</li>
          </ol>
        </nav>
        
        
        
                    <!-- start orders -->
        <section class="sec-offers pd-norm-sec" id="off_1">
            <div class="container">
                <div class="all-items">
                    <h5 class="mb-30">عروض من اجلك</h5>
                    <div class="row">
                        @foreach($offers as $offer)
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="card text-center">
                                <div class="content-offer">
                                    <span>خصم {{ $offer->count }}%</span>
                                    <div class="img-print mb-10">
                                        <i class="fab fa-hooli"></i>
                                    </div>
                                    <p>{{ $offer->title }}</p>
                                    <h6 class="mb-15">{{ $offer->content }}</h6>
                                    <p>انسخ  ال "برومو كود" المرفق ادناه اثناء الدفع
                                        للاشتراك بالعرض</p>
                                    <p class="promo-code" data-toggle="tooltip" data-placement="top" title="Copy to clipboard" >{{ $offer->code }}</p>
                                </div>
                                <p class="time-offer">مدة العرض  : من {{ $offer->started_at }} الى  {{ $offer->ended_at }} </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> 
            </div>
        </section>

        @include('login.footer')