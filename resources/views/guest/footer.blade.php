<footer class="end-footer" id="contact">
<!--            <div class="overlay"></div>-->
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div class="item">
                            <img src="{{url('/front/imgs/logo2.png')}}" alt="logo">
                            <p style="font-size: 17px !important;">اطبع لي .
                                بها تحفظ وقتك ومعها توفر مالك</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="item">
                            <h5>الخدمات</h5>
                            <ul>
                                <li>
                                    <a href="#" class="hvr-icon-back">
                                        العروض
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#how_print" class="hvr-icon-back">
                                        كيفية طلب الخدمة
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="item">
                            <h5>الدعم</h5>
                            <ul>
                                <li>
                                    <a href="#home" class="hvr-icon-back">
                                        الرئيسية
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/index#about') }}" class="hvr-icon-back">
                                        من نحن
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#services" class="hvr-icon-back">
                                        خدماتنا
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#testmonials" class="hvr-icon-back">
                                        أراء العملاء
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="item">
                            <h5>تواصل معنا</h5>
                            <div class="info-call">

                                <h6>البريد الالكتروني</h6>
                                <p>info@write4m.com</p>
                                <h6>تواصل معنا</h6>
                                <p>6708 875 55 966+</p>
                                <ul class="social_agileinfo">
                                    {{--<li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>--}}
                                    <li><a href="https://twitter.com/write4m" class="twitter"><i class="fab fa-twitter"></i></a></li>
                                    {{--<li><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></li>--}}
                                    {{--<li><a href="#" class="google"><i class="fab fa-google-plus-g"></i></a></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border-top: 1px solid rgba(204,204,204,.2);">
                <p class="text-center" style="font-size: 14px;">© 2019 - جميع الحقوق محفوظة لدي اطبع لي</p>
            </div>
        </footer>
        
                    <!-- end footer -->

      

        <script src="{{url('/front/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>   
        <script src="{{url('/front/js/popper.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/owl.carousel.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/wow.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/jquery.rateyo.js')}}" type="text/javascript"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="{{url('/front/js/code.js')}}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <script>
            AOS.init();
            new WOW().init();
            
            $(function () {
              $('[data-toggle="popover"]').popover()
            });
            
            $(function () {
              $('.example-popover').popover({
                container: 'body'
              })
            });
            
        </script>
        <script>
            $(document).on('click','#button_login',function (e) {
                e.preventDefault();
                var email = $('#email_login').val();
                var password = $('#password_login').val();
                var _token = '{{ csrf_token() }}';
                var rememberme = $('#rememberme_login').val();
                var agree = $('#agree_police').val();

                $.ajax({
                    url:'{{ route('login') }}',
                    method:'POST',
                    data : {_token:_token,email:email,password:password,rememberme:rememberme,agree:agree},
                    success : function (data) {
                        if (data.errors == null) {
                            Swal.fire({
                                title: 'رائع جاري تسجيل الدخول',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.href = '{{ route('index_login') }}';
                        }
                    },
                    error:function () {

                        Swal.fire({
                            title: 'البريد الالكتروني او كلمة المرور غير صحيحة',
                            type: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });

            $(document).on('click','#button_register',function (e) {
                e.preventDefault();
                var name = $('#name_register').val();
                var email = $('#email_register').val();
                var password = $('#password_register').val();
                var phone = $('#phone_register').val();
                var token_register = '{{ csrf_token() }}';

                $.ajax({
                    url:'{{ route('register_ajax') }}',
                    method:'POST',
                    data : {_token:token_register,email:email,password:password,name:name,phone,phone},
                    success : function (data) {
                        if (data.errors != null) {
                            $('.validate_register').children().remove();
                            var errorString = '<ul>';
                            $.each( data.errors, function( key, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            errorString += '</ul>';
                            $('.validate_register').removeAttr('hidden').append(errorString);

                        }else{
                            // alert('تم تسجيل طلبك بنجاح');
                            Swal.fire({
                                title: 'تم تسجيلك معنا بنجاح',
                                type: 'success',
                                showConfirmButton: false,
                                timer:2000
                            });
                            setTimeout(function(){
                                location.reload(true);
                            }, 2000);

                        }
                    }
                });
            });

            $(document).on('click','.error_must_login',function(e){
                e.preventDefault();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2500
                });

                Toast.fire({
                    type: 'error',
                    title: 'يجب تسجيل الدخول اولا'
                })
            });
        </script>
    </body>
</html>