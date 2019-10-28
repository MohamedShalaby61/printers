@include('login.header')
@include('login.neworder')
@include('login.navlogin')
                    <!-- END navbar -->
<!--
        <nav aria-label="breadcrumb" class="text-center bg-breadcrumb">
            <h4>تعديل الملغ الشخصي</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html" class="f-color">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">لوحة التحكم</li>
          </ol>
        </nav>
-->
        
        
        
                    <!-- start control -->
        <section class="edit-pro pd-norm-sec">
            <div class="container">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="nav flex-column nav-pills links-profile" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-user"></i> حسابي</a>
                      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-cog"></i> اعداداتي</a>
                      <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="tab-content content-profile" id="v-pills-tabContent">
                      <div class="tab-pane fade my-account show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <h5>حسابي</h5>
                            <div class="all-content">
                                <div class="text-center profile">
                                    <img src="{{url('/front/imgs/128.jpg')}}" id="blah" class="" alt="image">
                                    <!-- <a href="#" class="edit-profile"></a> -->
                                    <input type="file" id="file"/>
                                    <label for="file" class="btn-2"><i class="far fa-edit"></i> تعديل الصورة الشخصية</label>
                               </div>
                               @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="font-size: 12px;">{{ Session::get('message') }}</p>
                                @endif

                               <form action="{{route('updateProfile')}}" method="POST">
                                @csrf
                                @method('PUT')
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="inputEmail4">الأسم</label>
                                      <input type="text" name="name" class="form-control" id="inputEmail4" value="{{$userData->name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="inputPassword4">الرقم السري</label>
                                      <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="الرقم السري">
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="inputEmail4">البريد الألكتروني</label>
                                      <input type="email" name="email" class="form-control" id="inputEmail4" value="{{$userData->email}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="inputPassword4">رقم الهاتف</label>
                                      <input type="text" name="phone_number" class="form-control" id="inputPassword4" value="{{$userData->phone_number}}">
                                    </div>
                                  </div>
<!--
                                   <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="inputPassword4">المنطقة</label>
                                      <input type="password" class="form-control" id="inputPassword4" placeholder="المنطقة">
                                    </div>
                                  </div>
-->
                                  <button type="submit" class="btn btn-primary save-data">حفظ</button>
                                </form>
                            </div>
                      </div>
                      <div class="tab-pane my-setting fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                          <h5>اعداداتي</h5>
                          <div class="all-content">
                            <form>
                              <div class="form-row">
                                  <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput">اختر البلد</label>
                                      <select class="custom-select" id="inputGroupSelect01">
                                        <option selected>اختر البلد</option>
                                        @foreach( $countries as $country)
                                          <option value="{{$country->id}}">{{$country->country_name}}</option>
                                        @endforeach
                                      </select>
                                   </div>
                                  <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput">اختر اللغه</label>
                                      <select class="custom-select" id="inputGroupSelect01">
                                        <option selected>اختر اللغه</option>
                                        <option value="1">العربية</option>
                                        <option value="2">الإنجليزية</option>
                                      </select>
                                   </div>
                                  <div class="form-group col-md-6">
                                      <label for="formGroupExampleInput">قم بتقييمنا</label>
                                      <textarea class="form-control btn-block">اترك ملاحظاتك</textarea>
                                   </div>
                              </div>
                              <button type="submit" class="btn btn-primary save-data">حفظ</button>
                          </form>
                          </div>
                      </div>
                      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Messages</div>
                    </div>
                  </div>
                </div>
            </div>
        </section>       
      @push('js')
          <script>

                 function readURL(input) {
                  if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                      $('#blah').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                  }
                }

                $("#file").change(function() {
                  readURL(this);
                });

        </script>
      @endpush
        
@include('login.footer')