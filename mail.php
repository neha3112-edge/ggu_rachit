<?php


ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-error.log');
error_reporting(E_ALL);



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'response' => 'error',
        'message'  => 'POST is required'
    ]);
    exit;
}

/* ===============================
   1. COLLECT FORM DATA
================================ */
$full_name     = $_POST['full_name'] ?? '';
$email         = $_POST['email'] ?? '';
$phone         = $_POST['phone'] ?? '';
$course        = $_POST['course'] ?? '';
$state         = $_POST['state'] ?? '';
$source        = $_POST['source'] ?? '';
$sub_source    = $_POST['sub_source'] ?? '';
$utm_source    = $_POST['utm_source'] ?? '';
$utm_campaign  = $_POST['utm_campaign'] ?? '';
$utm_medium    = $_POST['utm_medium'] ?? '';
$utm_term      = $_POST['utm_term'] ?? '';
$page_url      = $_POST['page_url'] ?? '';
$show_brochure = $_POST['show_brochure'] ?? 'no';

/* ===============================
   2. PREPARE COMMON DATA
================================ */
$lead_data = [
    'full_name'    => $full_name,
    'name'         => $full_name, // for CRM
    'email'        => $email,
    'phone'        => $phone,
    'course'       => $course,
    'state'        => $state,
    'source'       => $source,
    'sub_source'   => $sub_source,
    'utm_source'   => $utm_source,
    'utm_campaign' => $utm_campaign,
    'utm_medium'   => $utm_medium,
    'utm_term'     => $utm_term,
    'page_url'     => $page_url
];






/* ===============================
   3. SEND TO CRM (JSON + LOGGING)
================================ */

$crm_url = 'https://api.crm.mysode.com/api/lead/apicreated';
$crm_api_key = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';

$log_file = __DIR__ . '/crm.log';

$payload = json_encode($lead_data);

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $crm_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => [
        "x-api-key: {$crm_api_key}",
        "Content-Type: application/json",
        "Accept: application/json"
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15
]);

$crm_response = curl_exec($ch);
$http_code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error  = curl_error($ch);

curl_close($ch);

/* ===== LOG EVERYTHING ===== */
$log_entry = "\n============================\n";
$log_entry .= "Date: " . date('Y-m-d H:i:s') . "\n";
$log_entry .= "Request URL: {$crm_url}\n";
$log_entry .= "HTTP Code: {$http_code}\n";
$log_entry .= "Payload:\n{$payload}\n";
$log_entry .= "Response:\n{$crm_response}\n";

if ($curl_error) {
    $log_entry .= "cURL Error:\n{$curl_error}\n";
}

file_put_contents($log_file, $log_entry, FILE_APPEND);

/* Optional: stop if CRM fails */
if ($http_code !== 200 && $http_code !== 201) {
    // You can exit here if CRM is mandatory
    // exit('CRM API failed');
}





/* ===============================
   4. SEND TO GOOGLE SHEET (JSON – FIXED)
================================ */
$sheet_url = 'https://script.google.com/macros/s/AKfycbzSOEabwc16HTdMnfxdxFuOoEouHyLDSNwId7rRh6MoGdW4Wm29crpXOgdqOeSw3xZy/exec';

$sheet_data = [
    'full_name'    => $full_name,
    'email'        => $email,
    'phone'        => $phone,
    'course'       => $course,
    'state'        => $state,
    'source'       => $source,
    // 'sub_source'   => $sub_source,
    // 'utm_source'   => $utm_source,
    // 'utm_campaign' => $utm_campaign,
    // 'utm_medium'   => $utm_medium,
    // 'utm_term'     => $utm_term,
    'page_url'     => $page_url,
    'website'      => 'GGU_LP' // 👈 TAB NAME IN GOOGLE SHEET
];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $sheet_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($sheet_data),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10
]);
curl_exec($ch);
curl_close($ch);

/* ===============================
   5. SEND TO PABBLY
================================ */
$pabbly_url = 'https://connect.pabbly.com/workflow/sendwebhookdata/IjU3NjUwNTZhMDYzNDA0MzI1MjY4NTUzMzUxMzAi_pc';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $pabbly_url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($lead_data),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10
]);
curl_exec($ch);
curl_close($ch);

/* ===============================
   6. REDIRECT USER
================================ */
if ($show_brochure === 'yes') {
    header("Location: thank-you.php?course=" . urlencode($course));
} else {
    header("Location: thank-you.php");
}
exit;
