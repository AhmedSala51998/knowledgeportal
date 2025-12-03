<?php
// fp_register.php
require_once 'config.php'; // هذا الملف يجب أن يعرف $conn (mysqli)
header('Content-Type: application/json');

// اقرأ JSON
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['status'=>'error','msg'=>'no input']);
    exit;
}

$fingerprint = isset($input['fingerprint']) ? trim($input['fingerprint']) : null;
$page_url = isset($input['page_url']) ? trim($input['page_url']) : '/';
$search_query = isset($input['search_query']) ? trim($input['search_query']) : null;

// فحص بسيط
if (!$fingerprint) {
    echo json_encode(['status'=>'error','msg'=>'no fingerprint']);
    exit;
}

// تأكد من إعداد charset
mysqli_set_charset($conn, 'utf8mb4');

// هل fingerprint موجود؟ خذ visitor_id إن وجد
$sql = "SELECT visitor_id FROM visitors WHERE fingerprint = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $fingerprint);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($res)) {
    $visitor_id = $row['visitor_id'];
} else {
    // أنشئ visitor_id جديد
    $visitor_id = 'v_' . bin2hex(random_bytes(10));
    // لا تدخل زيارة الآن - سنسجلها في خطوة لاحقة إذا لم يكن هناك سابقا
}

// ضع visitor_id كـ cookie من السيرفر (أقوى من JS)، مدة سنة
setcookie('visitor_id', $visitor_id, time() + (365*24*60*60), '/', '', false, true);

// نسجل الزيارة إذا لم تُسجل من قبل لنفس visitor/page
$sql = "SELECT id FROM visitors WHERE visitor_id = ? AND page_url = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $visitor_id, $page_url);
mysqli_stmt_execute($stmt);
$check = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($check) == 0) {
    $ip = (!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : 
          ((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0] : $_SERVER['REMOTE_ADDR']);
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $visit_time = date('Y-m-d H:i:s', strtotime('+3 hours'));

    // لو visitor_id جديد أدرجه مع fingerprint
    if (!isset($row)) {
        $sql = "INSERT INTO visitors (visitor_id, fingerprint, ip_address, user_agent, page_url, visit_time, search_query)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $visitor_id, $fingerprint, $ip, $user_agent, $page_url, $visit_time, $search_query);
        mysqli_stmt_execute($stmt);
    } else {
        // visitor_id موجود لكن لم يسجل لهذه الصفحة → سجل فقط الزيارة و fingerprint إن لم يكن مخزن
        $sql = "INSERT INTO visitors (visitor_id, fingerprint, ip_address, user_agent, page_url, visit_time, search_query)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $visitor_id, $fingerprint, $ip, $user_agent, $page_url, $visit_time, $search_query);
        mysqli_stmt_execute($stmt);
    }
}

// رد بسيط
echo json_encode(['status'=>'ok','visitor_id'=>$visitor_id]);
exit;
