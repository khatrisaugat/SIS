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
  
  require_once('queries.php');//including queries



$select_students=$obj->select("tbl_students");
$i=0;


?>

  <div class="container">
    <div class="row">

      <div class="col-md-12">
       <table class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>SN</th>
              <th>Students Name</th>
              <th>Documens Detail</th>

            </tr>
          </thead>
          <tbody>
            <?php while ($row=$select_students->fetch(PDO::FETCH_ASSOC)) { ?>
              <!-- <?php print_r($row);?> -->
             <tr>
               <td><?=++$i;?></td>
               <td><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
               <td><a href="academic_docs.php?sid=<?=$row['sid']?>&add=y" class="btn btn-primary">Add docs</a>
                <a href="print_docs.php?sid=<?=$row['sid']?>" class="btn btn-info">View docs</a></td>
             </tr>

             <?php } ?>
          </tbody>
       </table>
          </div>
      </div>
    </div>
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
  <script>
    $(document).ready(function(){
      setTimeout(function(){
        $('.alert').hide('fast')
      },3000);
    })
  </script>
</body>

</html>
