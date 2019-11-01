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

                            <input type="file"  multiple="multiple" id="file" name="file[]" />
                            <label for="file" class="btn-2"><i class="fas fa-plus"></i></label>
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
                        <button class="btn btn-primary btn-submit btn-block">اضف طلب</button>
                    </form>                  
                  
              </div>
            </div>
          </div>
        </div>

@push('js')
    <script src="{{ url('front/js/jquery.uploadfile.min.js') }}"></script>
  {{--<script type="text/javascript">--}}

            {{--$(".btn-submit").click(function(e){--}}
            {{--e.preventDefault();--}}


            {{--var _token22            = $("input[name='_token']").val();--}}
            {{--var file22              = $("#file").val();--}}
            {{--var serviceType22       = $("input[name='service_type_id']").val();--}}
            {{--var orderType22         = $("input[name='order_type_id']").val();--}}
            {{--var fontType22          = $("select[name='font_type_id']").val();--}}
            {{--var fontSize22          = $("select[name='font_size_id']").val();--}}
            {{--var additionalDetails22 = $("textarea[name='additional_details']").val();--}}

            {{--var formData = new FormData($(this).parents('form')[0]);--}}
                {{--console.log(formData);--}}

            {{--$.ajax({--}}
                {{--url: "{{ url('/store_order') }}",--}}
                {{--type:"post",--}}
                {{--data: {  _token:_token22,--}}
                         {{--service_type_id:serviceType22,--}}
                         {{--order_type_id:orderType22,--}}
                         {{--font_type_id:fontType22,--}}
                         {{--font_size:fontSize22,--}}
                         {{--more_details:additionalDetails22,--}}
                       {{--},--}}
                {{--success: function(data) {--}}

                  {{--if (data.errors != null) {--}}
                    {{--$('.validate_class').children().remove();--}}
                    {{--var errorString = '<ul>';--}}
                    {{--$.each( data.errors, function( key, value) {--}}
                        {{--errorString += '<li>' + value + '</li>';--}}
                    {{--});--}}
                    {{--errorString += '</ul>';--}}
                      {{--$('.validate_class').removeAttr('hidden').append(errorString);--}}

                  {{--}else{--}}
                      {{--$('#newPrint').modal('hide');--}}
                      {{--$('#upload_modal').modal('show');--}}
                      {{--Swal.fire({--}}
                          {{--title: 'تم ارسال طلبك بنجاح',--}}
                          {{--type: 'success',--}}
                          {{--showConfirmButton: false,--}}
                          {{--timer:2000--}}
                      {{--});--}}

                    {{--}--}}

                {{--}--}}


            {{--});--}}

        {{--});--}}
                    {{--//$('div.gallery').empty();--}}
                    {{--// Multiple images preview in browser--}}



  {{--</script>--}}


    <script type="text/javascript">

        $(".btn-submit").click(function(){

            $('#uploadForm').ajaxForm({
                target:'#imagesPreview',
                dataType:'JSON',
                success : function(res){
                    if (res.errors != null) {
                        $('.validate_class').children().remove();
                        var errorString = '<ul>';
                        $.each( res.errors, function( key, value) {
                        errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul>';
                        $('.validate_class').removeAttr('hidden').append(errorString);

                    }else{
                        $('#newPrint').modal('hide');
                        Swal.fire({
                        title: 'تم ارسال طلبك بنجاح',
                        type: 'success',
                        showConfirmButton: false,
                        timer:2000
                        });
                    }
                },

            });
            });
        $('input[type=file]').on('change',function () {
            alert('لقد اخترت'+$(this).get(0).files.length+'ملف للرفع');
        });
    </script>
@endpush