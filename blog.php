<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>المدونات -  بوابة المعرفة</title>
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

<body class="blog-page">

  <header id="header" class="header d-flex align-items-center sticky-top" dir="rtl">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <dotlottie-wc src="https://lottie.host/ec0b1ca0-0a17-4ad9-96bd-73491a7de386/lcx0UxtbZ4.lottie" style="width: 70px;height: 70px" autoplay loop></dotlottie-wc>
        <h1 class="sitename">بوابة المعرفة</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php#hero">الرئيسية</a></li>
          <li><a href="index.php#about">عن الموقع</a></li>
          <li><a href="index.php#services">خدماتنا</a></li>
          <li><a href="index.php#portfolio">بعض أعمالنا</a></li>
          <!--<li><a href="#pricing">Pricing</a></li>-->
          <li><a href="blog.php" class="active">مدوناتنا</a></li>
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
          <li><a href="index.php#contact">تواصل معنا</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="cta-btn" href="index.php#about">ابدأ رحلتك معنا</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" dir="rtl">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">المدونة</h1>
              <p class="mb-0">
                في هذه الصفحة نقدم لك أحدث المقالات والمستجدات المتعلقة بخدمات المقيمين والمواطنين في المملكة العربية السعودية، مثل متابعة الإقامات، بلاغات الهروب، الاستعلام عن العمالة، وأي تحديثات قانونية أو تعليمات رسمية. يمكنك هنا الاطلاع على نصائح، قوانين، ومواد الدولة ذات الصلة لتسهيل حياتك اليومية والتأكد من التزامك بالنظام.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">الرئيسية</a></li>
            <li class="current">المدونات</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Recent Posts Section -->
    <section id="blog-posts" class="blog-posts section" dir="rtl">

      <!-- Section Title -->
      <div class="container section-title">
        <h2>أحدث المدونات</h2>
        <p>مدوناتنا تقدم حلولاً عملية وإرشادات دقيقة لجميع المقيمين والمواطنين في المملكة العربية السعودية، مستندة إلى أنظمة وقوانين الدولة.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <article class="featured-post">
              <div class="featured-img">
                <img src="assets/img/blog/blog-post-7.webp" alt="" class="img-fluid" loading="lazy">
                <div class="featured-badge">مميز</div>
              </div>

              <div class="featured-content">
                <div class="post-header">
                  <a href="blog-details.php" class="category">الخدمات الإلكترونية</a>
                  <span class="post-date">18 ديسمبر 2024</span>
                </div>

                <h2 class="post-title">
                  <a href="blog-details.php">كيفية استخدام نظام أبشر لإنجاز معاملات الإقامة والعمل</a>
                </h2>

                <p class="post-excerpt">
                  دليل شامل لكيفية تسجيل الدخول إلى منصة أبشر، الاستفادة من الخدمات المختلفة مثل تجديد الإقامات، إصدار التأشيرات، وبلاغات الهروب، وفقاً للأنظمة والمواد الرسمية في المملكة (نظام العمل السعودي ونظام الإقامة). يشرح المقال خطوات عملية مع صور توضيحية لتسهيل تجربة المستخدم.
                </p>

                <div class="post-footer">
                  <div class="author-info">
                    <img src="assets/img/user_icon.png" alt="" class="author-avatar">
                    <div class="author-details">
                      <span class="author-name">فيصل المطيري</span>
                      <span class="read-time">5 دقائق قراءة</span>
                    </div>
                  </div>
                  <a href="blog-details.php" class="read-more">اقرأ المزيد</a>
                </div>
              </div>
            </article>

            <article class="featured-post" data-aos="fade-up" data-aos-delay="400">
              <div class="featured-img">
                <img src="assets/img/blog/blog-post-3.webp" alt="" class="img-fluid" loading="lazy">
                <div class="featured-badge">مميز</div>
              </div>

              <div class="featured-content">
                <div class="post-header">
                  <a href="blog-details.php" class="category">نظام العمل</a>
                  <span class="post-date">16 ديسمبر 2024</span>
                </div>

                <h2 class="post-title">
                  <a href="blog-details.php">الحقوق والواجبات للمقيمين وفق قانون العمل السعودي</a>
                </h2>

                <p class="post-excerpt">
                  مقال يشرح بالتفصيل حقوق العمال الوافدة، ساعات العمل، الإجازات، وطريقة التعامل مع حالات المخالفة، استناداً إلى نظام العمل واللوائح التنفيذية في المملكة. يشمل أيضًا نصائح عملية لتقديم بلاغات وحل المشكلات عبر منصات مثل مكتب العمل وأبشر.
                </p>

                <div class="post-footer">
                  <div class="author-info">
                    <img src="assets/img/user_icon.png" alt="" class="author-avatar">
                    <div class="author-details">
                      <span class="author-name">فيصل المطيري</span>
                      <span class="read-time">7 دقائق قراءة</span>
                    </div>
                  </div>
                  <a href="blog-details.php" class="read-more">اقرأ المزيد</a>
                </div>
              </div>
            </article>
          </div><!-- End featured post -->

          <div class="col-lg-4">

            <article class="recent-post" data-aos="fade-up" data-aos-delay="200">
              <div class="recent-img">
                <img src="assets/img/blog/blog-post-5.webp" alt="" class="img-fluid" loading="lazy">
              </div>
              <div class="recent-content">
                <a href="blog-details.php" class="category">الإقامات</a>
                <h3 class="recent-title">
                  <a href="blog-details.php">تجديد الإقامة في السعودية: خطوات وشروط واضحة</a>
                </h3>
                <div class="recent-meta">
                  <span class="author">بقلم فيصل المطيري</span>
                  <span class="date">15 ديسمبر 2024</span>
                </div>
              </div>
            </article><!-- End recent post -->

            <article class="recent-post" data-aos="fade-up" data-aos-delay="250">
              <div class="recent-img">
                <img src="assets/img/blog/blog-post-9.webp" alt="" class="img-fluid" loading="lazy">
              </div>
              <div class="recent-content">
                <a href="blog-details.php" class="category">مكتب العمل</a>
                <h3 class="recent-title">
                  <a href="blog-details.php">كيفية تقديم بلاغات الهروب وحماية حقوقك كعامل</a>
                </h3>
                <div class="recent-meta">
                  <span class="author">بقلم فيصل المطيري</span>
                  <span class="date">12 ديسمبر 2024</span>
                </div>
              </div>
            </article><!-- End recent post -->

            <article class="recent-post" data-aos="fade-up" data-aos-delay="300">
              <div class="recent-img">
                <img src="assets/img/blog/blog-post-6.webp" alt="" class="img-fluid" loading="lazy">
              </div>
              <div class="recent-content">
                <a href="blog-details.php" class="category">الخدمات الإلكترونية</a>
                <h3 class="recent-title">
                  <a href="blog-details.php">استعراض خطوات حجز المواعيد عبر منصة وزارة الموارد البشرية</a>
                </h3>
                <div class="recent-meta">
                  <span class="author">بقلم فيصل المطيري</span>
                  <span class="date">10 ديسمبر 2024</span>
                </div>
              </div>
            </article><!-- End recent post -->

            <article class="recent-post" data-aos="fade-up" data-aos-delay="350">
              <div class="recent-img">
                <img src="assets/img/blog/blog-post-8.webp" alt="" class="img-fluid" loading="lazy">
              </div>
              <div class="recent-content">
                <a href="blog-details.php" class="category">التقنية</a>
                <h3 class="recent-title">
                  <a href="blog-details.php">تطبيقات الهواتف لمتابعة الخدمات الحكومية بسهولة</a>
                </h3>
                <div class="recent-meta">
                  <span class="author">بقلم فيصل المطيري</span>
                  <span class="date">8 ديسمبر 2024</span>
                </div>
              </div>
            </article><!-- End recent post -->

          </div>

        </div>

      </div>

    </section><!-- /Recent Posts Section -->

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

      <div class="container">
        <div class="d-flex justify-content-center">
          <ul>
            <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#" class="active">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li>...</li>
            <li><a href="#">10</a></li>
            <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>

    </section><!-- /Blog Pagination Section -->

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