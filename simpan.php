<?php
$conn = new mysqli("localhost", "root", "", "survey_db");
$nama = $_POST['nama'];
$pilihan = $_POST['pilihan'];
$conn->query("INSERT INTO survei (nama, pilihan) VALUES ('$nama', '$pilihan')");
header("Location: grafik.php");
?>
