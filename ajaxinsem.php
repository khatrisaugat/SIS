  	<?php
    session_start();
  	include("queries.php");
    // echo $_SESSION['batch'];
  	include("includes/header.php");
  	include("includes/sidebar.php");
    if (isset($_POST['submit'])) {
      if ($_POST['submit']=='Upgrade') {
        $query=$obj->select("tbl_students WHERE status=1 AND batch=".$_SESSION['batch']);
        unset($_SESSION['batch']);
        $semResult=$query->fetch(PDO::FETCH_ASSOC);
        $sem['sem_id']=$semResult['sem_id']+1;
        // $sem_id=$semResult['sem_id'];
        $sn=$_POST['sem'];
        // print_r($sn);
        $obj->updateSem($sem,"tbl_students",$sn);
      }
      elseif ($_POST['submit']=='Downgrade') {
        $query=$obj->select("tbl_students WHERE status=1  AND batch=".$_SESSION['batch']);
        unset($_SESSION['batch']);
        $semResult=$query->fetch(PDO::FETCH_ASSOC);
        $sem['sem_id']=$semResult['sem_id']-1;
        // $sem_id=$semResult['sem_id'];
        $sn=$_POST['sem'];

        // print_r($sn);
        $obj->updateSem($sem,"tbl_students",$sn);
      }
  }

  	$batch_select=$obj->select("batch");?>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <h1>Semester Change</h1>
          <div class="col-sm-8">
          <select class="form-control" onchange="semup(this.value)">
            <option disabled="" selected="">Select Batch</option>
    <?php

  	while ($batch=$batch_select->fetch(PDO::FETCH_ASSOC)) {
  		// print_r($batch);
  		?>
        
          <option value="<?=$batch['batch'];?>"><?=$batch['batch'];?></option>

        
  		

      


  	<?php	
  	}



  	?>
    </select>
    </div>
    <div class="col-sm-9" id="data-pull">
        
      </div>
  </div>
</section>
</section>

    <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>
  <script type="text/javascript">
    function semup(batch){
      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){

        if(this.readyState == 4 && this.status==200){
         document.getElementById('data-pull').innerHTML=this.responseText;

        }
      }
      xhr.open('GET','up_sem.php?batch='+batch,true);
      xhr.send();
  };
  </script>
<script>
  $(document).ready(function(){
    setTimeout(function(){
      $('.alert').hide('slow')
    },3000);
  })
</script>
<script>
    function check_uncheck_checkbox(isChecked) {
  if(isChecked) {
    $('input[name="sem[]"]').each(function() { 
      this.checked = true; 
    });
  } else {
    $('input[name="sem[]"]').each(function() {
      this.checked = false;
    });
  }
}
  </script>
 
</body>

</html>