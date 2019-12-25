<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
require_once("includes/header.php");
require_once('queries.php');

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
						<input type="text" name="ftype" class="form-control">
					</div>
					<label>Batch*</label>
					<!-- <div class="form-group">
						<input type="text" name="batch" class="form-control">
					</div> -->
					<div class="form-group">
						<select name="batch" class="form-control">
							<option selected="" disabled="">Select Your Batch</option>
							<option>2018</option>
							<option>2019</option>
							<option>2020</option>
							<option>2021</option>
							<option>2022</option>
							<option>2023</option>
							<option>2024</option>

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