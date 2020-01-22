<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
  require_once("queries.php");
  include("includes/header.php"); 
  include("includes/sidebar.php");
  $sn=0;
  
  $gtotal=0;
  $pay_gtotal=0;
  $query="tbl_students";
  // additional codee
	if (isset($_POST['filter']) && $_POST['filter']=='set') {
	  $query.=" WHERE batch=".$_POST['batch'];
	  $batch=$obj->select($query);
	}
	$select_student=$obj->select($query);
// ad code end




  ?>
  <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
        <h2>Anual payment details</h2>
       	<form class="form-group" method="post" action="total_receivable.php?filter=set">
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
              <div class="col-sm-1">
               <input type="submit" name="filter" value="set" class="btn btn-primary">
             </div>     
           </form>
           <br>
         <table class="table table-bordered table-hover table-responsive">
         	<thead>
         		<tr>
	         		<th>S.N</th>
	         		<th>Student</th>
	         		<th>Total</th>
	         		<th>Paid</th>
         		</tr>
         	</thead>
         	<tbody>
         		<?php while ($students=$select_student->fetch(PDO::FETCH_ASSOC)) {

         			?>
         			<tr <?php if ($students['status']==0) {?>
         				style="background-color: #ff8080;color: #000;"
         			<?php } ?>>
         				<td><?=++$sn;?></td>
         				<td><?=$students['name']." ".$students['mname']." ".$students['lname'];?></td>
         				<td>
         					<?php  
         						$select_fees=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$students['batch']);
         						$fee_amount=0;        						
         						while ($fee_row=$select_fees->fetch(PDO::FETCH_ASSOC)) {
         							
         							$select_policy=$obj->select("tbl_student_policy WHERE sid=".$students['sid']." AND fid=".$fee_row['fid']);
         							while ($policy_row=$select_policy->fetch(PDO::FETCH_ASSOC)) {
         								$fee_row['fees']=$policy_row['amount'];
         							}
         							if ($fee_row['sem_wise']!=0) {
         								$fee_amount+=($fee_row['fees']*8);
         							}else{
         								$fee_amount+=$fee_row['fees'];
         							}
         						}
         						$total=$fee_amount;
         						echo $total;
         						$gtotal+=$total;


         					?>

         				</td>
         				<td>
         					<?php
         						$select_payment=$obj->select("tbl_student_payment WHERE sid=".$students['sid']);
         						$amount_paid=0;
         						while ($pay_row=$select_payment->fetch(PDO::FETCH_ASSOC)) {
         							$amount_paid+=$pay_row['amount'];
         						}
         						echo $amount_paid;
         						$pay_gtotal+=$amount_paid;
         					?>
         				</td>
         			</tr>
         			
         	<?php } ?>
         	<tr>
         		<td></td>
         		<td><b>Total</b></td>
         		<td><?=$gtotal;?></td>
         		<td><?=$pay_gtotal;?></td>
         	</tr>
         	</tbody>
         </table>



 </div>
        <!-- row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
   <?php include("includes/footer.php");
   
   ?>

    <!--footer end-->
  </section>
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
        $('.alert').hide('slow')
      },3000);
    })
  </script>
</body>

</html>