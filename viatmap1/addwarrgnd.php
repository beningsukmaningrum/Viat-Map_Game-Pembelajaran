<?php
include_once "conn.php";
$lesson = isset($_POST['lesson']) ? $_POST['lesson'] : false;
$number = isset($_POST['latihan']) ? $_POST['latihan'] : false;
$warr1 = isset($_POST['warr1']) ? $_POST['warr1'] : false;
$warr2 = isset($_POST['warr2']) ? $_POST['warr2'] : false;
$warr3 = isset($_POST['warr3']) ? $_POST['warr3'] : false;
$gnd1 = isset($_POST['gnd1']) ? $_POST['gnd1'] : false;
$gnd2 = isset($_POST['gnd2']) ? $_POST['gnd2'] : false;
$gnd3 = isset($_POST['gnd3']) ? $_POST['gnd3'] : false;


$query_cek_lesson = mysqli_query($connect, "SELECT * FROM `lessons` WHERE nama_lesson = '" . $lesson . "'");
$tampil = mysqli_fetch_assoc($query_cek_lesson);
// ketika tampil id_lesson digabungkan ke claims
while ($tampil['id_lesson'] == "") {
    $query_cek_lesson = mysqli_query($connect, "SELECT * FROM `lessons` WHERE nama_lesson = '" . $lesson . "'");
    $tampil = mysqli_fetch_assoc($query_cek_lesson);
}
// memasukkan data grounds sama warrants ke tabel
$query_warr1 = mysqli_query($connect, "INSERT INTO `warrants` (id_latihan, id_lesson, warrant) VALUES ('" . $number . "','" . $tampil['id_lesson'] . "','" . $warr1 . "')");
$query_warr2 = mysqli_query($connect, "INSERT INTO `warrants` (id_latihan, id_lesson, warrant) VALUES ('" . $number . "','" . $tampil['id_lesson'] . "','" . $warr2 . "')");
$query_warr3 = mysqli_query($connect, "INSERT INTO `warrants` (id_latihan, id_lesson, warrant) VALUES ('" . $number . "','" . $tampil['id_lesson'] . "','" . $warr3 . "')");
$query_gnd1 = mysqli_query($connect, "INSERT INTO `grounds` (id_latihan, id_lesson, ground) VALUES ('" . $number . "','" . $tampil['id_lesson'] . "','" . $gnd1 . "')");
$query_gnd2 = mysqli_query($connect, "INSERT INTO `grounds` (id_latihan, id_lesson, ground) VALUES ('" . $number . "','" . $tampil['id_lesson'] . "','" . $gnd2 . "')");
$query_gnd3 = mysqli_query($connect, "INSERT INTO `grounds` (id_latihan, id_lesson, ground) VALUES ('" . $number . "','" . $tampil['id_lesson'] . "','" . $gnd3 . "')");
    
	//if ($query_warr1) {
	//	echo "kenek";
	//}
