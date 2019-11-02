@include('login.header')
@include('login.neworder')
        <input type="hidden" id="_token_token" name="_token" value="{{ csrf_token() }}">

                    <!-- END navbar -->
@include('login.navlogin')
        <?php if(Session::has('message')){ ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

            <script>
                Swal.fire({
                    'title': 'عملية الدفع',
                    text: '{{ Session::get('message') }}',
                    type: '{{ Session::get('alert-class', 'alert-info') }}',
                })
            </script>
        <?php } ?>
        <section class="sec-order pd-norm-sec" id="sec_1">
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
                            @if($onProgressOrders->count() > 0)
                          <h5 class="mb-30">طلبات  تحت التنفيذ</h5>
                          <div class="row">
                              @foreach($onProgressOrders as $order)
                                  <div class="col-lg-4 col-sm-6 col-xs-12">
                                      <div class="card">
                                          <h6 class="bg-download">نوع الطلب :
                                              <span style="font-size: 12px;">{{ $order->order_type->type }}
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
                                              <span class="status quick" style="font-size: 11px;">{{ $order->order_status->status }} </span><span class="status completes" style="font-size: 11px;">{{ $order->order_type->type }} </span>
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
                                                      <a href="#" data-id="{{ $order->id }}" class="hvr-icon-down cancel-order hvr-buzz deleteProgress"><i class="fas fa-trash-alt"></i> الغاء الطلب  </a>
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
                           @else
                                <div class="missing text-center pd-norm-sec">
                                    <div class="container">
                                        <i class="far fa-file-excel"></i>
                                        <h5>لا توجد طلبات</h5>
                                        <p>قم بأنشاء طلبات جديدة لتسمتع بخدمتنا</p>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newPrint">انشاء طلب</button>
                                    </div>
                                </div>
                            @endif
                  </div>

                        <div class="tab-pane fade complete-order" id="complete_order" role="tabpanel" aria-labelledby="profile-tab">
                            @if($completedOrders->count() > 0)
                            <h5 class="mb-30">طلبات مكتملة</h5>
                            <div class="row">

                          @foreach($completedOrders as $order)
                              <div class="col-lg-4 col-sm-6 col-xs-12">
                                  <div class="card">
                                      <h6 class="bg-download">نوع الطلب :
                                          <span style="font-size: 12px;">{{ $order->order_status->status }}
                                              @if($order->payment->payment_status == 1)
                                                  <a href="{{ $order->file }}" target="_blank" class="hvr-icon-down"><i class="far fa-arrow-alt-circle-down hvr-icon"></i> تحميل الملف</a>
                                              @else
                                                  <a href="#" class="hvr-icon-down orderComplete"><i class="far fa-arrow-alt-circle-down hvr-icon"></i> تحميل الملف</a>
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
                                          <span class="status quick" style="font-size: 11px;">{{ $order->order_type->type }} </span><span class="status completes" style="font-size: 11px;">{{ $order->order_status->status }} </span>
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
                                                  <a href="#" class="hvr-icon-down"><i class="fas fa-check-circle {{ $order->payment->payment_status == 0 ? 'false' : 'true' }}"></i>{{ $order->payment->payment_status == 0 ? 'في انتظار الدفع' : 'تم الدفع' }}</a>
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
                                      @if($order->payment->payment_status == 1)
                                      <button type="button"
                                              data-id="{{ $order->id }}"
                                              data-type="{{ $order->order_type->type }}"
                                              data-order_date="{{ $order->order_date }}"
                                              data-delivery_date="{{ $order->deliveryDate }}"
                                              data-pages_number="{{ $order->pages_number }}"
                                              data-printer="{{ $order->printer_details->name }}"
                                              class="btn btn-primary true-pay hvr-float editBtnComplete" data-toggle="modal" data-target="#details_order">تفاصيل الطلب والتعديلات</button>
                                      @else
                                          {{--btn_paid--}}
                                          {{--data-amount="{{ $order->payment->cost }}"--}}
                                          {{--data-currency="SAR"--}}
                                          {{--data-user_id="{{ auth()->user()->id }}"--}}
                                          {{--data-user_email="{{ auth()->user()->email }}"--}}

                                          <a id="btn_payment" href="{{ route('payment_form_view',$order->id) }}" style="color: white" class="btn btn-primary false-pay hvr-float"> أكمال الدفع</a>

                                      @endif
                                  </div>
                              </div>
                          @endforeach
                      </div>
                            @else
                                <h2>لا يوجد لديك طلبات مكتملة</h2>
                            @endif
                        </div>
                </div>
            </div>
        </section>
        <!-- start modal show -->

            <div class="modal" id="detailsd_order" tabindex="-1" role="dialog" style="padding-right: 6px;" aria-modal="true">

            </div>

            <div class="modal" id="edit_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">طلب تعديل</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div hidden class="validate_class2 alert alert-danger"></div>
                            <form id="uploadForm2" method="post" action="{{ route('edit_order_front') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="order_id" name="id" value="###">
                                <div class="form-group">
                                    <h6 class="mb-10">ارفع الملفات التي بها الخطأ</h6>
                                    <p>الملفات التي نقبلها Pdf, Jpg, word </p>
                                    <input type="file" name="file2" multiple id="file2">
                                    {{--<label for="file2" class="btn-2"><i class="fas fa-plus"></i></label>--}}
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-10">ملاحظات اضافة</h6>
                                    <p>اكتب الملاحظات التفصيلية   التي تريد تعديلها في ملفك </p>
                                </div>

                                <div class="form-group">
                                    <textarea name="update_notes" required="required" id="update_notes" class="btn-block"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary sendEditReq btn-block">ارسال الطلب</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        <!-- end modal show -->
