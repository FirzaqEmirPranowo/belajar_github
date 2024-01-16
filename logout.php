<?php
// logout.php

// Mulai sesi jika belum dimulai
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Hancurkan sesi
session_destroy();

// Alihkan ke halaman login atau halaman lain yang sesuai
header("Location: login.php");
exit;
