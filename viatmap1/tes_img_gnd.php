<?php
    include_once "conn.php";
    $id_lesson =isset($_POST['lesson'])?$_POST['lesson']:false;
    $number = isset($_POST['latihan'])?$_POST['latihan']:false;
    $total = count($_FILES['files']['name']);

    $uploadError = false;
    for ( $i = 0; $i < $total; $i++)
    {
        $tmpFilePath = $_FILES['files']['tmp_name'];
       
        if ($tmpFilePath != "")
        {
            $newFilePath = "img/ground/".$_FILES['files']['name'];
            echo $tmpFilePath;
            if (!move_uploaded_file($tmpFilePath, $newFilePath))
               $uploadError = true;
        }
    }
    if ($uploadError)
        echo $_FILES['files']['name'];
    else
        echo "Uploaded Successfully";
        echo $_FILES['files']['name'];
?>