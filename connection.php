<?php 
/**
 * 
 */
class connection 
{
	protected $con;
	
	function __construct()
	{
		$host="localhost";
		$dbname="student";
		$username="root";
		$password="";
		$this->con=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);

	}
}