<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
require_once("includes/header.php");
require_once('queries.php');
$fee_select=$obj->select("fee_types");
$batch_select=$obj->select("batch");

if (isset($_POST['submit'])) {
	array_pop($_POST);//popping submit from post
	$obj->insert($_POST,"tbl_fees");//insert to tbl_fees
	
}



?>

	<div class="container">
		<div class="row">
			<div class="col-md-5">
				
					
				<h2><i class="glyphicon glyphicon-user"></i> Student's Fee Record Form</h2>
				<form action="" method="post" class="form-group">
					<div class="form-group">
						<label>Fee Type*</label>
						<select name="ftype" class="form-control">
							<option selected="" disabled="">Select Your Fee type</option>
							<?php while ($fee_type=$fee_select->fetch(PDO::FETCH_ASSOC)) {?>
								<option value="<?=$fee_type['fee_type'];?>"><?=$fee_type['fee_type'];?></option>
							<?php } ?>
							
						</select>
					</div>
					<label>Batch*</label>
					<!-- <div class="form-group">
						<input type="text" name="batch" class="form-control">
					</div> -->
					<div class="form-group">
						<select name="batch" class="form-control">
							<option selected="" disabled="">Select Your Batch</option>
								<?php while ($batch=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
								<option value="<?=$batch['batch'];?>"><?=$batch['batch'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Amount Charged*</label>
						<input type="number" name="fees" class="form-control">
					</div>
					<input type="submit" class="btn btn-success" name="submit" value="submit">
				</form>
			</div>
		</div>
	</div>

<?php
include_once("includes/footer.php")
?>