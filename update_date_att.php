<?php
     session_start();
	 include 'connector.php';
     $err=array();
     //print_r($_POST);
		$dat=$_POST;
		   //print_r($dat);
		   foreach($dat as $asf => $bsf){
		   $sql7="update attendance set daty='$bsf' where id=$asf";
		   if(!mysqli_query($conn,$sql7)){
			   array_push($err,"erui=".mysqli_error($conn));
		   }
		   }
		echo json_encode($err);
 ?>