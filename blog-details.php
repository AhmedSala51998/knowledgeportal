<?php
require_once 'dashboard/config.php';
require_once 'dashboard/track_visit.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset("utf8mb4");

if (!isset($_GET['id'])) {
    die("خطأ: لم يتم إرسال رقم المدونة.");
}

$blog_id = intval($_GET['id']);

$sql = "SELECT * FROM blogs WHERE id = $blog_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("لم يتم العثور على هذه المدونة.");
}

$blog = $result->fetch_assoc();

function getReferenceSystemById($id){
    global $conn;
    return $conn->query("SELECT * FROM systems WHERE id = $id")->fetch_assoc();
}

function getReferenceArticleById($id){
    global $conn;
    return $conn->query("SELECT * FROM articles WHERE id = $id")->fetch_assoc();
}

function getReferenceSectionById($id){
    global $conn;
    return $conn->query("SELECT * FROM sections WHERE id = $id")->fetch_assoc();
}

function getReferenceSubSectionById($id){
    global $conn;
    return $conn->query("SELECT * FROM sections WHERE id = $id")->fetch_assoc();
}

// تجميع هيكل الاستدلال للمدونة
$hierarchy = [];

$system_ids = !empty($blog['reference_system_id']) ? explode(',', $blog['reference_system_id']) : [];
$article_ids = !empty($blog['reference_article_id']) ? explode(',', $blog['reference_article_id']) : [];
$section_ids = !empty($blog['reference_section_id']) ? explode(',', $blog['reference_section_id']) : [];
$subsection_ids = !empty($blog['reference_subsection_id']) ? explode(',', $blog['reference_subsection_id']) : [];

foreach ($system_ids as $sys_id) {

    $sys = getReferenceSystemById($sys_id);
    if (!$sys) continue;

    $hierarchy[$sys_id] = [
        'title' => $sys['title'],
        'articles' => []
    ];

    foreach ($article_ids as $art_id) {
        $art = getReferenceArticleById($art_id);
        if ($art && $art['system_id'] == $sys_id) {

            $hierarchy[$sys_id]['articles'][$art_id] = [
                'title' => $art['title'],
                'sections' => []
            ];

            foreach ($section_ids as $sec_id) {
                $sec = getReferenceSectionById($sec_id);
                if ($sec && $sec['article_id'] == $art_id) {

                    $hierarchy[$sys_id]['articles'][$art_id]['sections'][$sec_id] = [
                        'title' => $sec['title'],
                        'subsections' => []
                    ];

                    foreach ($subsection_ids as $sub_id) {
                        $sub = getReferenceSubSectionById($sub_id);
                        if ($sub && $sub['parent_id'] == $sec_id) {
                            $hierarchy[$sys_id]['articles'][$art_id]['sections'][$sec_id]['subsections'][$sub_id] = $sub['title'];
                        }
                    }
                }
            }
        }
    }
}



// جلب آخر 5 مدونات ما عدا الحالية
$recent_stmt = $conn->prepare("SELECT * FROM blogs WHERE id != ? ORDER BY created_at DESC LIMIT 5");
$recent_stmt->bind_param("i", $blog_id);
$recent_stmt->execute();
$recent_posts = $recent_stmt->get_result();

