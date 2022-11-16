<?php
	include_once "conn.php";

	$email = isset($_POST['email'])?$_POST['email']:false;
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$time = isset($_POST['time'])?$_POST['time']:false;

	$query_user = mysqli_query($connect, "SELECT nama, level FROM `user` WHERE email = '".$email."'");
	$user = mysqli_fetch_assoc($query_user);

	$query_result = mysqli_query($connect, "INSERT INTO `result` (nama, email, kelas, lesson, waktu) VALUES ('".$user['nama']."','".$email."','".$user['level']."','".$lesson."','".$time."')");

	echo "{'nama':'".$user['nama']."', 'kelas':'".$user['level']."','email':'".$email."','lesson':'".$lesson."','time':'".$time."'}";

?>