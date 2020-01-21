<<<<<<< HEAD
<?php 
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
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
        <?php
         require_once('queries.php');
$fee_select=$obj->select("fee_types");
$batch_select=$obj->select("batch");

if (isset($_POST['submit'])) {
  array_pop($_POST);//popping submit from post
  $obj->insert($_POST,"tbl_fees");//insert to tbl_fees
  $_SESSION['true']="Data inserted successfully!";
  // exit();
}



?>

  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <?php if (isset($_SESSION['true'])) :?>

          <div class="alert alert-success">
            <?php echo $_SESSION['true'];
            unset($_SESSION['true']);
            ?>
          </div>


        <?php endif;?>
        <h2><i class="glyphicon glyphicon-user"></i>Fees Insert</h2>
        <form action="" method="post" class="form-group">
          <div class="form-group">
            <label>Fee Type*</label>
            <select name="ftid" class="form-control">
              <option selected="" disabled="">Select Your Fee type</option>
              <?php while ($fee_type=$fee_select->fetch(PDO::FETCH_ASSOC)) {?>
                <option value="<?=$fee_type['ftid'];?>"><?=$fee_type['fee_type'];?></option>
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
<script>
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').hide('slow')
    },3000);
  })
</script>
 
</body>

</html>
=======
<?php 
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
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
        <?php
         require_once('queries.php');
$fee_select=$obj->select("fee_types");
$batch_select=$obj->select("batch");

if (isset($_POST['submit'])) {
  array_pop($_POST);//popping submit from post
  $obj->insert($_POST,"tbl_fees");//insert to tbl_fees
  $_SESSION['true']="Data inserted successfully!";
  // exit();
}



?>

  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <?php if (isset($_SESSION['true'])) :?>

          <div class="alert alert-success">
            <?php echo $_SESSION['true'];
            unset($_SESSION['true']);
            ?>
          </div>


        <?php endif;?>
        <h2><i class="glyphicon glyphicon-user"></i>Fees Insert</h2>
        <form action="" method="post" class="form-group">
          <div class="form-group">
            <label>Fee Type*</label>
            <select name="ftid" class="form-control">
              <option selected="" disabled="">Select Your Fee type</option>
              <?php while ($fee_type=$fee_select->fetch(PDO::FETCH_ASSOC)) {?>
                <option value="<?=$fee_type['ftid'];?>"><?=$fee_type['fee_type'];?></option>
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
<script>
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').hide('slow')
    },3000);
  })
</script>
 
</body>

</html>
>>>>>>> ea6d328f31bc3aae11b0ae22047eeb3fe3352f02
