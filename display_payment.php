<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
    require_once("queries.php");
  $tbl_join="tbl_student_payment JOIN tbl_students ON tbl_students.sid=tbl_student_payment.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid";
  if (isset($_POST['filter']) && $_POST['filter']=='set') {
    $tbl_join.=" WHERE tbl_students.batch=".$_POST['batch'];
  }
  if(isset($_GET['field']))
  {
    $tbl_join.=" ORDER BY ".$_GET['field']." ".$_GET['order'];
   }
  $tbl_student_payment=$obj->select($tbl_join);
  $j=0;

  if(isset($_GET['op'])){
    if ($_GET['op']=='d') {
      $tspid['tspid']=$_GET['tspid'];
      $obj->delete($tspid,"tbl_student_payment");
      $_SESSION['true']="Data deleted successfully!";
      header("Location:display_payment.php");
      exit();
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
   <?php if (isset($_SESSION['true'])):  ?>
                        <div class="alert alert-success">
                            
                            <?php
                             echo $_SESSION['true'];
                             unset($_SESSION['true']);
                             ?>
                        </div>

                    <?php endif;?>
  <h1>Payment Details</h1>
  <form class="form-group" method="post" action="display_payment.php?filter=set">
     <div class="col-sm-3">
             <select class="form-control" name="batch">
               <option selected="" disabled="">Select Batch</option>
               <?php
                  $batch_select=$obj->select("batch");
                  while ($batch_option=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
                    <option value="<?=$batch_option['batch'];?>"><?=$batch_option['batch'];?></option>
                    
                 <?php }
               ?>
             </select>
              </div>
             <div class="col-sm-1">
               <input type="submit" name="filter" value="set" class="btn btn-primary">
             </div>     
    </form>
    <br><br>
  <table class="table table-bordered table-hover table-responsive">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Photo</th>
        <th>Name<a href="display_payment.php?field=name&order=ASC">&#10506;</a><a href="display_payment.php?field=name&order=DESC">&#10507;</a></th>
        <th>Fee type</th>
        <th>Batch<a href="display_payment.php?field=tbl_students.batch&order=ASC">&#10506;</a><a href="display_payment.php?field=tbl_students.batch&order=DESC">&#10507;</a></th>
        <th>Fees</th>
        <th>Policy Amount</th>
        <th>Paid Amount</th>
        <th>Date<a href="display_payment.php?field=pdate&order=ASC">&#10506;</a><a href="display_payment.php?field=pdate&order=DESC">&#10507;</a></th>
        <th>Semester<a href="display_payment.php?field=semester&order=ASC">&#10506;</a><a href="display_payment.php?field=semester&order=DESC">&#10507;</a></th>
      <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
        <th>Delete</th>
        <th>Edit</th>
      <?php }?>
      </tr>
    </thead>
    <tbody>
      <?php
      //   if(isset($_GET['filter']) && $_GET['filter']=='set'){
      //   $tbl_student_payment=$batch;
      // }
       while ($row=$tbl_student_payment->fetch(PDO::FETCH_ASSOC)) {//fetch data from tbl_student_payment
        ?>
        <tr>
          <td><?=++$j;?></td>
          <td><?php if(!empty($row['img'])){ ?>
            <a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" class="size"></a>
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
        <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
          <td><a href="display_payment.php?tspid=<?=$row['tspid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"
>Delete</a></td>
          <td><a href="display_payment.php?tspid=<?=$row['tspid'];?>&op=e" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this item?');"
>Edit</a></td>
<?php }?>

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

