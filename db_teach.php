<?php
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
		$sql2="insert into teachers(tid,tnm,temail,sub_id,class_id) values('$tid','$tmm','$temail','$sub','$id')";
		if(!mysqli_query($conn,$sql2)){
			array_push($err,$i.",err=".mysqli_error($conn));
		}
	}
	echo json_encode($err);
 ?>