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
      if (!isset($_GET['sid'])) {//not letting direct access
  header("Location:display_student.php");
}
//initialization
  $count=0;
  $Sem=0;
  $allSem=0;
  $Monthly=0;
  $Semfee=0;
  $admission=0;
//initialization finish
  require_once("queries.php");//include queries
  $query="tbl_student_payment JOIN semester ON semester.sem_id=tbl_student_payment.semester JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$_GET['sid'];//query for selecting payment data
  $select_payment=$obj->select($query);//select payment data

  $policy_select=$obj->select("tbl_student_policy JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$_GET['sid']);//select policy
  $tbl_fees=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid");//select fees

  $tbl_student=$obj->select("tbl_students WHERE sid=".$_GET['sid']);//select student data
  $row=$tbl_student->fetch(PDO::FETCH_ASSOC);//fetch student data
  
  //Calculation of fees for each semester excluding exam fees and including policy
  while ($policy=$policy_select->fetch(PDO::FETCH_ASSOC)) {//check policy
    
    $count++;
    if($policy['fee_type']=='admission'){
      $admission=$policy['amount'];
      
    }else if($policy['fee_type']=='Semester fee'){
      $Semfee=$policy['amount'];
      
    }else if($policy['fee_type']=='Monthly Fee'){
      $Monthly=$policy['amount'];
      
    }
  }
  while ($fees=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
    if($row['batch']==$fees['batch']){
      if($count==0){//if no policy than
        if($fees['fee_type']=='admission'){
          $Sem+=$fees['fees'];
        }else{
          $Sem+=$fees['fees'];
          $allSem+=$fees['fees'];
        }
    }else{//if some policy than
      if ($fees['fee_type']=='admission') {
        if($admission<=0){
          $Sem+=$fees['fees'];
        }else{
          $Sem+=$admission;
        }
      }else if ($fees['fee_type']=='Semester fee') {
        if($Semfee<=0){
          $Sem+=$fees['fees'];
          $allSem+=$fees['fees'];
        }else{
          $Sem+=$Semfee;
          $allSem+=$Semfee;
        }
      }else if ($fees['fee_type']=='Monthly Fee') {
        if($Monthly<=0){
          $Sem+=$fees['fees'];
          $allSem+=$fees['fees'];
        }else{
          $Sem+=$Monthly;
          $allSem+=$Monthly;
        }
      }
      
    }
  }
  }?>
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Semester</th>
          <th>Total Payment</th>
          <th>Payment Done</th>
        </tr> 
      </thead>
      <tbody>
        <?php while ($pay=$select_payment->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
          
            <td><?=$pay['semester'];?></td>
            <td><?php if($pay['sem_id']==1){echo $Sem;}else{echo $allSem;} ?></td>
            <td>
              <table class="table">
                <tr>
                <td><?=$pay['fee_type']?></td>
                <td><?=$pay['amount'];?></td>
                <td><?=$pay['pdate'];?></td>
                </tr>
              </table>
              
                
              
            </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
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
