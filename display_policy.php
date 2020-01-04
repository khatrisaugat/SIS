<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
 
  require_once("queries.php");
$policyData=$obj->select("tbl_student_policy");

if (isset($_GET['spid'])) {
  if ($_GET['op']=='d') {
    array_pop($_GET);
    $obj->delete($_GET,"tbl_student_policy");
    header("Location:display_policy.php");
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
        <h2>Display Fee Policy Table</h2>
        <table class="table table-striped" border="1">
          <thead>
            <tr>
              <th>SN</th>
              <th>Student Name</th>
              <th>Fee Type</th>
              <th>Amount</th>
              <th>Edit</th>
              <th>Delete</th>

            </tr>
          </thead>
          <tbody>
            <?php
            while ($row=$policyData->fetch(PDO::FETCH_ASSOC)) {?>
              <tr>
                 <td><?=++$i;?></td>
                 <td><?php
                 // print_r($row);
                $sn['sid']=$row['sid'];
                $nameResult=$obj->select("tbl_students WHERE sid=".$row['sid']);
                $result=$nameResult->fetch(PDO::FETCH_ASSOC);
                $fullnName=$result['name']." ".$result['mname']." ".$result['lname'];
                  echo $fullnName;?>

                </td>

                 <td><?php
                 $fid['fid']=$row['fid'];
                 $ftypeResult=$obj->select("tbl_fees WHERE fid=".$row['fid']);

                 // print_r($ftypeResult);
                 $ftype=$ftypeResult->fetch(PDO::FETCH_ASSOC);
                 echo $ftype['ftype'];?></td>
                 <td><?=$row['amount'];?></td>
                 <td><a href="display_policy.php?spid=<?=$row['spid'];?>&op=e">Edit</a></td>
                 <td><a href="display_policy.php?spid=<?=$row['spid'];?>&op=d">Delete</a></td>


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
  
</body>

</html>
