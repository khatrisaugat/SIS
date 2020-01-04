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
      header("Location:display_students.php");//redirect to display_student.php page


    }else if($_GET['op']=='e'){
      header("Location:edit_student.php?sid=".$_GET['sid']);
    }

  }

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
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Batch</th>
        <th>Gender</th>
        <th>Policy</th>
        <th>Payment</th>
        <th>Delete</th>
        <th>Edit</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row=$tbl_students->fetch(PDO::FETCH_ASSOC)) {//fetch data from tbl_students
        ?>
        <tr>
          <td><?=++$j;?></td>

          <?php
          if(!empty($row['img'])){?>
            <td><a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" width=100%></a></td>
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
          <td><a href="student_policy.php?sid=<?=$row['sid'];?>" class="btn btn-primary">Add policy</a></td>
          <td><a href="student_payment.php?sid=<?=$row['sid'];?>" class="btn btn-warning">Add payment</a></td>
          <td><a href="display_students.php?sid=<?=$row['sid'];?>&op=d" class="btn btn-danger">Delete</a></td>
          <td><a href="display_students.php?sid=<?=$row['sid'];?>&op=e" class="btn btn-info">Edit</a></td>
          <td><a href="student_details.php?sid=<?=$row['sid'];?>" class="btn btn-success">View</a></td>
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
</body>

</html>
