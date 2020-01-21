<<<<<<< HEAD
     <?php
     session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
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
  $_SESSION['true']="Data edited successfully!";
  header('location:display_fees.php');
  exit();
}
}
 } 
    include("includes/header.php"); 
     include("includes/sidebar.php");?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
       
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="col-md-6">
            <h2><i class="glyphicon glyphicon-user"></i> Student's Fee Edit Form</h2>
            <form action="" method="post" class="form-group">
              <div class="form-group">
                <label>Fee Type*</label>
                <select name="ftid" class="form-control">
                  <option selected="" disabled="">Select Your Fee type</option>
                  <?php while ($fee_type=$fee_select->fetch(PDO::FETCH_ASSOC)) {?>
                    <?php print_r($fee_type);?>
                    <option value="<?=$fee_type['ftid'];?>" <?php if ($value['ftid']==$fee_type['ftid']){echo "Selected";} ?>><?=$fee_type['fee_type'];?></option>
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
        </div>
        <!-- row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
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
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>

</body>

</html>
=======
     <?php
     session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
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
  $_SESSION['true']="Data edited successfully!";
  header('location:display_fees.php');
  exit();
}
}
 } 
    include("includes/header.php"); 
     include("includes/sidebar.php");?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
       
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="col-md-6">
            <h2><i class="glyphicon glyphicon-user"></i> Student's Fee Edit Form</h2>
            <form action="" method="post" class="form-group">
              <div class="form-group">
                <label>Fee Type*</label>
                <select name="ftid" class="form-control">
                  <option selected="" disabled="">Select Your Fee type</option>
                  <?php while ($fee_type=$fee_select->fetch(PDO::FETCH_ASSOC)) {?>
                    <?php print_r($fee_type);?>
                    <option value="<?=$fee_type['ftid'];?>" <?php if ($value['ftid']==$fee_type['ftid']){echo "Selected";} ?>><?=$fee_type['fee_type'];?></option>
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
        </div>
        <!-- row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
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
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>

</body>

</html>
>>>>>>> ea6d328f31bc3aae11b0ae22047eeb3fe3352f02
