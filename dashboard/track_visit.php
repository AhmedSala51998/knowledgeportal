<?php
require_once 'config.php';

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip = getUserIP();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$page_url = $_SERVER['REQUEST_URI']; 

// 🔍 استخراج كلمة البحث من الموقع نفسه
$search_query = isset($_GET['search']) ? trim($_GET['search']) : null;

// تأكد أن الـ IP لم يتم تسجيله مسبقاً مع نفس الصفحة
$sql = "SELECT * FROM visitors WHERE ip_address = ? AND page_url = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $ip, $page_url);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {

    // إضافة 3 ساعات للوقت
    $visit_time = date('Y-m-d H:i:s', strtotime('+3 hours'));

    // إدراج الزيارة
    $sql = "INSERT INTO visitors (ip_address, user_agent, page_url, visit_time, search_query)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $ip, $user_agent, $page_url, $visit_time, $search_query);
    mysqli_stmt_execute($stmt);
}
?>