@include('login.footer')
<script>
    $('input[name="file2"]').fileuploader({
        addMore: true
    });
</script>
<script class="src_btn" src=""></script>
    <script>
        $('.deleteProgress').on('click',function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'هل انت متأكد من ازالة الطلب ؟',
                text: 'بمجرد ازالة الطلب لن تستطيع استرجاعه مجددا',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف',
                cancelButtonText:'تراجع',
            }).then((result) => {
                if (result.value) {
                    var id = $(this).data('id');
                    var _token = $('#_token_token').val();
                    $.ajax({
                        type:'post',
                        url:'{{ route('delete_orders') }}',
                        data:{id:id,_token:_token},

                        success : function (data) {
                            Swal.fire({
                                title: 'تم الغاء طلبك بنجاح',
                                type: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(function(){
                                location.reload(true);
                            }, 2000);
                           
                        }
                    });

                }
            })
        });
        
        $('.orderComplete').on('click',function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'عذرا',
                text: 'يجب الدفع حتي تستطيع التحميل',
                imageUrl: 'https://dok7xy59qfw9h.cloudfront.net/85e/69864/c3bb/40a3/b0c5/49f86971ba7f/large/63320.jpg',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                confirmButtonText: 'حسنا',
                animation: false,
                customClass: {
                    popup: 'animated tada'
                }
            });
        });

        $('.editBtnComplete').on('click',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var order_type = $(this).data('type');
            var order_date = $(this).data('order_date');
            var delivery_date = $(this).data('delivery_date');
            var pages_number = $(this).data('pages_number');
            var printer = $(this).data('printer');
            //alert(order_type);
            $('#detailsd_order').html(`
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">تفاصيل الطلب و التعديلات</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <h6 class="bg-download">نوع الطلب :
                                    <span>${order_type} </span>
                                </h6>
                                <h6>رقم الطلب :
                                    <span>${id}</span>
                                </h6>
                                <h6>تاريخ الطلب :
                                    <span>${order_date}</span>
                                </h6>
                                <h6>تاريخ الاستلام :
                                    <span>${delivery_date}</span>
                                </h6>
                                <h6>عدد الاوراق :
                                    <span>${pages_number}</span>
                                </h6>
                                <h6>مركز الطباعة :
                                    <span>${printer}</span>
                                </h6>
                                <div class="line mb-15"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cost">
                                            <a style="color:white" class="btn btn-primary btn-sm sendEditArgs"
                                                data-id="${id}"
                                             >ارسال طلب تعديل</a>
                                        </div>
                                    </div>
                                </div>
                                <!--                                   <button type="button" class="btn btn-primary true-pay">تم الدفع</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            `).modal('show');
        });

        $(document).on('click','.sendEditArgs',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var good= $('#order_id').attr('value',id);
            //var ooop = good.val();
            //alert(ooop);
            $('#detailsd_order').modal('hide');
            $('#edit_order').modal('show');

        });

        $(".sendEditReq").click(function(){

            $('#uploadForm2').ajaxForm({
                dataType:'JSON',
                success : function(res){

                    if (res.errors != null) {
                        $('.validate_class2').children().remove();
                        var errorString = '<ul>';
                        $.each( res.errors, function( key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul>';
                        $('.validate_class2').removeAttr('hidden').append(errorString);

                    }else{
                        $('#edit_order').modal('hide');
                        Swal.fire({
                            title: 'تم ارسال تعديل الطلب بنجاح',
                            type: 'success',
                            showConfirmButton: false,
                            timer:2000
                        });
                        setTimeout(function(){
                            location.reload(true);
                        }, 2000);;
                    }
                },

            });
        });

        $('.btn_paid').on('click',function (e) {
            e.preventDefault();
            //alert('dasda');
            var amount = $(this).data('amount');
            var currency = $(this).data('currency');
            var user_id = $(this).data('user_id');
            var user_email = $(this).data('user_email');


            //alert(currency);
            $.ajax({
                url : '{{ url('payment') }}',
                method: 'GET',
                data:{amount:amount,currency:currency,user_id:user_id,user_email:user_email},
                success : function (data) {
                    // alert(data.id);
                    console.log(data.id);
                    $('#payment_modal').modal('show');
                    //$('.src_btn').attr('src','https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+data.id);
                    $('.payment_state').attr('action',"{{ url('payment/form/') }}"+'/'+data.id);
                    //$.getScript('https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+data.id);
                    var s = document.createElement('script');
                    s.src = 'https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+data.id;

                    document.body.appendChild(s);

                }
            });
        });

        {{--$('#btn_payment').on('click',function () {--}}
            {{--window.location.href = "{{ route('payment_form_view') }}";--}}
        {{--});--}}


    </script>
