<?php
   session_start();
   $var1=$_SESSION["id"];
   $hope=array();
   include 'connector.php';
   
   $sql1="select sub_name,sub_id from subjects where class_id='$var1'";
   
   $result=mysqli_query($conn,$sql1);
   if(!$result){
	   echo "ms error".mysqli_error($conn);
   }
   
   while($und=mysqli_fetch_assoc($result)){
	   array_push($hope,$und);
   }
   
   echo json_encode($hope);
  
?>