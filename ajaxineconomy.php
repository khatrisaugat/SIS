<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
  require_once("queries.php");
  $select_batch1=$obj->select("batch ORDER BY batch DESC");
  $current_batch=$select_batch1->fetch(PDO::FETCH_ASSOC);
// selecting current semester
  $select_semester=$obj->select("tbl_students WHERE batch=".$current_batch['batch']);

  $semester=$select_semester->fetch(PDO::FETCH_ASSOC);
  $current_semester=$semester['sem_id'];

  $select_sem=$obj->select("semester");
?>

	<select name="semester" class="form-control" required="">
          <option selected="" disabled="" >Select Semester</option>
          <?php while($sem=$select_sem->fetch(PDO::FETCH_ASSOC)){?>
          <option value="<?=$sem['sem_id'];?>" 
          	<?php

                      if ($sem['sem_id']==$current_semester) {
                      echo "style='font-weight:bold;color:red;'";
                      }

                      ?>
                      ><?=$sem['semester'];?></option>
          <?php }?>
     </select>   
