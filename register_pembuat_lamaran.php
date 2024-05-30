<?php
require 'config.php';
session_start(); // Koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Redirect atau tampilkan pesan bahwa pengguna harus login terlebih dahulu
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pembuat_lamaran'])) {
    $nama_tempat = $_POST['nama_tempat'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    
    // Periksa apakah pengguna telah membuat lamaran sebelumnya
    $check_query = mysqli_query($koneksi, "SELECT * FROM pembuat_lamaran WHERE id_user = '$user_id'");
    if (mysqli_num_rows($check_query) > 0) {
        // Pengguna sudah membuat lamaran sebelumnya, lakukan update data
        $update = mysqli_query($koneksi, "UPDATE pembuat_lamaran SET nama_tempat = '$nama_tempat', nama_perusahaan = '$nama_perusahaan' WHERE id_user = '$user_id'");
        
        if ($update) {
            header('Location: homepage.php?status=update_sukses');
        } else {
            header('Location: homepage.php?status=update_gagal');
        }
    } 
}
?>

