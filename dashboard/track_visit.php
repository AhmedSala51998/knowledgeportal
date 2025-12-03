<?php
require_once 'config.php';

/*
|--------------------------------------------------------------------------
| إنشاء معرف ثابت لكل زائر (Cookie)
|--------------------------------------------------------------------------
*/

if (!isset($_COOKIE['visitor_id'])) {
    $visitor_id = bin2hex(random_bytes(20)); // ID ثابت
    setcookie("visitor_id", $visitor_id, time() + (365 * 24 * 60 * 60), "/"); // سنة كاملة
} else {
    $visitor_id = $_COOKIE['visitor_id'];
}

/*
|--------------------------------------------------------------------------
| الحصول على IP المستخدم
|--------------------------------------------------------------------------
*/
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
$search_query = isset($_GET['search']) ? trim($_GET['search']) : null;

/*
|--------------------------------------------------------------------------
| تسجيل الزيارة مرة واحدة فقط لكل زائر لكل صفحة
|--------------------------------------------------------------------------
*/

$sql = "SELECT * FROM visitors WHERE visitor_id = ? AND page_url = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $visitor_id, $page_url);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// لو مفيش زيارة لنفس الصفحة من نفس الجهاز → نسجلها
if (mysqli_num_rows($result) == 0) {

    $visit_time = date('Y-m-d H:i:s', strtotime('+3 hours'));

    $sql = "INSERT INTO visitors (visitor_id, ip_address, user_agent, page_url, visit_time, search_query)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $visitor_id, $ip, $user_agent, $page_url, $visit_time, $search_query);
    mysqli_stmt_execute($stmt);
}
?>
