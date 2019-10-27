    
            @include('common::partials._session')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'تعديل الطلب' }}</h3>
                        </div>
                    @include('common::partials._errors')
                    <!-- /.box-header -->
                        <div class="box-body">
                            <form class="dddddd" action="{{ route('orders.update',$row->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-lg-12">
                                      <!-- Custom Tabs -->
                                      <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                          <li class="active"><a href="#tab_1" data-toggle="tab">المعلومات الرئيسية</a></li>
                                          <li><a href="#tab_2" data-toggle="tab">حالة ونوع الطلب والخدمة</a></li>
                                          <li><a href="#tab_3" data-toggle="tab">معلومات اخري</a></li>
                                          
                                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                        </ul>
                                        <div class="tab-content">
                                          <div class="tab-pane active" id="tab_1">
                                            <div class="form-group col-md-12">
                                                <label>العميل</label>
                                                <input type="text" disabled="disabled" class="form-control" name="user_id" value="{{ $row->user->name }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>حالة الطلب</label>
                                                <select class="form-control order_status" name="order_status_id">
                                                    @foreach($orderStatus as $status)
                                                        <option data-status="{{$status->id}}" {{ $status->id == $row->order_status_id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>نوع الطلب</label>
                                                <input class="form-control" value="{{ $row->order_type->type }}" type="text" disabled="disabled" name="order_type_id">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>نوع الخدمة</label>
                                                <select class="form-control" name="service_type_id">
                                                    @foreach($serviceType as $type)
                                                        <option {{ $type->id == $row->service_type_id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 hidden">
                                                <label>الملف المنتهي</label>
                                                <input class="form-control" type="file" name="completed_file">
                                            </div>

                                          </div>
                                          <!-- /.tab-pane -->
                                          <div class="tab-pane" id="tab_2">
                                            <div class="form-group col-md-6">
                                                <label>نوع الخط</label>
                                                <select class="form-control" name="font_type_id">
                                                    @foreach($fontType as $type)
                                                        <option {{ $type->id == $row->font_type_id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->line_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>حجم الخط</label>
                                                <input type="text" class="form-control" value="{{ $row->font_size }}" name="font_size">
                                            </div>

                                            @if($rowRelation !== null)
                                            <input hidden class="hidden" type="text" value="{{ $rowRelation->id }}" name="order_id">
                                            @endif
                                            <div class="form-group col-md-6">
                                                <label>تكلفة الطلب</label>
                                                <input type="text" class="form-control" name="cost" value="{{ $rowRelation !== null ? $rowRelation->cost : 0 }}">
                                            </div>

                                            @if($row->deliveryDate === null)
                                            <div class="form-group col-md-6">
                                                <label>تاريخ الاستلام</label>
                                                <input type="date" id="" class="form-control" name="deliveryDate" value="{{ $row->deliveryDate }}">
                                            </div>
                                            @else
                                            <div class="form-group col-md-6">
                                                <label>تاريخ الاستلام</label>
                                                <input type="text" id="" class="form-control" disabled="disabled" value="{{ $row->deliveryDate }}">
                                            </div>
                                            @endif

                                            <div class="form-group col-md-6">
                                                <label>تاريخ الطلب</label>
                                                <input disabled="disabled" type="text" name="order_date" class="form-control disabled" value="{{ $row->order_date }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>عدد الصفحات</label>
                                                <input type="text" class="form-control" name="pages_number" value="{{ $row->pages_number }}">
                                            </div>

                                          </div>
                                          <!-- /.tab-pane -->
                                          <div class="tab-pane" id="tab_3">
                                                <div class="form-group col-md-6">
                                                  <label>التقييم</label>
                                                  <input type="text" class="form-control" name="rate" value="{{ $row->rate }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label>الطابعة</label>
                                                  <select disabled="disabled" class="form-control" name="printer_id">
                                                      @foreach($printers as $printer)
                                                          <option {{ $printer->id == $row->printer_id ? 'selected' : '' }} value="{{$printer->id}}">{{$printer->name}}</option>
                                                      @endforeach
                                                  </select>
                                                </div>

                                                <div disabled class="form-group col-md-12">
                                                  <label>تفاصيل اكثر</label>
                                                  <textarea disabled class="form-control disabled" style="height: 110px">
                                                    @if($row->update_notes === null)
                                                        {{ $row->more_details }}
                                                    @else
                                                        {{ $row->update_notes }}
                                                    @endif
                                                  </textarea>
                                                </div>
                                          </div>
                                          <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                      </div>
                                      <!-- nav-tabs-custom -->
                                    </div>
                                  </div>

                                <button type="submit" class="btn btn-success"> <i class="fa fa-edit"></i>تعديل</button>

                                <button type="button" class="btn btn-secondary" id="close_edit">اغلاق</button>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
      <script type="text/javascript">
        $('.order_status').on('change',function(){
            $(this).find('option')
        });

        $(".order_status").change(function() {
          var id = $(this).children(":selected").attr("value");
          if (id == 4 || id == 7) {
            $('.hidden').removeClass('hidden');
            
          }
          if(id == 3 || id== 7){
            alert('يجب كتابة التكلفة و عدد الصفحات وتاريخ الاستلام')
          }
          
        });

        $('#close_edit').on('click',function(){
            window.location.href="{{ route('orders.index') }}";
        });
      </script>