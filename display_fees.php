<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }

require_once('queries.php');
$obj= new queries;
$feesData=$obj->select("tbl_fees");
$i=0;
if (isset($_GET['op'])) {
  if ($_GET['op']='d') {
    // print_r($_GET);
    array_pop($_GET); 
    $obj->delete($_GET,"tbl_fees");
    header('Location:display_fees.php');
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
        <h2>Display Fees Table</h2>
        <table class="table table-striped" border="1">
          <thead>
            <tr>
              <th>SN</th>
              <th>Fee Type</th>
              <th>Batch</th>
              <th>Fees</th>
              <th>Edit</th>
              <th>Delete</th>

            </tr>
          </thead>
          <tbody>
            <?php
            while ($row=$feesData->fetch(PDO::FETCH_ASSOC)) {?>
              <tr>
                 <td><?=++$i;?></td>
                 <td><?=$row['ftype'];?></td>
                 <td><?=$row['batch'];?></td>
                 <td><?=$row['fees'];?></td>
                 <td><a href="edit_fees.php?fid=<?=$row['fid'];?>&op=e">Edit</a></td>
                 <td><a href="display_fees.php?fid=<?=$row['fid'];?>&op=d">Delete</a></td>


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
  
</body>

</html>
