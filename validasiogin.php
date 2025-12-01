<?php
include 'conn2.php';
function validateTurnstile($token, $secret, $remoteip = null) {
    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    $data = [
        'secret' => $secret,
        'response' => $token
    ];

    if ($remoteip) {
        $data['remoteip'] = $remoteip;
    }

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        return ['success' => false, 'error-codes' => ['internal-error']];
    }

    return json_decode($response, true);

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $secret_key = '0x4AAAAAACD8ddH7RFPkWSk9eCm3gNO2SuY';
    $token = $_POST['cf-turnstile-response'] ?? '';
    $remoteip = $_SERVER['HTTP_CF_CONNECTING_IP'] ??
    $_SERVER['HTTP_X_FORWARDED_FOR'] ??
    $_SERVER['REMOTE_ADDR'];

    $validation = validateTurnstile($token, $secret_key, $remoteip);

    if ($validation['success']) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = trim($_POST['password']);
    
    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM akun WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($password === $user['password']) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $user['username'];
                $_SESSION['admin_id'] = $user['id'];
                
                header("Location: Admin/dashboard/dashboard_admin.php");
                exit();
            } else {
                $error = "Username atau password salah!";
            }
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Harap isi semua field!";
    }
    } else {
    header ("location: login_admin.php");
    echo "Verification failed. Please try again.";
    error_log('Turnstile validation failed: ' . implode(', ', $validation['error-codes']));
    }
    
}
?>

