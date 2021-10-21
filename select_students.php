<?php
    session_start();
	$err=array();
	$hop=array();
	include 'connector.php';
	

	$sql1="select * from class".$_SESSION["id"];
	$des="s";
	
	if(isset($_POST["ty"])){
		if($_POST["ty"]=="teach"){
		$sql1="select * from teachers where class_id='".$_SESSION["id"]."'";
		  $des='t';
		}
	
	}
	$result=mysqli_query($conn,$sql1);
	
    if(!$result){
	   array_push($err,"ms- error=".mysqli_error($conn));
    }	
	while($qop=mysqli_fetch_assoc($result)){
		$clas=$_SESSION["id"];
		if($des=="s")
		   $thid=$qop["stud_id"];
		else if($des=="t")
		  $thid=$qop["tid"];
		$sql2="select * from user_class where class_id='$clas' and class_user_id='$thid' and des='$des'";
		$res=mysqli_query($conn,$sql2);
		$fet=mysqli_fetch_assoc($res);
		if(!is_null($fet["id"])){
			$qop["status"]="Joined";
		}
		else{
			$qop["status"]="Not Joined";
		}
		array_push($hop,$qop);
	} 
	
	if(count($err)>0){
		echo json_encode($err);
	}
	else
	   echo json_encode($hop);
	
?>