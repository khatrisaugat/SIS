<?php

require_once("includes/header.php");
require_once('queries.php');
$batch_select=$obj->select("batch");
$fee_select=$obj->select("fee_types");
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
if (isset($_GET['fid'])) {
	array_pop($_GET);
	$value_select=$obj->select("tbl_fees WHERE fid=".$_GET['fid']);
	$value=$value_select->fetch(PDO::FETCH_ASSOC);
}


	


if (isset($_GET['fid'])) {

if (isset($_POST['submit'])) {

if ($_POST['submit']=='submit') {
	array_pop($_POST);
	$sn['fid']=$_GET['fid'];
	// print_r($sn);
	$obj->update($_POST,"tbl_fees",$sn);
	header('location:display_fees.php');
}
}
 } 






?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
						<li><a href="display_policy.php">Display Fee Policy</a></li>
						<li><a href="display_payment.php">Display Payment</a></li>

					</ul>
				</nav>
				</div>
			<div class="col-md-12">
					<div class="col-md-6">
						<h2><i class="glyphicon glyphicon-user"></i> Student's Fee Edit Form</h2>
						<form action="" method="post" class="form-group">
							<div class="form-group">
								<label>Fee Type*</label>
								<select name="ftype" class="form-control">
									<option selected="" disabled="">Select Your Fee type</option>
									<?php while ($fee_type=$fee_select->fetch(PDO::FETCH_ASSOC)) {?>
										<?php print_r($fee_type);?>
										<option value="<?=$fee_type['fee_type'];?>" <?php if ($value['ftype']==$fee_type['fee_type']){echo "Selected";} ?>><?=$fee_type['fee_type'];?></option>
									<?php } ?>
									
								</select>
							</div>
							
							<!-- <div class="form-group">
								<input type="text" name="batch" class="form-control">
							</div> -->
							<div class="form-group">
								<label>Batch*</label>
								<select name="batch" class="form-control">
									<option selected="" disabled="">Select Your Batch</option>
							<?php while ($batch=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
								<option value="<?=$batch['batch'];?>" <?php if($value['batch']==$batch['batch']){echo "selected";}?>><?=$batch['batch'];?></option>
							<?php } ?>

								</select>
							</div>
							<div class="form-group">
								<label>Amount Charged*</label>
								<input type="number" name="fees" class="form-control" value="<?=$value['fees'];?>">
							</div>
							<input type="submit" class="btn btn-success" name="submit" value="submit">
					</form>
				</div>

			</div>
		</div>
	</div>

<?php
include_once("includes/footer.php")
?>