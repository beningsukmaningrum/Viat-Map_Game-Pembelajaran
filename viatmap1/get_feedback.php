<?php
	include_once "conn.php";

	$email = isset($_POST['email'])?$_POST['email']:false;
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$number = isset($_POST['latihan'])?$_POST['latihan']:false;
	

	$query_lesson = mysqli_query($connect, "SELECT nama_lesson FROM `lessons`");
	$query_cek = mysqli_query($connect, 'SELECT lesson FROM `result` WHERE email = "'.$email.'"');
	// $tampil = mysqli_fetch_assoc($query_cek);
	$lesson_array = Array();
	$res_array = Array();

	while ($row = mysqli_fetch_assoc($query_lesson)) {
    	$lesson_array[] =  $row['nama_lesson'];  
	}

	while ($row = mysqli_fetch_assoc($query_cek)) {
    	$res_array[] =  $row['lesson'];  
	}
	

    $target = $lesson_array;
    $haystack = $res_array;
    $store = Array();
    foreach ($target as $val) {
    	if (!in_array($val, $haystack)){
    		$store[] = $val;
    	}
    }
	
	
	$query_lesson = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	$id_lesson = mysqli_fetch_assoc($query_lesson);

	$query_feed_warr = mysqli_query($connect, "SELECT warr_feed FROM `feedback` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."')");
	$query_feed_gnd = mysqli_query($connect, "SELECT gnd_feed FROM `feedback` WHERE (id_lesson, id_latihan) = ('".$id_lesson['id_lesson']."','".$number."')");


	$warrant_feed = Array();
	while ($roww = mysqli_fetch_assoc($query_feed_warr)) {
    	$warrant_feed[] =  $roww['warr_feed']; 
	}
	$ground_feed = Array();
	while ($rowg = mysqli_fetch_assoc($query_feed_gnd)) {
    	$ground_feed[] =  $rowg['gnd_feed']; 
	}
	
	echo '{"lesson":"'.$store[0].'","war0":"'.$warrant_feed[0].'","war1":"'.$warrant_feed[1].'","war2":"'.$warrant_feed[2].'","gnd0":"'.$ground_feed[0].'","gnd1":"'.$ground_feed[1].'","gnd2":"'.$ground_feed[2].'"}';

	

    
		
?>	