  	<?php
  	include("queries.php");
  	include("includes/header.php");
  	include("includes/sidebar.php");

  	$batch_select=$obj->select("batch");
  	while ($batch=$batch_select->fetch(PDO::FETCH_ASSOC)) {
  		print_r($batch);
  		?>
  		<a href="ajaxinsem.php?batch=<?=$batch['batch'];?>"><?=$batch['batch'];?></a><br>

  	<?php	
  	}



  	?>