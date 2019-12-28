<?php
if (!isset($_GET['sid'])) {//not letting direct access
	header("Location:display_student.php");
}
//initialization
	$count=0;
	$Sem=0;
	$allSem=0;
	$Monthly=0;
	$Semfee=0;
	$admission=0;
//initialization finish

	require_once("includes/header.php");//include header file
	require_once("queries.php");//include queries
	$query="tbl_student_payment JOIN semester ON semester.sem_id=tbl_student_payment.semester JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid WHERE sid=".$_GET['sid'];//query for selecting payment data
	$select_payment=$obj->select($query);//select payment data

	$policy_select=$obj->select("tbl_student_policy JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid WHERE sid=".$_GET['sid']);//select policy
	$tbl_fees=$obj->select("tbl_fees");//select fees

	$tbl_student=$obj->select("tbl_students WHERE sid=".$_GET['sid']);//select student data
	$row=$tbl_student->fetch(PDO::FETCH_ASSOC);//fetch student data
	
	//Calculation of fees for each semester excluding exam fees and including policy
	while ($policy=$policy_select->fetch(PDO::FETCH_ASSOC)) {//check policy
		
		$count++;
		if($policy['ftype']=='admission'){
			$admission=$policy['amount'];
			
		}else if($policy['ftype']=='Semester fee'){
			$Semfee=$policy['amount'];
			
		}else if($policy['ftype']=='Monthly Fee'){
			$Monthly=$policy['amount'];
			
		}
	}
	while ($fees=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
		if($row['batch']==$fees['batch']){
			if($count==0){//if no policy than
				if($fees['ftype']=='admission'){
					$Sem+=$fees['fees'];
				}else{
					$Sem+=$fees['fees'];
					$allSem+=$fees['fees'];
				}
		}else{//if some policy than
			if ($fees['ftype']=='admission') {
				if($admission<=0){
					$Sem+=$fees['fees'];
				}else{
					$Sem+=$admission;
				}
			}else if ($fees['ftype']=='Semester fee') {
				if($Semfee<=0){
					$Sem+=$fees['fees'];
					$allSem+=$fees['fees'];
				}else{
					$Sem+=$Semfee;
					$allSem+=$Semfee;
				}
			}else if ($fees['ftype']=='Monthly Fee') {
				if($Monthly<=0){
					$Sem+=$fees['fees'];
					$allSem+=$fees['fees'];
				}else{
					$Sem+=$Monthly;
					$allSem+=$Monthly;
				}
			}
			
		}
	}
	}?>
	<div class="container">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Semester</th>
					<th>Total Payment</th>
					<th>Payment Done</th>
				</tr>	
			</thead>
			<tbody>
				<?php while ($pay=$select_payment->fetch(PDO::FETCH_ASSOC)) {?>
				<tr>
					
						<td><?=$pay['semester'];?></td>
						<td><?php if($pay['sem_id']==1){echo $Sem;}else{echo $allSem;} ?></td>
						<td>
							<table class="table">
								<tr>
								<td><?=$pay['ftype']?></td>
								<td><?=$pay['amount'];?></td>
								</tr>
							</table>
							
								
							
						</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	