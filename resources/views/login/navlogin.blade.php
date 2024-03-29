        <nav class="navbar navbar-expand-lg navbar-light">
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
                                            <a class="dropdown-item" href="{{ url('/myOrders#sec_1') }}">
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
                          <a href="{{ url('/index#home') }}"  onclick="closeNav()">الرئيسية</a>
                          {{--<a href="{{ url('/index#about') }}">من نحن</a>--}}
                          <a href="{{ url('/index#services') }}"  onclick="closeNav()">خدماتنا</a>
                          <a href="{{ url('/index#how_print') }}"  onclick="closeNav()">كيفية طلب الخدمة</a>
                          <a href="{{ url('/index#testmonials') }}"  onclick="closeNav()">أراء العملاء</a>
                          <a href="{{ url('/myOrders#sec_1') }}"  onclick="closeNav()">طلباتي</a>
                          <a href="{{ url('/get/offers#off_1') }}"  onclick="closeNav()">العروض</a>
                          <a href="{{ url('/index#contact') }}"  onclick="closeNav()">تواصل معنا</a>
                           @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                <a href="{{ url('/get/login') }}">لوحة التحكم</a>
                           @endif
                          <a href="#"  onclick="closeNav()" class="nav-link btn btn-primary chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#newPrint">
                            انشاء طلب<i class="fas fa-print hvr-icon"></i>
                          </a>
<!--
                           <a href="#" class="nav-link btn chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-container="body" data-toggle="popover" data-placement="bottom" data-content="من فضلك قم بتسجيل الدخول اولا .">
                            انشاء طلب<i class="fas fa-print hvr-icon"></i>
                           </a>
-->
                           <a href="{{ url('logout') }}" class="nav-link btn btn-primary hvr-shutter-out-horizontal hvr-icon-pulse-grow">
                 تسجيل الخروج<i class="fas fa-sign-in-alt hvr-icon"></i>
                  </a>
                        </div>
                        <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fas fa-bars menu trans-2s"></i></span>
                 </li>

                    
                </ul>
              </div>
            </div>
        </nav>
                    <!-- END navbar -->
        <div class="bg-head" id="home">
            <div class="overlay"></div>
            <div class="container">
                <div class="content-head text-center">
                    <h1 class="mb-30"><span style="color: #4e9bd4;">اطبع لي</span> | منصتك الالكترونية للكتابة والتنسيق</h1>
                    <p class="lead" style="font-size: 35px !important;">بها تحفظ <span style="color: #4e9bd4;">وقتك</span> ومعها توفر <span style="color:#4e9bd4">مالك</span>.</p>
                </div>
            </div>
        </div>