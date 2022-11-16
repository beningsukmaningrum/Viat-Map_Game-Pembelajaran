<?php
	include_once "conn.php";
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$number = isset($_POST['latihan'])?$_POST['latihan']:false;
	$feedw1 = isset($_POST['feedw1'])?$_POST['feedw1']:false;
	$feedw2 = isset($_POST['feedw2'])?$_POST['feedw2']:false;
    $feedw3 = isset($_POST['feedw3'])?$_POST['feedw3']:false; 
    $feedg1 = isset($_POST['feedg1'])?$_POST['feedg1']:false;
	$feedg2 = isset($_POST['feedg2'])?$_POST['feedg2']:false;
    $feedg3 = isset($_POST['feedg3'])?$_POST['feedg3']:false;  


    $query_cek_lesson = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");	
    $tampil = mysqli_fetch_assoc($query_cek_lesson);
    while ($tampil['id_lesson'] == "")
		{
			$query_cek_lesson1 = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
			$tampil = mysqli_fetch_assoc($query_cek_lesson1);
		}
    echo $tampil['id_lesson'];
    $query_feed1 = mysqli_query($connect,"INSERT INTO `feedback` (id_latihan, id_lesson, warr_feed, gnd_feed) VALUES ('".$number."','".$tampil['id_lesson']."','".$feedw1."','".$feedg1."')");
    $query_feed2 = mysqli_query($connect,"INSERT INTO `feedback` (id_latihan, id_lesson, warr_feed, gnd_feed) VALUES ('".$number."','".$tampil['id_lesson']."','".$feedw2."','".$feedg2."')");
    $query_feed3 = mysqli_query($connect,"INSERT INTO `feedback` (id_latihan, id_lesson, warr_feed, gnd_feed) VALUES ('".$number."','".$tampil['id_lesson']."','".$feedw3."','".$feedg3."')");
    
?>