<?php
	require_once("includes/header.php");
  require_once("queries.php");
$policyData=$obj->select("tbl_student_policy");

if (isset($_GET['spid'])) {
	if ($_GET['op']=='d') {
		array_pop($_GET);
		$obj->delete($_GET,"tbl_student_policy");
	}
	else if($_GET['op']=='e'){
  		header("Location:edit_policy.php?spid=".$_GET['spid']);
  	}
}
// echo $fullnName;
$i=0;
?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<nav>
					<ul class="nav ">
						<li><a href="tbl_student_form.php">Insert Students</a></li>
						<li><a href="tbl_fees_form.php">Insert Fees</a></li>
						<li><a href="Student_policy.php">Insert Fee Policy</a></li>
						<li><a href="Student_payment.php">Insert Payment</a></li>
						<li><a href="display_student.php">Display Students</a></li>
						<li><a href="display_fees.php">Display Fees</a></li>
						<li><a href="display_Policy.php">Display Fee Policy</a></li>
						<li><a href="display_payment.php">Display Payment</a></li>

					</ul>
					</nav>
			 </div>
			<div class="col-md-12">
				<h2>Display Fee Policy Table</h2>
				<table class="table table-striped" border="1">
					<thead>
						<tr>
							<th>SN</th>
							<th>Student Name</th>
							<th>Fee Type</th>
							<th>Amount</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tbody>
						<?php
						while ($row=$policyData->fetch(PDO::FETCH_ASSOC)) {?>
							<tr>
							   <td><?=++$i;?></td>
							   <td><?php
							   // print_r($row);
								$sn['sid']=$row['sid'];
								$nameResult=$obj->select("tbl_students WHERE sid=".$row['sid']);
								$result=$nameResult->fetch(PDO::FETCH_ASSOC);
								$fullnName=$result['name']." ".$result['mname']." ".$result['lname'];
									echo $fullnName;?>

								</td>

							   <td><?php
							   $fid['fid']=$row['fid'];
							   $ftypeResult=$obj->select("tbl_fees WHERE fid=".$row['fid']);

							   // print_r($ftypeResult);
							   $ftype=$ftypeResult->fetch(PDO::FETCH_ASSOC);
							   echo $ftype['ftype'];?></td>
							   <td><?=$row['amount'];?></td>
							   <td><a href="display_policy.php?spid=<?=$row['spid'];?>&op=e">Edit</a></td>
							   <td><a href="display_policy.php?spid=<?=$row['spid'];?>&op=d">Delete</a></td>


						    </tr>
						<?php }?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

<?php 
require_once("includes/footer.php");
?>




