

      <?php 
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
   
         <?php 
  
  require_once('queries.php');//including queries
  if (isset($_GET['sid'])) {
    
  
$select_students=$obj->select("tbl_academic_docs JOIN tbl_students ON tbl_students.sid=tbl_academic_docs.sid WHERE tbl_academic_docs.sid=".$_GET['sid']);
}
 if(isset($_GET['stid'])){//check url for get variable


    if($_GET['op']=='d'){//delete operation
      array_pop($_GET);//popping op from get
      // $single_select="tbl_academic_docs WHERE sid=".$_GET['stid'];//selecting 1 row from tbl_students
      $file_name=$obj->select("tbl_academic_docs WHERE sid=".$_GET['stid']);//select function call
      $file=$file_name->fetch(PDO::FETCH_ASSOC);//fetch data
      // print_r($file);
      if(!empty($file['docs1'] || !empty($file['docs2']))){//delete image from storage
        $Location='docs/'.$file['docs1'];
        $Location1='docs/'.$file['docs2'];
        // echo "$Location";
        unlink($Location);
        unlink($Location1);
      }
      $sn['sid']=$_GET['stid'];
      $obj->delete($sn,"tbl_academic_docs");//delete data from tbl_academic_docs
      $_SESSION['true']="Documents deleted successfully!";
      header("Location:print_docs.php?sid=".$_GET['sid']);
      // exit();

    }else if($_GET['op']=='e'){
      header("Location:edit_print_docs.php?sid=".$_GET['sid']);
    }

  }


  include("includes/header.php");
  include("includes/sidebar.php");
$i=0;

?>
 <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
       <a href="add_docs.php"><button class="btn btn-info"> &laquo; </button></a><br><br>
          <table class="table table-bordered table-hover table-responsive">
          <thead>
            <tr>
              <th>SN</th>
              <th>Students Name</th>
              <th>Available Documents</th>
              <th>Edit</th>
              <th>Delete</th>

            </tr>
          </thead>
          <tbody>
            <?php while ($row=$select_students->fetch(PDO::FETCH_ASSOC)) { ?>
              
             <tr>
               <td><?=++$i;?></td>
               <td><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
               <td><?=$row['docs1']."<br/><hr/>".$row['docs2'];?></td>
               <td><a href="edit_print_docs.php?stid=<?=$row['sid']?>&op=e" class="btn btn-warning"
                onclick="return confirm('Are you sure you want to delete this item?');">Edit</a></td>
               <td><a href="print_docs.php?stid=<?=$row['sid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>

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
