<?php
session_start();
	if($_SESSION['status']!='Success'){
  	header("Location:login.php");
  				}
  	require_once('queries.php');
  $batch_select=$obj->select("batch");
  $sql="tbl_students";

if (isset($_GET['batch'])) {
	
		$sql.=" WHERE batch=".$_GET['batch']." AND status=1";

	
}

// print_r($_POST);

// print_r($_POST);
$select_students=$obj->select($sql);
$_SESSION['batch']=$_GET['batch'];
	?>
 <!--  <section id="main-content">
      <section class="wrapper">
        <div class="row">
        	<div class="col-md-6">
						<form method="post" class="form-group">
						<div class="col-md-8"> -->
		    	
					<div class="col-md-8">
						<form method="post">
							<table class="table table-bordered">
				  				<thead>
				  					<tr>
				  						
				  						<th>Students Name</th>
				  						<th>Semester</th>
				  					</tr>
				  				</thead>
				  				<tbody>
				  				<?php while($row=$select_students->fetch(PDO::FETCH_ASSOC)) {?>
				  					<tr>
				  					<!-- <div id="divCheckboxList"> -->
				  						<td><input type="checkbox" name="sem[]"  value="<?=$row['sid'];?>" /> <?=$row['name'].$row['mname'].$row['lname'];?></td>
				  						<td><?=$row['sem_id'];?></td>
				  					<!-- </div> -->
				  					</tr>
				  				<?php }?>
				  				</tbody>
				 			 </table>
							
				
		
						

							<div id="divCheckAll">
								<label>
								<input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);"> Check All</input></label>
							</div>
							<br>
							<button name="submit" value="Downgrade" class="btn btn-info" onclick="return confirm('Are you sure you want to Downgrade Semester');">Downgrade Semester</button>
				 			 <button name="submit" value="Upgrade" class="btn btn-warning" onclick="return confirm('Are you sure you want to Upgrade Semester');">Upgrade Semester</button>
						</form>
					</div>
				
			  
		<!-- </div>
</section>
</section> -->
