<?php
     session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
        require_once('queries.php');


// echo "<pre>";
// print_r($_GET);
// echo "</pre>";


if (isset($_POST['submit'])) {

if ($_POST['submit']=='submit') {
  array_pop($_POST);
  $obj->insert($_POST,"fee_types");
  $_SESSION['true']="Data inserted successfully";
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
            <?php if(isset($_SESSION['true'])):?>
              <div class="alert alert-success">
                <?php echo $_SESSION['true'];
                unset($_SESSION['true']);
                ?>
              </div>


            <?php endif;?>
            <h2><i class="glyphicon glyphicon-user"></i>FeeType Insert Form</h2>
            <form action="" method="post" class="form-group">
              <div class="form-group">
                <label>Fee Type</label>
                <input type="text" name="fee_type" class="form-control">
              </div>
              <div class="form-group">
                <label>Applicable for:</label>
                <select name="sem_wise" class="form-control">
                  <option value="0">1st Semester</option>
                  <option value="1">All Semester</option>
                </select>
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
<script>
 $(document).ready(function(){
    setTimeout(function(){
      $ ('.alert').hide('slow')
    },3000);
  })


</script>
</body>

</html>