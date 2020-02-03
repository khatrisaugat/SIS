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
    <!--main content start-->
   
         <?php 
  
  require_once('queries.php');//including queries

$select_students=$obj->select("tbl_students WHERE sid=".$_GET['sid']);
$Students=$select_students->fetch(PDO::FETCH_ASSOC);
$students_name=$Students['name']." ".$Students['mname']." ".$Students['lname'];
$select_students1=$obj->select("tbl_academic_docs WHERE sid=".$_GET['sid']);
$Students1=$select_students1->fetch(PDO::FETCH_ASSOC);
if (!empty($Students1)) {
header("Location:edit_print_docs.php?stid=".$_GET['sid']."&op=e");
exit();
}

if (isset($_POST['submit'])) {//check if form is submitted
  
if (isset($_FILES['docs1']) && isset( $_FILES['docs2'])) {
    $filename=$_FILES['docs1']['name'];//filename
    $temp_name=$_FILES['docs1']['tmp_name'];//temp name

    $filename1=$_FILES['docs2']['name'];//filename
    $temp_name1=$_FILES['docs2']['tmp_name'];//temp name
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $imageFileType1= strtolower(pathinfo($filename1,PATHINFO_EXTENSION));
    // echo $imageFileType;
    if($imageFileType == "pdf" || $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType=="jpeg" && $imageFileType1 == "pdf" || $imageFileType1 == "jpg" || $imageFileType1 == "png" || $imageFileType1=="jpeg") {
        $location='docs/'.$filename;
        move_uploaded_file($temp_name, $location);

        $location1='docs/'.$filename1;
        move_uploaded_file($temp_name1, $location1);
        array_pop($_POST);//popping submit form post
        $_POST['docs1']=$filename;
        $_POST['docs2']=$filename1;
        $obj->insert($_POST,"tbl_academic_docs");//insert query
        $_SESSION['true']="Students added successfully!";
      }else{
        $_SESSION['error']="Sorry, only PDF, TXT, PPT files are allowed!";
      
      }
        
    
}
}



// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

 include("includes/header.php");
  include("includes/sidebar.php");
?>
 <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <a href="add_docs.php"><button class="btn btn-info"> &laquo; </button></a><br><br>
        <?php if(isset($_SESSION['true'])):?>
          <div class="alert alert-success">
            <?php echo $_SESSION['true'];
            unset($_SESSION['true']);
            ?>
          </div>
        <?php endif;?>
         <?php if(isset($_SESSION['error'])):?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
          </div>
        <?php endif;?>
        <h2><i class="glyphicon glyphicon-user"></i> Academic Documents of <span style="color: blue;text-decoration: underline;"><?=$students_name;?></span></h2>
        <div class="col-md-6">
        
        <form action="" method="post" class="form-group" enctype="multipart/form-data">
          <div class="form-group">
            <label></label>
            <input type="hidden" name="sid" class="form-control" value="<?=$_GET['sid'];?>">
          </div>
          <div class="form-group">
            <label>SCL/SEE Documents*</label>
            <input type="file" name="docs1" class="form-control" >
          </div>
           <div class="form-group">
            <label>HSEB/NEB Documents*</label>
            <input type="file" name="docs2" class="form-control" >
          </div> 

         
          <button class="btn btn-success" name="submit" value="upload"><i class="glyphicon glyphicon-plus"></i> Add Record</button>
        </form>
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
