<?php  
session_start();
require_once("queries.php");
$sid=$_GET['sid'];
$fid=$_SESSION['fid'];
$payment_made=0;
$total=0;
$select_payment=$obj->select("tbl_student_payment WHERE sid=".$_GET['sid']." AND fid=".$_SESSION['fid']." AND semester=".$_GET['sem']);
while ($pay=$select_payment->fetch(PDO::FETCH_ASSOC)) {
	$payment_made+=$pay['amount'];
}
$tbl_join_policy="`tbl_fees` LEFT JOIN tbl_student_policy ON tbl_student_policy.fid=tbl_fees.fid  WHERE tbl_student_policy.sid=".$sid. " and tbl_student_policy.fid=".$fid . "  


  UNION (SELECT * FROM tbl_fees left  JOIN tbl_student_policy ON tbl_fees.fid=tbl_student_policy.fid
   where tbl_fees.fid=".$fid." AND tbl_student_policy.sid IS NULL)";
   $tbl_student_policy=$obj->select($tbl_join_policy);
   while ($row2=$tbl_student_policy->fetch(PDO::FETCH_ASSOC)) {
   	if($row2['fid']==$fid){
   		$total=$row2['amount'];
   		} else if($row2['amount']==""){
   			$total=$row2['fees'];
   			} 
   	}


?>
amount<br> Total = <?=$total;?>  <br><span style="color: #000066;font-weight: bold;"> rem = <?=($total-$payment_made); ?></span>
