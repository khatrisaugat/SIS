<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
require_once('queries.php');
$batch_select=$obj->select("batch");
//batch select for filter
$student_select=$obj->select("tbl_students");
$count=0;


include("includes/header.php");
include("includes/sidebar.php");?>
  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-sm-8">
            <div class="col-sm-4">
              <label>Batch</label>
    			     <select name="batch" class="form-control" onchange="batch(this.value)">
                  <option selected="" value="all">All</option>
                  <?php while ($row=$batch_select->fetch(PDO::FETCH_ASSOC)) {?>
                    <option value="<?=$row['batch'];?>"><?=$row['batch'];?></option>
                    <?php
                  } ?>   
               </select>
             </div>
           </div>
           <div class="col-sm-8" id="pay_table">
             <table class="table">
               <thead>
                 <tr>
                   <th>S.N</th>
                   <th>Name</th>
                   <th>Phone</th>
                   <th>Outstanding</th>
                   <th>Total</th>
                 </tr>
               </thead>
               <tbody>
                 <?php while ($students=$student_select->fetch(PDO::FETCH_ASSOC)) {?>
                  <tr>
                    <td><?=++$count;?></td>
                    <td><?=$students['name']." ".$students['mname']." ".$students['lname'];?></td>
                    <td><?=$students['phone'];?></td>
                    <?php
                    $sem=0;
                    $allsem=0;
                    $value=0;
                    $Total=0;
                    //initialization
                    $fee_select=$obj->select("tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$students['batch']);
                    
                    while ($fees=$fee_select->fetch(PDO::FETCH_ASSOC)) {
                      $policy_select=$obj->select("tbl_student_policy WHERE sid=".$students['sid']);
                        while ($policy=$policy_select->fetch(PDO::FETCH_ASSOC)) {
                          if ($fees['fid']==$policy['fid']) {
                            $fees['fees']=$policy['amount'];
                          }
                        }
                        $arr_fees[]=$fees;
                    }
                    $payment_select=$obj->select("tbl_student_payment WHERE sid=".$students['sid']);
                    while ($payment=$payment_select->fetch(PDO::FETCH_ASSOC)) {
                      $arr_payment[]=$payment;
                    }
                   for ($i=0; $i < count($arr_fees) ; $i++) { 
                     if ($arr_fees[$i]['sem_wise']==0) {
                       $sem+=$arr_fees[$i]['fees'];
                     }else{
                      $sem+=$arr_fees[$i]['fees'];
                      $allsem+=$arr_fees[$i]['fees'];
                     }
                   }
                    for ($i=0; $i < count($arr_fees); $i++) { 
                      $query="tbl_student_payment WHERE sid=".$students['sid']." AND fid=".$arr_fees[$i]['fid'];
                      $single_payment=$obj->select($query);
                      while ($paid=$single_payment->fetch(PDO::FETCH_ASSOC)) {
                        $value+=$paid['amount'];
                      }
                      $key=$arr_fees[$i]['fee_type'];
                      $arr[$key]=$value;
                      $value=0;
                    }

                  ?>
                   <td>

                     <table>
                      
                            
                          
                       <?php
                        // print_r($arr);
                        // echo $arr['admission'];
                      // for ($i=0; $i <count($arr_fees) ; $i++) { 
                      //   $fee_type=$arr_fees[$i]['fee_type'];
                      //   $payable[$fee_type]=$arr_fees[$i]['fees'];
                      // }
                      // print_r($payable);
                      // foreach ($payable as $key => $value) {
                      //   if ($arr[$key]<$value) {?>
                           <!-- <td><?=$key;?></td> -->
                          <!-- <td><?=($arr[$key]-$value)?></td> -->
                          <?php
                          
                      //   }
                      // }
                        
                        ?>



                        <?php
                        foreach ($arr as $key => $value) {
                          $query1="tbl_fees JOIN fee_types ON fee_types.ftid=tbl_fees.ftid WHERE batch=".$students['batch'];
                          $select_fees=$obj->select($query1);
                          while ($fee=$select_fees->fetch(PDO::FETCH_ASSOC)) {
                            $policy_select=$obj->select("tbl_student_policy WHERE sid=".$students['sid']);
                            while ($polic=$policy_select->fetch(PDO::FETCH_ASSOC)) {

                                if ($fee['fid']==$polic['fid']) {
                                  $fee['fees']=$polic['amount'];
                                }
                              }
                            if ($key==$fee['fee_type']) {
                              if ($fee['fees']>$value) {
                                if ($students['sem_id']>1) {
                                  if ($fee['sem_wise']==1) {
                                    $fee['fees']*=$students['sem_id'];
                                  }
                                }
                                $num=($fee['fees']-$value);
                                $Total+=$num;
                                ?>
                                <tr>
                                <td><?=$key." = ";?><?=$num;?></td>

                                </tr>
                                <?php 
                              }
                            }
                          }
                        }

                        ?>
                        
                      </table>
                    </td>
                    <td><?=$Total;?></td>
                  </tr>
                   <?php
                 } 
                 ?>
               </tbody>
             </table>
           </div>
		    </div>
      </section>
  </section>
<?php include("includes/footer.php"); ?>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script>
     function batch(batch){
      
         var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){

        if(this.readyState == 4 && this.status==200){
         document.getElementById('pay_table').innerHTML=this.responseText;

        }
      }
      xhr.open('GET','outstanding_filter_pay.php?batch='+batch,true);
      xhr.send();

     
  }
    $(document).ready(function(){

        setTimeout(function() {
            $('.alert').hide('slow')
        }, 3000);
    })
  </script>

  
</body>

</html>
