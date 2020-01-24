
<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
 include("includes/header.php"); ?>
<?php include("includes/sidebar.php");?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
        <?php
       if(!isset($_GET['sid'])){//not letting direct access
  header('Location:display_student.php');
}

require_once("queries.php");
 // selecting current batch
  $select_batch1=$obj->select("batch ORDER BY batch DESC");
  $current_batch=$select_batch1->fetch(PDO::FETCH_ASSOC);

// selecting current semester
  $select_semester=$obj->select("tbl_students WHERE batch=".$current_batch['batch']);

  $semester=$select_semester->fetch(PDO::FETCH_ASSOC);
  $current_semester=$semester['sem_id'];
$j=0;//initialize j
$count=0;//initialize count
$check_policy=$obj->select("tbl_student_policy JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$_GET['sid']);//select policy if exists
$student_select=$obj->select("tbl_students JOIN semester ON semester.sem_id=tbl_students.sem_id WHERE sid=".$_GET['sid']);
$student=$student_select->fetch(PDO::FETCH_ASSOC);//student has student details


?>
<div class="container">
  <table class="table table-bordered table-hover table-responsive">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Headings</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=++$j;?></td>
        <td>Photo</td>
        <td>
          <?php if(!empty($student['img'])){ ?> 
          <a href="files/<?=$student['img'];?>"><img src="files/<?=$student['img'];?>" class="size"></a>
        <?php }else{echo "No image inserted";} ?>
        </td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Name</td>
        <td><?=$student['name']." ".$student['mname']." ".$student['lname'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Gender</td>
        <td><?=$student['gender'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Batch</td>
        <td <?php

                      if ($student['batch']==$current_batch['batch']) {
                      echo "style='font-weight:bold;color:red;'";
                      }

                      ?> 
                      ><?=$student['batch'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Semester</td>
        <td><?=$student['semester'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Address</td>
        <td><?=$student['address'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Phone</td>
        <td><?=$student['phone'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Guardian's Name</td>
        <td><?=$student['gname'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Guardian's Phone</td>
        <td><?=$student['gphone'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Enrollment date</td>
        <td><?=$student['date'];?></td>
      </tr>
      <tr>
        <td><?=++$j;?></td>
        <td>Status</td>
        <td><?php if($student['status']==0){echo "Inactive";}else{echo "Active";}?></td>
      </tr>
      <tr>
        
        <?php while ($policy=$check_policy->fetch(PDO::FETCH_ASSOC)) {
          // print_r($policy);
          $policy_hai[]=['fee_type'=>$policy['fee_type'],'spid'=>$policy['spid'],'amount'=>$policy['amount']];
          $count++;
          ?>
          <td><?=++$j;?></td>
          <td>Policy Name</td>
          <td><?=$policy['fee_type'];?></td>
          
        
        
        <tr>
          <td><?=++$j;?></td>
          <td>Policy Amount</td>
          <td><?=$policy['amount'];?></td>
        </tr>
      <?php } ?>
      </tr>
    </tbody>
  </table>
  <?php
    $query_complete="tbl_student_payment JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN semester ON semester.sem_id=tbl_student_payment.semester JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$_GET['sid'];
    $j=0;
  $student_payment_select=$obj->select($query_complete);
  ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Payment type</th>
        <th>Payment Date</th>
        <th>Payment Amount</th>
        <th>Semester</th>
        <th>Applicable Amount</th>
      </tr>
      
    </thead>
    <tbody>
      <?php while ($payment=$student_payment_select->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
          <td><?=++$j;?></td>
          <td><?=$payment['fee_type'];?></td>
          <td><?=$payment['pdate'];?></td>
          <td><?=$payment['amount'];?></td>
          <td <?php

                      if ($payment['sem_id']==$current_semester) {
                      echo "style='font-weight:bold;color:red;'";
                      }

                      ?> 
                      ><?=$payment['semester']?></td>

          <td>
            <?php 
            // if($count>0){
              // for ($i=0; $i <count($policy_hai) ; $i++) { 
                // if ($payment['spid']==$policy_hai[$i]['spid']) {
                  // echo "Policy Amount = ".$policy_hai[$i]['amount'];
                // }
              // }
            // }
            ?>
            <?php 
            $check_policy=$obj->select("tbl_student_policy WHERE sid=".$_GET['sid']." AND fid=".$payment['fid']);//select policy if exists
            $fees_select=$obj->select("tbl_fees WHERE fid=".$payment['fid']);
            $fee_amount=$fees_select->fetch(PDO::FETCH_ASSOC);
            while ($row7=$check_policy->fetch(PDO::FETCH_ASSOC)) {
              $fee_amount['fees']=$row7['amount'];
            }
            echo $fee_amount['fees'];
            ?>
              
          </td>
        </tr>
        <?php
        
      } ?>
      
    </tbody>
  </table>
  <a href="payment_details.php?sid=<?=$_GET['sid'];?>" class="btn btn-info">Payment details</a>
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

  <style>
    .size{height: 120px;width: 120px;}
  </style>
</body>

</html>
