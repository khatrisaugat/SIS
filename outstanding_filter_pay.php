
<?php
session_start();
if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }
require_once('queries.php');
$sql="tbl_students";
if ($_GET['batch']!="all") {
$sql.=" WHERE batch=".$_GET['batch'];
}

$student_select=$obj->select($sql);
$count=0;
$total_pay=0;
 
?>


                       <table class="table table-bordered table-hover table-responsive">
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
                                  <td><a href="PAY.php?sid=<?=$students['sid'];?>"><?=$students['name']." ".$students['mname']." ".$students['lname'];?></a></td>
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

                                   <table class="table table-bordered">
                                    
                                          
                                        
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
                                  <td><?=$Total;
                                  $total_pay+=$Total;
                                  ?></td>
                                </tr>
                                 <?php
                               } 
                               ?>
                               <tr>
                                <td colspan="4">Total</td>
                                <td><h1><?=$total_pay;?></h1></td>
                              </tr>
                             </tbody>
                           </table>
             </div> 
