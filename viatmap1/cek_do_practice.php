<?php
include_once "conn.php";

$email = isset($_POST['email']) ? $_POST['email'] : false;
$lesson = isset($_POST['lesson']) ? $_POST['lesson'] : false;
$number = isset($_POST['latihan']) ? $_POST['latihan'] : false;

$query_lesson = mysqli_query($connect, "SELECT nama_lesson FROM `lessons`");
$query_cek = mysqli_query($connect, 'SELECT lesson FROM `result` WHERE email = "' . $email . '"');

// $tampil = mysqli_fetch_assoc($query_cek);
$lesson_array = array();
$res_array = array();

while ($row = mysqli_fetch_assoc($query_lesson)) {
	$lesson_array[] =  $row['nama_lesson'];
}

while ($row = mysqli_fetch_assoc($query_cek)) {
	$res_array[] =  $row['lesson'];
}

// manggil data soal
$store = array();
if ($query_cek = false) {
	$store[0] = $res_array[0];
}

$target = $lesson_array;
$haystack = $res_array;
foreach ($target as $val) {
	if (!in_array($val, $haystack)) {
		$store[] = $val;
	}
}

if (!empty($store[0])) {
	$query_lesson = mysqli_query($connect, "SELECT id_lesson FROM `lessons` WHERE nama_lesson = '" . $store[0] . "'");
	$id_lesson = mysqli_fetch_assoc($query_lesson);
	$query_claim = mysqli_query($connect, "SELECT claim FROM `claims` WHERE (id_lesson, id_latihan) = ('" . $id_lesson['id_lesson'] . "','" . $number . "') ");
	$claim = mysqli_fetch_assoc($query_claim);
	$query_warrant = mysqli_query($connect, "SELECT warrant FROM `warrants` WHERE (id_lesson, id_latihan) = ('" . $id_lesson['id_lesson'] . "','" . $number . "')");
	$query_ground = mysqli_query($connect, "SELECT ground FROM `grounds` WHERE (id_lesson, id_latihan) = ('" . $id_lesson['id_lesson'] . "','" . $number . "')");

	$query_max_num = mysqli_query($connect, "SELECT MAX(id_latihan) FROM `claims` WHERE id_lesson = '" . $id_lesson['id_lesson'] . "'");
	$max_num = mysqli_fetch_assoc($query_max_num);

	$warrant = array();
	while ($roww = mysqli_fetch_assoc($query_warrant)) {
		$warrant[] =  $roww['warrant'];
	}
	$ground = array();
	while ($rowg = mysqli_fetch_assoc($query_ground)) {
		$ground[] =  $rowg['ground'];
	}

	echo '{"lesson":"' . $store[0] . '","claim":"' . $claim['claim'] . '","max_num":"' . $max_num['MAX(id_latihan)'] . '","warrant0":"' . $warrant[0] . '","warrant1":"' . $warrant[1] . '","warrant2":"' . $warrant[2] . '","ground0":"' . $ground[0] . '","ground1":"' . $ground[1] . '","ground2":"' . $ground[2] . '"}';
} else {
	echo "kosong";
}
