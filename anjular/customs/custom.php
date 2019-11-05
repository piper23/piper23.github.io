<?php 
namespace data\functions;


Class Customs{

	public $err=0; // Default Value




	#1st argument pass data
	# options 2nd argument trim
	#option 3rd argument htmlentties
	public  function cleanUserData($data,...$options){

		if(!isset($data) || empty($data) ){
			$this->err=1;
			return false;
		}
		
		if(isset($options[0]) && $options[0]==1)
			$data=trim($data);		
		if (isset($options[1]) && $options[1]==1) 
			$data =htmlentities($data);
		return $data;
	}


	public  function isSTRING($data){
		if(!is_string($data)){
			$this->err=1;
		}
	}
	public  function isINT($data){
		$data= (int)$data;
		
		if($data == 0){
			$this->err=1;
		}
	}
	public  function isYear($data){
		
		if(strlen($data) != 4){
			$this->err=1;
		}
	}
}


?>