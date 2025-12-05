<?php
session_start();
include "conn2.php";

// Debug log
error_log("Login attempt started");

// Cek apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login_admin.php?error=Invalid request method");
    exit();
}

// Ambil data dari form
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Debug
error_log("Username: $username");

// Validasi input kosong
if (empty($username) || empty($password)) {
    header("Location: login_admin.php?error=Username dan password harus diisi");
    exit();
}

// Validasi Cloudflare Turnstile (opsional, bisa dinonaktifkan dulu untuk test)
$turnstileResponse = isset($_POST['cf-turnstile-response']) ? $_POST['cf-turnstile-response'] : '';

if (empty($turnstileResponse)) {
    header("Location: login_admin.php?error=Captcha belum diisi");
    exit();
}

// Query ke database
$stmt = $conn->prepare("SELECT id, username, password FROM akun WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    // Verifikasi password
    // Asumsikan password di database adalah plain text atau gunakan password_verify() jika hash
    if ($password === $user['password']) {
        // Login berhasil
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        
        error_log("Login successful for: $username");
        
        header("Location: Admin/dashboard/dashboard_admin.php");
        exit();
    } else {
        error_log("Wrong password for: $username");
        header("Location: login_admin.php?error=Password salah");
        exit();
    }
} else {
    error_log("User not found: $username");
    header("Location: login_admin.php?error=Username tidak ditemukan");
    exit();
}

$stmt->close();
$conn->close();
?>