@include('guest.header')
@include('guest.loginandregister')
@include('guest.navguest')
<!-- start about  -->
<section class="about-us pd-norm-sec text-center" id="about">
    <div class="container">
        <h2 class="mb-15">من نحن؟</h2>
        <p class="lead">منصة الكترونية تخدم الطلاب والباحثين والمثقفين في كتابة وتنسيق أبحاثهم وكتبهم ومستنداتهم بجميع  أنواعها.
            و تُتيح المنصة  لمن يُجيد الطباعة ( الكتابة ) من أفراد و مراكز الاشتراك فيها وتقديم خدمة الطباعة من خلالها .
            وتُعتبر منصة " اطبع لي" المنصة الإلكترونية الوحيدة  التي تُقدم  هذه الخدمات  بسعر لا يُنافس وجودة لا تُقارن.</p>
        <div class="app-download-area text-center">
            <div class=" app-download-btn wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <!-- Google Store Btn -->
                <a href="#">
                    <i class="fab fa-android"></i>
                    <p class="mb-0"><span>متاح على</span> متجر جوجل</p>
                </a>
            </div>
            <div class=" app-download-btn wow fadeInDown" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">
                <!-- Apple Store Btn -->
                <a href="#">
                    <i class="fab fa-apple"></i>
                    <p class="mb-0"><span>متاح على</span> متجر آبل</p>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- END about -->
@include('guest.services')
@include('guest.howtoprint')
@include('guest.testimonials')
@include('guest.footer')