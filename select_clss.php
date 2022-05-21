<?php
   session_start();
   $err=array();
   $wer=array();
   $vals=$_POST["ty"];
   include 'connector.php';
   $uid=$_SESSION["uid"];
   
   if($vals=="create"){
   
			$sql1="select * from classes where creator=$uid;";
			$result=mysqli_query($conn,$sql1);
			if(!$result){
				array_push($err,"Selection error=".mysqli_error($conn));
			}
			if(count($err)>0)
				echo json_encode($err);
			else{
				
				while($uio=mysqli_fetch_assoc($result)){
						$dte=$uio["cred"];
						//echo $dte;
						if($dte!=''){
						$ndate=date_create_from_format("Y-m-d",$dte);
						$uio["cred"]=date_format($ndate,"d-M-Y");
						}
					array_push($wer,$uio);   
				}
				
				echo json_encode($wer);
			}
   }
	else{
	   $sql2="select * from user_class where user_id=$uid";
	   $result=mysqli_query($conn,$sql2);
	   
		if(!$result){
		   array_push($err,"Selection error=".mysqli_error($conn));
	   }
	   if(count($err)>0)
		   echo json_encode($err);
	   else{
		   
		   while($uio=mysqli_fetch_assoc($result)){
			   $sql3="select * from classes where id='".$uio["class_id"]."'";//Getting Class info of joiner
			   $res2=mysqli_query($conn,$sql3);
			   $fet2=mysqli_fetch_assoc($res2);
			   $cid=$fet2["creator"];
			   $sql6="select * from user_g where user_id=$cid";//Getting details of the creator
			   //echo $sql6;
			   $res5=mysqli_query($conn,$sql6);
			   $fet5=mysqli_fetch_assoc($res5);
			   if(!is_null($fet5["user_id"])){
				   $fet2["crm"]=$fet5["name"];
			   }
			   else{
				   $sql7="select * from user_n where user_id=$cid";
				   $res6=mysqli_query($conn,$sql7);
				   $fet6=mysqli_fetch_assoc($res6);
				   $fet2["crm"]=$fet6["name"];
			   }
			   $dte=$fet2["cred"];
			   if($dte!=''){
				 //echo "hello";
			     $ndate=date_create_from_format("Y-m-d",$dte);
			     $fet2["cred"]=date_format($ndate,"d-M-Y");
			   }
			   $fet2["des"]=$uio["des"];
			   $fet2["pid"]=$uio["class_user_id"];
			   $fet2["pnm"]=$uio["user_name"];
			   if($uio["des"]=="t"){
				   $sql4="select sub_id as sub from teachers where tid='".$uio["class_user_id"]."' and class_id='".$uio["class_id"]."'";
				   $res3=mysqli_query($conn,$sql4);
				   $fet3=mysqli_fetch_assoc($res3);
				   $fet2["subi"]=$fet3["sub"];
				   
				   $sql5="select sub_name from subjects where class_id='".$uio["class_id"]."' and sub_id='".$fet2["subi"]."'";
				   $res4=mysqli_query($conn,$sql5);
				   $fet4=mysqli_fetch_assoc($res4);
				   $fet2["subn"]=$fet4["sub_name"];
				   
				   
			   }
			   else{
				   $fet2["subi"]=" ";
				   $fet2["subn"]=" ";
			   }
				   
			   //array_push($fet2->des,$uio["des"]);
			   array_push($wer,$fet2);   
		   }
		   
		   echo json_encode($wer);
	   }   
   }
   
?>