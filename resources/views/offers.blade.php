@include('login.header')
@include('login.neworder')

<nav class="navbar navbar-expand-lg navbar-light nav-order">
            <div class="container">
              <a class="navbar-brand" href="index.html"><img src="imgs/logo2.png" alt="logo"></a>
              <div class="" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                      </button>
                      <div class="dropdown-menu">
                        <h6 class="mb-15 text-center">التنبيهات</h6>
                        <div class="mr-10px">
                            <a class="dropdown-item active" href="#">
                                <div class="media">
                                  <img src="imgs/writting_icon.png" class="mr-3 bg-image" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="imgs/writting_icon.png" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="imgs/writting_icon.png" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="imgs/writting_icon.png" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="imgs/writting_icon.png" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item active">
                    <a href="#" class="nav-link btn btn-primary chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#newPrint">
					انشاء طلب<i class="fas fa-print hvr-icon"></i>
				    </a>
<!--
                       <a href="#" class="nav-link btn chg-color hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-container="body" data-toggle="popover" data-placement="bottom" data-content="من فضلك قم بتسجيل الدخول اولا .">
					انشاء طلب<i class="fas fa-print hvr-icon"></i>
				    </a>
-->
                  </li>
                  <li class="nav-item active">
                    <a href="#" class="nav-link btn btn-primary hvr-shutter-out-horizontal hvr-icon-pulse-grow" data-toggle="modal" data-target="#sign_in">
					تسجيل الدخول<i class="fas fa-sign-in-alt hvr-icon"></i>
				    </a>
                  </li>
                  <li class="nav-item active">
                       <div id="mySidenav" class="sidenav">
                          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                           <div class="text-center profile">
                                <img src="imgs/128.jpg" class="" alt="">
                                <h6>معاذ محسن</h6>
                                <a href="editProfile.html" class="edit-profile"><i class="far fa-edit"></i> تعديل الملف الشخصي</a>
                           </div>
                          <a href="index.html#home">الرئيسية</a>
                          <a href="#about">من نحن</a>
                          <a href="#services">خدماتنا</a>
                          <a href="#how_print">كيفية الطباعة</a>
                          <a href="#testmonials">أراء العملاء</a>
                          <a href="orders.html">طلباتي</a>
                          <a href="#">العروض</a>
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
        <nav aria-label="breadcrumb" class="text-center bg-breadcrumb">
            <h4>العروض</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html" class="f-color">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">عروض</li>
          </ol>
        </nav>
        
        
        
                    <!-- start orders -->
        <section class="sec-offers pd-norm-sec">
            <div class="container">
                <div class="all-items">
                    <h5 class="mb-30">عروض من اجلك</h5>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="card text-center">
                                <div class="content-offer">
                                    <span>خصم 20%</span>
                                    <div class="img-print mb-10">
                                        <i class="fab fa-hooli"></i>
                                    </div>
                                    <p>مطابع ال سعود</p>
                                    <h6 class="mb-15">خصم 20% على خدمة تنسيق رسائل و بحوث</h6>
                                    <p>انسخ  ال "برومو كود" المرفق ادناه اثناء الدفع
                                        للاشتراك بالعرض</p>
                                    <p class="promo-code">54812E</p>
                                </div>
                                <p class="time-offer">مدة العرض  : من 1 مارس الى 10 مارس</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="card text-center">
                                <div class="content-offer">
                                    <span>خصم 20%</span>
                                    <div class="img-print mb-10">
                                        <i class="fab fa-cpanel"></i>
                                    </div>
                                    <p>مطابع ال سعود</p>
                                    <h6 class="mb-15">خصم 20% على خدمة تنسيق رسائل و بحوث</h6>
                                    <p>انسخ  ال "برومو كود" المرفق ادناه اثناء الدفع
                                        للاشتراك بالعرض</p>
                                    <p class="promo-code">54812E</p>
                                </div>
                                <p class="time-offer">مدة العرض  : من 1 مارس الى 10 مارس</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="card text-center">
                                <div class="content-offer">
                                    <span>خصم 20%</span>
                                    <div class="img-print mb-10">
                                        <i class="fab fa-angrycreative"></i>
                                    </div>
                                    <p>مطابع ال سعود</p>
                                    <h6 class="mb-15">خصم 20% على خدمة تنسيق رسائل و بحوث</h6>
                                    <p>انسخ  ال "برومو كود" المرفق ادناه اثناء الدفع
                                        للاشتراك بالعرض</p>
                                    <p class="promo-code">54812E</p>
                                </div>
                                <p class="time-offer">مدة العرض  : من 1 مارس الى 10 مارس</p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>

        @include('login.footer')