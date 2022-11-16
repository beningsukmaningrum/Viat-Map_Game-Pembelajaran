<?php 
// ga ada
	include_once "conn.php";
	
	$query = mysqli_query($koneksi,"SELECT * FROM inventori");
	$tampil = mysqli_fetch_assoc($query);
	
	echo $tampil['id']." | ".$tampil['nama']." | ". $tampil['jumlah'];
