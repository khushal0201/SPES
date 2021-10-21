<?php
    session_start();
	$stat=$_POST["ty"];
	include 'connector.php';
	$err=array();
	$cls=$_SESSION["id"];
	$subs=$_SESSION["subs"];
	if($stat=="stud"){
	     if($_POST["ty2"]=="1st"){
			 $sql9="select * from class".$cls." where stud_id=".$_SESSION["pid"];
			 $res3=mysqli_query($conn,$sql9);
			 $fet3=mysqli_fetch_assoc($res3);
			 echo json_encode($fet3);
		 }
         if($_POST["ty2"]=="2nd"){
			 $stat="get";
		 }		 
		
	}
	
	if($stat=="get"){
		    $tbs=array();
			$sql1="create table attendance(id int not null auto_increment,class_id varchar(100),sub_id varchar(100),daty date,status varchar(50),primary key(id));";
			if(!mysqli_query($conn,$sql1)){
				array_push($err,"errg=".mysqli_error($conn));
			}
			//echo json_encode($err);
			$sql2="select * from attendance where class_id='".$cls."' and sub_id='".$subs."' and status='yes' order by id ASC";
		    $res1=mysqli_query($conn,$sql2);
			while($fet1=mysqli_fetch_assoc($res1)){
				array_push($tbs,$fet1);
			}
			echo json_encode($tbs);
		}
		
	if($stat=="set"){	
			$sql1="select DATE_ADD(max(daty),Interval 1 Day) as ddd from attendance where class_id='".$cls."' and sub_id='".$subs."'";
			
			$res=mysqli_query($conn,$sql1);
            //echo "err-".mysqli_error($conn);			
			$fet=mysqli_fetch_assoc($res);
			//print_r($fet);
			 $gest=$fet["ddd"];
			if(is_null($fet["ddd"])){
				$date=date("Y-m-d");
				$sql3="insert into attendance(class_id,sub_id,daty,status) values('$cls','$subs','$date','no')";
				if(!mysqli_query($conn,$sql3)){
					array_push($err,"err noll=".mysqli_error($conn));
				}
			}
			else{
				//echo "andarr";
			  	//echo "ddd=".$gest;
			   $sql3="insert into attendance(class_id,sub_id,daty,status) values('".$cls."','".$subs."','$gest','no')";
				if(!mysqli_query($conn,$sql3)){
					array_push($err,"err noll=".mysqli_error($conn));
					//print_r($err);
				}
			  }
			$sql8="select * from attendance where id=(select max(id) from attendance where class_id='".$cls."' and sub_id='".$subs."')";  
			$res2=mysqli_query($conn,$sql8);
			$fet2=mysqli_fetch_assoc($res2);
			echo json_encode($fet2);
	}
	
	if($stat=="sub"){
		$pp=$_POST["data"];
	     $sql4="select * from attendance where class_id='".$cls."' and sub_id='".$subs."' and status='no'";
	     $res4=mysqli_query($conn,$sql4);
		 $sql4="alter table class".$cls." ";
		 $assd=array();
		 while($fet4=mysqli_fetch_assoc($res4)){
			 $sql7="update attendance set status='yes' where id=".$fet4["id"];
			 if(!mysqli_query($conn,$sql7)){
				 array_push($err,"errkl=".mysqli_error($conn));
			 }
			 array_push($assd,"add ".$fet4["id"]." int");
		 }
		 $imp=implode(",",$assd);
		 $sql4.=$imp.",add tota_".$subs." int";
		 if(!mysqli_query($conn,$sql4)){
			 array_push($err,"erru=".mysqli_error($conn));
		 }
		// print_r($pp);
		 foreach($pp as $asd => $bsd){
			 $wss=explode("-",$asd);
			 $sql6="update class".$cls." set ".$wss[1]."=1 where stud_id='".$wss[0]."'";
			 if(!mysqli_query($conn,$sql6)){
				 array_push($err,"errs=".mysqli_error($conn));
			 }
			 $sql10="update class".$cls." set tota_".$subs."=tota_".$subs."+1 where stud_id='".$wss[0]."'";
			 if(!mysqli_query($conn,$sql10)){
				 array_push($err,"errs=".mysqli_error($conn));
			 }
		 }
		 echo json_encode($err);
	   
	}
	if($stat=="upd"){
		//print_r($_POST);
		$dat=$_POST["burs"];
		   //print_r($dat);
		   foreach($dat as $asf => $bsf){
		   $sql7="update attendance set daty='$dat' where id=$asf";
		   if(!mysqli_query($conn,$sql7)){
			   array_push($err,"erui=".mysqli_error($conn));
		   }
		   }
		echo json_encode($err);
	}
?>