<?php
	session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
if (isset($_GET['batch']) && $_GET['batch']=='ALL') {
	header("Location:receivable_payment.php");
}
	include("includes/header.php"); 
 	include("includes/sidebar.php");
 ?>
     <section id="main-content">
      <section class="wrapper">
       <div class="row mt">
        <?php
require_once("queries.php");//include queries
$select_batch1=$obj->select("batch ORDER BY batch DESC");
  $current_batch=$select_batch1->fetch(PDO::FETCH_ASSOC);

$query="tbl_students WHERE status=1";
// additional codee
if (isset($_GET['filter']) && $_GET['filter']=='set') {
  $query.=" AND batch=".$_GET['batch'];
  
  // echo $query;
  // $batch=$obj->select($query);
}
// ad code end
$sem_check=$obj->select($query);
$sem_of_student=$sem_check->fetch(PDO::FETCH_ASSOC);
$student_select=$obj->select($query);
?>
 <div class="row col-sm-10">
 	
 
           <form class="form-group" method="get">
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
               <option selected="" value="ALL">ALL</option>
               <?php
                  $batch_select=$obj->select("batch");
                  while ($batch_option=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
                    <option value="<?=$batch_option['batch'];?>" <?php if(isset($_GET['batch']) && $_GET['batch']==$batch_option['batch']){echo "selected";} ?>
 <?php

                      if ($batch_option['batch']==$current_batch['batch']) {
                      echo "style='font-weight:bold;color:red;'";
                      }

                      ?>><?=$batch_option['batch'];?></option>
                    
                 <?php }
               ?>
             </select>
              </div>
              
             <div class="col-sm-1">
               <input type="submit" name="filter" value="set" class="btn btn-primary">
             </div>     
           </form>
         </div>
         <br>
         <br>
         <br>
        <?php $Semester=$obj->select("semester");
        	if (isset($_GET['batch'])) {
        		while ($sem=$Semester->fetch(PDO::FETCH_ASSOC)) {
        			if ($sem_of_student['sem_id']>=$sem['sem_id']) {
        				# code...
        			?>
        			<a href="receivable_payment.php?batch=<?=$_GET['batch'];?>&filter=set&sem=<?=$sem['sem_id'];?>" class="btn btn-info"><?=$sem['semester'];?></a>
        			<?php
        			}
        		}
        	}
        ?>
	<table class="table table-bordered">
			<thead>
				<tr>
					<th>Student</th>
					<th>Semester</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				// if(isset($_GET['filter']) && $_GET['filter']=='set'){
				//         $students=$batch;
				//       }
				while ($students=$student_select->fetch(PDO::FETCH_ASSOC)) {

					if (isset($_GET['sem'])) {
						$students['sem_id']=$_GET['sem'];
		
					}
					?>
						<tr>
							<td><a href="PAY.php?sid=<?=$students['sid'];?>"><?=$students['name']." ".$students['mname']." ".$students['lname'];?></td>
							<td><?=$students['sem_id'];?></a></td>
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
										$paid_select=$obj->select("tbl_student_payment JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE sid=".$students['sid']." AND tbl_student_payment.semester=".$students['sem_id']);
										$paid_total=0;
										 ?>

										<tr>
											<td style="width: 300px;">
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
											<td style="width: 300px;">
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
														
														if ($students['sem_id']==1) {?>
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
			<?php	}
				
				 ?>
				
			</tbody>
		</table>
</div>
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
