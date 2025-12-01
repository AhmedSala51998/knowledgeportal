<?php
require_once 'dashboard/config.php';
require_once 'dashboard/track_visit.php';

// الاتصال
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset("utf8mb4");

// جلب آخر 5 مدونات
$blogs_query = "SELECT * FROM blogs ORDER BY created_at DESC LIMIT 5";
$blogs_result = $conn->query($blogs_query);

// تحويل النتائج لمصفوفة
$blogs = [];
while ($row = $blogs_result->fetch_assoc()) {
    $blogs[] = $row;
}
?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>الرئيسية -  بوابة المعرفة</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/head.gif" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Knowledge Portal
  * Template URL: https://knowledgeportal.codeyla.com/
  * Updated: Sep 20 2025 with Bootstrap v5.3.8
  * Author: Eng. Ahmed Salah
  * License:
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top" dir="rtl">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <dotlottie-wc src="https://lottie.host/ec0b1ca0-0a17-4ad9-96bd-73491a7de386/lcx0UxtbZ4.lottie" style="width: 70px;height: 70px" autoplay loop></dotlottie-wc>
        <h1 class="sitename">بوابة المعرفة</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">الرئيسية</a></li>
          <li><a href="#about">عن الموقع</a></li>
          <li><a href="#services">خدماتنا</a></li>
          <li><a href="#portfolio">بعض أعمالنا</a></li>
          <!--<li><a href="#pricing">Pricing</a></li>-->
          <li><a href="blog.php">مدوناتنا</a></li>
          <!--<li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>-->
          <li><a href="#contact">تواصل معنا</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="cta-btn" href="#about">ابدأ رحلتك معنا</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="info d-flex align-items-center">
        <div class="container">
          <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-8 text-center">
              <h2>بوابتك للمعلومات والخدمات داخل المملكة العربية السعودية</h2>
              <p>
              منصة معرفية تقدم محتوى موثوقًا يساعد المواطنين والمقيمين على
              الوصول للخدمات، فهم الأنظمة، والتعرّف على كل ما يخص الحياة والعمل داخل المملكة.
              </p>
              <a href="#recent-posts" class="btn-get-started">دعنا نبدأ</a>
            </div>
          </div>
        </div>
      </div>

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item">
          <img src="assets/img/slider/slider-16.webp" alt="">
        </div>

        <div class="carousel-item">
          <img src="assets/img/slider/slider-13.webp" alt="">
        </div>

        <div class="carousel-item">
          <img src="assets/img/slider/slider-3.webp" alt="">
        </div>

        <div class="carousel-item active">
          <img src="assets/img/slider/slider-14.webp" alt="">
        </div>

        <div class="carousel-item">
          <img src="assets/img/slider/slider-5.webp" alt="">
        </div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section" dir="rtl">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>من نحن</h2>
        <p>منصة معرفية موجهة للمواطنين والمقيمين في السعودية، تقدم معلومات موثوقة تساعدك على فهم الأنظمة والخدمات والحياة داخل المملكة.</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-5 align-items-center">
          <div class="col-lg-6 position-relative">
            <div class="about-img" data-aos="fade-right">
              <!--<img src="assets/img/about/about-portrait-2.webp" class="img-fluid" alt="">-->
              <dotlottie-wc
                src="https://lottie.host/02b51ca1-fb54-42f7-8946-ae97eda81fb9/syu0t3KKVe.lottie"
                style="height: 650px"
                autoplay
                loop
              ></dotlottie-wc>
            </div>

            <div class="experience-badge" data-aos="fade-up">
              <h2>12</h2>
              <p>عامًا من<br>المحتوى الموثوق</p>
            </div>

            <div class="projects-badge" data-aos="fade-left">
              <h2>345+</h2>
              <p>مقال وخدمة</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left">
            <h2 class="display-4 fw-bold mb-4">نقدّم لك المعرفة التي تحتاجها في السعودية</h2>

            <p class="lead mb-4">
              نساعدك في تبسيط الإجراءات والخدمات الحكومية، ونسهّل عليك الوصول للمعلومات التي يحتاجها كل من يعيش في المملكة،
              سواء كنت مواطنًا أو مقيمًا. مقالاتنا مكتوبة بلغة بسيطة وموثقة لضمان تجربة سلسة وواضحة.
            </p>

            <div class="features">

              <div class="feature-item mb-4" data-aos="fade-up">
                <div class="feature-icon">
                  <i class="bi bi-rocket-takeoff"></i>
                </div>
                <div class="feature-content">
                  <h4>معلومات موثوقة وسريعة</h4>
                  <p>نوفر لك شروحات دقيقة عن الأنظمة، الخدمات الحكومية، الإقامات، الجوازات، العمل، والفرص المتاحة داخل المملكة.</p>
                </div>
              </div>

              <div class="feature-item mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                  <i class="bi bi-globe2"></i>
                </div>
                <div class="feature-content">
                  <h4>محتوى يناسب الجميع</h4>
                  <p>نعرض لك كل ما يهم المواطنين والمقيمين على حد سواء، بدءًا من شؤون الحياة اليومية وصولًا إلى أهم التحديثات الحكومية.</p>
                </div>
              </div>

              <ul class="check-list" data-aos="fade-up" data-aos-delay="200">
                <li><i class="bi bi-check-circle"></i> تبسيط الخدمات الحكومية مثل أبشر، الجوازات، النقل، البلديات، المرور.</li>
                <li><i class="bi bi-check-circle"></i> نصائح عملية للحياة والعمل والمعيشة داخل المملكة للمقيمين والمواطنين.</li>
              </ul>

              <a href="#" class="btn btn-primary btn-lg mt-4" data-aos="fade-up" data-aos-delay="300">اكتشف المزيد</a>
            </div>
          </div>
        </div>

      </div>

    </section>
    <!-- /About Section -->


    <!-- Services Section -->
    <section id="services" class="services section" dir="rtl">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>خدماتنا</h2>
        <p>نوفر محتوى موثوقًا وشروحًا مبسطة تساعد كل من يعيش داخل المملكة العربية السعودية على الوصول للمعلومات والخدمات بسهولة.</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-6">
            <div class="services-content" data-aos="fade-left" data-aos-duration="900">

              <span class="subtitle">ما الذي نقدمه؟</span>

              <h2>محتوى يساعدك في كل ما يخص الحياة داخل السعودية</h2>

              <p data-aos="fade-right" data-aos-duration="800">
                نوفّر شروحات مبسطة للإجراءات الحكومية، ونصائح للمقيمين والمواطنين، ودلائل متكاملة
                عن العمل، السفر، الإقامة، التعليم، المعاملات الرسمية، والحياة اليومية داخل المملكة.
              </p>

              <div class="mt-4" data-aos="fade-right" data-aos-duration="1100">
                <a href="#" class="btn-consultation">
                  <span>اكتشف المزيد</span>
                  <i class="bi bi-arrow-left"></i>
                </a>
              </div>

            </div>
          </div>

          <div class="col-lg-6">
            <div class="services-image" data-aos="fade-left" data-aos-delay="200">
              <!--<img src="assets/img/services/services-9.webp" alt="خدمات المدونة" class="img-fluid">-->
              <dotlottie-wc
                  src="https://lottie.host/d9cd47a2-04fa-4feb-b710-05231aa12806/OxEgo2EM3p.lottie"
                  autoplay
                  loop
              ></dotlottie-wc>
              <div class="shape-circle"></div>
              <div class="shape-accent"></div>
            </div>
          </div>
        </div>

        <!-- Slider -->
        <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000">
          <div class="col-12">
            <div class="services-slider swiper init-swiper">

              <script type="application/json" class="swiper-config">
                {
                  "slidesPerView": 3,
                  "spaceBetween": 20,
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "navigation": {
                    "nextEl": ".swiper-nav-next",
                    "prevEl": ".swiper-nav-prev"
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 1
                    },
                    "768": {
                      "slidesPerView": 2
                    },
                    "992": {
                      "slidesPerView": 3
                    }
                  }
                }
              </script>

              <div class="swiper-wrapper">

                <!-- #1 -->
                <div class="swiper-slide">
                  <div class="service-card">
                    <div class="icon-box">
                      <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                    <div class="content">
                      <h4><a href="#">شروحات الأنظمة الحكومية</a></h4>
                      <p>نقدم تبسيطًا للأنظمة مثل الإقامة، الجوازات، منصة أبشر، التأشيرات، وتجديد الوثائق.</p>
                      <div class="service-number">01</div>
                    </div>
                  </div>
                </div>

                <!-- #2 -->
                <div class="swiper-slide">
                  <div class="service-card">
                    <div class="icon-box">
                      <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                    <div class="content">
                      <h4><a href="#">نصائح للمقيمين الجدد</a></h4>
                      <p>إرشادات تساعد الوافدين على الاندماج في السعودية، العثور على عمل، وفهم الثقافة المحلية.</p>
                      <div class="service-number">02</div>
                    </div>
                  </div>
                </div>

                <!-- #3 -->
                <div class="swiper-slide">
                  <div class="service-card">
                    <div class="icon-box">
                      <i class="bi bi-shield-check"></i>
                    </div>
                    <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                    <div class="content">
                      <h4><a href="#">دليل الخدمات اليومية</a></h4>
                      <p>كل ما تحتاجه عن الصحة، التعليم، النقل، السكن، البنوك، والمستشفيات داخل المملكة.</p>
                      <div class="service-number">03</div>
                    </div>
                  </div>
                </div>

                <!-- #4 -->
                <div class="swiper-slide">
                  <div class="service-card">
                    <div class="icon-box">
                      <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                    <div class="content">
                      <h4><a href="#">أفكار ونصائح للمواطنين</a></h4>
                      <p>نصائح للمعاملات الحكومية، السفر، الترفيه، والمناسبات المحلية داخل السعودية.</p>
                      <div class="service-number">04</div>
                    </div>
                  </div>
                </div>

                <!-- #5 -->
                <div class="swiper-slide">
                  <div class="service-card">
                    <div class="icon-box">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <a href="#" class="arrow-link"><i class="bi bi-arrow-right"></i></a>
                    <div class="content">
                      <h4><a href="#">إجابات على الأسئلة الشائعة</a></h4>
                      <p>نوفر إجابات واضحة على الأسئلة المتكررة حول العمل، السفر، الإيجار، الضرائب، وغيرها.</p>
                      <div class="service-number">05</div>
                    </div>
                  </div>
                </div>

              </div><!-- /swiper-wrapper -->

            </div>
          </div>
        </div>

        <!-- Slider Navigation -->
        <div class="row">
          <div class="col-12">
            <div class="swiper-navigation">
              <button class="swiper-nav-prev" style="margin-left: 5px;"><i class="bi bi-chevron-right"></i></button>
              <button class="swiper-nav-next"><i class="bi bi-chevron-left"></i></button>
            </div>
          </div>
        </div>

      </div>

    </section>

    <!-- Features Section -->
    <section id="features" class="features section" dir="rtl">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
            <div class="features-content">
              <h2>خدمات مدونات مفيدة للمواطنين والمقيمين في المملكة</h2>
              <p>نوفر لك أحدث المقالات والمعلومات العملية التي تساعدك في حياتك اليومية، نظام العمل، والإجراءات الحكومية في السعودية.</p>

              <div class="main-feature">
                <div class="feature-icon">
                  <i class="bi bi-rocket-takeoff"></i>
                </div>
                <div class="feature-text">
                  <h4>معلومات دقيقة وسريعة</h4>
                  <p>احصل على المقالات والإرشادات بسرعة وبشكل موثوق، لتسهيل حياتك اليومية واتخاذ القرارات الصحيحة.</p>
                </div>
              </div><!-- End Main Feature -->

              <a href="blog.php" class="btn-get-started">اكتشف المدونات الآن</a>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
            <div class="features-grid">
              <div class="feature-card" data-aos="zoom-in" data-aos-delay="400">
                <div class="icon-wrapper">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h5>موثوقية المحتوى</h5>
                <p>جميع المقالات مستندة إلى معلومات رسمية ومصادر موثوقة لتضمن دقة المعلومات المتعلقة بالحياة والعمل في المملكة.</p>
              </div><!-- End Feature Card -->

              <div class="feature-card" data-aos="zoom-in" data-aos-delay="450">
                <div class="icon-wrapper">
                  <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h5>تحديثات مستمرة</h5>
                <p>ابقَ على اطلاع دائم على كل جديد بخصوص القوانين، الإجراءات، والمستجدات التي تهم المواطنين والمقيمين.</p>
              </div><!-- End Feature Card -->

              <div class="feature-card" data-aos="zoom-in" data-aos-delay="500">
                <div class="icon-wrapper">
                  <i class="bi bi-people"></i>
                </div>
                <h5>تواصل ومشاركة</h5>
                <p>شارك خبراتك وتجاربك مع المجتمع عبر التعليقات والمناقشات لتبادل المعرفة والخبرات العملية.</p>
              </div><!-- End Feature Card -->

              <div class="feature-card" data-aos="zoom-in" data-aos-delay="550">
                <div class="icon-wrapper">
                  <i class="bi bi-cloud-arrow-up"></i>
                </div>
                <h5>الوصول من أي جهاز</h5>
                <p>اقرأ المقالات واستفد من المعلومات في أي وقت ومن أي جهاز سواء كنت في المنزل أو العمل.</p>
              </div><!-- End Feature Card -->

              <div class="feature-card" data-aos="zoom-in" data-aos-delay="600">
                <div class="icon-wrapper">
                  <i class="bi bi-gear"></i>
                </div>
                <h5>تصنيفات متنوعة</h5>
                <p>نقدم محتوى مصنف بشكل يسهل الوصول إلى المعلومات حسب الموضوعات المهمة لك، مثل العمل، الإقامة، والخدمات الحكومية.</p>
              </div><!-- End Feature Card -->

              <div class="feature-card" data-aos="zoom-in" data-aos-delay="650">
                <div class="icon-wrapper">
                  <i class="bi bi-headset"></i>
                </div>
                <h5>دعم وإرشاد مستمر</h5>
                <p>فريقنا متاح لتقديم النصائح والإجابة عن أسئلتك حول المقالات والخدمات المتعلقة بحياتك اليومية في المملكة.</p>
              </div><!-- End Feature Card -->
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Features Section -->


    <!-- Clients Section -->
    <!--<section id="clients" class="clients section light-background">

      <div class="container">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide">
              <img src="assets/img/clients/labor-office.webp" class="img-fluid" alt="مكتب العمل">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/absher.webp" class="img-fluid" alt="منصة أبشر">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/gosi.webp" class="img-fluid" alt="الهيئة العامة للتأمينات الاجتماعية">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/municipality.webp" class="img-fluid" alt="البلدية">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/ministry-of-health.webp" class="img-fluid" alt="وزارة الصحة">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/ministry-of-education.webp" class="img-fluid" alt="وزارة التعليم">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/ministry-of-interior.webp" class="img-fluid" alt="وزارة الداخلية">
            </div>
            <div class="swiper-slide">
              <img src="assets/img/clients/naqd.webp" class="img-fluid" alt="منصة نقد">
            </div>
          </div>
        </div>

      </div>

    </section>--><!-- /Clients Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section" dir="rtl">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>قصص نجاح مدوناتنا</h2>
        <p>استعرض كيف ساعدت مدوناتنا المواطنين والمقيمين في المملكة على حل مشكلات حياتهم اليومية وفهم نظام العمل والإجراءات الحكومية.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
            <li data-filter="*" class="filter-active">الكل</li>
            <li data-filter=".filter-visa">الإقامات والتأشيرات</li>
            <li data-filter=".filter-government">الخدمات الحكومية</li>
            <li data-filter=".filter-living">الحياة اليومية</li>
            <li data-filter=".filter-employment">العمل</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300" dir="rtl">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-visa">
              <div class="portfolio-card">
                <div class="portfolio-img">
                  <!--<img src="assets/img/portfolio/visa-help.webp" alt="مساعدة في التأشيرات" class="img-fluid">-->
                  <dotlottie-wc
                    src="https://lottie.host/02b51ca1-fb54-42f7-8946-ae97eda81fb9/syu0t3KKVe.lottie"
                    style="height: 300px"
                    autoplay
                    loop
                  ></dotlottie-wc>
                  <div class="portfolio-overlay">
                    <!--<a href="assets/img/portfolio/visa-help.webp" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>
                    <a href="#" class="portfolio-details-link"><i class="bi bi-link"></i></a>-->
                  </div>
                </div>
                <div class="portfolio-info">
                  <h4>تسهيل إجراءات التأشيرات</h4>
                  <p>ساعدنا العديد من المقيمين على فهم خطوات تجديد الإقامة والحصول على التأشيرات بسهولة.</p>
                  <div class="portfolio-tags">
                    <span>الإقامات</span>
                    <span>التأشيرات</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-government">
              <div class="portfolio-card">
                <div class="portfolio-img">
                  <dotlottie-wc
                    src="https://lottie.host/02b51ca1-fb54-42f7-8946-ae97eda81fb9/syu0t3KKVe.lottie"
                    style="height: 300px"
                    autoplay
                    loop
                  ></dotlottie-wc>
                  <div class="portfolio-overlay">
                    <!--<a href="assets/img/portfolio/absher-guide.webp" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>
                    <a href="#" class="portfolio-details-link"><i class="bi bi-link"></i></a>-->
                  </div>
                </div>
                <div class="portfolio-info">
                  <h4>إرشادات منصة أبشر</h4>
                  <p>قدمنا شروحات واضحة لكيفية استخدام خدمات أبشر للحصول على المستندات الحكومية بسهولة وسرعة.</p>
                  <div class="portfolio-tags">
                    <span>الخدمات الحكومية</span>
                    <span>أبشر</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-living">
              <div class="portfolio-card">
                <div class="portfolio-img">
                  <dotlottie-wc
                    src="https://lottie.host/02b51ca1-fb54-42f7-8946-ae97eda81fb9/syu0t3KKVe.lottie"
                    style="height: 300px"
                    autoplay
                    loop
                  ></dotlottie-wc>
                  <div class="portfolio-overlay">
                    <!--<a href="assets/img/portfolio/daily-life-tips.webp" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>
                    <a href="#" class="portfolio-details-link"><i class="bi bi-link"></i></a>-->
                  </div>
                </div>
                <div class="portfolio-info">
                  <h4>تسهيل الحياة اليومية</h4>
                  <p>قدمنا نصائح عملية حول السكن، المواصلات، والخدمات الأساسية لمساعدة المواطنين والمقيمين.</p>
                  <div class="portfolio-tags">
                    <span>الحياة اليومية</span>
                    <span>خدمات</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-employment">
              <div class="portfolio-card">
                <div class="portfolio-img">
                  <img src="assets/img/logo.png" alt="إرشادات العمل" class="img-fluid">
                  <div class="portfolio-overlay">
                    <!--<a href="assets/img/portfolio/work-guides.webp" class="glightbox portfolio-lightbox"><i class="bi bi-plus"></i></a>
                    <a href="#" class="portfolio-details-link"><i class="bi bi-link"></i></a>-->
                  </div>
                </div>
                <div class="portfolio-info">
                  <h4>إرشادات نظام العمل</h4>
                  <p>ساعدنا العمال وأصحاب الأعمال على فهم حقوقهم وواجباتهم وفق قوانين العمل السعودية.</p>
                  <div class="portfolio-tags">
                    <span>العمل</span>
                    <span>حقوق وواجبات</span>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- End Portfolio Items Container -->

        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
          <a href="#portfolio" class="btn btn-primary">عرض جميع قصص النجاح</a>
        </div>

      </div>

    </section><!-- /Portfolio Section -->


    <!-- Faq Section -->
    <section id="faq" class="faq section" dir="rtl">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-10">

            <div class="faq-tabs mb-5">
              <ul class="nav nav-pills justify-content-center" id="faqTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="work-tab" data-bs-toggle="pill" data-bs-target="#faq-work" type="button" role="tab" aria-controls="faq-work" aria-selected="true">
                    <i style="margin-left:3px" class="bi bi-briefcase me-2"></i>نظام العمل
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="residency-tab" data-bs-toggle="pill" data-bs-target="#faq-residency" type="button" role="tab" aria-controls="faq-residency" aria-selected="false">
                    <i style="margin-left:3px" class="bi bi-person-badge me-2"></i>الإقامات
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="absconding-tab" data-bs-toggle="pill" data-bs-target="#faq-absconding" type="button" role="tab" aria-controls="faq-absconding" aria-selected="false">
                    <i style="margin-left:3px" class="bi bi-exclamation-triangle me-2"></i>بلاغات الهروب
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="navigation-tab" data-bs-toggle="pill" data-bs-target="#faq-navigation" type="button" role="tab" aria-controls="faq-navigation" aria-selected="false">
                    <i style="margin-left:3px" class="bi bi-mouse me-2"></i>تصفح النظام
                  </button>
                </li>
              </ul>
            </div>

            <div class="tab-content" id="faqTabContent">
              
              <!-- Work System FAQs -->
              <div class="tab-pane fade show active" id="faq-work" role="tabpanel" aria-labelledby="work-tab">
                <div class="faq-list">

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3>
                      <span style="margin-left: 5px;" class="num">1</span>
                      <span class="question">ما هي حقوق وواجبات الموظف في السعودية؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نوضح هنا حقوق العاملين مثل الراتب، الإجازات، وساعات العمل، وكذلك الواجبات الأساسية وفق نظام العمل السعودي، مع روابط لمصادر رسمية للتأكد من المعلومات.</p>
                    </div>
                  </div>

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>
                      <span style="margin-left: 5px;" class="num">2</span>
                      <span class="question">كيف يمكن إنهاء عقد العمل أو الاستقالة بطريقة قانونية؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نشرح الخطوات القانونية لإنهاء العقد أو تقديم الاستقالة بما يتوافق مع لوائح وزارة الموارد البشرية والتنمية الاجتماعية في السعودية.</p>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Residency FAQs -->
              <div class="tab-pane fade" id="faq-residency" role="tabpanel" aria-labelledby="residency-tab">
                <div class="faq-list">

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3>
                      <span style="margin-left: 5px;" class="num">1</span>
                      <span class="question">كيف يمكن تجديد الإقامة أو نقل الكفالة؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نشرح بالتفصيل خطوات تجديد الإقامة ونقل الكفالة عبر نظام أبشر، مع الروابط الرسمية وأفضل الممارسات لتجنب التأخير أو المشاكل.</p>
                    </div>
                  </div>

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>
                      <span style="margin-left: 5px;" class="num">2</span>
                      <span class="question">ما هي شروط الإقامة للمواطنين والمقيمين؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نوضح أنواع الإقامات، متطلباتها، وحقوق المقيم لكل نوع وفق الأنظمة السعودية الحديثة.</p>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Absconding FAQs -->
              <div class="tab-pane fade" id="faq-absconding" role="tabpanel" aria-labelledby="absconding-tab">
                <div class="faq-list">

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3>
                      <span style="margin-left: 5px;" class="num">1</span>
                      <span class="question">ماذا أفعل إذا تم تقديم بلاغ هروب ضدي؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نوضح الإجراءات المتاحة للمقيمين لحل بلاغات الهروب، وكيفية التواصل مع صاحب العمل والجهات الرسمية لتسوية الوضع بطريقة قانونية.</p>
                    </div>
                  </div>

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>
                      <span style="margin-left: 5px;" class="num">2</span>
                      <span class="question">كيف يمكن رفع بلاغ هروب على موظف متغيب؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نشرح خطوات رفع البلاغ عبر منصة أبشر للجهات الرسمية، مع نصائح لتوثيق البلاغ بشكل صحيح لتجنب أي مشاكل لاحقة.</p>
                    </div>
                  </div>

                </div>
              </div>

              <!-- System Navigation FAQs -->
              <div class="tab-pane fade" id="faq-navigation" role="tabpanel" aria-labelledby="navigation-tab">
                <div class="faq-list">

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                    <h3>
                      <span style="margin-left: 5px;" class="num">1</span>
                      <span class="question">كيف أستخدم موقعنا للوصول لحل مشكلتي؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نقدم دليلًا خطوة بخطوة لكيفية تصفح موقعنا، البحث عن المقالات والإرشادات، والاستفادة من الخدمات لحل المشكلات المتعلقة بالعمل والإقامات وبلاغات الهروب.</p>
                    </div>
                  </div>

                  <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                    <h3>
                      <span style="margin-left: 5px;" class="num">2</span>
                      <span class="question">هل يمكنني التواصل مباشرة مع فريق الدعم لحل مشكلتي؟</span>
                      <i class="bi bi-plus-lg faq-toggle"></i>
                    </h3>
                    <div class="faq-content">
                      <p>نوضح طرق التواصل مع فريقنا عبر الموقع، البريد الإلكتروني أو نموذج الاتصال، للحصول على مساعدة سريعة وموثوقة.</p>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="faq-cta text-center mt-5" data-aos="fade-up" data-aos-delay="300">
              <p>هل لديك سؤال آخر؟ فريقنا موجود لمساعدتك!</p>
              <a href="#" class="btn btn-primary">تواصل مع الدعم</a>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /Faq Section -->


    <!-- Team Section -->
    <section id="team" class="team section light-background" dir="rtl">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>فريق الدعم</h2>
        <p>فريقنا ملتزم بتقديم المساعدة والإرشاد لكل المقيمين والمواطنين في المملكة العربية السعودية، لضمان حل مشكلاتهم في نظام العمل والإقامات وبلاغات الهروب.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>علي محمد</h4>
                <span class="position">مسئول دعم</span>
                <p>متخصص في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>رقية أحمد</h4>
                <span class="position">مسئولة دعم</span>
                <p>متخصصة في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>يوسف محمد</h4>
                <span class="position">مسئول دعم</span>
                <p>متخصص في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>تهاني عبد الله</h4>
                <span class="position">مسئولة دعم</span>
                <p>متخصصة في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

        <div class="row gy-4 mt-4">

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>طارق علي</h4>
                <span class="position">مسئول دعم</span>
                <p>متخصص في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>ايما علي</h4>
                <span class="position">مسئولة دعم</span>
                <p>متخصصة في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>أحمد اسماعيل</h4>
                <span class="position">مسئول دعم</span>
                <p>متخصص في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="team-card">
              <div class="image-wrapper">
                <img src="assets/img/user_icon.png" alt="Team Member" class="img-fluid">
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i></a>
                  <a href="#"><i class="bi bi-phone"></i></a>
                </div>
              </div>
              <div class="content">
                <h4>سارة محمد</h4>
                <span class="position">مسئولة دعم</span>
                <p>متخصصة في الارشاد والرد على الاستفسارات.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->


    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section" dir="rtl">
        <div class="container section-title">
            <h2>أحدث المدونات</h2>
            <p>مدوناتنا تقدم حلولاً عملية وإرشادات دقيقة لجميع المقيمين والمواطنين في المملكة العربية السعودية، مستندة إلى أنظمة وقوانين الدولة.</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                    <?php if (!empty($blogs)): ?>
                        <?php $featured = $blogs[0]; ?>
                        <article class="featured-post">
                            <div class="featured-img">
                                <img src="dashboard/<?php echo $featured['image_url'] ?: 'assets/img/blog/default.jpg'; ?>" 
                                    alt="" class="img-fluid" loading="lazy">
                                <div class="featured-badge">مميز</div>
                            </div>

                            <div class="featured-content">
                                <div class="post-header">
                                    <span class="category">مدونة</span>
                                    <span class="post-date"><?php echo date("d F Y", strtotime($featured['created_at'])); ?></span>
                                </div>

                                <h2 class="post-title">
                                    <a href="blog-details.php?id=<?php echo $featured['id']; ?>">
                                        <?php echo htmlspecialchars($featured['title']); ?>
                                    </a>
                                </h2>

                                <p class="post-excerpt">
                                    <?php echo mb_substr(strip_tags($featured['content']), 0, 200) . '...'; ?>
                                </p>

                                <div class="post-footer">
                                    <div class="author-info">
                                        <img src="assets/img/user_icon.png" alt="" class="author-avatar">
                                        <div class="author-details">
                                            <span class="author-name">بوابة المعرفة</span>
                                            <span class="read-time">5 دقائق قراءة</span>
                                        </div>
                                    </div>
                                    <a href="blog-details.php?id=<?php echo $featured['id']; ?>" class="read-more">اقرأ المزيد</a>
                                </div>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>


                <div class="col-lg-4">

                      <?php for ($i = 1; $i < count($blogs); $i++): ?>
                          <?php $item = $blogs[$i]; ?>

                          <article class="recent-post" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($i * 80); ?>">
                              <div class="recent-img">
                                  <img src="dashboard/<?php echo $item['image_url'] ?: 'assets/img/blog/default.jpg'; ?>" 
                                      alt="" class="img-fluid" loading="lazy">
                              </div>
                              <div class="recent-content">
                                  <span class="category">مدونة</span>
                                  <h3 class="recent-title">
                                      <a href="blog-details.php?id=<?php echo $item['id']; ?>">
                                          <?php echo htmlspecialchars($item['title']); ?>
                                      </a>
                                  </h3>
                                  <div class="recent-meta">
                                      <span class="author">بوابة المعرفة</span>
                                      <span class="date"><?php echo date("d F Y", strtotime($item['created_at'])); ?></span>
                                  </div>
                              </div>
                          </article>

                      <?php endfor; ?>

                  </div>
              </div>
          </div>
      </section>


    <!-- Contact Section -->
    <section id="contact" class="contact section light-background" dir="rtl">
      <!-- Section Title -->
      <div class="container section-title">
        <h2>تواصل معنا</h2>
        <p>يمكنك التواصل معنا لأي استفسارات أو طلبات دعم، وسنحرص على الرد عليك بأسرع وقت ممكن.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="contact-main-wrapper">
          <div class="map-wrapper">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="contact-content">
            <div class="contact-cards-container" data-aos="fade-up" data-aos-delay="300">
              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="contact-text">
                  <h4>الموقع</h4>
                  <p>الرياض، المملكة العربية السعودية</p>
                </div>
              </div>

              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="contact-text">
                  <h4>البريد الإلكتروني</h4>
                  <p>contact@ma3refah.sa</p>
                </div>
              </div>

              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="contact-text">
                  <h4>الهاتف</h4>
                  <p>+966 557703987</p>
                </div>
              </div>

              <div class="contact-card">
                <div class="icon-box">
                  <i class="bi bi-clock"></i>
                </div>
                <div class="contact-text">
                  <h4>ساعات العمل</h4>
                  <p>الإثنين - الجمعة: 9 صباحاً - 6 مساءً</p>
                </div>
              </div>
            </div>

            <div class="contact-form-container" data-aos="fade-up" data-aos-delay="400">
              <h3>تواصل معنا مباشرة</h3>
              <p>يمكنك إرسال استفسارك أو مشكلتك من خلال النموذج أدناه، وسنرد عليك في أسرع وقت ممكن لتقديم الدعم والمساعدة اللازمة.</p>

              <form action="forms/contact.php" method="post" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="اسمك" required="">
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="البريد الإلكتروني" required="">
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="الموضوع" required="">
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="5" placeholder="رسالتك" required=""></textarea>
                </div>

                <div class="my-3">
                  <div class="loading">جاري الإرسال...</div>
                  <div class="error-message"></div>
                  <div class="sent-message">تم إرسال رسالتك. شكراً لتواصلك معنا!</div>
                </div>

                <div class="form-submit">
                  <button type="submit">إرسال الرسالة</button>
                  <!--<div class="social-links">
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                  </div>-->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section -->


  </main>

  <footer id="footer" class="footer dark-background" dir="rtl">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-content">
            <a href="index.php" class="logo d-flex align-items-center mb-4">
              <dotlottie-wc src="https://lottie.host/ec0b1ca0-0a17-4ad9-96bd-73491a7de386/lcx0UxtbZ4.lottie" style="width: 100px;height: 100px" autoplay loop></dotlottie-wc>
              <h1 class="sitename">بوابة المعرفة</h1><span>.</span>
            </a>
            <p class="mb-4">بوابتنا تقدم خدمات شاملة للمواطنين والمقيمين في المملكة العربية السعودية، مثل متابعة الإقامات، تقديم بلاغات الهروب، الاستعلام عن موظفين وأي خدمات متعلقة بنظام العمل.</p>

            <div class="newsletter-form">
              <h5>اشترك لتصلك آخر التحديثات</h5>
              <form action="forms/newsletter.php" method="post" class="php-email-form">
                <div class="input-group">
                  <input type="email" name="email" class="form-control" placeholder="أدخل بريدك الإلكتروني" required="">
                  <button type="submit" class="btn-subscribe">
                    <i class="bi bi-send"></i>
                  </button>
                </div>
                <div class="loading">جاري الإرسال...</div>
                <div class="error-message"></div>
                <div class="sent-message">شكراً لاشتراكك!</div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>عن البوابة</h4>
            <ul>
              <li><a href="#"><i class="bi bi-chevron-left"></i> من نحن</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> الوظائف</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> الصحافة</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> المدونة</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> تواصل معنا</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>الخدمات</h4>
            <ul>
              <li><a href="#"><i class="bi bi-chevron-left"></i> متابعة الإقامات</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> بلاغات الهروب</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> الاستعلام عن العمالة</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> الدعم القانوني للعمل</a></li>
              <li><a href="#"><i class="bi bi-chevron-left"></i> الاستفسارات العامة</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="footer-contact">
            <h4>تواصل معنا</h4>
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="contact-info">
                <p>الرياض، المملكة العربية السعودية</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-telephone"></i>
              </div>
              <div  class="contact-info">
                <p>+966 557703987</p>
              </div>
            </div>

            <div class="contact-item">
              <div  class="contact-icon">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="contact-info">
                <p>contact@ma3refah.sa</p>
              </div>
            </div>

            <div class="social-links">
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-youtube"></i></a>
              <a href="#"><i class="bi bi-github"></i></a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="copyright">
              <p>© <span>حقوق النشر</span> <strong class="px-1 sitename">بوابة المعرفة</strong> <span>جميع الحقوق محفوظة</span></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="footer-bottom-links">
              <a href="#">سياسة الخصوصية</a>
              <a href="#">شروط الاستخدام</a>
              <a href="#">سياسة الكوكيز</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</php>