<?php
require_once("includes/header.php");
require_once('queries.php');
$obj= new queries;
$feesData=$obj->select("tbl_fees");
$i=0;
if (isset($_GET['op'])) {
	if ($_GET['op']='d') {
		// print_r($_GET);
		array_pop($_GET);	
		$obj->delete($_GET,"tbl_fees");
		header('location:display_fees.php');
	}

	else if($_GET['op']=='e'){
		$sn=$_GET['fid'];
		header("location:edit_fees.php?fid=.$sn");
		
		
	}
	
	
	
}
?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<nav>
					<ul class="nav navbar-nav">
						<li><a href="tbl_student_form.php">Insert Students</a></li>
						<li><a href="tbl_fees_form.php">Insert Fees</a></li>
						<li><a href="Student_policy.php">Insert Fee Policy</a></li>
						<li><a href="Student_payment.php">Insert Payment</a></li>
						<li><a href="display_student.php">Display Students</a></li>
						<li><a href="display_fees.php">Display Fees</a></li>
						<li><a href="display_policy.php">Display Fee Policy</a></li>
						<li><a href="display_payment.php">Display Payment</a></li>

					</ul>
				</nav>
			</div>
			<div class="col-md-12">
				<h2>Display Fees Table</h2>
				<table class="table table-striped" border="1">
					<thead>
						<tr>
							<th>SN</th>
							<th>Fee Type</th>
							<th>Batch</th>
							<th>Fees</th>
							<th>Edit</th>
							<th>Delete</th>

						</tr>
					</thead>
					<tbody>
						<?php
						while ($row=$feesData->fetch(PDO::FETCH_ASSOC)) {?>
							<tr>
							   <td><?=++$i;?></td>
							   <td><?=$row['ftype'];?></td>
							   <td><?=$row['batch'];?></td>
							   <td><?=$row['fees'];?></td>
							   <td><a href="edit_fees.php?fid=<?=$row['fid'];?>&op=e">Edit</a></td>
							   <td><a href="display_fees.php?fid=<?=$row['fid'];?>&op=d">Delete</a></td>


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