
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
                    <div hidden="hidden" class="validate_class alert alert-danger">
                      
                    </div>
                    <form method="POST" id="uploadForm" action="{{ route('order.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <h6 class="mb-10">اختر الملف</h6>
                            <p>(بالضغط ctrl مع الاختيار تستطيع رفع اكثر من ملف )</p>
                            <p >الملفات التي نقبلها Pdf, Jpg, word </p>

                            <input type="file" id="file" multiple name="file" />
                            {{--<label for="file" class="btn-2"><i class="fas fa-plus"></i></label>--}}
                        </div>


                        <div class="form-group">
                            <h6 class="mb-10">نوع الخدمة</h6>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInline1" name="service_type_id" value="1" class="custom-control-input" checked>
                              <label class="custom-control-label" for="customRadioInline1">كتابة</label>
                            </div>
                            <div class="custom-control mb-15 custom-radio custom-control-inline">
                              <input type="radio" id="customRadioInline2" name="service_type_id" value="2" class="custom-control-input">
                              <label class="custom-control-label" for="customRadioInline2">تنسيق بحوث ورسائل  </label>
                            </div> 
                            <ul class="nav nav-pills order-status  mb-3" id="pills-tab" role="tablist">
                              <li class="nav-item">
                                  <label class="nav-link active" id="quick-btn">مستعجل
                                      <input type="radio" checked="" name="order_type_id" value="1">
                                  </label>
<!--                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">مستعجل</a>-->
                              </li>
                              <li class="nav-item">
                                  <label class="nav-link" id="normal-btn">عادي
                                      <input type="radio" name="order_type_id" value="2">
                                  </label>
<!--                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">عادي</a>-->
                              </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <h6 class="mb-10">نوع الخط</h6>
                            <select id="custom-select" class="form-control" name="font_type_id">
                                @foreach($fonts as $font)
                                  <option value="{{$font->id}}" >{{$font->line_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <h6 class="mb-10">حجم الخط</h6>
                            <select id="custom-select" class="form-control" name="font_size">
                                @for($i = 1 ; $i <= 20 ; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <h6 class="mb-10">ملاحظات اضافة</h6>
                            <textarea class="btn-block" name="additional_details" value="{{old('additional_details')}}"></textarea>
                        </div>
                        <button class="btn btn-primary btn_load btn-submit btn-block">اضف طلب</button>
                    </form>                  
                  
              </div>
            </div>
          </div>
        </div>

<link href="{{ url('dist/font/font-fileuploader.css') }}" media="all" rel="stylesheet">
<link href="{{ url('dist/jquery.fileuploader.min.css') }}" media="all" rel="stylesheet">

@push('js')

    <script type="text/javascript">

                $('input[name="file"]').fileuploader({
                    addMore: true
                });
                $(".btn-submit").click(function(){


                    $('#uploadForm').ajaxForm({
                        target:'#imagePreview',
                        dataType : 'JSON',
                        success : function(res){
                            if (res.errors != null) {
                                $('.validate_class').children().remove();
                                var errorString = '<ul>';
                                $.each( res.errors, function( key, value) {
                                    errorString += '<li>' + value + '</li>';
                                });
                                errorString += '</ul>';
                                $('.validate_class').removeAttr('hidden').append(errorString);

                                $('.btn_load').removeAttr('disabled');
                            }else{
                                $('#newPrint').modal('hide');
                                Swal.fire({
                                    title: 'تم ارسال طلبك بنجاح',
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer:2000
                                });
                                setTimeout(function(){
                                    location.reload(true);
                                }, 2000);

                            }
                        },
                        beforeSend: function(){
                            $('.btn_load').attr('disabled','disabled');
                        },
                    });
                });

    </script>

@endpush