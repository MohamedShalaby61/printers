    @extends('common::layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="font-family: 'Cairo', sans-serif;">
                رؤية الطلب
                <small>لوحة التحكم</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
                <li class="active">الطلبات</li>
                <li class="active">رؤية</li>
            </ol>
        </section>

        <section style="height:600px" class="content">
            @include('common::partials._session')
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="font-family: 'Cairo', sans-serif;" class="box-title">{{ 'رؤية بدون تعديل' }}</h3>
                        </div>
                    @include('common::partials._errors')
                    <!-- /.box-header -->
                        <div class="box-body">
              
                                <div class="row">
                                    <div class="col-lg-12">
                                      <!-- Custom Tabs -->
                                      <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                          <li class="active"><a href="#tab_1" data-toggle="tab">المعلومات الرئيسية</a></li>
                                          <li><a href="#tab_2" data-toggle="tab">حالة ونوع الطلب والخدمة</a></li>
                                          <li><a href="#tab_3" data-toggle="tab">معلومات اخري</a></li>
                                          <li><a href="#tab_4" data-toggle="tab">الملفات المرفوعة</a></li>
                                          
                                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                        </ul>
                                        <div class="tab-content">
                                          <div class="tab-pane active" id="tab_1">
                                            <div class="form-group col-md-12">
                                                <label>العميل</label>
                                                    @foreach($users as $user)
                                                      @if($user->id == $row->user_id)
                                                        <div {{ $user->id == $row->user_id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</div>
                                                      @endif  
                                                    @endforeach
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>حالة الطلب</label>
                                                
                                                    @foreach($orderStatus as $status)
                                                      @if($status->id == $row->order_status_id)
                                                        <div {{ $status->id == $row->order_status_id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->status }}</div>
                                                      @endif  
                                                    @endforeach
                                                
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>نوع الطلب</label>
                                                
                                                    @foreach($orderType as $typo)
                                                      @if($typo->id == $row->order_type_id)
                                                        <div {{ $typo->id == $row->order_type_id ? 'selected' : '' }} value="{{ $typo->id }}">{{ $typo->type }}</div>
                                                      @endif  
                                                    @endforeach
                                                
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>نوع الخدمة</label>
                                                
                                                    @foreach($serviceType as $type)
                                                      @if($type->id == $row->service_type_id)  
                                                        <option {{ $type->id == $row->service_type_id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                      @endif  
                                                    @endforeach
                                                
                                            </div>

                                          </div>
                                          <!-- /.tab-pane -->
                                          <div class="tab-pane" id="tab_2">
                                            <div class="form-group col-md-6">
                                                <label>نوع الخط</label>
                                                
                                                    @foreach($fontType as $type)
                                                      @if($type->id == $row->font_type_id)
                                                        <div {{ $type->id == $row->font_type_id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->line_type }}</div>
                                                      @endif  
                                                    @endforeach
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>حجم الخط</label>
                                                <div>{{ $row->font_size }}</div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>تكلفة الطلب</label>
                                                @foreach($row->order_cost as $cost)
                                                <div>{{ $cost->cost }}</div>
                                                @endforeach
                                            </div>

                                            @if($row->DeliverDate  !== null)

                                                <div class="form-group col-md-6">
                                                <label>تاريخ الاستلام</label>
                                                <div>{{ $row->deliveryDate->format('y-m-d') }}</div>
                                              </div>
                                            
                                            

                                            @endif

                                            <div class="form-group col-md-6">
                                                <label>تاريخ الطلب</label>
                                                <div>{{ $row->order_date }}</div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>عدد الصفحات</label>
                                                <div>{{ $row->pages_number }}</div>
                                            </div>

                                          </div>
                                          <!-- /.tab-pane -->
                                          <div class="tab-pane" id="tab_3">
                                                <div class="form-group col-md-6">
                                                  <label>التقييم</label>
                                                  <div>{{ $row->rate }}</div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label>الطابعة</label>
                                                  
                                                      @foreach($printers as $printer)
                                                        @if($printer->id == $row->printer_id)
                                                          <div {{ $printer->id == $row->printer_id ? 'selected' : '' }} value="{{$printer->id}}">{{$printer->name}}</div>
                                                        @endif  
                                                      @endforeach
                                                 
                                                </div>

                                                <div disabled class="form-group col-md-12">
                                                  <label>تفاصيل اكثر</label>
                                                  <div style="height: 110px">
                                                    @if($row->update_notes === null)
                                                        {{ $row->more_details }}
                                                    @else
                                                        {{ $row->update_notes }}
                                                    @endif
                                                  </div>
                                                </div>
                                          </div>
                                          <div class="tab-pane" id="tab_4">
                                               <div class="form-group col-lg-3">
                                                  <label>الملفات المرفوعة من العميل اول مرة</label>
                                                  <br>
                                                  @foreach($row->choose_file as $index=>$file)
                                                    <a target="_blank" href="{{ $file->file }}">الملف رقم ({{ $index+1 }})</a><br/>
                                                  @endforeach
                                               </div>
                                               <div class="form-group col-lg-3">
                                                  <label>الملفات المرفوعة لهدف التعديل</label>
                                                  <br>
                                                  @foreach($row->upload_modify as $index=>$file)
                                                    <a target="_blank" href="{{ $file->file }}">الملف رقم ({{ $index+1 }})</a><br/>
                                                  @endforeach
                                               </div>
                                               <div class="form-group col-lg-3">
                                                  <label>الملفات التي رفعناها للعميل</label>
                                                  <br>
                                                    @if($row->complete_file !== null)
                                                    <a target="_blank" href="{{ $row->complete_file->url }}">الملف رقم (1)</a><br/>
                                                    @endif
                                               </div>
                                          </div>
                                          <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                      </div>
                                      <!-- nav-tabs-custom -->
                                    </div>
                                  </div>

                             

                                <button type="button" onclick="window.history.go(-1);" class="btn btn-secondary" data-dismiss="modal">عوده</button>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>
 </section>
        
    </div>
@endsection


