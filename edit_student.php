<?php
 	require_once("includes/header.php");
	require_once("queries.php");//including queries
	$query_complete="`tbl_students` WHERE sid=".$_GET['sid'];
	$select_single=$obj->select($query_complete);//select single data row 
	$row=$select_single->fetch(PDO::FETCH_ASSOC);//row contains values of selected data
	 print_r($row);
if (isset($_POST['submit'])) {//check if form is submitted
	
	if (isset($_FILES['image'])) {
		$filename=$_FILES['image']['name'];//filename
		$temp_name=$_FILES['image']['tmp_name'];//temp name
		$location='files/'.$filename;
		move_uploaded_file($temp_name, $location);//upload file
		array_pop($_POST);//popping submit form post
		$sn['sid']=$_GET['sid'];
		$_POST['img']=$filename;//insert filename in post variable
		
		
		
	}
	$obj->update($_POST,"tbl_students",$sn);//update query
	header("Location:display_student.php");
}
if(isset($_GET['img'])){//check if the image edit link is clicked
	if($_GET['img']=='d'){
	$location='files/'.$row['img'];
	unlink($location);//delete image from storage
	$_GET['img']='ok';//get variable is assigned to new value as to prevent error since the page will refresh

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
						<input type="text" name="name" class="form-control"value="<?=$row['name'];?>">
					</div>
					<div class="form-group">
						<label>Middle Name*</label>
						<input type="text" name="mname" class="form-control"value="<?=$row['mname'];?>">
					</div>
					<div class="form-group">
						<label>Last Name*</label>
						<input type="text" name="lname" class="form-control"value="<?=$row['lname'];?>">
					</div>
					<div class="form-group">
						<label>Photo*</label>
						<?php if(!empty($row['img']) && !isset($_GET['img'])){?>
							<a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" width="100%"></a><br>
							<a href="edit_student.php?sid=<?=$_GET['sid'];?>&img=d">Edit image</a>
							<?php

						}else{ ?>
						<input type="file" name="image" class="form-control">
					<?php } ?>
					</div>
					<div class="form-group">
						<label>City*</label>
						<input type="text" name="city" class="form-control"value="<?=$row['city'];?>">
					</div>
					<div class="form-group">
						<label>Address*</label>
						<input type="text" name="address" class="form-control"value="<?=$row['address'];?>">
					</div>
					<div class="form-group">
						<label>Phone*</label>
						<input type="text" name="phone" class="form-control"value="<?=$row['phone'];?>">
					</div>
					<div class="form-group">
						<label>Guardian's Name*</label>
						<input type="text" name="gname" class="form-control"value="<?=$row['gname'];?>">
					</div>
					<div class="form-group">
						<label>Guardian's Phone*</label>
						<input type="text" name="gphone" class="form-control"value="<?=$row['gphone'];?>">
					</div>
					<label>Batch*</label>
					<!-- <div class="form-group">
						<input type="text" name="batch" class="form-control">
					</div> -->
					<div class="form-group">
						<select name="batch" class="form-control">
							<option <?php if($row['batch']==2018){echo "selected";}?>>2018</option>
							<option <?php if($row['batch']==2019){echo "selected";}?>>2019</option>
							<option <?php if($row['batch']==2020){echo "selected";}?>>2020</option>
							<option <?php if($row['batch']==2021){echo "selected";}?>>2021</option>
							<option <?php if($row['batch']==2022){echo "selected";}?>>2022</option>
							<option <?php if($row['batch']==2023){echo "selected";}?>>2023</option>
							<option <?php if($row['batch']==2024){echo "selected";}?>>2024</option>

						</select>
					</div>
					<div class="form-group">
						<label>Gender*</label><br>
						<label><input type="radio" name="gender" value="male" <?php if($row['gender']=='male'){echo "checked";}?>>Male</label>
						<label><input type="radio" name="gender" value="female"<?php if($row['gender']=='female'){echo "checked";}?>>Female</label>
					</div>
					<div class="form-group">
						<label>Date*</label>
						<input type="date" name="date" class="form-control"value="<?=$row['date'];?>">
					</div>
					<button class="btn btn-success" name="submit" value="upload"><i class="glyphicon glyphicon-plus"></i> Update Record</button>
				</form>
			</div>
		</div>
	</div>

<?php
include_once("includes/footer.php")
?>
?>
