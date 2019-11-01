@include('login.header')
@include('login.neworder')

@include('login.navlogin')
                    <!-- END navbar -->
        <nav aria-label="breadcrumb" class="text-center bg-breadcrumb">
            <h4>العروض</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="" class="f-color">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">عروض</li>
          </ol>
        </nav>
        
        
        
                    <!-- start orders -->
        <section class="sec-offers pd-norm-sec" id="off_1">
            <div class="container">
                <div class="all-items">
                    <h5 class="mb-30">عروض من اجلك</h5>
                    <div class="row">
                        @foreach($offers as $offer)
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <div class="card text-center">
                                <div class="content-offer">
                                    <span>خصم {{ $offer->count }}%</span>
                                    <div class="img-print mb-10">
                                        <i class="fab fa-hooli"></i>
                                    </div>
                                    <p>{{ $offer->title }}</p>
                                    <h6 class="mb-15">{{ $offer->content }}</h6>
                                    <p>انسخ  ال "برومو كود" المرفق ادناه اثناء الدفع
                                        للاشتراك بالعرض</p>
                                    <p class="promo-code">{{ $offer->code }}</p>
                                </div>
                                <p class="time-offer">مدة العرض  : من {{ $offer->started_at }} الى  {{ $offer->ended_at }} </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> 
            </div>
        </section>

        @include('login.footer')