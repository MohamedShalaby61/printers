        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
              <a class="navbar-brand" href="index.html"><img src="{{url('/front/imgs/logo2.png')}}" alt="logo"></a>
              <div class="" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                       <a href="#" class="nav-link btn btn-primary chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#newPrint">
          انشاء طلب<i class="fas fa-print hvr-icon"></i>
            </a>

                  </li>
                  <li class="nav-item active">
                    <a href="/logout" class="nav-link btn btn-primary hvr-shutter-out-horizontal hvr-icon-pulse-grow">
					تسجيل الخروج<i class="fas fa-sign-in-alt hvr-icon"></i>
				    </a>
                  </li>
                  
                  <li class="nav-item active">
                       <div id="mySidenav" class="sidenav">
                          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                           <div class="text-center profile">
                                <img src="{{url('/front/imgs/128.jpg')}}" class="" alt="">
                                <h6>معاذ محسن</h6>
                                <a href="/editProfile" class="edit-profile"><i class="far fa-edit"></i> تعديل الملف الشخصي</a>
                           </div>
                          <a href="#home">الرئيسية</a>
                          <a href="#about">من نحن</a>
                          <a href="#services">خدماتنا</a>
                          <a href="#how_print">كيفية الطباعة</a>
                          <a href="#testmonials">أراء العملاء</a>
                          <a href="{{ route('order_user') }}">طلباتي</a>
                          <a href="/offers">العروض</a>
                          <a href="#contact">تواصل معنا</a> 
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
        <div class="bg-head" id="home">
            <div class="overlay"></div>
            <div class="container">
                <div class="content-head text-center">
                    <h1 class="mb-30">اطبع لي | وجهتك المفضلة للطباعة الإلكترونية</h1>
                    <p class="lead">منصة اطبع لي تقدم كافة خدمات الطباعة أونلاين بخطوات سهلة ، وأسعار منافسة وجودة عالية مع خدمة التوصيل السريع</p>
                </div>
            </div>
        </div>