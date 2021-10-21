<?php
// Start the session
session_start();
?>
<?php
    $err=array();
   $var1=$_POST["class_id"];
   $var2=$_POST["class_name"];
   $var3=$_POST["insti"];
   $var4=$_POST["sess"];
   
   $conn=mysqli_connect("localhost","root","","hometime","3308");
         if (!$conn) {
               array_push($err,"cant connect ");
              }
			
   
   $sql1="create table classes(id varchar(20) NOT NULL,name varchar(50),PRIMARY KEY(id))";
   
   
   //$df=$_SESSION["id"];
   //array_push($err,"ID=".$df);
   if(mysqli_query($conn,$sql1)){
	   array_push($err,"Table Already Created");
   }
   $uid=$_SESSION["uid"];
   $_SESSION["designate"]="Creator";
   $sql3="select * from classes where id='$var1'";
   $fet1=mysqli_query($conn,$sql3);
   $res1=mysqli_fetch_assoc($fet1);
   //echo $res1["name"];
   if(is_null($res1["name"])){
       date_default_timezone_set('Asia/Kolkata');
	   $date=date("Y-m-d");
	   $sql2="insert into classes(id,name,creator,institute,sess,cred) values('$var1','$var2',$uid,'$var3','$var4','$date')";
	   
	   
	   
	   if(!mysqli_query($conn,$sql2)){
		   array_push($err,"errr=".mysqli_error($conn));
	   }
	   else{
		  $sql5="create table class".$var1."(stud_id varchar(50),name varchar(50),email varchar(100),last_msg int)";
			if(!mysqli_query($conn,$sql5)){
				array_push($err,"err=,".mysqli_error($conn));
			} 
		   
		  $_SESSION["id"]=$var1;
		  $_SESSION["name"]=$var2;	
          $_SESSION["institute"]=$var3;
          $_SESSION["sess"]=$var4;
          $_SESSION["cdate"]=date("d-M-Y");		  
	   }
	   
	   $sql4="insert into chatn(class_id,chat_name,designation) values ('$var1','Class Group','stc')";
	   if(!mysqli_query($conn,$sql4)){
		   array_push($err,"err4=".mysqli_error($conn));
	   }
	   
	   $sql5="insert into chatn(class_id,chat_name,designation) values ('$var1','Students Group','s')";
	   if(!mysqli_query($conn,$sql5)){
		   array_push($err,"err5=".mysqli_error($conn));
	   }
	   
	   $sql6="insert into chatn(class_id,chat_name,designation) values ('$var1','Teachers Group','tc')";
	   if(!mysqli_query($conn,$sql6)){
		   array_push($err,"err6=".mysqli_error($conn));
	   }
   }
   else{
	   array_push($err,"Exists");
   }
   echo json_encode($err);
?>