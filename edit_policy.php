<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
        require_once("queries.php");
        if (isset($_GET['spid'])) {
          $tspid_select=$obj->select("tbl_student_policy WHERE spid=".$_GET['spid']);
          $tspid=$tspid_select->fetch(PDO::FETCH_ASSOC);
          // $sn['sid']=$tspid['sid'];
          $fid['fid']=$tspid['fid'];
          $name_select=$obj->select("tbl_students WHERE sid=".$tspid['sid']);
          $row=$name_select->fetch(PDO::FETCH_ASSOC);
          $ftype_select=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE fid=".$fid['fid']);
          $ftype=$ftype_select->fetch(PDO::FETCH_ASSOC);

            if (isset($_POST['submit'])) {

              if ($_POST['submit']=='submit') {
                array_pop($_POST);
                $sn['spid']=$_GET['spid'];
                // print_r($sn);
                $obj->update($_POST,"tbl_student_policy",$sn);
                header('location:display_policy.php');
              }
            }
          } 
  $tbl_name="tbl_students";
  $tbl_students=$obj->select($tbl_name);//selecting all data from tbl_students
  $tbl_fees=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$row['batch']);


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
        
    <div class="container">
            <div class="row">
                       <div class="col-md-12">
                              <form action="" method="post" class="form-group">
                                    <div class="col-md-6">
                                        <h1><i class="glyphicon glyphicon-user"></i> Student's Fee Policy Form</h1>
                                        <div class="form-group">
                                            <label><?=$row['name'];?></label>
                                            <input type="hidden" name="sid" value="<?=$row['sid'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Fees</label>
                                            <select name="fid" class="form-control">
                                              <option selected="" disabled="">Select Option</option>
                                                <?php
                                                  while ($row1=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                      <option value="<?=$row1['fid'];?>" 
                                                          <?php if ($row1['fid']==$ftype['fid']) {
                                                          echo "selected";
                                                        }?>
                                                        ><?=$row1['fee_type']." (".$row1['batch'].") ";?></option>
                                                    <?php
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                        
                                     
                                
                                    <div class="form-group">
                                        <label>amount</label>
                                <input type="number" name="amount" class="form-control" value="<?=$tspid['amount'];?>">
                                    </div>
                                  <input type="submit" name="submit"  class="btn btn-success" value="submit">  
                            </div>    
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

</body>

</html>
