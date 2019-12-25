<?php 
require_once("includes/header.php");
  require_once("queries.php");
  $tbl_name="tbl_students";
  $tbl_students=$obj->select($tbl_name);//selecting all data from tbl_students
  $tbl_fees=$obj->select("tbl_fees");
  // $row=$result->fetch(PDO::FETCH_ASSOC);
  // print_r($row);

  //for inserting data
  if(isset($_POST['submit'])){
    if($_POST['submit']=='submit'){
      array_pop($_POST);//popping submit from $_POST
      // $join=join(',',array_keys($_POST));
      // echo "$join";
      $obj->insert($_POST,"tbl_student_policy");//insert values from form
      
      
    }
  }


?>

<div class="container">
					<form action="" method="post" class="form-group">
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
                                <label class="bmd-label-floating">Student</label>
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
                          	<label class="bmd-label-floating">amount</label>
                         	<input type="number" name="amount" class="form-control">
                        </div>
                      </div>
                    </div>
                    
					<input type="submit" name="submit"  class="btn btn-success" value="submit">
					</form>
				</div>
        <?php
include_once("includes/footer.php")
?>