<?php
   session_start();
   include 'connector.php';
   $name=$_POST["name"];
   $email=$_POST["email"];
   $img=$_POST["img"];
   $thes=file_get_contents($img);
   //echo "name=".$name." p ".$email;
   $err=array();
   $sql1="create table user_g(name varchar(100),email varchar(100))";
   if(!mysqli_query($conn,$sql1)){
	   mysqli_error($conn);
	   array_push($err,"err1=".mysqli_error($conn));
   }

   $sql2="select user_id,email from user_g where email='$email'";
   //echo $sql2;
   $res1=mysqli_query($conn,$sql2);
  
   $fet=mysqli_fetch_assoc($res1);
   if(is_null($fet["email"])){
	   $sql3="select user_id,email from user_n where email='$email'";
	   $res2=mysqli_query($conn,$sql3);
	   $fet2=mysqli_fetch_assoc($res2);
	   if(is_null($fet2["email"])){
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
		    
			$iio="pics/".$uid.".jpg";
		   $sql4="insert into user_g(name,email,user_id,img) values('$name','$email',$uid,'$iio')";
		   if(!mysqli_query($conn,$sql4)){
			   array_push($err,"err".mysqli_error($conn));
		   }
		   $_SESSION["uid"]=$uid;
	   
	   
	   }
	   else 
	    $_SESSION["uid"]=$fet2["user_id"];
   }
   else 
	   $_SESSION["uid"]=$fet["user_id"];
   $_SESSION["u-name"]=$name;
   $_SESSION["email"]=$email;
   $_SESSION["trav"]="2";
    $_SESSION["img"]="pics/".$_SESSION["uid"].".jpg";
   if(!file_put_contents("./pics/".$_SESSION["uid"].".jpg",$thes)){
				array_push($err,"file not moved");
	}
	
   array_push($err,"helloo trav her is=".$_SESSION['trav']);
   echo json_encode($err);
 ?>