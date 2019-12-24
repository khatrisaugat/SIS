<?php 
require_once("connection.php");
/**
 * 
 */
class queries extends connection
{
	
	function select($tbl_name)
	{
		$sql="SELECT * FROM $tbl_name";
		$stm=$this->con->prepare($sql);
		$stm->execute();
		return $stm;

	}
	function insert($val,$tbl_name){

		$sql="INSERT INTO $tbl_name(";
		$sql.=join(',',array_keys($val));
		$sql.=") VALUES('";
		$sql.=join("','",$val);
		$sql.="')";
		// echo "$sql";
		$stm=$this->con->prepare($sql);
		$stm->execute();
	}
}
$obj=new queries;