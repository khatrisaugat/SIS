<?php 
require_once("includes/header.php");
  require_once("queries.php");

if (isset($_GET['spid'])) {
	$tspid_select=$obj->select("tbl_student_policy WHERE spid=".$_GET['spid']);
  $tspid=$tspid_select->fetch(PDO::FETCH_ASSOC);
	// $sn['sid']=$tspid['sid'];
	$fid['fid']=$tspid['fid'];
	$name_select=$obj->select("tbl_students WHERE sid=".$tspid['sid']);
  $name=$name_select->fetch(PDO::FETCH_ASSOC);
	$ftype_select=$obj->select("tbl_fees WHERE fid=".$fid['fid']);
  $ftype=$ftype_select->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {

if ($_POST['submit']=='submit') {
	array_pop($_POST);
	$sn['spid']=$_GET['spid'];
	// print_r($sn);
	$obj->update($_POST,"tbl_student_policy",$sn);
	header('location:display_policy.php');
}
}
 } 
?>


<?php 
require_once("includes/header.php");
  require_once("queries.php");
  $tbl_name="tbl_students";
  $tbl_students=$obj->select($tbl_name);//selecting all data from tbl_students
  $tbl_fees=$obj->select("tbl_fees");
  // $row=$result->fetch(PDO::FETCH_ASSOC);
  // print_r($row);


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
            <div class="row">
                  <div class="col-md-12">
                            <nav>
                                  <ul class="nav  ">
                                    <li><a href="tbl_student_form.php">Insert Students</a></li>
                                    <li><a href="tbl_fees_form.php">Insert Fees</a></li>
                                    <li><a href="Student_policy.php">Insert Fee Policy</a></li>
                                    <li><a href="Student_payment.php">Insert Payment</a></li>
                                    <li><a href="display_student.php">Display Students</a></li>
                                    <li><a href="display_fees.php">Display Fees</a></li>
                                    <li><a href="display_policy.php">Display Fee Policy</a></li>
                                    <li><a href="display_payment.php">Display Payment</a></li>

                                  </ul>
                          </nav>
                       </div>     
                       <div class="col-md-12">
                              <form action="" method="post" class="form-group">
                                    <div class="col-md-6">
                                        <h1><i class="glyphicon glyphicon-user"></i> Student's Fee Policy Form</h1>
                                        <div class="form-group">
                                            <label>Student</label>
                                            <select name="sid" class="form-control">
                                            	<option selected="" disabled="">Select Option</option>
                                            	 <?php
                                                  while ($row=$tbl_students->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                      <option value="<?=$row['sid'];?>"
                                                      		<?php	if ($row['sid']==$name['sid']) {
                                                      		echo "selected";
                                                      	}?>
                                                      	><?=$row['name']." ".$row['mname']." ".$row['lname']." (".$row['batch'].") ";?></option>
                                                    <?php
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Student</label>
                                            <select name="fid" class="form-control">
                                            	<option selected="" disabled="">Select Option</option>
                                                <?php
                                                  while ($row1=$tbl_fees->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                      <option value="<?=$row1['fid'];?>" 
                                                      		<?php if ($row1['fid']==$ftype['fid']) {
                                                      		echo "selected";
                                                      	}?>
                                                      	><?=$row1['ftype']." (".$row1['batch'].") ";?></option>
                                                    <?php
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                        
                                     
                                
                                    <div class="form-group">
                                        <label>amount</label>
                  							<input type="number" name="amount" class="form-control" value="<?=$tspid['amount'];?>">
                                    </div>
                                  <input type="submit" name="submit"  class="btn btn-success" value="submit">  
                            </div>    
                      </form>
                </div>
        </div>
    </div>
        
</body>
</html>


        <?php
include_once("includes/footer.php")
?>