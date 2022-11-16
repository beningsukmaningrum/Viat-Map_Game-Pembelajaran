<?php
$connect = new mysqli("localhost","root","","viatmap1");

if($connect){
}else{
	echo "Connection Failed";
	exit();
}