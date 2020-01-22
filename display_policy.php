<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
 
  require_once("queries.php");
  $sql="tbl_student_policy JOIN tbl_students ON tbl_students.sid=tbl_student_policy.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid";

if (isset($_POST['filter']) && $_POST['filter']=='set') {
    $sql.=" WHERE tbl_students.batch=".$_POST['batch'];
  }
  if(isset($_GET['field']))
  {
    $sql.=" ORDER BY ".$_GET['field']." ".$_GET['order'];
   }
   $policyData=$obj->select($sql);

if (isset($_GET['spid'])) {
  if ($_GET['op']=='d') {
    array_pop($_GET);
    $obj->delete($_GET,"tbl_student_policy");
    $_SESSION['true']="Data deleted successfully!";
    header("Location:display_policy.php");
    exit();
  }
  else if($_GET['op']=='e'){
      header("Location:edit_policy.php?spid=".$_GET['spid']);
    }
}
// echo $fullnName;
$i=0;
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
        <h2>Policy Table</h2>
        <form class="form-group" method="post" action="display_policy.php?filter=set">
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
        </form><br><br>
        <table class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>SN</th>
              <th>Student Name<a href="display_policy.php?field=name&order=ASC">&#10506;</a><a href="display_policy.php?field=name&order=DESC">&#10507;</a></th>
              <th>Fee Type</th>
              <th>Amount<a href="display_policy.php?field=amount&order=ASC">&#10506;</a><a href="display_policy.php?field=amount&order=DESC">&#10507;</a></th>
          <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
              <th>Edit</th>
              <th>Delete</th>
            <?php }?>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row=$policyData->fetch(PDO::FETCH_ASSOC)) {?>
              <tr>
                 <td><?=++$i;?></td>
                 <td><?php
                  echo $row['name']." ".$row['mname']." ".$row['lname'];?>

                </td>

                 <td><?php
                 // $fid['fid']=$row['fid'];
                 // $ftypeResult=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE fid=".$row['fid']);

                 // print_r($ftypeResult);
                 // $ftype=$ftypeResult->fetch(PDO::FETCH_ASSOC);
                 echo $row['fee_type'];?></td>
                 <td><?=$row['amount'];?></td>
            <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
                 <td><a href="display_policy.php?spid=<?=$row['spid'];?>&op=e" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this item?');"
>Edit</a></td>
                 <td><a href="display_policy.php?spid=<?=$row['spid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"
>Delete</a></td>
<?php }?>


                </tr>
            <?php }?>
          </tbody>
        </table>

      </div>
    </div>
  </div>


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
</body>

</html>

