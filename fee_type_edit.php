 <?php
     session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
        require_once('queries.php');
$fee_select=$obj->select("fee_types WHERE ftid=".$_GET['ftid']);
$row=$fee_select->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
if (isset($_GET['ftid'])) {

if (isset($_POST['submit'])) {

if ($_POST['submit']=='submit') {
  array_pop($_POST);
  $sn['ftid']=$_GET['ftid'];
  // print_r($sn);
  $obj->update($_POST,"fee_types",$sn);
  header('location:fee_type_display.php');
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
            <h2><i class="glyphicon glyphicon-user"></i> Fee Type Edit Form</h2>
            <form action="" method="post" class="form-group">
              <div class="form-group">
                <label>Fee Type</label>
                <input type="text" name="fee_type" class="form-control" value="<?=$row['fee_type'];?>">
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