<?php 
	include_once "conn.php";
	$lesson = isset($_POST['lesson'])?$_POST['lesson']:false;
	$number = isset($_POST['latihan'])?$_POST['latihan']:false;
    $claim = isset($_POST['claim'])?$_POST['claim']:false;  

	$query_cek_lesson = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	
	
	$cek = mysqli_num_rows($query_cek_lesson);
	if($query_cek_lesson){
		if ($cek > 0) {
			$tampil = mysqli_fetch_assoc($query_cek_lesson);
			// echo '{"id_lesson":"'.$tampil['id_lesson'].'","nama_lesson":"'.$tampil['nama_lesson'].'","status":"ada"}';
		// cek lesson agar tidak double
		}else{
			$query_in_lesson = mysqli_query($connect,"INSERT INTO `lessons` (nama_lesson) VALUES ('".$lesson."')");
			
			$query_cek_lesson1 = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
			$tampil = mysqli_fetch_assoc($query_cek_lesson1);
			// echo '{"id_lesson":"'.$tampil['id_lesson'].'","nama_lesson":"'.$tampil['nama_lesson'].'","status":"tersimpan"}';
		}
		// cek lesson yang tersedia
		while ($tampil['id_lesson'] == "")
			{
				$query_cek_lesson1 = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
				$tampil = mysqli_fetch_assoc($query_cek_lesson1);
			}

		// 
		$query_cek_lesson = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
		$query_cek_claim = mysqli_query($connect,"SELECT * FROM `claims` WHERE (id_latihan, id_lesson) = ('".$number."', '".$tampil['id_lesson']."')");
		
		// otomatis number
		$cek1 = mysqli_num_rows($query_cek_claim);
		if($cek1 > 0){
			$tampil2 = mysqli_fetch_assoc($query_cek_claim);
			echo '{"id_lesson":"'.$tampil['id_lesson'].'","id_latihan":"'.$tampil2['id_latihan'].'","claim":"'.$tampil2['claim'].'","status":"sudah_ada"}';
		}else{
  			$query_in_claim = mysqli_query($connect,"INSERT INTO `claims` (id_lesson,id_latihan,claim) VALUES ('".$tampil['id_lesson']."','".$number."','".$claim."')");
  			$query_cek_claim = mysqli_query($connect,"SELECT * FROM `claims` WHERE (id_latihan, id_lesson) = ('".$number."', '".$tampil['id_lesson']."')");
  			$tampil2 = mysqli_fetch_assoc($query_cek_claim);
			echo '{"id_lesson":"'.$tampil['id_lesson'].'","id_latihan":"'.$tampil2['id_latihan'].'","claim":"'.$tampil2['claim'].'","status":"tersimpan"}';
    	}
   	}else{
        echo '{"status":"gagal"}';
	}
