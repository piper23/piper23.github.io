<?php

require("../customs/dbConnection.php");
Class Model{
	public $connection = '';
    public $myslqi = '';
	function __construct() {
        $this->connection = DBConnection::getInstance();
        $this->myslqi = $this->connection->getMySQLIConnection();
	}
	public function insertToManufacture($data){
		$retVal=0;
		$query = "INSERT INTO manufacture_data (st_manu_name , dt_created) VALUES ( ?, NOW())";	
		$stmt =  $this->myslqi->prepare($query);
		$stmt->bind_param("s", $data['manufacture']);
		if ($stmt->execute()) {
			$retVal=1;
		}
		return $retVal;
	}

	public function selectManufatures(){
		$retVal=array();
		$query = "Select int_man_id,st_manu_name from manufacture_data";	
		$stmt =  $this->myslqi->prepare($query);
		
		if ($stmt->execute()) {
		$stmt->bind_result($man_id, $man_name);
			
                while ($stmt->fetch()) {
                    array_push($retVal, array('man_id'=>$man_id,'man_name'=>$man_name));
                    
                }
		}
		return $retVal;
	}

	public function inserModel($data){
		$retVal=0;
		$query = "INSERT INTO `car_model`( `st_model_name`, `st_color`, `st_reg_no`, `dt_manu_year`, `st_note`, `st_image`, `int_manu_id`, `dt_created`) VALUES ( ?,?,?,?,?,?,?,NOW())";	
		$stmt =  $this->myslqi->prepare($query);
		$stmt->bind_param("ssssssi", $data['st_model_name'],$data['st_color'],$data['st_reg_no'],$data['dt_manu_year'],$data['st_note'],$data['st_image'],$data['int_manu_id']);
		if ($stmt->execute()) {
			$retVal=1;
		}
		return $retVal;
	}


		public function selectInventory(){
		$retVal=array();
		$query = "select md.st_manu_name,cm.* from manufacture_data md LEFT JOIN car_model cm ON md.int_man_id = cm.int_manu_id ORDER BY cm.st_model_name DESC";	
		$stmt =  $this->myslqi->prepare($query);
		
		if ($stmt->execute()) {
		$stmt->bind_result($a, $b,$c,$d,$e,$f,$g,$h,$i,$j);
			
                while ($stmt->fetch()) {
                	if(!array_key_exists($a, $retVal)){
                		$retVal[$a]=array();
                	}
                	if(!empty($c)){
                		array_push($retVal[$a], array(
                    	'st_model_name'=>$c,
                    	'st_color'=>$d,
                    	'st_reg_no'=>$e,
                    	'dt_manu_year'=>date("Y", strtotime($f)),
                    	'st_note'=>$g,
                    	'st_image'=>$h,
                    )
                );

                	}

                    
                }
		}



		return $retVal;
	}


}

?>