?>
<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>تفاصيل المدونة -  بوابة المعرفة</title>
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

    <style>
    .tree {
        list-style: none;
        padding-right: 0;
    }

    .tree li {
        margin-bottom: 8px;
        position: relative;
    }

    .tree li a {
        display: block;
        padding: 8px 12px;
        background: #f6f6f6;
        border-radius: 8px;
        font-weight: 600;
        color: #444;
        text-decoration: none;
        transition: 0.2s;
    }

    .tree li a:hover {
        background: #ffb85c;
        color: #fff;
    }

    .tree ul {
        margin-right: 18px;
        border-right: 2px dashed #ccc;
        padding-right: 12px;
        margin-top: 8px;
    }

    .tree li::before {
        content: "•";
        font-size: 20px;
        color: #ff8800;
        margin-left: 6px;
    }
  </style>

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
              في هذه الصفحة نقدم لك أحدث المقالات والمستجدات المتعلقة بخدمات المقيمين والمواطنين في المملكة العربية السعودية، مثل متابعة الإقامات، بلاغات الهروب، الاستعلام عن العمالة، وتجديد التأشيرات. نغطي أيضًا كل التحديثات القانونية والإجراءات الرسمية وفق أنظمة وزارة الموارد البشرية والتنمية الاجتماعية ووزارة الداخلية. يمكنك هنا الاطلاع على نصائح عملية، خطوات تفصيلية، قوانين ومواد الدولة ذات الصلة، بالإضافة إلى إرشادات حول كيفية استخدام الخدمات الرقمية الرسمية لتسهيل حياتك اليومية وضمان التزامك بالنظام.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">الرئيسية</a></li>
            <li class="current">تفاصيل المدونة</li>
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

    <div class="container" dir="rtl">
      <div class="row">

        <?php if ($blog): ?>
        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <?php if (!empty($blog['image_url'])): ?>

                      <img src="dashboard/<?php echo $blog['image_url']; ?>" 
                          alt="<?php echo htmlspecialchars($blog['title']); ?>" class="img-fluid" loading="lazy">

                  <?php else: ?>

                      <dotlottie-wc
                          src="https://lottie.host/4ca8fb55-0007-4af3-b062-c0c7bd96b2e7/wtRDuQLkqL.lottie"
                          style="height:400px;width:auto"
                          autoplay
                          loop>
                      </dotlottie-wc>

                  <?php endif; ?>
                </div>

                <h2 class="title"><?php echo htmlspecialchars($blog['title']); ?></h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i style="margin-left:5px" class="bi bi-person"></i> <a href="blog-details.php?id=<?php $blog_id; ?>">بوابة المعرفة</a></li>
                    <li class="d-flex align-items-center"><i style="margin-left:5px" class="bi bi-clock"></i> <a href="blog-details.php?id=<?php $blog_id; ?>><time datetime="<?php echo date('Y-m-d', strtotime($blog['created_at'])); ?>"> <?php echo getArabicDate($blog['created_at']); ?></time></a></li>
                  </ul>
                </div><!-- End meta top -->

                <div class="content">
                  <?php
                    $clean = strip_tags($blog['content']);
                    $clean = html_entity_decode($clean, ENT_QUOTES, 'UTF-8');
                    $clean = trim($clean);
                    echo nl2br($clean);
                  ?>

                  <blockquote>
                    <p>
                      من المهم دائمًا متابعة التحديثات الرسمية لتجنب أي مخالفات وضمان استمرارية الإقامة القانونية والإجراءات النظامية لجميع المقيمين.
                    </p>
                  </blockquote>

                </div><!-- End post content -->

                <div class="meta-bottom">
                  <i class="bi bi-folder"></i>
                  <ul class="cats">
                    <li><a href="blog.php?search=خدمات المقيمين والمواطنين">خدمات المقيمين والمواطنين</a></li>
                  </ul>

                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="blog.php?search=الإقامة">الإقامة</a></li>
                    <li><a href="blog.php?search=العمالة">العمالة</a></li>
                    <li><a href="blog.php?search=القوانين">القوانين</a></li>
                    <li><a href="blog.php?search=أبشر">أبشر</a></li>
                    <li><a href="blog.php?search=النظام السعودي">النظام السعودي</a></li>
                  </ul>
                </div><!-- End meta bottom -->

              </article>

            </div>
          </section><!-- /Blog Details Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Blog Author Widget -->
            <div class="blog-author-widget widget-item">
              <div class="d-flex flex-column align-items-center">
                <div class="d-flex align-items-center w-100">
                  <img src="assets/img/user_icon.png" class="rounded-circle flex-shrink-0" alt="">
                  <div style="margin-right: 10px;">
                    <h4>بوابة المعرفة</h4>
                    <!--<div class="social-links">
                      <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                      <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                      <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                      <a href="https://linkedin.com/#"><i class="biu bi-linkedin"></i></a>
                    </div>-->
                  </div>
                </div>
                <p>
                  مختصة في تقديم المعلومات والإرشادات القانونية والخدمية للمقيمين والمواطنين، لضمان فهم واضح لجميع الإجراءات الرسمية والخدمات الرقمية في المملكة العربية السعودية.
                </p>
              </div>
            </div><!--/Blog Author Widget -->

            <div class="tags-widget widget-item">
                <h3 class="widget-title">الاستدلال من الأنظمة والقوانين</h3>

                <?php if (!empty($hierarchy)): ?>
                    <ul class="tree mt-3">

                        <?php foreach ($hierarchy as $system): ?>
                            <li>
                                <a><?php echo htmlspecialchars($system['title']); ?></a>

                                <?php if (!empty($system['articles'])): ?>
                                    <ul>

                                        <?php foreach ($system['articles'] as $article): ?>
                                            <li>
                                                <a><?php echo htmlspecialchars($article['title']); ?></a>

                                                <?php if (!empty($article['sections'])): ?>
                                                    <ul>

                                                        <?php foreach ($article['sections'] as $section): ?>
                                                            <li>
                                                                <a><?php echo htmlspecialchars($section['title']); ?></a>

                                                                <?php if (!empty($section['subsections'])): ?>
                                                                    <ul>
                                                                        <?php foreach ($section['subsections'] as $sub): ?>
                                                                            <li>
                                                                                <a><?php echo htmlspecialchars($sub); ?></a>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                <?php endif; ?>

                                                            </li>
                                                        <?php endforeach; ?>

                                                    </ul>
                                                <?php endif; ?>

                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                <?php endif; ?>

                            </li>
                        <?php endforeach; ?>

                    </ul>

                <?php else: ?>
                    <p class="text-muted">لا توجد روابط قانونية مرتبطة بهذه المدونة.</p>
                <?php endif; ?>

            </div>


            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">
              <h3 class="widget-title">أحدث المقالات</h3>

              <?php while ($post = $recent_posts->fetch_assoc()): ?>
                <div class="post-item">

                      <?php if (!empty($post['image_url'])): ?>

                          <img src="dashboard/<?php echo $post['image_url']; ?>" 
                            alt="<?php echo htmlspecialchars($post['title']); ?>" 
                            class="flex-shrink-0">

                      <?php else: ?>

                          <dotlottie-wc
                              src="https://lottie.host/4ca8fb55-0007-4af3-b062-c0c7bd96b2e7/wtRDuQLkqL.lottie"
                              style="width:100px;height:100px"
                              autoplay
                              loop>
                          </dotlottie-wc>

                      <?php endif; ?>

                  <div style="margin-right: 10px;">
                    <h4>
                      <a href="blog-details.php?id=<?php echo $post['id']; ?>">
                        <?php echo htmlspecialchars($post['title']); ?>
                      </a>
                    </h4>

                    <time datetime="<?php echo date('Y-m-d', strtotime($post['created_at'])); ?>">
                      <?php echo getArabicDate($blog['created_at']); ?>
                    </time>
                  </div>
                </div>
              <?php endwhile; ?>

            </div>

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">
              <h3 class="widget-title">مدونات تهمك</h3>
              <ul>
                <li><a href="blog.php?search=إقامة">إقامة</a></li>
                <li><a href="blog.php?search=عمالة">عمالة</a></li>
                <li><a href="blog.php?search=قوانين">قوانين</a></li>
                <li><a href="blog.php?search=خدمات رقمية">خدمات رقمية</a></li>
                <li><a href="blog.php?search=أبشر">أبشر</a></li>
                <li><a href="blog.php?search=نصائح">نصائح</a></li>
              </ul>
            </div><!--/Tags Widget -->

          </div>

        </div>
        <?php else: ?>

        <div class="alert alert-danger mt-3">
          عذراً، لم يتم العثور على هذه المدونة.
        </div>

        <?php endif; ?>

      </div>
    </div>

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

</body>

</php>