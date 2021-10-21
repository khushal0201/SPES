<?php
  session_start();
  $id=$_POST["clss"];
  $err=array();
  include 'connector.php';
  
  $sql1="select * from classes where id='$id';";
  $result=mysqli_query($conn,$sql1);
  //array_push($err,$result);
  $ar=mysqli_fetch_assoc($result);
  if(is_null($ar["name"])){
	  array_push($err,"not present");
	  $_SESSION["id"]="";
      $_SESSION["name"]="";
	  
  }   
  else{
	  //$ar=mysqli_fetch_assoc($result);
	  //array_push($err,$ar);
	  $_SESSION['id']=$id;
	  $_SESSION['name']=$ar["name"];
	  $_SESSION["institute"]=$ar["institute"];
	  $_SESSION["sess"]=$ar["sess"];
	  
	  $cid=$ar["creator"];
	  $sql6="select * from user_g where user_id=$cid";
	  $res5=mysqli_query($conn,$sql6);
	  $fet5=mysqli_fetch_assoc($res5);
      if(!is_null($fet5["user_id"])){
 		   $_SESSION["crea"]=$fet5["name"];
	   }
	   else{
		   $sql7="select * from user_n where user_id=$cid";
		   $res6=mysqli_query($conn,$sql7);
		   $fet6=mysqli_fetch_assoc($res6);
		   $_SESSION["crea"]=$fet6["name"];
		   }
	   $dte=$ar["cred"];
	   if($dte!=''){
	   $ndate=date_create_from_format("Y-m-d",$dte);
	   $_SESSION["cdate"]=date_format($ndate,"d-M-Y");
	   }
	   else{
		  $_SESSION["cdate"]="null"; 
	   }
  }
  echo json_encode($err);
?>