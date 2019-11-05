<?php
require("../customs/custom.php");
require('../models/model.php');
$cusValidation = new data\functions\Customs();
$model = new Model();


$data['manufacture']=$cusValidation->cleanUserData($_POST['manufacture'],1,1);


if($model->insertToManufacture($data)){
	$response['status']=true;
}else{
	$response['status']=false;
}
echo json_encode($response);

?>