<?php
	$fid=$_GET['fid'];
	$sid=$_GET['sid'];
	require_once("queries.php");
	$tbl_join_policy="`tbl_student_policy` JOIN tbl_fees ON tbl_fees.fid=tbl_student_policy.fid JOIN tbl_students ON tbl_students.sid=tbl_student_policy.sid JOIN fee_types ON fee_types.ftid=tbl_fees.ftid";
  //joining tbl_students_payment and tbl_fees
  $tbl_student_policy=$obj->select($tbl_join_policy);
  //selecting all data from tbl_student_policy


	?>
	<label class="bmd-label-floating">Student Policy</label>
    <select name="spid" class="form-control">
        <?php
        while ($row2=$tbl_student_policy->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <?php if($row2['sid']==$sid){?>
        <option value="<?=$row2['spid'];?>" <?php if($row2['fid']==$fid){echo "Selected";} ?>>
        <?=$row2['fee_type']." (".$row2['batch'].") ".$row2['amount']." for ".$row2['name'];?>
        </option>
        <?php
    		}
         }
        ?>
        <option value="">Select</option>
    </select>
