<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }

require_once('queries.php');
$batchdata=$obj->select("batch");
$i=0;
if (isset($_GET['op'])) {
  if ($_GET['op']='d') {

    // print_r($_GET);
    array_pop($_GET); 
    $obj->delete($_GET,"batch");
     $_SESSION['true']="Data deleted successfully!";
    header('Location:batch_display.php');
exit();
    
  }

  else if($_GET['op']=='e'){
    $sn=$_GET['bid'];
    header("Location:batch_edit.php?bid=.$sn");
    
    
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
        <h2>Display Fees Table</h2>
        <table class="table table-striped" border="1">
          <thead>
            <tr>
              <th>SN</th>
              <th>Batch</th>
              <th>Edit</th>
              <th>Delete</th>

            </tr>
          </thead>
          <tbody>
            <?php
            while ($row=$batchdata->fetch(PDO::FETCH_ASSOC)) {?>
              <tr>
                 <td><?=++$i;?></td>
                 <td><?=$row['batch'];?></td>
                 <td><a href="batch_edit.php?bid=<?=$row['bid'];?>" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this item?');">Edit</a></td>
                 <td><a href="batch_display.php?bid=<?=$row['bid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"
>Delete</a></td>


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
