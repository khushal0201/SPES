<?php
    // from up_teachers
    session_start();
	include 'connector.php';
	$llo=count($_POST)/5;
	$err=array();
	$id=$_SESSION["id"];
	
	$sql1="create table teachers(id int not null auto_increment,tid varchar(50),tnm varchar(100),temail varchar(100),sub_id varchar(50),class_id varchar(100),primary key(id))";
	if(!mysqli_query($conn,$sql1)){
		array_push($err,"error=".mysqli_error($conn));
	}
	$i=1;
	for($i;$i<=$llo;$i++){
		$ind=$_POST["indee".$i];
		$tid=$_POST["id".$ind];
		$tmm=$_POST["name".$ind];
		$temail=$_POST["email".$ind];
		$sub=$_POST["sub".$ind];
		$sql5="select tid  from teachers where tid='".$tid."' and class_id='".$id."'";
		$res=mysqli_query($conn,$sql5);
		$fet5=mysqli_fetch_assoc($res);
		if(isset($fet2["tid"])){
			array_push($err,"$i statement student id is already there in Table ");
			continue;
		}
		$sql8="select email from class$id where email='".$temail."'";
		$res=mysqli_query($conn,$sql8);
		$fet5=mysqli_fetch_assoc($res);
		if(isset($fet5["email"])){
			array_push($err,"$i statement Email is Already Registered");
			continue;
		}
 
		$sql8="select temail from teachers where class_id='".$id ."' and temail='".$temail."'";
		$res=mysqli_query($conn,$sql8);
		$fet5=mysqli_fetch_assoc($res);
		if(isset($fet5["temail"])){
			array_push($err,"$i statement Email is Already Registered for teachers");
			continue;
		}
		$sql2="insert into teachers(tid,tnm,temail,sub_id,class_id) values('$tid','$tmm','$temail','$sub','$id')";
		if(!mysqli_query($conn,$sql2)){
			array_push($err,$i.",err=".mysqli_error($conn));
		}
	}
	echo json_encode($err);
 ?>