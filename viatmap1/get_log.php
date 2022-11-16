<?php
include_once "conn.php";
ini_set('memory_limit', '44M');
$email = isset($_POST['email']) ? $_POST['email'] : false;
$lesson = isset($_POST['lesson']) ? $_POST['lesson'] : false;

$query_lessons = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '" . $lesson . "'");
$lessons = mysqli_fetch_assoc($query_lessons);

$query_get_log = mysqli_query($connect, "SELECT * FROM `log` WHERE (email, id_lesson) = ('" . $email . "','" . $lessons['id_lesson'] . "')");

$log = array();

while ($row = mysqli_fetch_assoc($query_get_log)) {
	$log[] = $row;
}

// memanggil data buat di tampilan log
foreach ($log as $data) {
	echo "{$data['email']}|"
		. "{$data['nama_lesson']}|"
		. "{$data['nama']}|"
		. "{$data['id_latihan']}|"
		. "{$data['warrant']}|"
		. "{$data['ground']}|"
		. "{$data['war_conf']}|"
		. "{$data['gnd_conf']}|"
		. "{$data['confirm']}|";
}
echo "|||||||||";

//	echo "{'email':'".$get_log['email']."', 'nama':'".$get_log['nama']."','id_lesson':'".$get_log['id_lesson']."','id_latihan':'".$get_log['id_latihan']."','war_ans':'".$get_log['warrant']."','gnd_ans':'".$get_log['ground']."','war_conf':'".$get_log['war_conf']."','gnd_conf':'".$get_log['gnd_conf']."','time':'".$get_log['time']."'}";
