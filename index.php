<?php
// Aktifkan output buffering agar tidak ada output sebelum header
ob_start();

// Cek apakah setup sudah selesai
if (file_exists('/tmp/setup_completed.flag')) {
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/customerSide/home/home.php");
    exit();
} else {
    define('DB_HOST', 'php-mysql-resto');
    define('DB_USER', 'user');
    define('DB_PASS', 'password');

    // Buat koneksi database
    $link = new mysqli(DB_HOST, DB_USER, DB_PASS);
    if ($link->connect_error) {
        die('Connection Failed: ' . $link->connect_error);
    }

    // Buat database jika belum ada
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS restaurantdb";
    $link->query($sqlCreateDB);

    // Gunakan database restaurantdb
    $link->select_db('restaurantdb');

    // Fungsi untuk menjalankan SQL dari file restaurantDB.txt
    function executeSQLFromFile($filename, $link) {
        if (!file_exists($filename)) {
            die("Error: SQL file not found.");
        }

        $sql = file_get_contents($filename);
        if (empty($sql)) {
            die("Error: SQL file is empty.");
        }

        if ($link->multi_query($sql) === TRUE) {
            file_put_contents('/tmp/setup_completed.flag', 'Setup completed successfully.');
        }
    }

    // Jalankan SQL dari restaurantDB.txt
    executeSQLFromFile('/var/www/html/restaurantDB.txt', $link);
    $link->close();

    // Redirect ke halaman utama setelah setup selesai
    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/customerSide/home/home.php");
    exit();
}

// Pastikan tidak ada output sebelum header()
ob_end_flush();
?>
