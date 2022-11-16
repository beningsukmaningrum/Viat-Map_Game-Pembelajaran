<?php
	include_once "conn.php";

	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$number = isset($_POST['latihan'])?$_POST['latihan']:false;	
	
	// manggil ke halaman practice
	$query_lesson = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	$id_lesson = mysqli_fetch_assoc($query_lesson);
	$query_claim = mysqli_query($connect, "SELECT claim FROM `claims` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."') ");
	$claim = mysqli_fetch_assoc($query_claim);
	$query_warrant = mysqli_query($connect, "SELECT warrant FROM `warrants` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."')");
	$query_ground = mysqli_query($connect, "SELECT ground FROM `grounds` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."')");

	// manggil pilihan warrant dan ground
	$warrant = Array();
	while ($roww = mysqli_fetch_assoc($query_warrant)) {
    	$warrant[] =  $roww['warrant']; 
	}
	$ground = Array();
	while ($rowg = mysqli_fetch_assoc($query_ground)) {
    	$ground[] =  $rowg['ground']; 
	}
	
	echo '{"lesson":"'.$lesson.'","number":"'.$number.'","claim":"'.$claim['claim'].'","warrant0":"'.$warrant[0].'","warrant1":"'.$warrant[1].'","warrant2":"'.$warrant[2].'","ground0":"'.$ground[0].'","ground1":"'.$ground[1].'","ground2":"'.$ground[2].'"}';
