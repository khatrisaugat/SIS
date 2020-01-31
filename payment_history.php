<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
    require_once("queries.php");
$i=0;
    $select_history=$obj->select(" tbl_student_payment JOIN tbl_students ON tbl_students.sid=tbl_student_payment.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON tbl_fees.ftid=fee_types.ftid");
   
 include("includes/header.php");
 ?>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <?php include("includes/sidebar.php");?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
    <div class="container">
      <h2>Payment History</h2>
      <b>Note:Students who got policy are highlighted in <span style="color: green;">green color</span>.</b><br><br>
      <div class="col-md-12">
        <table class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>SN</th>
              <th>Student's Name</th>
              <th>Fee type</th>
              <th>Amount</th>
              <th>Semester</th>
              <th>Date</th>

            </tr>
          </thead>
          <tbody>
            <?php while ($row=$select_history->fetch(PDO::FETCH_ASSOC)) {?>
             
              <tr <?php if(isset($row['spid'])){ ?>  style="background-color: #99f2c1;color: #000;"  <?php } ?>>
                <td><?=++$i;?></td>
                <td ><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
                <td><?=$row['fee_type'];?></td>
                <td><?=$row['amount'];?></td>
                <!-- if(isset($row['spid'])){echo " (<b style="."color:red;".">".$row['fees']."</b>)";} -->
                <td><?=$row['semester'];?></td>
                <td><?=$row['pdate'];?></td>
              </tr>
              <?php }?>
          </tbody>
        </table>
      </div>
    </div>

</div>
</section>
</section>
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
  <script>
    $(document).ready(function(){

        setTimeout(function() {
            $('.alert').hide('slow')
        }, 3000);
    })
  </script>
  <style>
    .size{height: 150px;width: 150px;}
    
  </style>
</body>

</html>

