<?php

require_once('queries.php');//including queries

if (isset($_POST['submit'])) {//check if form is submitted
	
if (isset($_FILES['image'])) {
		$filename=$_FILES['image']['name'];//filename
		$temp_name=$_FILES['image']['tmp_name'];//temp name
		$location='files/'.$filename;
		move_uploaded_file($temp_name, $location);//upload file
		array_pop($_POST);//popping submit form post

		$_POST['img']=$filename;//insert filename in post variable
		
		$obj->insert($_POST,"tbl_students");//insert query
		
}
}



?>

	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<h1><i class="glyphicon glyphicon-user"></i> Student's Record Form</h1>
				<form action="" method="post" class="form-group" enctype="multipart/form-data">
					<div class="form-group">
						<label>First Name*</label>
						<input type="text" name="name" class="form-control">
					</div>
					<div class="form-group">
						<label>Middle Name*</label>
						<input type="text" name="mname" class="form-control">
					</div>
					<div class="form-group">
						<label>Last Name*</label>
						<input type="text" name="lname" class="form-control">
					</div>
					<div class="form-group">
						<label>Photo*</label>
						<input type="file" name="image" class="form-control">
					</div>
					<div class="form-group">
						<label>City*</label>
						<input type="text" name="city" class="form-control">
					</div>
					<div class="form-group">
						<label>Address*</label>
						<input type="text" name="address" class="form-control">
					</div>
					<div class="form-group">
						<label>Phone*</label>
						<input type="text" name="phone" class="form-control">
					</div>
					<div class="form-group">
						<label>Guardian's Name*</label>
						<input type="text" name="gname" class="form-control">
					</div>
					<div class="form-group">
						<label>Guardian's Phone*</label>
						<input type="text" name="gphone" class="form-control">
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
						<label>Gender*</label><br>
						<label><input type="radio" name="gender" value="male">Male</label>
						<label><input type="radio" name="gender" value="female">Female</label>
					</div>
					<div class="form-group">
						<label>Date*</label>
						<input type="date" name="date" class="form-control">
					</div>
					<button class="btn btn-success" name="submit" value="upload"><i class="glyphicon glyphicon-plus"></i> Add Record</button>
				</form>
			</div>
		</div>
	</div>

<?php
include_once("includes/footer.php")
?>