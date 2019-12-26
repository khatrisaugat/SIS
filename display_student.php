<?php
  require_once("includes/header.php");
  require_once("queries.php");
  $tbl_students=$obj->select("tbl_students");//select all from tbl_students
  $j=1;//initialize j
  if(isset($_GET['sid'])){//check url for get variable


  	if($_GET['op']=='d'){//delete operation
  		array_pop($_GET);//popping op from get
  		$single_select="tbl_students WHERE sid=".$_GET['sid'];//selecting 1 row from tbl_students
  		$img_name=$obj->select($single_select);//select function call
  		$img=$img_name->fetch(PDO::FETCH_ASSOC);//fetch data
  		if(!empty($img['img'])){//delete image from storage
  			$Location='files/'.$img['img'];
  			echo "$Location";
  			unlink($Location);
  		}
  		$obj->delete($_GET,"tbl_students");//delete data from tbl_students
  		header("Location:display_student.php");//redirect to display_student.php page


  	}else if($_GET['op']=='e'){
  		header("Location:edit_student.php?sid=".$_GET['sid']);
  	}

  }

	
 ?>
 <div class="container">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>S.N</th>
				<th>Photo</th>
				<th>Name</th>
				<th>City</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Guardian's Name</th>
				<th>Guardian's Phone</th>
				<th>Batch</th>
				<th>Gender</th>
				<th>date</th>
				<th>Delete</th>
				<th>Edit</th>
				<th>View</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row=$tbl_students->fetch(PDO::FETCH_ASSOC)) {//fetch data from tbl_students
				?>
				<tr>
					<td><?=++$j;?></td>

					<?php
					if(!empty($row['img'])){?>
						<td><a href="files/<?=$row['img'];?>"><img src="files/<?=$row['img'];?>" width=100%></a></td>
						<?php

					}else{
						echo "<td>NO image </td>";
					}
					?>
					<td><?=$row['name']." ".$row['mname']." ".$row['lname'];?></td>
					<td><?=$row['city'];?></td>
					<td><?=$row['address'];?></td>
					<td><?=$row['phone'];?></td>
					<td><?=$row['gname'];?></td>
					<td><?=$row['gphone'];?></td>
					<td><?=$row['batch'];?></td>
					<td><?=$row['gender'];?></td>
					<td><?=$row['date'];?></td>
					<td><a href="display_student.php?sid=<?=$row['sid'];?>&op=d">Delete</a></td>
					<td><a href="display_student.php?sid=<?=$row['sid'];?>&op=e">Edit</a></td>
					<td><a href="student_details.php?sid=<?=$row['sid'];?>">View</a></td>
				</tr>
				<?php
			}
				?>
				
				
			</tbody>
		</table>
	</div>
