
<?php 
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }

    // <!--header end-->
    // <!-- **********************************************************************************************************************************************************
    //     MAIN SIDEBAR MENU
    //     *********************************************************************************************************************************************************** -->

  require_once("queries.php");
  $tbl_students=$obj->select("tbl_students");//select all from tbl_students
  $j=1;//initialize j
  if(isset($_GET['sid'])){//check url for get variable


    if($_GET['op']=='d'){//delete operation
      array_pop($_GET);//popping op from get
      $single_select="tbl_students WHERE sid=".$_GET['sid'];//selecting 1 row from tbl_students
      $img_name=$obj->select($single_select);//select function call
      $img=$img_name->fetch(PDO::FETCH_ASSOC);//fetch data
      if(!empty($img['img'])){//delete image from storage
        $Location='files/'.$img['img'];
        echo "$Location";
        unlink($Location);
      }
      $obj->delete($_GET,"tbl_students");//delete data from tbl_students
      $_SESSION['true']="Data deleted successfully!";
      header("Location:display_students.php");//redirect to display_student.php page
      exit();

    }else if($_GET['op']=='e'){
      header("Location:edit_student.php?sid=".$_GET['sid']);
    }

  }
  if(isset($_GET['field']))
  {
    // if ($_GET['submit']=='Sort') {
      // print_r($_POST);
      // array_pop($_POST);
     $tbl_students=$obj->select("tbl_students ORDER BY ".$_GET['field']." ".$_GET['order']);
     
    // }
  }
// additional codee
if (isset($_POST['filter']) && $_POST['filter']=='set') {
  $query="tbl_students WHERE ";
  array_pop($_POST);
  foreach ($_POST as $key => $value) {
    if ($value!='') {
      $arr[]=$key."='$value'";
    }

  }
  if (isset($arr)) {
    $query.=implode(' AND ', $arr);
  }
  $batch=$obj->select($query);
}
// ad code end



  include("includes/header.php");
  include("includes/sidebar.php"); 
 ?>
   
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
         
  
 <div class="container">
   <h1>Students Details</h1>
  <div class="row" style="margin-bottom: 3px;">
 
           <form class="form-group" method="post" action="display_students.php?filter=set">
               <!-- <select name="sort" style="padding: 8px 12px;">
                <option selected="" disabled="">Select Sorting method</option>
                 <option value="Date">Date</option>
                 <option value="batch">Batch</option>
                 <option value="city">City</option>
                 <option value="status">Status</option>

             </select>
             <input type="submit" name="submit" value="Sort" class="btn btn-success"> -->
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
              <div class="col-sm-3">
             <input type="text" name="city" class="form-control" placeholder="Enter the city">
             </div>
             <div class="col-sm-1">
               <input type="submit" name="filter" value="set" class="btn btn-primary">
             </div>     
           </form>
         </div>
     <?php if (isset($_SESSION['true'])):  ?>
                        <div class="alert alert-success">
                            
                            <?php
                             echo $_SESSION['true'];
                             unset($_SESSION['true']);
                             ?>
                        </div>

                    <?php endif;?>
  
  <table class="table table-bordered table-hover table-responsive">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Photo</th>
        <th>Name<a href="display_students.php?field=name&order=ASC">&#10506;</a><a href="display_students.php?field=name&order=DESC">&#10507;</a></th>
        <th>Address<a href="display_students.php?field=address&order=ASC">&#10506;</a><a href="display_students.php?field=address&order=DESC">&#10507;</a></th>
        <th>Phone</th>
        <th>Batch<a href="display_students.php?field=batch&order=ASC">&#10506;</a><a href="display_students.php?field=batch&order=DESC">&#10507;</a></th>
        <th>Gender</th>
        <th>Policy</th>
        <th>Payment</th>
    <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
        <th>Delete</th>
        <th>Edit</th>
      <?php }?>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if(isset($_GET['filter']) && $_GET['filter']=='set'){
        $tbl_students=$batch;
      }

      while ($row=$tbl_students->fetch(PDO::FETCH_ASSOC)) {//fetch data from tbl_students
        ?>
        <tr <?php if($row['status']==0){ ?>  style="background-color: #ff8080;color: #000"  <?php } ?>>
          <td><?=$j++;?></td>

          <?php
          if(!empty($row['img'])){?>
            <td><a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" class="size"></a></td>
            <?php

          }else{
            echo "<td>NO image </td>";
          }
          ?>
          <td><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
         
          <td><?=$row['address'];?></td>
          <td><?=$row['phone'];?></td>
          
          <td><?=$row['batch'];?></td>
          <td><?=$row['gender'];?></td>

 <?php   if($row['status']==0) {?><!--if clause start-->
              

          <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
          <td colspan="5" style="text-align: center;"><a href="display_students.php?sid=<?=$row['sid'];?>&op=e" class="btn btn-warning" onclick="return confirm('Are you sure you want to active status?');"
>This student is Inactive</a></td>
<?php }else{?>
<td colspan="5" style="text-align: center;"><span style="font-size: 18px;color: #fff;">This student is Inactive</span></td>

<?php }?>
             


        <?php }else{ ?>
           <td><a href="student_policy.php?sid=<?=$row['sid'];?>" class="btn btn-primary">Policy</a></td>
          <td><a href="student_payment.php?sid=<?=$row['sid'];?>" class="btn btn-warning">Payment</a></td>
        <?php if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){ ?>
          <td><a href="display_students.php?sid=<?=$row['sid'];?>&op=d" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"
>Delete</a></td>
          <td><a href="display_students.php?sid=<?=$row['sid'];?>&op=e" class="btn btn-info" onclick="return confirm('Are you sure you want to edit this item?');"
>Edit</a></td>
<?php }?>
          <td><a href="student_details.php?sid=<?=$row['sid'];?>" class="btn btn-success">View</a></td>
      <!--else clause end--> <?php }?>

        <!--if clause end-->
        </tr>
        <?php
      }
        ?>
        
        
      </tbody>
    </table>
  </div>
          
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <?php include("includes/footer.php"); ?>
    
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Divyagyan Software!',
        // (string | mandatory) the text inside the notification
        text: 'This is a student information system that is built by the students as a project',
        // (string | optional) the image to display on the left
        image: 'img/Divya-Gyan-College.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
  <script>
    $(document).ready(function(){

        setTimeout(function() {
            $('.alert').hide('slow')
        }, 3000);
    })
  </script>
  
   

  <style>
   
    .size{height: 60px;width: 60px;}
  </style>
</body>

</html>
