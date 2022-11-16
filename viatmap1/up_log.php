<?php
	include_once "conn.php";

	$email = isset($_POST['email'])?$_POST['email']:false;
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$number = isset($_POST['latihan'])?$_POST['latihan']:false;
	$time = isset($_POST['time'])?$_POST['time']:false;
	$war_ans = isset($_POST['war_ans'])?$_POST['war_ans']:false;
	$gnd_ans = isset($_POST['gnd_ans'])?$_POST['gnd_ans']:false;
	$war_conf = isset($_POST['war_conf'])?$_POST['war_conf']:false;
	$gnd_conf = isset($_POST['gnd_conf'])?$_POST['gnd_conf']:false;
	$confirm = isset($_POST['confirm'])?$_POST['confirm']:false;
	
	

	echo $lesson;
	echo $email;
	$query_user = mysqli_query($connect, "SELECT nama, level FROM `user` WHERE email = '".$email."'");
	$user = mysqli_fetch_assoc($query_user);

	$query_lessons = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	$lessons = mysqli_fetch_assoc($query_lessons);
	
	$query_result = mysqli_query($connect, "INSERT INTO `log` 
		(email, nama, id_lesson, nama_lesson, id_latihan, warrant, ground, war_conf, gnd_conf, confirm, time) 
		VALUES 
		('".$email."','".$user['nama']."','".$lessons['id_lesson']."','".$lesson."','".$number."','".$war_ans."','".$gnd_ans."','".$war_conf."','".$gnd_conf."','".$confirm."','".$time."')");

	if ($query_result) {
		echo "string";
	}

	$query_get_log = mysqli_query($connect, "SELECT * FROM `log` WHERE (email, id_lesson) = ('".$email."','".$lessons['id_lesson']."') ORDER BY id_log DESC");
	$get_log = mysqli_fetch_assoc($query_get_log);


	echo "{'email':'".$get_log['email']."', 'nama':'".$get_log['nama']."','lesson':'".$get_log['nama_lesson']."','id_latihan':'".$get_log['id_latihan']."','war_ans':'".$get_log['warrant']."','gnd_ans':'".$get_log['ground']."','war_conf':'".$get_log['war_conf']."','gnd_conf':'".$get_log['gnd_conf']."','time':'".$get_log['time']."'}";
