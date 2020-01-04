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
$batch_select=$obj->select("batch");

if (isset($_POST['submit'])) {//check if form is submitted
  
if (isset($_FILES['image'])) {
    $filename=$_FILES['image']['name'];//filename
    $temp_name=$_FILES['image']['tmp_name'];//temp name
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType!="") {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

          
      }else{
        $location='files/'.$filename;
        move_uploaded_file($temp_name, $location);//upload file
        array_pop($_POST);//popping submit form post

        $_POST['img']=$filename;//insert filename in post variable
        
        $obj->insert($_POST,"tbl_students");//insert query
      }
    
    
}
}



?>

  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h1><i class="glyphicon glyphicon-user"></i> Student's Record Form</h1>
        <form action="" method="post" class="form-group" enctype="multipart/form-data">
          <div class="form-group">
            <label>First Name*</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label>Middle Name*</label>
            <input type="text" name="mname" class="form-control">
          </div>
          <div class="form-group">
            <label>Last Name*</label>
            <input type="text" name="lname" class="form-control">
          </div>
          <div class="form-group">
            <label>Photo*</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="form-group">
            <label>City*</label>
            <input type="text" name="city" class="form-control">
          </div>
          <div class="form-group">
            <label>Address*</label>
            <input type="text" name="address" class="form-control">
          </div>
          <div class="form-group">
            <label>Phone*</label>
            <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group">
            <label>Guardian's Name*</label>
            <input type="text" name="gname" class="form-control">
          </div>
          <div class="form-group">
            <label>Guardian's Phone*</label>
            <input type="text" name="gphone" class="form-control">
          </div>
          <label>Batch*</label>
          <!-- <div class="form-group">
            <input type="text" name="batch" class="form-control">
          </div> -->
          <div class="form-group">
            <select name="batch" class="form-control">
              <option selected="" disabled="">Select Your Batch</option>
              <?php while ($batch=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
                <option value="<?=$batch['batch'];?>"><?=$batch['batch'];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Gender*</label><br>
            <label><input type="radio" name="gender" value="male">Male</label>
            <label><input type="radio" name="gender" value="female">Female</label>
          </div>
          <div class="form-group">
            <label>Date*</label>
            <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <button class="btn btn-success" name="submit" value="upload"><i class="glyphicon glyphicon-plus"></i> Add Record</button>
        </form>
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

</body>

</html>
