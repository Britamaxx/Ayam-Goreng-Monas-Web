<?php
/**
 * Database Connection File
 * Ayam Goreng Monas - Admin System
 * 
 * File ini berisi konfigurasi koneksi database MySQL
 */

// Konfigurasi Database
$db_host = "localhost";        // Host database (biasanya localhost)
$db_user = "root";             // Username database
$db_pass = "";                 // Password database (kosong untuk default XAMPP/WAMP)
$db_name = "ayamgoreng_monas"; // Nama database

// Membuat koneksi ke database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset ke UTF-8 untuk mendukung karakter Indonesia
mysqli_set_charset($conn, "utf8mb4");

// Optional: Set timezone (sesuaikan dengan zona waktu Indonesia)
date_default_timezone_set('Asia/Makassar'); // WIT (Balikpapan, Samarinda)
// Alternatif timezone:
// date_default_timezone_set('Asia/Jakarta');   // WIB
// date_default_timezone_set('Asia/Pontianak'); // WIB

// Fungsi helper untuk query data header
function getHeader($conn) {
    $query = "SELECT * FROM header WHERE id = 1 LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

// Fungsi helper untuk query data footer
function getFooter($conn) {
    $query = "SELECT * FROM footer WHERE id = 1 LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

// Load data header dan footer untuk digunakan global
$h = getHeader($conn);
$f = getFooter($conn);

/**
 * Catatan Penggunaan:
 * 
 * 1. Pastikan database 'ayamgoreng_monas' sudah dibuat
 * 2. Import file SQL (ayamgoreng_monas.sql) ke database
 * 3. Sesuaikan username dan password database jika berbeda
 * 4. File ini harus di-include di setiap halaman yang butuh koneksi database
 * 
 * Contoh penggunaan:
 * include "conn.php";
 * atau
 * include "../conn.php"; (jika berada di subfolder)
 * 
 * Query data:
 * $query = "SELECT * FROM menu";
 * $result = mysqli_query($conn, $query);
 * while ($row = mysqli_fetch_assoc($result)) {
 *     echo $row['nama'];
 * }
 */
?>