 <?php
 session_start();
 if($_SESSION['status']!='Success'){
  header("Location:login.php");
  }


 ?>


 <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="index.php"><img src="img/Divya-Gyan-College.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">DivyaGyan College</h5>
          <li class="mt">
            <a class="active" href="display_students.php">
              <i class="fa fa-dashboard"></i>
              <span>Student Table</span>
              </a>
          </li>
          
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>Forms</span>
              </a>
            <ul class="sub">
              <li><a href="student_form.php">Insert Student</a></li>
              <li><a href="student_fees.php">Fee Insert</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-th"></i>
              <span>Tables</span>
              </a>
            <ul class="sub">
              <li><a href="display_payment.php">Payment Table</a></li>
              <li><a href="display_policy.php">Policy Table</a></li>
              <li><a href="display_fees.php">Fee Table</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="up_sem.php">
              <i class="fa fa-pencil"></i>
              <span>Semester Change</span>
            </a>
          </li>
            <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-money"></i>
            

                <span>Payment</span>
              </a>
            <ul class="sub">
              <li><a href="outstanding_pay.php">Outstanding Payment</a></li>
              <li><a href="display_economy.php">Received Payment</a></li>
              <li><a href="total_receivable.php">Total Recievable</a></li>
            </ul>
          </li>
          <?php 
                if(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin']=="yes"){

                ?>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
            

                <span>Extra</span>
              </a>
            <ul class="sub">
              <li><a href="batch_display.php">batch display</a></li>
              <li><a href="batch_insert.php">batch insert</a></li>
              <li><a href="fee_type_insert.php">fee type insert</a></li>
              <li><a href="fee_type_display.php">fee type display</a></li>
            </ul>
          </li>
        </ul>
        <?php
      }
             ?>
              
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->