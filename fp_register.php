<?php
require_once 'dashboard/config.php'; // يجب أن يعرف $conn

header('Content-Type: application/json');

// قراءة JSON
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['status'=>'error','msg'=>'no input']);
    exit;
}

$fingerprint = trim($input['fingerprint'] ?? '');
$page_url = trim($input['page_url'] ?? '/');
$search_query = trim($input['search_query'] ?? '');

if (!$fingerprint) {
    echo json_encode(['status'=>'error','msg'=>'no fingerprint']);
    exit;
}

// إعداد charset
mysqli_set_charset($conn, 'utf8mb4');

// جلب visitor_id إن وجد
$sql = "SELECT visitor_id FROM visitors WHERE fingerprint = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $fingerprint);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($res)) {
    $visitor_id = $row['visitor_id'];
} else {
    $visitor_id = 'v_' . bin2hex(random_bytes(10));
}

// ضع cookie من السيرفر (مدة سنة)
setcookie('visitor_id', $visitor_id, time() + (365*24*60*60), '/', '', false, true);

// سجل الزيارة إذا لم تُسجل من قبل لنفس visitor/page
$sql = "SELECT id FROM visitors WHERE visitor_id = ? AND page_url = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $visitor_id, $page_url);
mysqli_stmt_execute($stmt);
$check = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($check) == 0) {
    $ip = $_SERVER['HTTP_CLIENT_IP'] ?? ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']);
    if (strpos($ip, ',') !== false) $ip = explode(',', $ip)[0];
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $visit_time = date('Y-m-d H:i:s', strtotime('+3 hours'));

    $sql = "INSERT INTO visitors (visitor_id, fingerprint, ip_address, user_agent, page_url, visit_time, search_query)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $visitor_id, $fingerprint, $ip, $user_agent, $page_url, $visit_time, $search_query);
    mysqli_stmt_execute($stmt);
}

// رد بسيط
echo json_encode(['status'=>'ok','visitor_id'=>$visitor_id]);
exit;
