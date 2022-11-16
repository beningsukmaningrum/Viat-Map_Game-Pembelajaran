<?php 
	include_once "conn.php";
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;  

	$query_cek = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	
	// cek lesson tersedia apa tidak. jika tidak tersedia ke lesson berikutnya.
	$cek = mysqli_num_rows($query_cek);
	if ($cek > 0){
		$tampil = mysqli_fetch_assoc($query_cek);
		$query_ceknum = mysqli_query($connect,"SELECT id_lesson, MAX(id_latihan) FROM claims WHERE id_lesson = '".$tampil['id_lesson']."'");
		$tampil1 = mysqli_fetch_assoc($query_ceknum);
		if ($tampil1['MAX(id_latihan)'] < 30){
			$last_id_lat = $tampil1['MAX(id_latihan)'] + 1;
			echo '{"id_lesson":"'.$tampil['id_lesson'].'","lesson":"'.$tampil['nama_lesson'].'","id_latihan":"'.$last_id_lat.'","status":"ada"}';
		}else{
			echo '{"id_lesson":"'.$tampil['id_lesson'].'","lesson":"'.$tampil['nama_lesson'].'","id_latihan":"'.$tampil1['MAX(id_latihan)'].'","status":"penuh"}';
		}

	}else {
		echo'{"lesson":"'.$lesson.'","status":"baru","id_latihan":"1"}';
	}
