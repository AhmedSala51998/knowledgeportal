<?php
require_once 'dashboard/config.php';

// الاتصال
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset("utf8mb4");

$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

// جلب آخر 5 مدونات
//$blogs_query = "SELECT * FROM blogs ORDER BY created_at DESC";
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search) {

    // إجمالي النتائج
    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM blogs 
                                  WHERE title LIKE ? OR content LIKE ?");
    $like = "%".$search."%";
    $stmt_count->bind_param("ss", $like, $like);
    $stmt_count->execute();
    $stmt_count->bind_result($total_blogs);
    $stmt_count->fetch();
    $stmt_count->close();

    // جلب البيانات
    $stmt = $conn->prepare("SELECT * FROM blogs 
                            WHERE title LIKE ? OR content LIKE ?
                            ORDER BY created_at DESC
                            LIMIT ?, ?");
    $stmt->bind_param("ssii", $like, $like, $start, $per_page);
    $stmt->execute();
    $blogs_result = $stmt->get_result();

} else {

    // إجمالي المدونات
    $count = $conn->query("SELECT COUNT(*) AS c FROM blogs")->fetch_assoc();
    $total_blogs = $count['c'];

    // جلب البيانات
    $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY created_at DESC LIMIT ?, ?");
    $stmt->bind_param("ii", $start, $per_page);
    $stmt->execute();
    $blogs_result = $stmt->get_result();
}

$total_pages = ceil($total_blogs / $per_page);

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

      <a class="cta-btn" href="index.php#recent-posts">ابدأ رحلتك معنا</a>

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

    <div class="container my-5" dir="rtl">
        <form method="GET" action="blog.php" class="input-group">
            <input style="border-radius:0 5px 5px 0" type="text" name="search" class="form-control" placeholder="ابحث في المدونات..." 
                  value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required>
            <button class="btn" type="submit" 
                    style="background: linear-gradient(45deg, #ff8800, #ff6a00); color:#fff; border:0;border-radius:5px 0 0 5px">
                <i class="bi bi-search"></i> بحث
            </button>
        </form>
    </div>

    <!-- Recent Posts Section -->
 <!-- Recent Posts Section -->
  <section id="blog-posts" class="blog-posts section" dir="rtl">
      <?php if (!empty($blogs)): ?>
        <div class="container section-title">
            <h2>أحدث المدونات</h2>
            <p>مدوناتنا تقدم حلولاً عملية وإرشادات دقيقة لجميع المقيمين والمواطنين في المملكة العربية السعودية، مستندة إلى أنظمة وقوانين الدولة.</p>
        </div>
      <?php endif; ?>
      <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row">
              <?php if (empty($blogs)): ?>

              <div style="
                  height: 60vh;
                  display: flex;
                  flex-direction: column;
                  justify-content: center;
                  align-items: center;
                  text-align: center;
              " dir="rtl">

                  <dotlottie-wc 
                      src="https://lottie.host/6d7d98df-8530-40e5-a812-a9fcf1bb6178/M2mgko81So.lottie" 
                      style="width: 400px; height: 400px"
                      autoplay loop>
                  </dotlottie-wc>

                  <h3 class="mt-3" style="font-weight:600;">
                      <?php if ($search): ?>
                          لا توجد نتائج مطابقة لبحثك:  
                          <span style="color:#ff8800;"><?php echo htmlspecialchars($search); ?></span>
                      <?php else: ?>
                          لا توجد مدونات حالياً.
                      <?php endif; ?>
                  </h3>

              </div>

              <?php endif; ?>
              <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                  <?php if (!empty($blogs)): ?>
                      <?php $featured = $blogs[0]; ?>
                      <article class="featured-post">
                          <div class="featured-img">
                              <?php if (!empty($featured['image_url'])): ?>

                                  <img src="dashboard/<?php echo $featured['image_url']; ?>" 
                                      alt="" class="img-fluid" loading="lazy">

                              <?php else: ?>

                                  <dotlottie-wc
                                      src="https://lottie.host/4ca8fb55-0007-4af3-b062-c0c7bd96b2e7/wtRDuQLkqL.lottie"
                                      class="featured-media"
                                      autoplay
                                      loop>
                                  </dotlottie-wc>

                              <?php endif; ?>
                              <div class="featured-badge">مميز</div>
                          </div>

                          <div class="featured-content">
                              <div class="post-header">
                                  <span class="category">مدونة</span>
                                  <span class="post-date"><?php echo getArabicDate($featured['created_at']); ?></span>
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
                              <?php if (!empty($item['image_url'])): ?>

                                  <img src="dashboard/<?php echo $item['image_url']; ?>" 
                                      alt="" class="img-fluid" loading="lazy">

                              <?php else: ?>

                                  <dotlottie-wc
                                      src="https://lottie.host/4ca8fb55-0007-4af3-b062-c0c7bd96b2e7/wtRDuQLkqL.lottie"
                                      class="recent-media"
                                      autoplay
                                      loop>
                                  </dotlottie-wc>

                              <?php endif; ?>
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
                                    <span class="date"><?php echo getArabicDate($item['created_at']); ?></span>
                                </div>
                            </div>
                        </article>

                    <?php endfor; ?>

                </div>
            </div>
        </div>
    </section>


  <!-- Contact Section -->

    <?php if ($total_pages > 1): ?>
      <section id="blog-pagination" class="blog-pagination section">
          <div class="container">
              <div class="d-flex justify-content-center">
                  <ul>

                      <!-- Previous -->
                      <li>
                          <?php if ($page > 1): ?>
                              <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">
                                  <i class="bi bi-chevron-left"></i>
                              </a>
                          <?php else: ?>
                              <span class="disabled"><i class="bi bi-chevron-left"></i></span>
                          <?php endif; ?>
                      </li>

                      <!-- Page Numbers -->
                      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                          <li>
                              <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>" 
                                class="<?= ($i == $page) ? 'active' : '' ?>">
                                  <?= $i ?>
                              </a>
                          </li>
                      <?php endfor; ?>

                      <!-- Next -->
                      <li>
                          <?php if ($page < $total_pages): ?>
                              <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">
                                  <i class="bi bi-chevron-right"></i>
                              </a>
                          <?php else: ?>
                              <span class="disabled"><i class="bi bi-chevron-right"></i></span>
                          <?php endif; ?>
                      </li>

                  </ul>
              </div>
          </div>
      </section>
      <?php endif; ?>

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
              <li><a href="index.php#about"><i class="bi bi-chevron-left"></i> من نحن</a></li>
              <li><a href="blog.php?search=الوظائف"><i class="bi bi-chevron-left"></i> الوظائف</a></li>
              <li><a href="blog.php?search=الصحافة"><i class="bi bi-chevron-left"></i> الصحافة</a></li>
              <li><a href="blog.php?search=المدونة"><i class="bi bi-chevron-left"></i> المدونة</a></li>
              <li><a href="index.php#contact"><i class="bi bi-chevron-left"></i> تواصل معنا</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>الخدمات</h4>
            <ul>
              <li><a href="blog.php?search=متابعة الإقامات"><i class="bi bi-chevron-left"></i> متابعة الإقامات</a></li>
              <li><a href="blog.php?search=بلاغات الهروب"><i class="bi bi-chevron-left"></i> بلاغات الهروب</a></li>
              <li><a href="blog.php?search=الاستعلام عن العمالة"><i class="bi bi-chevron-left"></i> الاستعلام عن العمالة</a></li>
              <li><a href="blog.php?search=الدعم القانوني للعمل"><i class="bi bi-chevron-left"></i> الدعم القانوني للعمل</a></li>
              <li><a href="blog.php?search=الاستفسارات العامة"><i class="bi bi-chevron-left"></i> الاستفسارات العامة</a></li>
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
  <script src="dashboard/js/fingerprint.js"></script>

</body>

</php>