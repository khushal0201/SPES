<?php 
   session_start();
   $email=$_POST["email"];
   $pass=$_POST["password"];
   include 'connector.php';
   $err=array();
   $sql1="select email from user_n where email='$email'";
   $res=mysqli_query($conn,$sql1);
   $fet=mysqli_fetch_assoc($res);
   if(is_null($fet["email"])){
	   array_push($err,"Email");
	   
   } 
   else{
	   
	    $sql2="select email from user_g where email='$email'";
	    $res1=mysqli_query($conn,$sql2);
	    $fet2=mysqli_fetch_assoc($res1);
	    if(isset($fet2["email"])){
		   array_push($err,"Email-g");
		   
	    } 
	   else{
		   
		   $sql2="select user_id,name,pass,img from user_n where email='$email'";
		   
		   $res1=mysqli_query($conn,$sql2);
		   $fet2=mysqli_fetch_assoc($res1);
		   //echo "err=".mysqli_error($conn);
		   if($pass!=$fet2["pass"]){
			   array_push($err,"Password");
		   }
		   else{
			   $_SESSION["email"]=$email;
			   $_SESSION["u-name"]=$fet2["name"];
			   $_SESSION["uid"]=$fet2["user_id"];
			   $_SESSION["img"]=$fet2["img"];
			   $_SESSION["trav"]="2";
			   array_push($err,"True");}
	   }   
   }   
   echo json_encode($err);
  ?>