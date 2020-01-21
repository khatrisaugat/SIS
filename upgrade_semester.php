<<<<<<< HEAD
<?php
session_start();
	if($_SESSION['status']!='Success'){
  	header("Location:login.php");
  				}
  	require_once('queries.php');
  	$batch_select=$obj->select("batch");


if (isset($_POST['submit'])) {
	if ($_POST['submit']=='Upgrade') {
		$query=$obj->select("tbl_students WHERE status=1 AND batch=".$_POST['batch']);
		$semResult=$query->fetch(PDO::FETCH_ASSOC);
		$sem['sem_id']=$semResult['sem_id']+1;
		$sn['batch']=$_POST['batch'];
		$obj->update($sem,"tbl_students",$sn);
	}
	elseif ($_POST['submit']=='Downgrade') {
		$query=$obj->select("tbl_students WHERE status=1 AND batch=".$_POST['batch']);
		$semResult=$query->fetch(PDO::FETCH_ASSOC);
		$sem['sem_id']=$semResult['sem_id']-1;
		$sn['batch']=$_POST['batch'];
		$obj->update($sem,"tbl_students",$sn);
	}
	}

include("includes/header.php");?>
    <?php include("includes/sidebar.php");?>



	?>
  <section id="main-content">
      <section class="wrapper">
        <div class="row">
			  <div class="container">
			    <div class="row">
					<div class="col-md-6">
						<form method="post" class="form-group">
						<select name="batch" class="form-control">
							<option selected="" disabled="">Select Batch</option>
							<?php while ($row=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
								<option value="<?=$row['batch'];?>"><?=$row['batch'];?></option>

								<?php
							} ?>
						</select><br>
						<input type="submit" name="submit" value="Downgrade" class="btn btn-warning" onclick="return confirm('Are you sure you want to downgrade ?');">
						<input type="submit" name="submit" value="Upgrade" class="btn btn-primary" onclick="return confirm('Are you sure you want to upgrade ?');">
						
					</form>		
					</div>	    	


			      </div>
			  </div>
		</div>
</section>
</section>
<?php include("includes/footer.php"); ?>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
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

=======
<?php
session_start();
	if($_SESSION['status']!='Success'){
  	header("Location:login.php");
  				}
  	require_once('queries.php');
  	$batch_select=$obj->select("batch");


if (isset($_POST['submit'])) {
	if ($_POST['submit']=='Upgrade') {
		$query=$obj->select("tbl_students WHERE status=1 AND batch=".$_POST['batch']);
		$semResult=$query->fetch(PDO::FETCH_ASSOC);
		$sem['sem_id']=$semResult['sem_id']+1;
		$sn['batch']=$_POST['batch'];
		$obj->update($sem,"tbl_students",$sn);
	}
	elseif ($_POST['submit']=='Downgrade') {
		$query=$obj->select("tbl_students WHERE status=1 AND batch=".$_POST['batch']);
		$semResult=$query->fetch(PDO::FETCH_ASSOC);
		$sem['sem_id']=$semResult['sem_id']-1;
		$sn['batch']=$_POST['batch'];
		$obj->update($sem,"tbl_students",$sn);
	}
	}

include("includes/header.php");?>
    <?php include("includes/sidebar.php");?>



	?>
  <section id="main-content">
      <section class="wrapper">
        <div class="row">
			  <div class="container">
			    <div class="row">
					<div class="col-md-6">
						<form method="post" class="form-group">
						<select name="batch" class="form-control">
							<option selected="" disabled="">Select Batch</option>
							<?php while ($row=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
								<option value="<?=$row['batch'];?>"><?=$row['batch'];?></option>

								<?php
							} ?>
						</select><br>
						<input type="submit" name="submit" value="Downgrade" class="btn btn-warning" onclick="return confirm('Are you sure you want to downgrade ?');">
						<input type="submit" name="submit" value="Upgrade" class="btn btn-primary" onclick="return confirm('Are you sure you want to upgrade ?');">
						
					</form>		
					</div>	    	


			      </div>
			  </div>
		</div>
</section>
</section>
<?php include("includes/footer.php"); ?>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
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

>>>>>>> ea6d328f31bc3aae11b0ae22047eeb3fe3352f02
</html>