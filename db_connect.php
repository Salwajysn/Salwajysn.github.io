<?php
$servername = "localhost";
$username = "root"; // Username default XAMPP
$password = ""; // Password default XAMPP
$dbname = "techthree";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
