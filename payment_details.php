
<?php
	session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
include("includes/header.php"); 
 include("includes/sidebar.php");
 ?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
        <?php
      if (!isset($_GET['sid'])) {//not letting direct access
  header("Location:display_student.php");
}
require_once("queries.php");//include queries
 // selecting current batch
  $select_batch1=$obj->select("batch ORDER BY batch DESC");
  $current_batch=$select_batch1->fetch(PDO::FETCH_ASSOC);

// selecting current semester
  $select_semester=$obj->select("tbl_students WHERE batch=".$current_batch['batch']);

  $semester=$select_semester->fetch(PDO::FETCH_ASSOC);
  $current_semester=$semester['sem_id'];
$query="tbl_student_payment JOIN semester ON semester.sem_id=tbl_student_payment.semester JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$_GET['sid'];//query for selecting payment data
  $select_payment=$obj->select($query);//select payment data
  //initialization
  $Totalpaid=0;
  $firstSem=0;
  $allSem=0;
  //initialization


  $policy_select=$obj->select("tbl_student_policy JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$_GET['sid']);//select policy
  $tbl_fees=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid");//select fees

  $tbl_student=$obj->select("tbl_students WHERE sid=".$_GET['sid']);//select student data
  $row=$tbl_student->fetch(PDO::FETCH_ASSOC);//fetch student data


  while ($policy=$policy_select->fetch(PDO::FETCH_ASSOC)) {
  	// print_r($policy);
  	$check[]=$policy['fid'];
  	if($policy['sem_wise']==0){
  		$firstSem+=$policy['amount'];
  	}else{
  		$firstSem+=$policy['amount'];
  		$allSem+=$policy['amount'];
  	}
  }
  // if (!isset($check)) {
  //  $check[0]=0;
  // }

  $i=0;
  while ($fees=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
  	if($fees['batch']==$row['batch']){
  			if($fees['fid']!=$policy['fid']){
  				if($fees['sem_wise']==0){
			  		$firstSem+=$fees['fees'];
			  	}else{
			  		$firstSem+=$fees['fees'];
			  		$allSem+=$fees['fees'];
			  	}
  			}
  			// if ($check[0]!=0) {
     //     $i++;
     //    }
  		}
  	}
?>
<div class="container">
    <table class="table table-bordered table-hover table-responsive">
      <thead>
        <tr>
          <th>Semester</th>
          <!-- <th>Total Payment</th> -->
          <th>Payment Done</th>
        </tr> 
      </thead>
      <tbody>
        <?php while ($pay=$select_payment->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
          
            <td <?php

                      if ($pay['sem_id']==$current_semester) {
                      echo "style='font-weight:bold;color:red;'";
                      }

                      ?>
                      ><?=$pay['semester'];?></td>
            <td>
                <table class="table table-hover table-responsive">
                  <thead>
                        <tr>
                            <th><?=$pay['fee_type'];?></th>
                            <th><?=$pay['amount'];
                            $Totalpaid+=$pay['amount'];
                            ?></th>
                            <th><?=$pay['pdate'];?></th>
                        </tr>
                  </thead>
                </table>
            </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <h3>Total Paid=<?=$Totalpaid?></h3><br>
    <h3>Total Amount=<?=($firstSem+(7*$allSem));?></h3>
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
