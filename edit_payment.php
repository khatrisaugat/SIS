<?php
if (!isset($_GET['tspid'])) {//not letting direct access
  header("Location:display_payment.php");
}
	require_once("includes/header.php");
	require_once("queries.php");//including queries
	$tbl_name="tbl_students";
    $tbl_students=$obj->select($tbl_name);
  //selecting all data from tbl_students
    $tbl_fees=$obj->select("tbl_fees");
  //selecting all data from tbl_fees
    $tbl_join_hai="`tbl_student_policy` JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN tbl_students ON tbl_students.sid=tbl_student_policy.sid";
  //joining tbl_students_payment and tbl_fees
    $tbl_student_policy=$obj->select($tbl_join_hai);
  //selecting all data from tbl_student_policy
    //$tbl_join="tbl_student_payment JOIN tbl_students ON tbl_students.sid=tbl_student_payment.sid JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid WHERE tspid=".$_GET['tspid'];

     $tbl_students_single=$obj->select("tbl_student_payment WHERE tspid=".$_GET['tspid']);
     $single_select=$tbl_students_single->fetch(PDO::FETCH_ASSOC);

     if(isset($_POST['submit'])){
     	if($_POST['submit']=='submit'){
     		array_pop($_POST);
     		$sn['tspid']=$_GET['tspid'];
     		 if($_POST['spid']==''){
            	unset($_POST['spid']);
            //if there is no policy than spid is not needed
        	 }
        	 $obj->update($_POST,"tbl_student_payment",$sn);
        	 header("Location:display_payment.php");
     	}
     }
?>
<div class="container">
					<form action="" method="post" enctype="multipart/form-data" class="form-group">
						<div class="row">
             <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Student</label>
                  <select name="sid">
                        <?php
                          while ($row=$tbl_students->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                              <option value="<?=$row['sid'];?>" <?php 
                              if ($single_select['sid']==$row['sid']) {
                              		echo "selected";
                              } ?>>
                              <?=$row['name']." ".$row['mname']." ".$row['lname']." (".$row['batch'].") ";?></option>
                            <?php
                          }
                        ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Fee Type</label>
                                <select name="fid">
                                    <?php
                                      while ($row1=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row1['fid'];?>" <?php 
				                              if ($single_select['fid']==$row['fid']) {
				                              		echo "selected";
				                              } ?>>
                              				<?=$row1['ftype']." (".$row1['batch'].") ";?></option>
                                        <?php
                                      }
                                    ?>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Student Policy</label>
                                <select name="spid">
                                  <option value="" <?php if(empty($single_select['spid'])){echo "selected";} ?>>
                                  	No policy
                              	  </option>
                                    <?php
                                      while ($row2=$tbl_student_policy->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row2['spid'];?>" <?php 
				                              if ($single_select['spid']==$row['spid']) {
				                              		echo "selected";
				                              } ?>>
				                              <?=$row2['ftype']." (".$row2['batch'].") ".$row2['amount']." for ".$row2['name'];?></option>
                                        <?php
                                      }
                                    ?>
                                </select>
                            </div>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            	<label class="bmd-label-floating">amount</label>
                           	<input type="text" name="amount" class="form-control" value="<?=$single_select['amount'];?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">date</label>
                            <input type="date" name="pdate" class="form-control" value="<?=$single_select['pdate'];?>">
                          </div>
                        </div>
                      </div>
                    
					<input type="submit" name="submit"  class="btn btn-success" value="submit">
					</form>
				</div>
        <?php
include_once("includes/footer.php")
?>