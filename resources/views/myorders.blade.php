@include('login.header')
@include('login.neworder')
        <input type="hidden" id="_token_token" name="_token" value="{{ csrf_token() }}">

                    <!-- END navbar -->
@include('login.navlogin')
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
                            <h2 style="font-family: 'Droid Arabic Kufi',bold, serif">لا يوجد لديك طلبات جديدة</h2>
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
                                      <button type="button" class="btn btn-primary false-pay hvr-float"> أكمال الدفع</button>
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

            </div>

        <!-- end modal show -->
@include('login.footer')

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
                confirmButtonText: 'حسنا احذفه ؟',
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
                                timer: 1000
                            });
                            setTimeout(function(){
                                location.reload(true);
                            }, 1000);
                           
                        }
                    });

                }
            })
        });
        
        $('.orderComplete').on('click',function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'عذرا',
                text: 'يجب الدفع حتي تستطيع التحميل يبشه',
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
            $('#edit_order').html(`
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">طلب تعديل</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <h6 class="mb-10">ارفع الملفات التي بها الخطأ</h6>
                                    <p>الملفات التي نقبلها Pdf, Jpg, word </p>

                                    <input type="file" id="file">
                                    <label for="file" class="btn-2"><i class="fas fa-plus"></i></label>
                                </div>
                                <div class="form-group">
                                    <h6 class="mb-10">ملاحظات اضافة</h6>
                                    <p>اكتب الملاحظات التفصيلية   التي تريد تعديلها في ملفك </p>
                                </div>

                                <div class="form-group">
                                    <textarea name="update_notes" required="required" id="update_notes" class="btn-block"></textarea>
                                </div>
                                <button type="submit" data-id="${id}" class="btn btn-primary sendEditReq btn-block">ارسال الطلب</button>
                            </form>

                        </div>
                    </div>
                </div>
            `);

            $('#detailsd_order').modal('hide');
            $('#edit_order').modal('show');

        });

        $(document).on('click','.sendEditReq',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var _token = $('#_token_token').val();
            var update_notes = $('#update_notes').val();
            if (!update_notes){
                alert('حقل الملاحظات الاضافية مطلوب');
            }else{
                $.ajax({
                    url:'{{ route('edit_order_front') }}',
                    method:'post',
                    data : {id:id,_token:_token,update_notes:update_notes},
                    success: function () {
                        $('#edit_order').modal('hide');
                        Swal.fire({
                            title: 'تم ارسال طلب التعديل بنجاح',
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }

            return false;
        });

    </script>
