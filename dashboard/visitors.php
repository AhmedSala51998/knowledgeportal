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
    <title>سجل الزوار</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body>
<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>سجل الزوار</h4>
        </div>

        <div class="card-body">

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
                                <td><?php echo $row['visit_time']; ?></td>
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
</body>
</html>
