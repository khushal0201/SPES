<?php
   session_start();
   $err=array("halloo");
   $_POST1=$_POST;
   $test=array_shift($_POST1);
   include 'connector.php';
   $cls=$_SESSION["id"];
   $i=1;
   if($_SESSION["test_n"]!=""){
	   $_POST1=$_POST;
	   $test=$_SESSION["test_n"];
	   echo "inside";
   }
   
   foreach($_POST1 as $a => $b){
	  // $sub=substr($a,strpos($a,"-")+1);
	   $sus=explode("-", $a);
	   //echo "test=".$test;
	   //print_r($test."=".$sub);
	   //print_r($sus);
	   $sql1="update class$cls set test_".$sus[1]."_$test='$b' where stud_id='".$sus[0]."'";
	   if(!mysqli_query($conn,$sql1)){
		   array_push($err,"update error".mysqli_error($conn));
	   }
	   
   }
   if(count($err)>0){
	   echo json_encode($err);
   }
   
 ?>