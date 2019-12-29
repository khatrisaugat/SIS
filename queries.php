<?php 
require_once("connection.php");

class queries extends connection
{
	
	function select($tbl_name)
	{
		$sql="SELECT * FROM {$tbl_name}";
		$stm=$this->con->prepare($sql);
		// echo "$sql";
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
	function delete($val,$tbl_name){
		$sql="DELETE FROM $tbl_name WHERE ";
		$sql.=join('',array_keys($val));
		$sql.="=".join('',$val);
		$stm=$this->con->prepare($sql);
		// echo "$sql";
		$stm->execute();

	}
	function update($val,$tbl_name,$sn){
		$sql="UPDATE $tbl_name SET ";
		foreach ($val as $key => $value) {
			$arr[]=$key."='$value'";
		}
		$sql.=implode(',', $arr);
		
		$sql.=" WHERE ";
		$sql.=join('',array_keys($sn));
		$sql.="=".join('',$sn);
		$stm=$this->con->prepare($sql);
		$stm->execute();
		// echo "$sql";
	}
}
$obj=new queries;