@include('login.header')
@include('login.navlogin')
@include('login.neworder')
<!-- start about  -->
<section class="about-us pd-norm-sec text-center" id="about">
    <div class="container">
        <h2 class="mb-15">من نحن؟</h2>
        <p class="lead">التطبيق عبارة عن منصة الكترونية تخدم الطلاب والباحثين وغيرهم في كتابة وتنسيق أبحاثهم وكتبهم ومستنداتهم بشتى أنواعها، يبدأ سعر الورقة فيه بريالين.
            - كما أنه يتيح لأحد يجيد الطباعة ( الكتابة ) الاشتراك وتقديم خدمة الطباعة .
            يمتاز  تطبيق " اطبع لي" انه الوحيد الذي يقدم هذه الخدمة.
            كما يمتاز بقلة السعر ، والحرص على جودة المنتج، وسهولة الاستخدام.. فماعلى المستفيد الا رفع الملف المراد كتابته أو تنسيقه، مع تحديد خيارات الكتابة التي يريدها في حجم الخط ونوعه، ليستقبل طلبه بعد ذلك مركز الخدمة، الذي يعمل تحت إدارته عدد من الطابعين المهرة القادرين -بحول الله- على إنجاز العمل في وقت قياسي.</p>
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
@include('login.services')
@include('login.howtoprint')
@include('login.testimonials')
@include('login.footer')