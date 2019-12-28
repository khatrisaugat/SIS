<?php 
  require_once("includes/header.php");
  require_once("queries.php");
  $tbl_join="tbl_student_payment JOIN tbl_students ON tbl_students.sid=tbl_student_payment.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid";
  $tbl_student_payment=$obj->select($tbl_join);
  $j=0;

  if(isset($_GET['op'])){
  	if ($_GET['op']=='d') {
  		$tspid['tspid']=$_GET['tspid'];
  		$obj->delete($tspid,"tbl_student_payment");
  		header("Location:display_payment.php");
  	}else if($_GET['op']=='e'){
  		header("Location:edit_payment.php?tspid=".$_GET['tspid']);
  	}
  }



?>
<div class="container">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Photo</th>
				<th>Name</th>
				<th>Fee type</th>
				<th>Batch</th>
				<th>Fees</th>
				<th>Policy Amount</th>
				<th>Amount</th>
				<th>Date</th>
				<th>Delete</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row=$tbl_student_payment->fetch(PDO::FETCH_ASSOC)) {//fetch data from tbl_student_payment
				?>
				<tr>
					<td><?=++$j;?></td>
					<td><?php if(!empty($row['img'])){ ?>
						<a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" width=100%></a>
					<?php }else{
						echo "photo not inserted";
					}?>
					</td>
					<td><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
					<td><?=$row['ftype'];?></td>
					<td><?=$row['batch'];?></td>
					<td><?=$row['fees'];?></td>
					<td><?php
						$spid=$obj->select("tbl_student_policy WHERE spid=".$row['spid']);
						$tbl_spid=$spid->fetch(PDO::FETCH_ASSOC);
						echo $tbl_spid['amount'];
					?>
						
					</td>
					<td><?=$row['amount'];?></td>
					<td><?=$row['pdate'];?></td>
					<td><a href="display_payment.php?tspid=<?=$row['tspid'];?>&op=d" class="btn btn-danger">Delete</a></td>
					<td><a href="display_payment.php?tspid=<?=$row['tspid'];?>&op=e" class="btn btn-info">Edit</a></td>

				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
