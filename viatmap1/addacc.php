<?php
include_once "conn.php";
//post data dari enroll student
$nama = isset($_POST['nama']) ? $_POST['nama'] : false;
$kelas = isset($_POST['kelas']) ? $_POST['kelas'] : false;
$induk = isset($_POST['induk']) ? $_POST['induk'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$pass = isset($_POST['pass']) ? $_POST['pass'] : false;

// cek tabel user, user terdaftar apa belum. agar tidak doubel
$query_cek = mysqli_query($connect, "SELECT * FROM `user` WHERE email = '" . $email . "'");
$sql_in = "INSERT INTO `user` (nama, nomor_induk, email, password, level) VALUES ('" . $nama . "','" . $induk . "','" . $email . "','" . $pass . "','" . $kelas . "')";
$cek = mysqli_num_rows($query_cek);
if ($cek > 0) {
	$tampil = mysqli_fetch_assoc($query_cek);
	echo '{"email":"' . $tampil['email'] . '","status":"dipakai"}';
} else {
	$query_in = mysqli_query($connect, $sql_in);
	echo '{"status":"tersimpan"}';
	// echo '{"email":"'.$email.'","status":"gasss"}';
}
