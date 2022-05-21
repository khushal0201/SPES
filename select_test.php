<?php
   //These are normal tests of marking
    $dats=array();
  session_start();
   $id=$_SESSION["id"];
  
    include 'connector.php';
	
	$sql1="select * from tests where class_id='$id' and status='published';";
	
	if(isset($_POST["ty"])){
		if($_POST["ty"]=="mt"){
			$sql1="select * from madeup_test where class_id='$id' and status='published';";
			if($_SESSION["designate"]=="Creator")
				$sql1="select * from madeup_test where class_id='$id'";
		}
		
		else if($_POST["ty"]=="subn"){
			$sql1="select * from tests where class_id='$id' and status='published'";
		}
		else if($_POST["ty"]=="getf"){
			$sql1="select * from tests where class_id='$id'";
		}
	}
	$result=mysqli_query($conn,$sql1);
	$err=array();
	array_push($err,"er=".mysqli_error($conn));
	
	while($ok=mysqli_fetch_assoc($result)){
		array_push($dats,$ok);
	}
	echo json_encode($dats);
 ?>
 