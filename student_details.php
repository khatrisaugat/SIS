<?php 
require_once("includes/header.php");
require_once("queries.php");
$j=0;//initialize j
$count=0;//initialize count
$check_policy=$obj->select("tbl_student_policy JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid WHERE sid=".$_GET['sid']);//select policy if exists
$student_select=$obj->select("tbl_students WHERE sid=".$_GET['sid']);
$student=$student_select->fetch(PDO::FETCH_ASSOC);//student has student details


?>
<div class="container">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Headings</th>
				<th>Detail</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=++$j;?></td>
				<td>Photo</td>
				<td>
					<?php if(!empty($student['img'])){ ?> 
					<a href="files/<?=$student['img'];?>"><img src="files/<?=$student['img'];?>" width=100%></a>
				<?php }else{echo "No image inserted";} ?>
				</td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Name</td>
				<td><?=$student['name']." ".$student['mname']." ".$student['lname'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Gender</td>
				<td><?=$student['gender'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Batch</td>
				<td><?=$student['batch'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Address</td>
				<td><?=$student['address'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Phone</td>
				<td><?=$student['phone'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Guardian's Name</td>
				<td><?=$student['gname'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Guardian's Phone</td>
				<td><?=$student['gphone'];?></td>
			</tr>
			<tr>
				<td><?=++$j;?></td>
				<td>Enrollment date</td>
				<td><?=$student['date'];?></td>
			</tr>
			<tr>
				
				<?php while ($policy=$check_policy->fetch(PDO::FETCH_ASSOC)) {
					// print_r($policy);
					$policy_hai[]=['ftype'=>$policy['ftype'],'spid'=>$policy['spid'],'amount'=>$policy['amount']];
					$count++;
					?>
					<td><?=++$j;?></td>
					<td>Policy Name</td>
					<td><?=$policy['ftype'];?></td>
					
				
				
				<tr>
					<td><?=++$j;?></td>
					<td>Policy Amount</td>
					<td><?=$policy['amount'];?></td>
				</tr>
			<?php } ?>
			</tr>
		</tbody>
	</table>
	<?php
	if ($count>0) {
		$query_complete="tbl_student_payment JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid WHERE sid=".$_GET['sid'];
	}else{
		$query_complete="tbl_student_payment JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid WHERE sid=".$_GET['sid'];
	}
		$j=0;
	$student_payment_select=$obj->select($query_complete);
	?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Payment type</th>
				<th>Payment Date</th>
				<th>Payment Amount</th>
				<th>Policy(if any)</th>
			</tr>
			
		</thead>
		<tbody>
			<?php while ($payment=$student_payment_select->fetch(PDO::FETCH_ASSOC)) {?>
				<tr>
					<td><?=++$j;?></td>
					<td><?=$payment['ftype'];?></td>
					<td><?=$payment['pdate'];?></td>
					<td><?=$payment['amount'];?></td>
					<td>
						<?php 
						if($count>0){
							for ($i=0; $i <count($policy_hai) ; $i++) { 
								if ($payment['spid']==$policy_hai[$i]['spid']) {
									echo "Policy Amount = ".$policy_hai[$i]['amount'];
								}
							}
						}
						?>
							
					</td>
				</tr>
				<?php
				
			} ?>
			
		</tbody>
	</table>
</div>
