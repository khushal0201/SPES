<?php
    session_start();
	if(isset($_POST["opon"])){
		$f=0;
		if(!getimagesize($_FILES["bul"]["tmp_name"])){
			$f=1;
		}
		echo json_encode($f);
	}
	else{
		$err=array();
	   $name=$_POST["name"];
	   $pass=$_POST["pass"];
	   $email=$_SESSION["email"];
	   include 'connector.php';
	   $_SESSION["u-name"]=$name;
	   $sql1="create table user_n(name varchar(100),email varchar(100),pass varchar(100));";
	   if(!mysqli_query($conn,$sql1)){
		   array_push($err,"err1=".mysqli_error($conn));
	   }
	   $sql4="select max(user_id) as high from user_g";
	   $res1=mysqli_query($conn,$sql4);
	   $fet1=mysqli_fetch_assoc($res1);
	   $sql5="select max(user_id) as high from user_n";
	   $res2=mysqli_query($conn,$sql5);
	   $fet2=mysqli_fetch_assoc($res2);
	   $a=$fet1["high"];
	   $b=$fet2["high"];

	   $uid="";
	   if($a>$b)
		   $uid=$a+1;
	   else
		   $uid=$b+1;
	   $sql2="";
	   $op="./pics/";
	  // print_r($_FILES);
	   if($_FILES["dp"]["error"]!=4){
		   $ex=$ex=strtolower(pathinfo($_FILES["dp"]["name"],PATHINFO_EXTENSION));
		  // echo "its-".strtolower(pathinfo($_FILES["dp"]["name"],PATHINFO_EXTENSION));
		   if($ex==""){
			   $ex="jpg";
		   }
		   $thf=$uid;
		   $dest=$op.$thf.".".$ex;
		   if(!move_uploaded_file($_FILES["dp"]["tmp_name"],$dest)){
			   array_push($err,"image not uplooaded");
		   }
		   $dest="pics/".$thf.".".$ex;
		   $sql2="insert into user_n(name,email,pass,user_id,img) values('$name','$email','$pass',$uid,'$dest')";
		   $_SESSION["img"]=$dest;
	   }
	   else{
		 $def="pics/default.jpg";
		 $sql2="insert into user_n(name,email,pass,user_id) values('$name','$email','$pass',$uid)";
		 $_SESSION["img"]=$def;
	   }  
	  $_SESSION["uid"]=$uid;
	  
	   if(!mysqli_query($conn,$sql2)){
		   array_push($err,"err2=".mysqli_error($conn));
		   
	   }
	   $_SESSION["trav"]="2";
	   echo json_encode($err);   
	}
?>