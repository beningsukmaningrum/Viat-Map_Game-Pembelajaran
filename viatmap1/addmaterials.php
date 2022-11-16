<?php 
	include_once "conn.php";
	$lesson = isset($_GET['lesson'])?$_GET['lesson']:false;
	$number = isset($_POST['number'])?$_POST['number']:false;
    $claim = isset($_POST['claim'])?$_POST['claim']:false;
	$warrant1 = isset($_POST['warrant1'])?$_POST['warran1']:false;
	$warrant2 = isset($_POST['warrant2'])?$_POST['warran2']:false;
	$warrant3 = isset($_POST['warrant3'])?$_POST['warran3']:false;
	$ground1 = isset($_POST['ground1'])?$_POST['ground1']:false;
	$ground2 = isset($_POST['ground2'])?$_POST['ground2']:false;
	$ground3 = isset($_POST['ground3'])?$_POST['ground3']:false;
  

	$query_cek = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
	$query_ceknum = mysqli_query($connect,"SELECT lesson, MAX(number) FROM lesson WHERE lesson = '".$lesson."'");
   
    $sql_in = "INSERT INTO `lesson` (nama_lesson) VALUES ('".$lesson."')";
	$cek = mysqli_num_rows($query_cek);
	if($cek > 0){
		$tampil = mysqli_fetch_assoc($query_cek);
		$tampil1 = mysqli_fetch_assoc($query_ceknum);
		$last_num = ($tampil1['MAX(number)'] + 1);
		echo '{"lesson":"'.$tampil['lesson'].'","status":"ada", "number":"'.$last_num.'"}';
	}else{
        echo '{"status":"tersedia","number":"1"}';
	}
    
?>