<?php 
	include_once "conn.php";
	$email = isset($_POST['email'])?$_POST['email']:false;
	$password = isset($_POST['pass'])?$_POST['pass']:false;
	
	$query = mysqli_query($connect,"SELECT * FROM `user` WHERE email = '".$email."' AND password = '".$password."'");
	$cek = mysqli_num_rows($query);
	if($cek > 0){
		$tampil = mysqli_fetch_assoc($query);
		echo '{"nama":"'.$tampil['nama'].'","kelas":"'.$tampil['level'].'","status":"berhasil"}';
	}else{
		echo '{"email":"'.$email.'","status":"gagal"}';
	}
?>