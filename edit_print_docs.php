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

$select_students=$obj->select("tbl_academic_docs JOIN tbl_students ON tbl_students.sid=tbl_academic_docs.sid WHERE tbl_academic_docs.sid=".$_GET['stid']);
$Students=$select_students->fetch(PDO::FETCH_ASSOC);
$select_students1=$obj->select("tbl_students WHERE sid=".$_GET['stid']);
$Students1=$select_students1->fetch(PDO::FETCH_ASSOC);
// print_r($Students);


$students_name=$Students1['name']." ".$Students1['mname']." ".$Students1['lname'];
if (isset($_GET['status']) && $_GET['status']=='d') {
  $field="docs".$_GET['docs'];
  $val[$field]='';
  $sn['sid']=$_GET['stid'];
  $filename=$obj->select("tbl_academic_docs WHERE sid=".$_GET['stid']);
  $file_name=$filename->fetch(PDO::FETCH_ASSOC);
  $docs=$file_name[$field];
  if(!empty($docs)){
    $location='docs/'.$docs;
    unlink($location);
  }
  $obj->update($val,"tbl_academic_docs",$sn);
    header("Location:edit_print_docs.php?stid=".$_GET['stid']);
    exit();
  
}


if (isset($_POST['submit']) && $_POST['submit']=='submit') {//check if form is submitted
  
if (isset($_FILES['docs'.$_GET['docs']])) {
    $filename=$_FILES['docs'.$_GET['docs']]['name'];//filename
    $temp_name=$_FILES['docs'.$_GET['docs']]['tmp_name'];//temp name

   
    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
   
    // echo $imageFileType;
    if($imageFileType == "pdf" || $imageFileType == "jpg" || $imageFileType == "png" || $imageFileType=="jpeg") {
        $location='docs/'.$filename;
        move_uploaded_file($temp_name, $location);

       
        array_pop($_POST);//popping submit form post
        $_POST['docs'.$_GET['docs']]=$filename;
        $sn['sid']=$_GET['stid'];
        $obj->update($_POST,"tbl_academic_docs",$sn);//insert query
        $_SESSION['true']="Students added successfully!";
        if (isset($_GET['src'])) {
           header("location:student_details.php?sid=".$_GET['stid']);
        exit();
        }
        elseif(isset($_GET['add'])){
          header("location:edit_print_docs.php?stid=".$_GET['stid']);
        exit();
        }
       
      }else{
        $_SESSION['error']="Sorry, only PDF, JPEG, PNG, JPG files are allowed!";
      
      }
        
    
}
}

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
        <div class="col-md-12">
        
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>SEE/SLC Docs</th>
              <th>HSEB/NEB Docs</th>

            </tr>
          </thead>
          <tr>
            <td>
              <?php if(isset($_GET['status']) && $_GET['status']=='e' && $_GET['docs']==1) {?>
                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>SCL/SEE Documents*</label>
                      <input type="file" name="docs1" class="form-control" >
                    </div>
                    <button name="submit" value="submit" class="btn btn-info">Update</button>
                  </form>
            

              <?php } else{
            if (!empty($Students['docs1'])) { ?>
              
              <a href="docs/<?=$Students['docs1']?>"><img src="docs/<?=$Students['docs1']?>" class="img"></a>
           <?php } else{echo "No documents !";}
            ?><br><br>
           <a href="edit_print_docs.php?stid=<?=$_GET['stid']?>&status=e&docs=1 
            <?php if(isset($_GET['return'])){ echo"&src=new";} ?>" class="btn btn-primary">Edit</a>
            <a href="edit_print_docs.php?stid=<?=$_GET['stid']?>&status=d&docs=1" class="btn btn-primary">Delete</a>
            <?php } ?>
          </td>
            <td>
                <?php if(isset($_GET['status']) && $_GET['status']=='e' && $_GET['docs']==2) {?>
                  <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>HSEB/NEB Documents*</label>
                      <input type="file" name="docs2" class="form-control" >
                    </div>
                    <button name="submit" value="submit" class="btn btn-info">Update</button>
                  </form>
            

              <?php } else{ 
            if (!empty($Students['docs2'])) { ?>
              
              <a href="docs/<?=$Students['docs2']?>" ><img src="docs/<?=$Students['docs2']?>" class="img"></a>
           <?php } else{echo "No documents !";}
            ?>
          <br><br>
           <a href="<?php  
           if(isset($_GET['add'])){
            echo "edit_print_docs.php?stid=".$_GET['stid']."&status=e&docs=2&add=y";
           }else{
            echo "edit_print_docs.php?stid=".$_GET['stid']."&status=e&docs=2&src=new";
           }



           ?>" class="btn btn-primary">Edit</a>
            <a href="edit_print_docs.php?stid=<?=$_GET['stid']?>&status=d&docs=2" class="btn btn-primary">Delete</a>
          <?php } ?>
          </td>
          </tr>
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
  <style>
    .file_box{border: 1px solid #000;padding: 8px 14px;border-radius: 4px;}
    .img{width: 350px;height: 350px;}
  </style>
</body>

</html>
