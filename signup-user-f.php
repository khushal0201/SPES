<?php
   session_start();
   $arr=array();
   include 'connector.php';
   $to=$_POST["email"];
   $check1="select email from user_n where email='$to'";
   $res1=mysqli_query($conn,$check1);
   $fet=mysqli_fetch_assoc($res1);
   if(is_null($fet["email"])){
	   
	    $check2="select email from user_g where email='$to'";
		$res2=mysqli_query($conn,$check2);
	    $fet2=mysqli_fetch_assoc($res2);
		
	    if(is_null($fet2["email"])){
		   $subject="OTP Performance";
		
		   $sql1="select id,code from otp_gen where id=(select max(id) from otp_gen)";
		   $res1=mysqli_query($conn,$sql1);
		   $wes=mysqli_fetch_assoc($res1);
		   $oid=$wes["id"];
		   $code=$wes["code"];
		   $_SESSION["otp"]=$oid;
		   $sql2="update otp_gen set email='$to' where id=$oid";
		   if(!mysqli_query($conn,$sql2)){
			   array_push($arr,"err".mysqli_error($conn));
		   }
		   $codee=$code+1;
		   $sql3="insert into otp_gen(code) values($codee)";
		   if(!mysqli_query($conn,$sql3)){
			   array_push($arr,"err".mysqli_error($conn));
		   }
		   $body="Your One Time Password is ".$code;
		   $_SESSION["email"]=$to;
		   $_SESSION["tp-bod"]=$body;
		   array_push($arr,$to,$body);
		}
		else{
			 array_push($arr,"Already-g");
		}
	     
   }
   else{
	   array_push($arr,"Already-n");
   }
  
   echo json_encode($arr);
 ?>
 

 