@include('login.header')
@include('login.neworder')

        <nav class="navbar navbar-expand-lg navbar-light nav-order">
            <div class="container">
              <a class="navbar-brand" href="index.html"><img src="{{url('/front/imgs/logo2.png')}}" alt="logo"></a>
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
                                  <img src="{{url('/front/imgs/writting_icon.png')}}" class="mr-3 bg-image" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="{{url('/front/imgs/writting_icon.png')}}" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="{{url('/front/imgs/writting_icon.png')}}" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="{{url('/front/imgs/writting_icon.png')}}" class="mr-3" alt="...">
                                  <span><i class="far fa-clock clock"></i> منذ ساعه</span>
                                  <div class="media-body">
                                    <p class="mt-0">رقم الطلب  : 000000 - كتابة</p>
                                    <p>حالة طلبك :  تم الاستقبال من قبل المطبعة</p>
                                  </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="media">
                                  <img src="{{url('/front/imgs/writting_icon.png')}}" class="mr-3" alt="...">
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
                          <a href="offers.html">العروض</a>
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
        
        <section class="sec-order pd-norm-sec">
            <div class="container">
                <ul class="nav nav-tabs mb-15" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="home" aria-selected="true">طلبات  تحت التنفيذ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#complete_order" role="tab" aria-controls="profile" aria-selected="false">مكتملة</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active complete-order orders" id="orders" role="tabpanel" aria-labelledby="home-tab">
                          <h5 class="mb-30">طلبات  تحت التنفيذ</h5>
                          <div class="row">
                              @foreach($onProgressOrders as $order)
                                  <div class="col-lg-4 col-sm-6 col-xs-12">
                                      <div class="card">
                                          <h6 class="bg-download">نوع الطلب :
                                              <span>{{ $order->order_type->type }}
                                                  <!--                                            <a href="#" class="hvr-icon-down"><i class="far fa-arrow-alt-circle-down hvr-icon"></i> تحميل الملف</a>-->
                                        </span>
                                          </h6>
                                          <h6>رقم الطلب :
                                              <span>{{ $order->id }}</span>
                                          </h6>
                                          <h6>تاريخ الطلب :
                                              <span>{{ $order->order_date }}</span>
                                          </h6>
                                          <h6>حالة الطلب :
                                              <span class="status quick">{{ $order->order_status->status }} </span><span class="status completes">{{ $order->order_type->type }} </span>
                                          </h6>
                                          <h6>عدد الاوراق :
                                              <span>{{ $order->pages_number }}</span>
                                          </h6>
                                          <h6>تاريخ الاستلام :
                                              <span>{{ $order->deliveryDate }}</span>
                                          </h6>
                                          <h6>مركز الطباعة :
                                              <span>{{ $order->printer_details->name }}</span>
                                          </h6>
                                          <div class="line mb-15"></div>
                                          <div class="row">
                                              <div class="col">
                                                  <div class="status-payment">
                                                      <a href="#" class="hvr-icon-down cancel-order hvr-buzz"><i class="fas fa-trash-alt"></i> الغاء الطلب  </a>
                                                  </div>
                                              </div>
                                              <div class="col">
                                                  <div class="cost">
                                                      <h5>القيمة</h5>
                                                      @if(is_numeric($order->payment->cost))
                                                      <p>{{ $order->payment->cost }} ريال سعودي</p>
                                                      @else
                                                      <p>{{ $order->payment->cost }}</p>
                                                      @endif
                                                  </div>
                                              </div>
                                          </div>
                                          <!--                                   <button type="button" class="btn btn-primary true-pay">تم الدفع</button>-->
                                      </div>
                                  </div>
                              @endforeach

                          </div>
                  </div>
                  <div class="tab-pane fade complete-order" id="complete_order" role="tabpanel" aria-labelledby="profile-tab">
                      <h5 class="mb-30">طلبات مكتملة</h5>
                      <div class="row">

                          @foreach($completedOrders as $order)
                              <div class="col-md">
                                  <div class="card">
                                      <h6 class="bg-download">نوع الطلب :
                                          <span>{{ $order->order_status->status }}
                                              @if($order->payment->payment_status == 1)
                                                  <a href="{{ $order->file }}" target="_blank" class="hvr-icon-down"><i class="far fa-arrow-alt-circle-down hvr-icon"></i> تحميل الملف</a>
                                              @else
                                                  <a href="#" class="hvr-icon-down"><i class="far fa-arrow-alt-circle-down hvr-icon"></i> تحميل الملف</a>
                                              @endif
                                    </span>
                                      </h6>
                                      <h6>رقم الطلب :
                                          <span>{{ $order->id }}</span>
                                      </h6>
                                      <h6>تاريخ الطلب :
                                          <span>{{ $order->order_date }}</span>
                                      </h6>
                                      <h6>حالة الطلب :
                                          <span class="status quick">{{ $order->order_type->type }} </span><span class="status completes">{{ $order->order_status->status }} </span>
                                      </h6>
                                      <h6>عدد الاوراق :
                                          <span>{{ $order->pages_number }}</span>
                                      </h6>
                                      <h6>تاريخ الاستلام :
                                          <span>{{ $order->deliveryDate }}</span>
                                      </h6>
                                      <h6>مركز الطباعة :
                                          <span>{{ $order->printer_details->name }}</span>
                                      </h6>
                                      <div class="line mb-15"></div>
                                      <div class="row">
                                          <div class="col">
                                              <div class="status-payment">
                                                  <a href="#" class="hvr-icon-down"><i class="fas fa-check-circle true"></i>{{ $order->payment->payment_status == 0 ? 'في انتظار الدفع' : 'تم الدفع' }}</a>
                                              </div>
                                          </div>
                                          <div class="col">
                                              <div class="cost">
                                                  <h5>القيمة</h5>
                                                  @if(is_numeric($order->payment->cost))
                                                  <p>{{ $order->payment->cost }} ريال سعودي</p>
                                                  @else
                                                  <p>{{ $order->payment->cost }}</p>
                                                  @endif
                                              </div>
                                          </div>
                                      </div>
                                      <button type="button" class="btn btn-primary true-pay hvr-float" data-toggle="modal" data-target="#details_order">تفاصيل الطلب والتعديلات</button>
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>
                </div>
            </div>
        </section>
        
@include('login.footer')