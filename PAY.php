<?php
	session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
   if (!isset($_GET['sid'])) {//not letting direct access
  header("Location:display_student.php");
	}
	include("includes/header.php"); 
 	include("includes/sidebar.php");
 ?>
     <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
        <?php

   $sid=$_GET['sid'];
require_once("queries.php");//include queries

$student_select=$obj->select("tbl_students WHERE sid=".$_GET['sid']);
// $payment_sem=$obj->select("tbl_student_payment WHERE sid=".$_GET['sid']);
// while ($get_sem=$payment_sem->fetch(PDO::FETCH_ASSOC)) {
// 	$arr[]=$get_sem['semester'];
// }
// $payment_sem_count=array_unique($arr);


$students=$student_select->fetch(PDO::FETCH_ASSOC);?>

<h1>
<?php
// print_r($payment_sem_count);
// echo $payment_sem_count[0];
if (!empty($students['img'])) {?>
	<img src="files/<?=$students['img'];?>" style="width: 150px;height: 150px;margin-top: -80px;">
<?php	
}
?>
<?=$students['name']." ".$students['mname']." ".$students['lname'];?></h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Semester</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$maxSem=$obj->select_sum(" MAX(semester) AS maxSem FROM tbl_student_payment WHERE sid=".$_GET['sid']);
						$count_maxSem=$maxSem->fetch(PDO::FETCH_ASSOC);
						// print_r($count_maxSem) ;
				$Semester=$obj->select("semester WHERE sem_id<=".$count_maxSem['maxSem']);
				while ($row=$Semester->fetch(PDO::FETCH_ASSOC)) {
					// for($x=$payment_sem_count[0];$x<=count($payment_sem_count);$x++){
					// if($row['sem_id']<=$payment_sem_count[$x]) {
						?>
						<tr>
							<td><?=$row['semester'];?></td>
							<td>
								<table class="table table-bordered">
									<tr>
										<thead>
											<th>Paid</th>
											<th>Receivable</th>
											<th>Outstanding</th>
										</thead>
									</tr>
									<tbody>
										<?php 
										$paid_select=$obj->select("tbl_student_payment JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$sid." AND tbl_student_payment.semester=".$row['sem_id']);
										$paid_total=0;
										 ?>

										<tr>
											<td>
												<table class="table table-striped">
													<?php while ($paid_row=$paid_select->fetch(PDO::FETCH_ASSOC)) {?>
														<tr>
														<td><?=$paid_row['fee_type'];?></td>
														<td><?=$paid_row['pdate'];?></td>
														<td><?=$paid_row['amount'];
															$paid_total+=$paid_row['amount'];
														?></td>
														
													</tr>
										<?php		} ?>
													<tr>
														<td></td>
														<td></td>
														<td><b><big><?=$paid_total;?></big></b></td>
													</tr>
												</table>
											</td>
											<td>
												<table class="table table-striped">
													<?php $sql="tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$students['batch'];
													$Receivable_select=$obj->select($sql);
													$receivable_total=0;
													while ($Receivable=$Receivable_select->fetch(PDO::FETCH_ASSOC)) {
														$policy_select=$obj->select("tbl_student_policy WHERE sid=".$students['sid']);
														while ($policy_check=$policy_select->fetch(PDO::FETCH_ASSOC)) {
															if ($policy_check['fid']==$Receivable['fid']) {
																$Receivable['fees']=$policy_check['amount'];
															}
														}

														echo "<tr>";
														
														if ($row['sem_id']==1) {?>
															<td><?=$Receivable['fee_type'];?></td>
															<td><?=$Receivable['fees'];
															$receivable_total+=$Receivable['fees'];
															?></td>
														<?php	
														}else{
															if($Receivable['sem_wise']==1){ ?>
																<td><?=$Receivable['fee_type'];?></td>
															<td><?=$Receivable['fees'];
															$receivable_total+=$Receivable['fees'];
															?></td><?php
															}
														}?>
														<?php
														echo "</tr>";
													}
													 ?>
													 <tr>
													 	<td></td>
													 	<td><b><big><?=$receivable_total;?></big></b></td>
													 </tr>
												</table>
											</td>
											<td><b><big><?=($receivable_total-$paid_total);?></big></b></td>
										</tr>
									</tbody>
								</table>

							</td>

						</tr>
			<?php	
		// }
	// }
				}
				 ?>
				
			</tbody>
		</table>
		<center>
			<a href="student_details.php?sid=<?=$sid;?>" class="btn btn-primary">Student Details</a>
			<!-- <a href="payment_details.php?sid=<?=$sid;?>" class="btn btn-warning">View Payments Only</a> -->
		</center>
		</div>
	</section>
</section>
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
