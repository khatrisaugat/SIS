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
  $tbl_name="tbl_students  WHERE sid=".$_GET['sid'];
  $tbl_students=$obj->select($tbl_name);//selecting all data from tbl_students
  $row=$tbl_students->fetch(PDO::FETCH_ASSOC);
  // print_r($row);
  

  $policy="tbl_student_policy JOIN tbl_students ON tbl_students.sid= tbl_student_policy.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE tbl_student_policy.sid=".$_GET['sid'];
  $tbl_students2=$obj->select($policy);//selecting all data from tbl_students
 
  $tbl_fees=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE tbl_fees.batch=".$row['batch']);
  // $row11=$tbl_fees->fetch(PDO::FETCH_ASSOC);
  // print_r($row11);
  // die();
  $tbl_policy=$obj->select("tbl_student_policy WHERE sid=".$_GET['sid']);
  while ($pol=$tbl_policy->fetch(PDO::FETCH_ASSOC)) {
    $polic[]=$pol;
  }

  //for inserting data
  if(isset($_POST['submit'])){
    if($_POST['submit']=='submit'){
      array_pop($_POST);//popping submit from $_POST
      // $join=join(',',array_keys($_POST));
      // echo "$join";
     
      $obj->insert($_POST,"tbl_student_policy");//insert values from form
      $_SESSION['true']="Data inserted successfully!";


      
      
      
    }
  }
$i=0;

?>

<div class="container">
  
          <form action="" method="post" class="form-group">
            <div class="row">
                          <div class="col-md-12">
                            <?php if (isset($_SESSION['true'])):  ?>
                        <div class="alert alert-success">
                            
                            <?php
                             echo $_SESSION['true'];
                             unset($_SESSION['true']);
                             ?>
                        </div>

                    <?php endif;?>
                            <div class="form-group">
                                <h2><?=$row['name']." ".$row['mname']." ".$row['lname']." ". "(".$row['batch'].")";?></h2>
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
                                        for ($i=0; $i < count($polic) ; $i++) { 
                                          $fid[]=$polic[$i]['fid'];
                                        }
                                          $j=0;
                                          if($fid[$j]!=$row1['fid']){?>
                                            <option value="<?=$row1['fid'];?>"><?=$row1['fee_type']." (".$row1['fees'].") ";?></option>
                                            <?php
                                       }                                                            $j++;
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

          <div class="col-md-12">
            <h2>Applied Policies</h2>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Name</th>
                  <th>Fee Type</th>
                  <th>Amount</th>

                </tr>
              </thead>
              <tbody>
               <?php while ($row2=$tbl_students2->fetch(PDO::FETCH_ASSOC)
) { ?>
                <tr>
                  <td><?=++$i;?></td>
                  <td><?=$row2['name'];?></td>
                  <td><?=$row2['fee_type'];?></td>
                  <td><?=$row2['amount'];?></td>

                </tr>
                <?php }
                ?>
                
              </tbody>
            </table>

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

        setTimeout(function() {
            $('.alert').hide('slow')
        }, 3000);
    })
  </script>

</body>

</html>

