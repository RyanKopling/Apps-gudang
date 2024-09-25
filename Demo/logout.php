<?php
session_start(); // Memulai session
session_unset(); // Menghapus semua variabel session
session_destroy(); // Menghancurkan session

// Redirect ke halaman login
header("Location: cobalogin.php");
exit();
?>