<?php 

$target_dir =__DIR__. "/../files/";
$filename=date("dmyihs")."_".basename($_FILES["files"]["name"]);
$target_file = $target_dir . $filename;


$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["files"]["tmp_name"]);
if($check !== false) {
    
  move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)." STATE ";
  $response['filename']=$filename;
  $response['ogFileName']=basename($_FILES["files"]["name"]);
  $uploadOk = 1;
} else {
    $response['ogFileName']=basename($_FILES["files"]["name"]);
    $uploadOk = 0;
}


$response['status']=$uploadOk;


echo json_encode($response);