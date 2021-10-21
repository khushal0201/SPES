<?php
   session_start();
   $ret=array(); 
    include 'connector.php';
   $sql1="select code from otp_gen where id=".$_SESSION["otp"];
   $res1=mysqli_query($conn,$sql1);
   $fet=mysqli_fetch_assoc($res1);
   $rec=$_POST["otp"];
   if($fet["code"]==$rec){
	   array_push($ret,"Right");
	   $sql2="delete from otp_gen where id=".$_SESSION["otp"];
	   if(!mysqli_query($conn,$sql2)){
		   array_push($ret,"err".mysqli_error($conn));
	   }
   }
   else{
	   array_push($ret,"Wrong");
	   
   }
   echo json_encode($ret);
 ?>  