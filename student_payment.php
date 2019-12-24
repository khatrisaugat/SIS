<?php 
  require_once("includes/header.php");
  require_once("queries.php");
  $tbl_name="tbl_students";
  $tbl_students=$obj->select($tbl_name);
  //selecting all data from tbl_students
  $tbl_fees=$obj->select("tbl_fees");
  //selecting all data from tbl_fees
  $tbl_join_hai="`tbl_student_payment` JOIN tbl_fees ON tbl_fees.fid=tbl_student_payment.fid";
  //joining tbl_students_payment and tbl_fees
  $tbl_student_policy=$obj->select($tbl_join_hai);
  //selecting all data from tbl_student_policy
  if(isset($_POST['submit'])){
    if($_POST['submit']=='submit'){
      array_pop($_POST);
      //popping submit from $_POST

      // $join=join(',',array_keys($_POST));
      // echo "$join";

      if($_POST['spid']==''){
            unset($_POST['spid']);
            //if there is no policy than spid is not needed
      }

      $obj->insert($_POST,"tbl_student_payment");
      //insert values from form
      
      
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
                              <option value="<?=$row['sid'];?>"><?=$row['name']." ".$row['mname']." ".$row['lname']." (".$row['batch'].") ";?></option>
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
                                          <option value="<?=$row1['fid'];?>"><?=$row1['ftype']." (".$row1['batch'].") ";?></option>
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
                                  <option value="" selected="">No policy</option>
                                    <?php
                                      while ($row2=$tbl_student_policy->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                          <option value="<?=$row2['spid'];?>"><?=$row2['ftype']." (".$row2['batch'].") ".$row2['amount'];?></option>
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
                           	<input type="text" name="amount" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">date</label>
                            <input type="date" name="date" class="form-control">
                          </div>
                        </div>
                      </div>
                    
					<input type="submit" name="submit"  class="btn btn-success" value="submit">
					</form>
				</div>