<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
  require_once("queries.php");
  $i=0;
   $sum=0;
   $value=0;
  $sum1=0;
  $Receivable_amount=0;
  $remaining=0;
  
  // print_r($_POST);
	$select_batch=$obj->select("batch");
	$select_sem=$obj->select("semester");
  $students=$obj->select("tbl_students");
  $tbl_heading=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid");
  $tbl_heading1=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid");
  $select_current_batch=$obj->selectCurrent(" MAX(batch) AS maxBatch FROM tbl_students");
  $current_batch=$select_current_batch->fetch(PDO::FETCH_ASSOC);
  $select_current_sem=$obj->selectCurrent(" MIN(sem_id) AS minSem FROM tbl_students");
  $current_sem=$select_current_sem->fetch(PDO::FETCH_ASSOC);



//   if (isset($_POST['submit']) && $_POST['submit']=='submit') {
//     if ($_POST['semester']==1) {
//           $query="tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE ";
          
//           array_pop($_POST);
//           foreach ($_POST as $key => $value) {
//             if ($value!='') {
//               $arr[]=$key."='$value'";
//             }

//           }
//           if (isset($arr)) {
//             array_pop($arr);
//             $query.=implode(' AND ', $arr);
//           }
// echo $query;
// echo "<br>";

//            $tbl_heading=$obj->select($query);

//             $tbl_heading1=$obj->select($query);
//         }



//        else{
//           $query="tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE fee_types.sem_wise=1 AND ";
          
//           array_pop($_POST);
//           foreach ($_POST as $key => $value) {
//             if ($value!='') {
//               $arr[]=$key."='$value'";
//             }

//           }
//           if (isset($arr)) {
//             array_pop($arr);
//             $query.=implode(' AND ', $arr);
//           }
//           echo "<br>";

// echo $query;
// // echo $query1;
//            $tbl_heading=$obj->select($query);

//         $tbl_heading1=$obj->select($query);
//         }
 
// }

// OR

if (isset($_POST['submit'])) {
  if ($_POST['submit']=='submit') {
    
    if ($_POST['semester']==1) {
      $tbl_heading=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$_POST['batch']);
      $tbl_heading1=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$_POST['batch']);
      
    }
    else{
      $tbl_heading=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE fee_types.sem_wise=1 AND batch=".$_POST['batch']);
    $tbl_heading1=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE fee_types.sem_wise=1 AND batch=".$_POST['batch']);      
    }
   
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
         
  		<div class="col-md-12">
  			<h1>Payment Received Details</h1>
  			<form method="post" class="form-group">
          				<div class="col-md-4">
          				
          					<select name="batch" class="form-control" required="">
          						<option selected="" disabled="" >Select Batch</option>
          						<?php while($batch=$select_batch->fetch(PDO::FETCH_ASSOC)){ ?>
          						<option value="<?=$batch['batch'];?>" <?php if($current_batch['maxBatch']==$batch['batch']){echo "selected";}?>><?=$batch['batch'];?></option>
          						<?php }?>
          					</select>
          			</div>
          			<div class="col-md-4">
          				
          					<select name="semester" class="form-control" required="">
          						<option selected="" disabled="" >Select Semester</option>
          						<?php while($sem=$select_sem->fetch(PDO::FETCH_ASSOC)){?>
          						<option value="<?=$sem['sem_id'];?>" <?php if($current_sem['minSem']==$sem['sem_id']){echo "selected";}?><?=$batch['batch'];?>><?=$sem['semester'];?></option>
          						<?php }?>
          					</select>
          			</div>
          			<button name="submit" value="submit" class="btn btn-success">Filter</button>
  			</form>
  		</div>
  		<div class="col-md-12">
        <?php $headings=$tbl_heading->fetchAll(PDO::FETCH_ASSOC);?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SN</th>
            <th>Sutdents Name</th>
            <th>Batch</th>
            <th>Semester</th>
            <?php for($a=0;$a<count($headings);$a++){?>
              <th><?=$headings[$a]['fee_type'];?></th>
            <?php }?>
            <th>Payment Received</th>
            <th>Outstanding Payment</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row=$students->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr>
              <td><?=++$i;?></td>
              <td><?=$row['name'];?></td>
              <td><?=$row['batch'];?></td>
              <td><?=$row['sem_id'];?></td>
              <?php for($a=0;$a<count($headings);$a++){?>
              <td><?php 
             
                $policy=$obj->select("tbl_student_policy WHERE sid=".$row['sid']." AND fid=".$headings[$a]['fid']);
                $policy_select=$policy->fetch(PDO::FETCH_ASSOC);
                  if ($policy_select== '') {
                    $value=$headings[$a]['fees'];
                    echo $value;
                  } 
                  else{
                    $value=$policy_select['amount'];

                    echo $value;
                  }
                  $sum+=$value;
                  $Receivable_amount+=$value;


              ?></td> 
            <?php }?>

            <td>
              <table class="table">
                <tr>
                  <td>
                    <?php
                    for($a=0;$a<count($headings);$a++){
                     $payment_received=$obj->select_sum(" SUM(amount) FROM tbl_student_payment JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid WHERE tbl_fees.batch=".$row['batch']." AND tbl_student_payment.sid=".$row['sid']." AND tbl_fees.ftid=".$headings[$a]['ftid']);
                     $payment_received_data=$payment_received->fetch(PDO::FETCH_ASSOC);
                     echo $headings[$a]['fee_type'];
                     echo "=";
                      echo $payment_received_data['SUM(amount)'];echo "<br>";
                     // $row['sid']++;
                      
                   $sum1+=$payment_received_data['SUM(amount)'];
                   $remaining+=$payment_received_data['SUM(amount)'];
                  }
                    ?>
                  </td>

                </tr>
              </table>
            </td>
             <td>
               <table class="table table-bordered">
                 <tr>
                   <td><?php
             
                   if($sum>$sum1)
                   {
                     $OA=$sum-$sum1;
                     echo $OA;
                   }
                   else{
                    $OA=$sum1-$sum;
                     echo $OA;
                   }
                  ?></td>
                  <td><?php
             echo "Receivable amount =".$sum;
             echo "<br>";
             echo " Received amount =".$sum1;
             
                   
                  ?></td>
                 </tr>
               </table>
             </td>

            </tr>
            <?php
             $sum=0;
              $value=0;
              $sum1=0;
              ?>
          <?php }?>
        </tbody>
      </table>

      <!-- Economic Details -->
<h3>Total Receivable amount = <?=$Receivable_amount;?></h3>
<h3>Total Received amount = <?= $remaining;?></h3>
<h3>Remaining amount to be received =
<?php if ($Receivable_amount>$remaining) {
 $amt=$Receivable_amount-$remaining;
 echo $amt;
} 
else{
  $amt=$remaining-$Receivable_amount;
 echo $amt;
}
?></h3>


      <!-- Economic Details -->

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
</body>

</html>