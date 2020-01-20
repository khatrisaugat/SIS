<?php
	$fid=$_GET['fid'];
  // echo $fid;
	$sid=$_GET['sid'];

  // echo $fid." ".$sid;
	require_once("queries.php");
	$tbl_join_policy="`tbl_fees` LEFT JOIN tbl_student_policy ON tbl_student_policy.fid=tbl_fees.fid  WHERE tbl_student_policy.sid=".$sid. " and tbl_student_policy.fid=".$fid . "  


  UNION (SELECT * FROM tbl_fees left  JOIN tbl_student_policy ON tbl_fees.fid=tbl_student_policy.fid
   where tbl_fees.fid=".$fid." AND tbl_student_policy.sid IS NULL)";

  // echo $tbl_join_policy;
  //joining tbl_students_payment and tbl_fees
  // echo "Thissssssss";
  $tbl_student_policy=$obj->select($tbl_join_policy);
  //selecting all data from tbl_student_policy
//$non_policy_amount=$obj->select("tbl_fees WHERE fid=".$fid);

	?>
	<label class="bmd-label-floating">Applicable Fees</label>
    <select name="spid" class="form-control" >
        <?php
        while ($row2=$tbl_student_policy->fetch(PDO::FETCH_ASSOC)) {
          
        ?>
        <?php if($row2['fid']==$fid){?>

          <option value="<?=$row2['spid'];?>"><?=$row2['amount'];?></option>
      <?php /*  <option value="<?=$row2['spid'];?>" <?php if($row2['fid']==$fid){echo "Selected";} ?>>
        <?=$row2['fee_type']." (".$row2['batch'].") ".$row2['amount']." for ".$row2['name'];?>
        </option> */ ?>
        <?php
    		
     } else if($row2['amount']==""){ ?>
          <option value=""><?php echo $row2['fees']?></option>
      <?php  } }
        ?>
    </select>
