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
                                    <a href="{{ url('/index') }}" class="hvr-icon-back">
                                        الرئيسية
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/index#about') }}" class="hvr-icon-back">من نحن
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/index#how_print') }}" class="hvr-icon-back">
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
                                    <a href="{{ url('/myOrders#sec_1') }}" class="hvr-icon-back">
                                        طلباتي
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/get/offers#off_1') }}" class="hvr-icon-back">
                                        العروض
                                        <i class="fas fa-angle-left hvr-icon"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="###" class="hvr-icon-back">
                                        تواصل معنا
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
                                
                                {{--<h6>موقعنا:</h6>--}}
                                {{--<p>الحي الثاني في السالمية , دولة الكويت</p>--}}
                                <h6>البريد الالكتروني</h6>
                                <p>info@write4m.com</p>
                                <h6>تواصل معنا</h6>
                                <p>6708 875 55 966+</p>
                                <ul class="social_agileinfo">
                                    {{--<li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>--}}
                                    <li><a href="https://twitter.com/write4m]" class="twitter"><i class="fab fa-twitter"></i></a></li>
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


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="{{url('/front/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/popper.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/owl.carousel.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/wow.min.js')}}" type="text/javascript"></script>
        <script src="{{url('/front/js/jquery.rateyo.js')}}" type="text/javascript"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="{{url('/front/js/code.js')}}" type="text/javascript"></script>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{ url('dist/jquery.fileuploader.min.js') }}" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

@stack('js')


</body>
</html>