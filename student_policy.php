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
          require_once("queries.php");
  $tbl_name="tbl_students WHERE sid=".$_GET['sid'];
  $tbl_students=$obj->select($tbl_name);//selecting all data from tbl_students
  $row=$tbl_students->fetch(PDO::FETCH_ASSOC);
  $tbl_fees=$obj->select("tbl_fees WHERE batch=".$row['batch']);
  // $row=$result->fetch(PDO::FETCH_ASSOC);
  // print_r($row);

  //for inserting data
  if(isset($_POST['submit'])){
    if($_POST['submit']=='submit'){
      array_pop($_POST);//popping submit from $_POST
      // $join=join(',',array_keys($_POST));
      // echo "$join";
      $obj->insert($_POST,"tbl_student_policy");//insert values from form
      
      
    }
  }


?>

<div class="container">
          <form action="" method="post" class="form-group">
            <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating"><?=$row['name'];?></label>
                                 <input type="hidden" name="sid" value="<?=$row['sid'];?>">
                            </div>

                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Student</label>
                                <select name="fid" class="form-control">
                                    <?php
                                      while ($row1=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row1['fid'];?>"><?=$row1['ftype']." (".$row1['fees'].") ";?></option>
                                        <?php
                                      }
                                    ?>
                                </select>
                            </div>
                            
                          </div>
                        </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">amount</label>
                          <input type="number" name="amount" class="form-control">
                        </div>
                      </div>
                    </div>
                    
          <input type="submit" name="submit"  class="btn btn-success" value="submit">
          </form>
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
