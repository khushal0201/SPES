<?php 
    session_start();
	include 'connector.php';
    $err=array();
	$cls=$_SESSION["id"];
	$subs=$_SESSION["subs"];
    $pp=$_POST;
	     $sql4="select * from attendance where class_id='".$cls."' and sub_id='".$subs."' and status='no'";
	     $res4=mysqli_query($conn,$sql4);
		 $sql4="alter table class".$cls." add(";
		 $assd=array();
		 $chre="";
		foreach($pp as $asd => $bsd){
			 $wss=explode("-",$asd);
			 $sql7="update attendance set status='yes' where id=".$wss[1];
			 if(!mysqli_query($conn,$sql7)){
				 array_push($err,"errkl=".mysqli_error($conn));
			 }
			  $sql4="alter table class".$cls." add a_".$wss[1]." int not null";
			  $res4=mysqli_query($conn,$sql4);
			   if(!mysqli_query($conn,$sql4)){
			 array_push($err,"erru=".mysqli_error($conn));
		       }
			  
		 }
		 //$imp=implode(",",$assd);
		 $sql4="alter table class".$cls." add tota_".$subs." int not null";
		// $sql4.=$imp.",tota_".$subs." int)";
		 if(!mysqli_query($conn,$sql4)){
			 array_push($err,"erru=".mysqli_error($conn));
		 }
		// print_r($pp);
		 foreach($pp as $asd => $bsd){
			 $wss=explode("-",$asd);
			 $sql6="update class".$cls." set a_".$wss[1]."=1 where stud_id='".$wss[0]."'";
			 if(!mysqli_query($conn,$sql6)){
				 array_push($err,"errs=".mysqli_error($conn));
			 }
			 $sql10="update class".$cls." set tota_".$subs."=tota_".$subs."+1 where stud_id='".$wss[0]."'";
			 if(!mysqli_query($conn,$sql10)){
				 array_push($err,"errs=".mysqli_error($conn));
			 }
		 }
		 echo json_encode($err);	
   
 ?>