<?php 
   session_start();
   $err=array();
   $id=$_POST["stud_id"];
   $cls_id=$_SESSION["id"];
   include 'connector.php';
   if($_POST["desi"]=="Student")
        $sql1="select name,email from class$cls_id where stud_id='$id'";
   else
	   $sql1="select tnm as name,temail as email,sub_id as sub from teachers where tid='$id' and class_id='$cls_id'";
   
   $result=mysqli_query($conn,$sql1);
   $fet=mysqli_fetch_assoc($result);
   if(is_null($fet["name"])){
	   array_push($err,"Existance");
	   $_SESSION["pid"]="";
	   $_SESSION["pnm"]="";
   }
   else{
	   
	   $_SESSION["pid"]=$id;
	   $_SESSION["pnm"]=$fet["name"];
	   if($_POST["desi"]=="Student")
		   $_SESSION["designate"]="s";
	   else{
	      $_SESSION["designate"]="t";
	      $_SESSION["subs"]=$fet["sub"];
		  $sql3="select sub_name from subjects where class_id='$cls_id' and sub_id='".$_SESSION["subs"]."'";
		  $res3=mysqli_query($conn,$sql3);
		  $fet3=mysqli_fetch_assoc($res3);
		  if(!$fet3){
			  array_push($err,"err=".mysqli_error($conn));
		  }
		  else{
			  $_SESSION["sub_name"]=$fet3["sub_name"];
		  }
		  
	   }
	   $email=$fet["email"];
	   $sql1="select id,code from otp_gen where id=(select max(id) from otp_gen)";
	   $res1=mysqli_query($conn,$sql1);
	   $wes=mysqli_fetch_assoc($res1);
	   $oid=$wes["id"];
       $code=$wes["code"];
	   $_SESSION["otp"]=$oid;
  	   $sql2="update otp_gen set email='$email' where id=$oid";
	   if(!mysqli_query($conn,$sql2)){
		   array_push($arr,"err".mysqli_error($conn));
	   }
	   $codee=$code+1;
	   $sql3="insert into otp_gen(code) values($codee)";
	   if(!mysqli_query($conn,$sql3)){
		   array_push($arr,"err".mysqli_error($conn));
	   }
	   $body="Your One Time Password for Class Login is=".$code;
	   array_push($err,$email,$body);
	   
   }
   echo json_encode($err);
  ?>