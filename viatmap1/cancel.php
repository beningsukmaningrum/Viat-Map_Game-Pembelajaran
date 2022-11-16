<?php
	include_once "conn.php";
	$email = isset($_POST['email'])?$_POST['email']:false;
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	
	$query_lessons = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	$lessons = mysqli_fetch_assoc($query_lessons);

	$query_delete = mysqli_query($connect, "DELETE FROM `log` WHERE (email, id_lesson) = ('".$email."','".$lessons['id_lesson']."')");
	//$query_get_log = mysqli_query($connect, "SELECT * FROM `log` WHERE (email, id_lesson) = ('".$email."','".$lessons['id_lesson']."')");

	if ($query_delete){
		echo"canceled";
	}
?>