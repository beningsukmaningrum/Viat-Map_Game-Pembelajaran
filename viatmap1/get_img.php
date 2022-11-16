<?php
	include_once "conn.php";

	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$number = isset($_POST['latihan'])?$_POST['latihan']:false;
	
	$query_lesson = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	$id_lesson = mysqli_fetch_assoc($query_lesson);
	$query_img_war = mysqli_query($connect, "SELECT warrant_image FROM `warrant_images` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."') ");
	$query_img_gnd = mysqli_query($connect, "SELECT ground_image FROM `ground_images` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."') ");
	
	$war_img = Array();
	while ($roww = mysqli_fetch_assoc($query_img_war)) {
    	$war_img[] =  $roww['warrant_image']; 
	}
	$gnd_img = Array();
	while ($rowg = mysqli_fetch_assoc($query_img_gnd)) {
    	$gnd_img[] =  $rowg['ground_image']; 
	}

	echo '{"war1":"'.$war_img[0].'","war2":"'.$war_img[1].'","war3":"'.$war_img[2].'","gnd1":"'.$gnd_img[0].'","gnd2":"'.$gnd_img[1].'","gnd3":"'.$gnd_img[2].'"}';
		
?>	