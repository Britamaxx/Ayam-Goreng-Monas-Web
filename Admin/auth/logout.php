<?php
/**
 * Logout Script
 * Ayam Goreng Monas - Admin System
 * 
 * File ini menghancurkan session dan redirect ke halaman login
 */

// Mulai session
session_start();

// Hapus semua session variables
$_SESSION = array();

// Hancurkan session cookie jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header("Location: ../../login_admin.php");
exit();
?>