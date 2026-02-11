<?php
session_start();

// Hapus semua data session
session_unset();

// Hapus session itu sendiri
session_destroy();

// Redirect ke halaman login (Asumsi file ini ada di Root)
header("Location: Login/login.php");
exit;
?>