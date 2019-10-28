<div class="modal fade" id="sign_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header row">
              <ul class="nav nav-pills row" id="pills-tab" role="tablist">
                <li class="nav-item col">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">تسجيل الدخول</a>
                </li>
                <li class="nav-item col">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">انشاء حساب</a>
                </li>
              </ul>
        </div>

        <div class="modal-body">
           <div class="tab-content" id="pills-tabContent">
            <!-- login -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <h5 class="form-group">اهلا بك  مجددآ..</h5>
                  <div class="form-group">
                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="inputAddress" placeholder="البريد الالكتروني" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputAddress" placeholder="الرقم السري" required autocomplete="current-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class=" form-group custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" name="remember" id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="customCheck1">تذكرني</label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">تسجيل الدخول</button>
                </form>
            </div>
            <!-- end login -->
            <!-- register --> 
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form method="POST" action="{{ route('register_create') }}">
                      @csrf
                      <h5 class="form-group">حساب جديد</h5>
                      <div class="form-group">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputAddress" placeholder="الاسم" name="name" value="{{ old('name') }}" required autocomplete="name">
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputAddress" placeholder="البريد الالكتروني" name="email" value="{{ old('email') }}" required autocomplete="email">
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputAddress" placeholder="الرقم السري" name="password" value="{{ old('password') }}" required >
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control @error('area') is-invalid @enderror" id="inputAddress" placeholder="المنطقة" name="area" value="{{ old('area') }}" required autocomplete="area"> 
                          @error('area')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputAddress" placeholder="رقم الجوال" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                          @error('phone')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class=" form-group custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="agree" id="customCheck2" {{ old('agree') ? 'checked' : '' }}>
                          <label class="custom-control-label" for="customCheck2">أوافق علي الشروط و الأحكام</label>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block">تسجيل الدخول</button>
                    </form>
                </div>
            </div>
            <!-- end register -->
          </div>
        </div>
      </div>
    </div>
  </div>