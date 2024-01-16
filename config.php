<?php

// koneksi dengan database

$databaseHost = 'localhost';
$databaseName = 'db_crud';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (!$mysqli) {
    die("koneksi gagal: " . mysqli_connect_error());
}
