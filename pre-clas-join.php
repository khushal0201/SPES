<?php
   session_start();
   include 'connector.php';
   $cls=$_SESSION["id"];
   $userid=$_SESSION["uid"];
   $classuserid=$_SESSION["pid"];
   $cname=$_SESSION["pnm"];
   
   
   $des=$_SESSION["designate"];
   //$_SESSION["designate"]=$des;
   $err=array();
   $sql1="create table user_class(user_id int,class_user_id varchar(50),user_name varchar(50),class_id varchar(50),des varchar(50))";
   if(!mysqli_query($conn,$sql1)){
	   array_push($err,"err1=".mysqli_error($conn));
   }
   
   $sql2="insert into user_class(user_id,class_user_id,user_name,class_id,des) values($userid,'$classuserid','$cname','$cls','$des')";
   if(!mysqli_query($conn,$sql2)){
	   array_push($err,"err2=".mysqli_error($conn));
   }
   //print_r($err);
   echo json_encode($err);
   
?>