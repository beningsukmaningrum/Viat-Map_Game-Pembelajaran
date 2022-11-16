<?php
    include_once "conn.php";
    $lesson =isset($_POST['lesson'])?$_POST['lesson']:false;
    $number = isset($_POST['latihan'])?$_POST['latihan']:false;
    $filename = isset($_POST['filename'])?$_POST['filename']:false;
    //$total = count($_POST['filename']);

    $query_cek_lesson = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'"); 
    $tampil = mysqli_fetch_assoc($query_cek_lesson);

    while ($tampil['id_lesson'] == "")
            {
                $query_cek_lesson1 = mysqli_query($connect,"SELECT * FROM `lessons` WHERE nama_lesson = '".$lesson."'");
                $tampil = mysqli_fetch_assoc($query_cek_lesson1);
            }
    $query_img1 = mysqli_query($connect,"INSERT INTO `warrant_images` (id_latihan, id_lesson, warrant_image) VALUES ('".$number."','".$tampil['id_lesson']."','".$filename."')");
 
?>