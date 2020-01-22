<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }

require_once('queries.php');
$obj= new queries;
$sql="tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid";
if (isset($_POST['filter']) && $_POST['filter']=='set') {
    $sql.=" WHERE batch=".$_POST['batch'];
  }
  if(isset($_GET['field']))
  {
    $sql.=" ORDER BY ".$_GET['field']." ".$_GET['order'];
   }
$feesData=$obj->select($sql);
$i=0;
if (isset($_GET['op'])) {
  if ($_GET['op']='d') {
    // print_r($_GET);
    array_pop($_GET); 
    $obj->delete($_GET,"tbl_fees");
    $_SESSION['true']="Data deleted successfully!";
        header('Location:display_fees.php');
      exit();
  }

  else if($_GET['op']=='e'){
    $sn=$_GET['fid'];
    header("Location:edit_fees.php?fid=.$sn");
    
    
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
        <h2>Display Fees</h2>
        <form class="form-group" method="post" action="display_fees.php?filter=set">
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
        <table class="table table-striped" border="1">
          <thead>
            <tr>
              <th>SN</th>
              <th>Fee Type</th>
              <th>Batch<a href="display_fees.php?field=batch&order=ASC">&#10506;</a><a href="display_fees.php?field=batch&order=DESC">&#10507;</a></th>
              <th>Fees<a href="display_fees.php?field=fees&order=ASC">&#10506;</a><a href="display_fees.php?field=fees&order=DESC">&#10507;</a></th>
          <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
              <th>Edit</th>
              <th>Delete</th>
            <?php }?>

            </tr>
          </thead>
          <tbody>
            <?php
            while ($row=$feesData->fetch(PDO::FETCH_ASSOC)) {?>
              <tr>
                 <td><?=++$i;?></td>
                 <td><?=$row['fee_type'];?></td>
                 <td><?=$row['batch'];?></td>
                 <td><?=$row['fees'];?></td>
            <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
                 <td><a href="edit_fees.php?fid=<?=$row['fid'];?>&op=e" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a></td>
                 <td><a href="display_fees.php?fid=<?=$row['fid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"
>Delete</a></td>
<?php }?>


                </tr>
            <?php }?>
          </tbody>
        </table>

      </div>
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
</body>

</html>
