<?php
     session_start();
	 include 'connector.php';
	 $seee=$_POST["ty"];
	 if($seee!="dest"){
		 $_SESSION["id"]=$_POST["id"];
		 $_SESSION["name"]=$_POST["name"];
		 $_SESSION["institute"]=$_POST["ins"];
		 $_SESSION["sess"]=$_POST["sess"];
		 $_SESSION["cdate"]=$_POST["date"];
	 }
	 if($seee=="voll"){
		 $_SESSION["pid"]=-400;
	 }
	 if($seee=="nset"){
		 $whos=$_SESSION['uid'];
		 $sql1="select * from user_class where user_id=$whos and class_id='".$_SESSION["id"]."'";//user class = user id and respective class id
		 $res=mysqli_query($conn,$sql1);
		 $fet=mysqli_fetch_assoc($res);
		 $_SESSION['pid']=$_POST["pid"];
		 $_SESSION['pnm']=$_POST["pnm"];
		 $_SESSION['insta']="OK";
		 $_SESSION["crea"]=$_POST["crea"];
		 $_SESSION["designate"]=$_POST["des"];
		 if($_SESSION["designate"]=="t"){
			 $_SESSION["subs"]=$_POST["subs"];
			 $_SESSION["sub_name"]=$_POST["sub_name"];
		 }
	 }
	 else if($seee=="dest"){
		 session_destroy();
		 echo json_encode("Successfully logged out");
	 }
?>