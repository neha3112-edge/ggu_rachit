<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name    = $_POST['full_name'] ?? '';
    $email        = $_POST['email'] ?? '';
    $phone        = $_POST['phone'] ?? '';
    $course       = $_POST['course'] ?? '';
    $state        = $_POST['state'] ?? '';
    $source       = $_POST['source'] ?? '';
    $sub_source   = $_POST['sub_source'] ?? '';
    $utm_source   = $_POST['utm_source'] ?? '';
    $utm_campaign = $_POST['utm_campaign'] ?? '';
    $utm_medium   = $_POST['utm_medium'] ?? '';
    $utm_term     = $_POST['utm_term'] ?? '';
    $page_url     = $_POST['page_url'] ?? '';
    $show_brochure = $_POST['show_brochure'] ?? 'no';

    $crm_data = [
        'name' => $full_name,
        'email' => $email,
        'phone' => $phone,
        'course' => $course,
        'state' => $state,
        'source' => $source,
        'sub_source' => $sub_source,
        'utm_source' => $utm_source,
        'utm_campaign' => $utm_campaign,
        'utm_medium' => $utm_medium,
        'utm_term' => $utm_term,
    ];

    // === Send to CRM ===
    $api_key = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';
    $crm_url = 'https://api.crm.mysode.com/api/lead/apicreated';
     $headers = [
        "x-api-key: $api_key",
        "Content-Type: application/json"
    ];
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $crm_url,
        CURLOPT_POST => true,
       CURLOPT_POSTFIELDS => json_encode($crm_data),
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    $crm_response = curl_exec($ch);
    $crm_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        error_log('CRM Error: ' . curl_error($ch));
    } else {
        error_log("CRM HTTP $crm_http_code: $crm_response");
    }
    curl_close($ch);

    // === Send to Google Sheet ===
    $sheet_url = 'https://script.google.com/macros/s/AKfycbw_fs0VuBfikRu4EZkjS3vKBHlkQA3Vvcn_JSdacXXlyXExWahWUHUZF_Y2otR2PHSZ/exec';
    $sheet_data = array_merge($crm_data, [
        'full_name' => $full_name,
        'page_url' => $page_url,
        'website' => 'GGU_LP'
    ]);
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $sheet_url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($sheet_data),
    ]);
    curl_exec($ch);
    curl_close($ch);

    // === Send to Pabbly ===
    $pabbly_url = 'https://connect.pabbly.com/workflow/sendwebhookdata/IjU3NjUwNTZhMDYzNDA0MzI1MjY4NTUzMzUxMzAi_pc';
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $pabbly_url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($crm_data),
    ]);
    curl_exec($ch);
    curl_close($ch);

    // === Redirect ===
    if ($show_brochure === 'yes') {
        header("Location: thank-you.php?course=" . urlencode($course));
    } else {
        header("Location: thank-you.php");
    }
    exit();
} else {
    echo json_encode(['response' => 'error', 'message' => 'POST is required']);
    exit();
}
?>
