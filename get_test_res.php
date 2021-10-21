<?php
   session_start();
   include 'connector.php';
   $id=$_SESSION["test_id"];
   $name=$_SESSION["test_n"];
   $clsis=$_SESSION["id"];
   $wh=$_POST["wh"];
   $err=array();
   $tbps=array();
   if($wh=="cols"){
	   $sql3="";
	  if($_SESSION["designate"]!="t"){
		  $sql3="select * from no_test_s where test_id=".$id." and class_id='".$clsis."'";
	  }
	  if($_SESSION["designate"]=="t"){
	   $subid=$_SESSION["subs"];
	   if($_SESSION["test_ty"]=="nt")
          $sql3="select * from no_test_s where test_id=".$id." and class_id='".$clsis."' and sub_id='".$subid."'";
	   else if($_SESSION["test_ty"]=="mt")
		   $sql3="select * from ma_test_s where m_test_id=".$id." and class_id='".$clsis."' and sub_id='".$subid."'";
	  } 
	  if($_SESSION["designate"]=="Creator"&&$_SESSION["test_ty"]=="mt"){
		  $sql3="select * from ma_test_s where m_test_id=".$id." and class_id='".$clsis."'";
	  }
	  
       $fet1=mysqli_query($conn,$sql3);
       while($res1=mysqli_fetch_assoc($fet1)){
		   $_SESSION["tcol"]=$res1["id"];
		   if($_SESSION["test_ty"]=="nt")
		      $res1["id"]="t_".$res1["id"];
		   else if($_SESSION["test_ty"]=="mt")
			  $res1["id"]="mt_".$res1["id"]; 
		   $tcol=$res1["id"];
		   array_push($tbps,$res1);
	   }
	   if($_SESSION["designate"]=="t"){
		   $sql7="update no_test_s set status='draft' where id=".$res1["id"];
	       if(!mysqli_query($conn,$sql7)){
			   array_push($err,"err=".mysqli_error($conn));
		   }
	   }
	   
       $sql4="alter table class$clsis add $tcol int default '0'";
       if(!mysqli_query($conn,$sql4)){
		   array_push($err,"err=".mysqli_error($conn));
	   }	
       //print_r($err);	   
	   echo json_encode($tbps);
   }
   
   
   else if($wh=="get"){
	   $where="";
	   if($_SESSION["designate"]=="s"){
		   $where="where stud_id='".$_SESSION["pid"]."'";
	   }
	   $sql5="select * from class$clsis $where";
	   $fet2=mysqli_query($conn,$sql5);
	   while($res3=mysqli_fetch_assoc($fet2)){
		   array_push($tbps,$res3);
	   }
	   echo json_encode($tbps);
   }
   else if($wh=="upd"){
	   $col=$_POST["col"];
	   $stu=$_POST["stu"];
	   $data=$_POST["data"];
	   $sql6="update class$clsis set $col=$data where stud_id='$stu'";
	   
	   if(!mysqli_query($conn,$sql6)){
		   array_push($err,"err=".mysqli_error($conn));
	   }
	   
       echo json_encode($err);
   }   
	else if($wh=="sta"){
		$sql8="update no_test_s set status='submitted' where id=".$_SESSION["tcol"];
		if(!mysqli_query($conn,$sql8)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
	}  
	else if($wh=="mtt"){
		
		$sql9="select * from ma_test_s where m_test_id=$id and class_id='$clsis'";
	    $fet3=mysqli_query($conn,$sql9);
		while($res4=mysqli_fetch_assoc($fet3)){
			$res4["id"]="mt_".$res4["id"];
			array_push($tbps,$res4);
		}
		echo json_encode($tbps);
		
	}
  	else if($wh=="pubb"){
		$sql10="update tests set status='published' where id='$id'";
		if(!mysqli_query($conn,$sql10)){
			array_push($err,"err=".mysqli_error($conn));
		}
	    echo json_encode($err);
	}
	else if($wh=="wst"){
		$sql11="select * from ma_test_t where test_id=$id and class_id='$clsis'";
		$fet4=mysqli_query($conn,$sql11);
		while($res5=mysqli_fetch_assoc($fet4)){
			array_push($tbps,$res5);
		}
		echo json_encode($tbps);
	}
	else if($wh=="oltst"){
		$sql12="select * from tests where class_id='$clsis'";
		$fet5=mysqli_query($conn,$sql12);
		while($res6=mysqli_fetch_assoc($fet5)){
			array_push($tbps,$res6);
		}
		echo json_encode($tbps);
	}
	
    /*$conn=mysqli_connect("localhost","root","","information_schema","3308");
	//echo $id." name ".$name;
    $tobesub=array();
    $sql1="select column_name from columns where table_name='class$clsis' and column_name like '%$name'";
	if($_SESSION['test_ty']=="mt")
		$sql1="select column_name from columns where table_name='class$clsis' and column_name like '%$id'";
	$res1=mysqli_query($conn,$sql1);
	$subs="";
	$sebsend=array();
	//print_r($res1);
	$c=mysqli_num_rows($res1);
	//echo $c;
	$z=1;
	while($fet=mysqli_fetch_assoc($res1)){
		//$c=count($fet);
		$subs.=$fet["COLUMN_NAME"];
		array_push($sebsend,$fet["COLUMN_NAME"]);
		if($c!=$z){
		    $subs.=",";	
		}
		$z++;
	}
	array_push($tobesub,$sebsend);
	include 'connector.php';
    $sql2="select $subs,stud_id,name from class$clsis where stud_id='".$_SESSION["pid"]."'";
	if(isset($_POST["type"])){
		if($_POST["type"]=="tea"){
			$sql2="select $subs,stud_id,name from class$clsis ";
		}
	}
	$res2=mysqli_query($conn,$sql2);
	//echo $sql2;
	//echo "error of mysql=".mysqli_error($conn);
	while($fest=mysqli_fetch_assoc($res2)){
		array_push($tobesub,$fest);
	}
	echo json_encode($tobesub);
   }*/
 ?>