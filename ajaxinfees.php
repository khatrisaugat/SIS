<?php
	require_once("queries.php");
	$batch_select=$obj->select("batch");
	
?>
			<select name="batch" class="form-control">
              <option selected="" disabled="">Select Your Batch</option>
                <?php while ($batch=$batch_select->fetch(PDO::FETCH_ASSOC)) {
                		$check_value=true;
                		$check_batch=$obj->select("tbl_fees WHERE ftid=".$_GET['ftid']);
                		while ($batch_check=$check_batch->fetch(PDO::FETCH_ASSOC)) {
                			if($batch_check['batch']==$batch['batch']){
                				$check_value=false;
                			}
                		}
                		if ($check_value) {
                			# code...
                		
                	?>

                <option value="<?=$batch['batch'];?>"><?=$batch['batch'];?></option>
              <?php
              	}
               } ?>
            </select>