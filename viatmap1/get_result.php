<?php
include_once "conn.php";

$query_result = mysqli_query($connect, "SELECT * FROM `result` ORDER BY id DESC");
$result = array();

while ($row = mysqli_fetch_assoc($query_result)) {
	$result[] = $row;
}
// memanggil data untuk hasil result
foreach ($result as $data) {
	echo "{$data['nama']}|"
		. "{$data['lesson']}|"
		. "{$data['waktu']}|"
		. "{$data['kelas']}|"
		. "{$data['email']}|";
}
echo "string|string|string|string|string|";
