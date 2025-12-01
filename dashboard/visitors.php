<?php
require_once 'config.php';
requireAdmin();

// جلب الزوار
$sql = "SELECT * FROM visitors ORDER BY visit_time DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سجل الزوار - لوحة التحكم</title>
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: white;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 5px;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        .sidebar .nav-link i {
            margin-left: 10px;
        }

        .top-navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px 0;
        }

        .content {
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="p-3 text-center">
                <h4><i class="fas fa-blog"></i> لوحة التحكم</h4>
            </div>
            <nav class="nav flex-column p-3">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> الرئيسية</a>
                <a class="nav-link" href="systems.php"><i class="fas fa-gavel"></i> الأنظمة والقوانين</a>
                <a class="nav-link" href="blogs.php"><i class="fas fa-newspaper"></i> المدونات</a>
                <a class="nav-link" href="users.php"><i class="fas fa-users"></i> المستخدمين والصلاحيات</a>
                <a class="nav-link" href="entities.php"><i class="fas fa-building"></i> الجهات المعنية</a>
                <a class="nav-link" href="usages.php"><i class="fas fa-cogs"></i> الاستخدامات</a>
                <a class="nav-link active" href="visitors.php"><i class="fas fa-users"></i> الزوار</a>
                <a class="nav-link" href="index.php?logout=true"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div class="d-flex justify-content-between align-items-center px-4">
                    <h2>سجل الزوار</h2>
                    <div class="user-info">
                        <span>مرحباً، <?php echo $_SESSION['username']; ?></span>
                        <img src="https://picsum.photos/seed/user<?php echo $_SESSION['user_id']; ?>/40/40.jpg" alt="User Avatar">
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <h5 class="mb-3">
                    👤 عدد الزوار الفريدين: 
                    <span class="badge bg-success">
                        <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT ip_address FROM visitors")); ?>
                    </span>
                </h5>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>IP الزائر</th>
                                    <th>المتصفح</th>
                                    <th>الصفحة</th>
                                    <th>وقت الزيارة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['ip_address']; ?></td>
                                        <td><?php echo mb_substr($row['user_agent'], 0, 30) . "..."; ?></td>
                                        <td><?php echo $row['page_url']; ?></td>
                                        <td><?php echo date('Y/m/d h:i A', strtotime($row['visit_time'])); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">لا توجد زيارات حتى الآن.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
