@include('login.header')
<!-- Modal new print -->
<div class="modal" id="payment_modal">
    <script class="src_btn" src=""></script>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اكمال عملية الدفع</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="direction: ltr">
                <form action="##" style="direction: ltr" class="paymentWidgets payment_state" data-brands="VISA MASTER AMEX"></form>
            </div>
        </div>
    </div>
</div>

<input hidden name="_token" id="_token" value="{{ csrf_token() }}">
<div class="modal fade" id="newPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">طلب جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <h6 class="mb-10">اختر الملف</h6>
                        <p >الملفات التي نقبلها Pdf, Jpg, word </p>

                        <input type="file" id="file" />
                        <label for="file" class="btn-2"><i class="fas fa-plus"></i></label>
                    </div>
                    <div class="form-group">
                        <h6 class="mb-10">نوع الخدمة</h6>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked>
                            <label class="custom-control-label" for="customRadioInline1">كتابة</label>
                        </div>
                        <div class="custom-control mb-15 custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">تنسيق بحوث ورسائل  </label>
                        </div>
                        <ul class="nav nav-pills order-status  mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <label class="nav-link active" id="quick-btn">مستعجل
                                    <input type="radio" checked="" name="rad">
                                </label>
                                <!--                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">مستعجل</a>-->
                            </li>
                            <li class="nav-item">
                                <label class="nav-link" id="normal-btn">عادي
                                    <input type="radio" name="rad">
                                </label>
                                <!--                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">عادي</a>-->
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <h6 class="mb-10">نوع الخط</h6>
                        <select id="custom-select" class="form-control">
                            <option>ٍSample Arabic</option>
                            <option>ٍSample Arabic</option>
                            <option>ٍSample Arabic</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6 class="mb-10">حجم الخط</h6>
                        <select id="custom-select" class="form-control">
                            <option>ٍSample Arabic</option>
                            <option>ٍSample Arabic</option>
                            <option>ٍSample Arabic</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6 class="mb-10">ملاحظات اضافة</h6>
                        <textarea class="btn-block"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target=".successful-order" data-dismiss="modal">ارسال الطلب</button>
                </form>

            </div>
            <!--
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
            -->
        </div>
    </div>
</div>

<section class="operat-payment pd-norm-sec text-center">
    <div class="container">
        <h3>ادفع الان</h3>
        <form class="">

                  <span style="max-width: 300px; margin: 20px auto;" class="input-group input-group-sm">
                      <input id="promoCode" placeholder="كود الخصم" style="margin: 0px; background-color: white; font-size: 14px; border-width: 1px; border-color: rgb(238, 238, 238); padding: 18px 5px" type="text" class="form-control">
                      <span class="input-group-btn">
                          <button id="btnSubmit" style="margin-left: 5px;" type="submit" class="btn btn-primary">فحص</button>
                      </span>
                    </span>

            <p>المجموع الجزئي : <span>{{ $order->order_cost->sortByDesc('id')->first()->cost }} ر.س</span></p>
            <p>خصم : <span class="offer_count">--.--</span></p>
            <p>المجموع الكلي : <span class="after_count">{{ $order->order_cost->sortByDesc('id')->first()->cost }} ر.س</span></p>
        </form>
        {{--btn_paid--}}
        {{--data-amount="{{ $order->payment->cost }}"--}}
        {{--data-currency="SAR"--}}
        {{--data-user_id="{{ auth()->user()->id }}"--}}
        {{--data-user_email="{{ auth()->user()->email }}"--}}
            <button
                    data-amount="{{ $order->order_cost->sortByDesc('id')->first()->cost * 100 }}"
                    data-currency="SAR"
                    data-user_id="{{ auth()->user()->id }}"
                    data-user_email="{{ auth()->user()->email }}"
                    class="btn_paid form-control btn btn-primary" >ادفع الان</button>

    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{url('/front/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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

<script>
        $('#btnSubmit').on('click',function (e) {
            e.preventDefault();
            var promo = $('#promoCode').val();
            var _token = $('#_token').val();
            var order_id = '{{ $order->id }}';
            $.ajax({
                url : '{{ route('check_code_promo') }}',
                dataType : 'json',
                method: 'POST',
                data : {order_id:order_id,_token:_token,code:promo},
                success : function (data) {
                    if (data.offer == null){
                        alert('الكود خاطيء او انتهت صلاحيته');
                        $('#promoCode').val('');
                    }else{
                        alert('تم التحقق من الكود بشكل صحيح');
                        $('.offer_count').html(data.discount+' ر.س');

                        $('.after_count').html(data.payment + ' ر.س');

                        $('.btn_paid').attr('data-amount',data.payment * 100);
                    }
                }
                
            });
        });

        $('.btn_paid').on('click',function (e) {
            e.preventDefault();
            //alert('dasda');
            var amount = $(this).data('amount');
            var currency = $(this).data('currency');
            var user_id = $(this).data('user_id');
            var user_email = $(this).data('user_email');
            var order_id = '{{ $order->id }}';

            //alert(currency);
            $.ajax({
                url : '{{ url('payment') }}',
                method: 'GET',
                data:{order_id:order_id,amount:amount,currency:currency,user_id:user_id,user_email:user_email},
                success : function (data) {
                    // alert(data.id);
                    console.log(data.id);
                    $('#payment_modal').modal('show');
                    //$('.src_btn').attr('src','https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+data.id);
                    $('.payment_state').attr('action',"{{ url('payment/form/') }}"+'/'+data.id +'/'+data.payment_id);
                    //$.getScript('https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+data.id);
                    var s = document.createElement('script');
                    s.src = 'https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+data.id;

                    document.body.appendChild(s);

                }
            });
        });
    </script>
