<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
    require_once("queries.php");
  $tbl_join="tbl_student_payment JOIN tbl_students ON tbl_students.sid=tbl_student_payment.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid";
  $tbl_student_payment=$obj->select($tbl_join);
  $j=0;

  if(isset($_GET['op'])){
    if ($_GET['op']=='d') {
      $tspid['tspid']=$_GET['tspid'];
      $obj->delete($tspid,"tbl_student_payment");
      header("Location:display_payment.php");
    }else if($_GET['op']=='e'){
      header("Location:edit_payment.php?tspid=".$_GET['tspid']);
    }
  }



 include("includes/header.php");?>
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
  <h1>Payment Details</h1>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Fee type</th>
        <th>Batch</th>
        <th>Fees</th>
        <th>Policy Amount</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Semester</th>
        <th>Delete</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row=$tbl_student_payment->fetch(PDO::FETCH_ASSOC)) {//fetch data from tbl_student_payment
        ?>
        <tr>
          <td><?=++$j;?></td>
          <td><?php if(!empty($row['img'])){ ?>
            <a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" width=100%></a>
          <?php }else{
            echo "photo not inserted";
          }?>
          </td>
          <td><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
          <td><?=$row['fee_type'];?></td>
          <td><?=$row['batch'];?></td>
          <td><?=$row['fees'];?></td>
          <td><?php
            $spid=$obj->select("tbl_student_policy WHERE spid=".$row['spid']);
            $tbl_spid=$spid->fetch(PDO::FETCH_ASSOC);
            echo $tbl_spid['amount'];
          ?>
            
          </td>
          <td><?=$row['amount'];?></td>
          <td><?=$row['pdate'];?></td>
          <td><?=$row['semester']." Sem";?></td>
          <td><a href="display_payment.php?tspid=<?=$row['tspid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"
>Delete</a></td>
          <td><a href="display_payment.php?tspid=<?=$row['tspid'];?>&op=e" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this item?');"
>Edit</a></td>

        </tr>
      <?php } ?>
      </tbody>
    </table>
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
  
</body>

</html>
