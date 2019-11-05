<?php
require("../customs/custom.php");
require('../models/model.php');
$cusValidation = new data\functions\Customs();
$model = new Model();


////If Method Get Send Manufacture Data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	echo   json_encode($model->selectManufatures());
}

////If Method POST Insert model Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {




	if($_POST['st_imageName']!=""){
		$_POST['st_imageName']=substr_replace($_POST['st_imageName'] ,"",-1);
	}


	$data['st_model_name']=$cusValidation->cleanUserData($_POST['st_model'],1,1);

	$data['st_color']=$cusValidation->cleanUserData($_POST['st_color'],1,1);

	$data['st_reg_no']=$cusValidation->cleanUserData($_POST['st_regNo'],1,1);
	$data['st_note']=$cusValidation->cleanUserData($_POST['st_note'],1,1);
	$data['int_manu_id']=$cusValidation->cleanUserData($_POST['st_manufacture'],1,1);

	$date=$cusValidation->cleanUserData($_POST['dt_manu_year']);

	$cusValidation->isYear($date);
	$data['dt_manu_year']=date('Y-m-d h:i:s', strtotime($date)); 
	$date=$cusValidation->isINT($_POST['dt_manu_year']);



////Return If There Are Validation Errors
	if($cusValidation->err){
		$response['status']=false;
		echo json_encode($response);
		exit;
	}
///File Images

	$data['st_image']=$_POST['st_imageName'];


	if($model->inserModel($data)){
		$response['status']=true;
	}else{
		$response['errCode']=1;
		$response['status']=false;
	}
	echo json_encode($response);

}






?>