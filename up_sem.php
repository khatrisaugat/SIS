<?php
session_start();
	if($_SESSION['status']!='Success'){
  	header("Location:login.php");
  				}
  	require_once('queries.php');

  	// selecting current batch
  $select_batch1=$obj->select("batch ORDER BY batch DESC");
  $current_batch=$select_batch1->fetch(PDO::FETCH_ASSOC);
 
  $batch_select=$obj->select("batch");
  $sql="tbl_students WHERE status=1";

if (isset($_POST['submit']) && $_POST['submit']=='Submit') {
	
		$sql.=" AND batch=".$_POST['batch'];

	
}
else{
	$sql.=" AND batch=".$current_batch['batch'];
}

// print_r($_POST);

// print_r($_POST);

if (isset($_POST['submit'])) {
	if ($_POST['submit']=='Upgrade') {
		$query=$obj->select("tbl_students WHERE status=1");
		$semResult=$query->fetch(PDO::FETCH_ASSOC);
		$sem['sem_id']=$semResult['sem_id']+1;
		// $sem_id=$semResult['sem_id'];
		$sn=$_POST['sem'];
		// print_r($sn);
		$obj->updateSem($sem,"tbl_students",$sn);
	}
	elseif ($_POST['submit']=='Downgrade') {
		$query=$obj->select("tbl_students WHERE status=1");
		$semResult=$query->fetch(PDO::FETCH_ASSOC);
		$sem['sem_id']=$semResult['sem_id']-1;
		// $sem_id=$semResult['sem_id'];
		$sn=$_POST['sem'];
		// print_r($sn);
		$obj->updateSem($sem,"tbl_students",$sn);
	}
	}
$select_students=$obj->select($sql);

include("includes/header.php");?>
    <?php include("includes/sidebar.php");?>



	?>
  <section id="main-content">
      <section class="wrapper">
        <div class="row">
        	<div class="col-md-6">
						<form method="post" class="form-group">
						<div class="col-md-8">
							<select name="batch" class="form-control" >
							<option selected="" disabled="">Select Batch</option>
							<?php while ($row=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
								<option value="<?=$row['batch'];?>" 

									<?php

			                      if ($row['batch']==$current_batch['batch']) {
			                      echo "style='font-weight:bold;color:red;'";
			                      }

                      ?>
									><?=$row['batch'];?></option>

								<?php
							} ?>
						</select>
						</div>
						
						<!-- <input type="submit" name="submit" value="Downgrade" class="btn btn-warning" onclick="return confirm('Are you sure you want to downgrade ?');"> -->
						<button  name="submit" value="Submit" class="btn btn-primary" >Filter</button>
						
					</form>		
				</div>	    	
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
				
			  
		</div>
</section>
</section>
<?php include("includes/footer.php"); ?>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script>
  	function check_uncheck_checkbox(isChecked) {
	if(isChecked) {
		$('input[name="sem[]"]').each(function() { 
			this.checked = true; 
		});
	} else {
		$('input[name="sem[]"]').each(function() {
			this.checked = false;
		});
	}
}
  </script>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script>
    $(document).ready(function(){

        setTimeout(function() {
            $('.alert').hide('slow')
        }, 3000);
    })
  </script>

  
</body>

</html>