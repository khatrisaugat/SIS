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
  $tbl_name="tbl_students WHERE sid=".$_GET['sid'];//selecting the student 
  $tbl_students=$obj->select($tbl_name);
  //selecting data from tbl_students
  $row=$tbl_students->fetch(PDO::FETCH_ASSOC);
  //fetch the data of the student
  $tbl_fees=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$row['batch']);
  //selecting all data from tbl_fees
  $tbl_join_policy="`tbl_student_policy` JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN tbl_students ON tbl_students.sid=tbl_student_policy.sid";
  //joining tbl_students_payment and tbl_fees
  $tbl_student_policy=$obj->select($tbl_join_policy);
  //selecting all data from tbl_student_policy
  
  $tbl_sem=$obj->select("semester");
  if(isset($_POST['submit'])){
    if($_POST['submit']=='submit'){
      array_pop($_POST);
      //popping submit from $_POST

      // $join=join(',',array_keys($_POST));
      // echo "$join";

      if($_POST['spid']==''){
            unset($_POST['spid']);
            //if there is no policy than spid is not needed
      }

      $obj->insert($_POST,"tbl_student_payment");
      //insert values from form
      
      
    }
  }




?>

<div class="container">
          <form action="" method="post" enctype="multipart/form-data" class="form-group">
            <div class="row">
             <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating"><?=$row['name']." ".$row['mname']." ".$row['lname'];?></label>
                 <input type="hidden" name="sid" value="<?=$row['sid']?>">
                </div>
              </div>
            </div>
            <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Fee Type</label>
                                <select name="fid" class="form-control">
                                    <?php
                                      while ($row1=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row1['fid'];?>"><?=$row1['fee_type']." (".$row1['batch'].") ";?></option>
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
                                <label class="bmd-label-floating">Student Policy</label>
                                <select name="spid" class="form-control">
                                  <option value="" selected="">No policy</option>
                                    <?php
                                      while ($row2=$tbl_student_policy->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row2['spid'];?>"><?=$row2['ftype']." (".$row2['batch'].") ".$row2['amount']." for ".$row2['name'];?></option>
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
                                <label class="bmd-label-floating">Semester</label>
                                <select name="semester" class="form-control">
                                  <option value="" selected="" disabled="">Select</option>
                                    <?php
                                      while ($row3=$tbl_sem->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row3['sem_id'];?>"><?=$row3['semester'];?></option>
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
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">date</label>
                            <input type="date" name="pdate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
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
