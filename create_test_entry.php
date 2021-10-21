<?php
    session_start(); 
    include 'connector.php';
	$pos=$_POST["ty"];
	$err=array();
	$tbps=array();
	//echo "sesss=".$_SESSION["id"];
	$teac=$_SESSION["pid"];
	$clas=$_SESSION["id"];
	if($pos=="maket"){
		$sql1="create table online_test_rec(id int not null auto_increment,class_id varchar(100),teacher_id varchar(100),test_name varchar(100),test_mark int,test_date date,test_time time,d_h int,d_m int,status varchar(50) default 'draft',primary key(id))";
		if(!mysqli_query($conn,$sql1)){
			array_push($err,"err=".mysqli_error($conn));
			
		}
		$tn=$_POST["dats"]["mtestn"];
		//print_r($_POST);
		$sql3="insert into online_test_rec(test_name,teacher_id,class_id) values('$tn','".$_SESSION["pid"]."','".$_SESSION["id"]."')";
		if(!mysqli_query($conn,$sql3)){
			array_push($err,"err=".mysqli_error($conn));
			
		}
		//print_r($err);
		$sql2="select max(id) as col1 from online_test_rec where class_id='".$_SESSION["id"]."' and teacher_id='".$_SESSION["pid"]."'";
		$res=mysqli_query($conn,$sql2);
		$fet=mysqli_fetch_assoc($res);
		$er=$fet["col1"];
		$_SESSION["otid"]=$fet["col1"];
		array_push($tbps,$er);
	    echo json_encode($tbps);	
		
	}
	else if($pos=="inset"){
		$sql4="create table online_mcq(id int not null auto_increment,class_id varchar(100),test_id int,quest varchar(100),op1 varchar(100),op2 varchar(100),op3 varchar(100),op4 varchar(100),ans varchar(100),mark int,primary key(id))";
		$sql5="create table online_norm(id int not null auto_increment,class_id varchar(100),test_id int,quest varchar(100),mark int,primary key(id))";
		if(!mysqli_query($conn,$sql4)){
			array_push($err,"err is=".mysqli_error($conn));
		}
		if(!mysqli_query($conn,$sql5)){
			array_push($err,"err is=".mysqli_error($conn));
		}
	    //print_r($_POST);
		$tid=$_POST["tid"];
		if($_POST["das"]["qty"]=="mcq"){
			$que=$_POST["das"]["quest"];
			$cou=count($_POST["das"])-4;
			//echo "cou=".$cou;
			$arri=array();
			$arra=array();
			for($y=1;$y<=$cou;$y++){
				array_push($arri,"op".$y);
				array_push($arra,"'".$_POST["das"]["op".$y]."'");
			}
			$ni=implode(",",$arri);
			$na=implode(",",$arra);
			$ma=$_POST["das"]["mark"];
			$ans=$_POST["das"]["ans"];
			$sql6="insert into online_mcq(class_id,test_id,quest,".$ni.",mark,ans) values('$clas',$tid,'$que',".$na.",$ma,'$ans')";
			if(!mysqli_query($conn,$sql6)){
				array_push($err,"err ins=".mysqli_error($conn));
			}
//print_r($err);
			$sql8="select max(id) as ids from online_mcq where test_id='".$_POST['tid']."'";
		    $res1=mysqli_query($conn,$sql8);
			$fet1=mysqli_fetch_assoc($res1);
			$fet1["ty"]="mcq";
			array_push($tbps,$fet1);
		}
		
		else if($_POST["das"]["qty"]=="norm"){
			//echo "i dont knpw=".$tid;
			$que=$_POST["das"]["quest"];
			$ma=$_POST["das"]["mark"];
			$sql7="insert into online_norm(class_id,test_id,quest,mark) values('$clas',$tid,'$que',$ma)";
			if(!mysqli_query($conn,$sql7)){
				array_push($tbps,"err ins=".mysqli_error($conn));
			}
			$sql9="select max(id) as ids from online_norm where test_id='".$_POST['tid']."'";
	        $res2=mysqli_query($conn,$sql9);
			$fet2=mysqli_fetch_assoc($res2);
			$fet["ty"]="norm";
			array_push($tbps,$fet2);
			
			}
			echo json_encode($tbps);
	}
	else if($pos=="upd"){
		$que=$_POST["das"]["quest"];
		$mark=$_POST["das"]["mark"];
		
		if($_POST["das"]["qty"]==$_POST["ott"]){
			if($_POST["das"]["qty"]=="mcq"){
				
				$cou=count($_POST["das"])-4;
				//echo "cou=".$cou;
				$arri=array();
				$arra=array();
				for($y=1;$y<=$cou;$y++){
					$no="op".$y;
					array_push($arra,"$no='".$_POST["das"]["op".$y]."'");
				}
				$na=implode(",",$arra);
				$ans=$_POST["das"]["ans"];
				$oid=$_POST["oid"];
				$sql10="update online_mcq set quest='$quest',".$na.",ans='$ans',mark=$mark where id=$oid";
				if(!mysqli_query($conn,$sql10)){
					array_push($err,"err=".mysqli_error($conn));
				}
			    $tbps["ids"]=$_POST["oid"];
				$tbps["ty"]="mcq";
			}
			else{
				$oid=$_POST["oid"];
				$sql10="update online_norm set quest='$quest',mark=$mark where id=$oid";
				if(!mysqli_query($conn,$sql10)){
					array_push($err,"err=".mysqli_error($conn));
				}
			    $tbps["ids"]=$_POST["oid"];
				$tbps["ty"]="norm";
			}
		}
		else{
			  $sql12="";
			  if($_POST["ott"]=="mcq"){
				  $sql12="delete from online_mcq where id=".$_POST["ott"];
			  } 
			  else{
				  $sql12="delete from online_norm where id=".$_POST["ott"];
			  }
			   if(!mysqli_query($conn,$sql12)){
				   array_push($err,"err=".mysqli_query($conn));
			   }
			
				$tid=$_POST["tid"];
			if($_POST["das"]["qty"]=="mcq"){
				$que=$_POST["das"]["quest"];
				$cou=count($_POST["das"])-4;
				//echo "cou=".$cou;
				$arri=array();
				$arra=array();
				for($y=1;$y<=$cou;$y++){
					array_push($arri,"op".$y);
					array_push($arra,"'".$_POST["das"]["op".$y]."'");
				}
				$ni=implode(",",$arri);
				$na=implode(",",$arra);
				$ma=$_POST["das"]["mark"];
				$ans=$_POST["das"]["ans"];
				$sql6="insert into online_mcq(test_id,quest,".$ni.",mark,ans) values($tid,'$que',".$na.",$ma,'$ans')";
				if(!mysqli_query($conn,$sql6)){
					array_push($err,"err ins=".mysqli_error($conn));
				}
	//print_r($err);
				$sql8="select max(id) as ids from online_mcq where test_id='".$_POST['tid']."'";
				$res1=mysqli_query($conn,$sql8);
				$fet1=mysqli_fetch_assoc($res1);
				$fet1["ty"]="mcq";
				array_push($tbps,$fet1);
			}
			
			else if($_POST["das"]["qty"]=="norm"){
				$que=$_POST["das"]["quest"];
				$ma=$_POST["das"]["mark"];
				$sql7="insert into online_norm(test_id,quest,mark) values($tid,'$que',$ma)";
				if(!mysqli_query($conn,$sql7)){
					array_push($tbps,"err ins=".mysqli_error($conn));
				}
				$sql9="select max(id) as ids from online_norm where test_id='".$_POST['tid']."'";
				$res2=mysqli_query($conn,$sql9);
				$fet2=mysqli_fetch_assoc($res2);
				$fet["ty"]="norm";
				array_push($tbps,$fet2);
				
				}
				
			}
			echo json_encode($tbps);
			}
		else if($pos=="fett"){
		$tba="";
		
		$sql13="select * from online_test_rec where teacher_id='$teac' and class_id='$clas' $tba";
		if(isset($_POST["who"])){
			if($_POST["who"]=="stud")
			 $sql13="select * from online_test_rec where class_id='$clas' and status='publish'";
		}
		$res3=mysqli_query($conn,$sql13);
		while($fet3=mysqli_fetch_assoc($res3)){
			$fet3["ttd"]=$fet3["test_date"];
			$fet3["ttm"]=$fet3["test_time"];
			$thc1=0;
			$thc2=0;
			if(!is_null($fet3["test_date"])){
				$new=date_create($fet3["test_date"]);
				$thc1=1;
				
				$fet3["test_date"]=date_format($new,"d-M-Y");
			}
			if(!is_null($fet3["test_time"])){
				$new=date_create($fet3["test_time"]);
				$thc2=1;
				$fet3["test_time"]=date_format($new,"g:i:s A");
			}
			$thc3=0;$thc4=0;
			if(!is_null($fet3["end_date"])){$thc3=1;}
			if(!is_null($fet3["end_time"])){$thc4=1;}
			if($fet3["status"]=="publish"&&$thc1==1&&$thc2==1&&$thc3==1&&$thc4==1){
				date_default_timezone_set('Asia/Kolkata');
				$thed1=date_create_from_format("Y-m-d H:i:s",$fet3["ttd"].' '.$fet3["ttm"]);
				$thed2=date_create_from_format("Y-m-d H:i:s",$fet3["end_date"].' '.$fet3["end_time"]);
				$crt=date("Y-m-d H:i:s");
			
				//echo $fet3["ttd"].' '.$fet3["ttm"]."-y-".$fet3["ttm"].' '.$fet3["end_time"];
				//echo $thed1." ".$thed2." ".$crt."and =".$fet3['test_date']."and e=".$fet3["test_time"];
				//echo $thed1." ".$thed2." ".$crt;
				$crt2=date_create_from_format("Y-m-d H:i:s",$crt);
				if($thed1<$crt2&&$crt2<$thed2){
				  //echo "in 1";
				  $fet3["status"]="live";	
				
				}
				else if($crt2>$thed2){
					//echo "in 2";
					$fet3["status"]="done";
					//echo $fet3["test_name"];
				}
			}
			array_push($tbps,$fet3);
		}
		echo json_encode($tbps);
	}
	else if($pos=="loader"){
		$tid="";
		if(isset($_POST["gt"])){
			$tid=$_SESSION["gtid"];
		}
		else 
			$tid=$_SESSION["otid"];
		//echo "might be workin=$tid and clasid=".$_SESSION["id"].",ok";
		$sql14="select * from online_mcq where test_id=$tid ";
		$sql15="select * from online_norm where test_id=$tid ";
		$res4=mysqli_query($conn,$sql14);
		while($fet4=mysqli_fetch_assoc($res4)){
			//print_r($fet4);
			$fet4["typp"]="mcq";
			array_push($tbps,$fet4);
		}
		$res5=mysqli_query($conn,$sql15);
		while($fet5=mysqli_fetch_assoc($res5)){
			$fet5["typp"]="norm";
			array_push($tbps,$fet5);
		}
		echo json_encode($tbps);
	}
	else if($pos=="cht"){
		$tid=$_SESSION["otid"];
		$ttm=$_POST["ttm"];
		$ttd=$_POST["ttd"];
		$hrs=$_POST["hrs"];
		$min=$_POST["min"];
		$sec=$_POST["sec"];
		$ttm=$ttm.":00";
		//echo "ttm=".$ttm."ttd=".$ttd;
		
		$thecr=date_create_from_format("H:i:s Y-m-d",$ttm." ".$ttd);
		$endd=date_add($thecr,date_interval_create_from_date_string($hrs." hours ".$min." minutes ".$sec." seconds"));
		
		$enddate=date_format($endd,"Y-m-d");
		$endtime=date_format($endd,"H:i:s");
		
		$sql16="update online_test_rec set status='publish',test_time='$ttm',test_date='$ttd',d_h='$hrs',d_m='$min',d_s='$sec',end_date='$enddate',end_time='$endtime' where id=$tid";
		if(!mysqli_query($conn,$sql16)){
			array_push($tbps,"err=".mysqli_error($conn));
		}
		echo json_encode($tbps);
	}
	else if($pos=="inss"){
		$otid=$_SESSION["otid"];
		$qty=$_POST["qty"];
		if($qty=="mcq"){
			   $sql17="insert into online_mcq(test_id) values($otid)";
			   if(!mysqli_query($conn,$sql17)){
				   array_push($err,"err=".mysqli_error($conn));
			   }
			   $sql19="select max(id) as id from online_mcq where test_id=$otid";
			   $fet6=mysqli_query($conn,$sql19);
			   $res6=mysqli_fetch_assoc($fet6);
		}
	    else{
		   $sql18="insert into online_norm(test_id) values($otid)";
		   if(!mysqli_query($conn,$sql18)){
			   array_push($err,"err=".mysqli_error($conn));
		   }
		   $sql19="select max(id) as id from online_norm where test_id=$otid";
		   $fet6=mysqli_query($conn,$sql19);
		   $res6=mysqli_fetch_assoc($fet6);
		}
		$tbs=$_POST["tbs"];
		if($tbs=="yes"){
			$qid=$_POST["oid"];
			$qty=$_POST["ott"];
			$sql50="";
			if($qty=="mcq")
			  $sql50="delete from online_mcq where id=$qid";
		    else if($qty=="norm"){
			  $sql50="delete from online_norm where id=$qid";
			}
			if(!mysqli_query($conn,$sql50)){
				array_push($err,"err=".mysqli_error($conn));
			}
		}
		
	   array_push($tbps,$res6);
	   
	   echo json_encode($tbps);
	   
	}
	else if($pos=="updat"){
		$qid=$_POST["qid"];
		$qty=$_POST["das"]["qty"];
		$quest="";
		$mark="";
		$op1="";
		$op2="";
		if(isset($_POST["das"]["quest"])){
			$quest=$_POST["das"]["quest"];
		}
		else{
			$quest='';
		}
		if($_POST["das"]["mark"]!=''){
			$mark=$_POST["das"]["mark"];
		}
		else{
			$mark="null";
		}
		
		//$mark=$_POST["das"]["mark"];
		if($qty=="mcq"){
			if(isset($_POST["das"]["op1"])){
			$op1="'".$_POST["das"]["op1"]."'";
			}
			else{
				$op1='null';
			}
			
			//$op1=$_POST["das"]["op1"];
			if(isset($_POST["das"]["op2"])){
			    $op2="'".$_POST["das"]["op2"]."'";
			}
			else{
				$op2='null';
			}
			//$op2=$_POST["das"]["op2"];
			$ans=$_POST["das"]["ans"];
			$op3="";
			$op4="";
			
			$ans=$_POST["das"]["ans"];
			if(isset($_POST["das"]["op3"])){
				$op3=",op3='".$_POST["das"]["op3"]."'";
				
			}
			else{
				$op3=",op3=null";
			}
			
			if(isset($_POST["das"]["op4"])){
				$op4=",op4='".$_POST["das"]["op4"]."'";
			}
			else{
				$op4=",op4=null";
			}	
			$sql133="update online_mcq set quest='$quest',mark=$mark,op1=$op1,op2=$op2".$op3.$op4.",ans='$ans',class_id='$clas' where id=$qid";
			//echo $sql133;
			if(!mysqli_query($conn,$sql133)){
				array_push($err,"err=".mysqli_error($conn));
			}
		}
		else{
			$sql133="update online_norm set quest='$quest',mark=$mark,class_id='$clas' where id=$qid";
			if(!mysqli_query($conn,$sql133)){
				array_push($err,"err=".mysqli_error($conn));
			}
		}
		echo json_encode($err);
	}
	else if($pos=="qqq"){
		$gtid=$_POST["gtid"];
		$sql10="select * from online_test_rec where class_id='$clas' and status='publish' and id=$gtid";
		$fet7=mysqli_query($conn,$sql10);
		$res7=mysqli_fetch_assoc($fet7);
		date_default_timezone_set('Asia/Kolkata');
		if($res7["test_date"]==date("Y-m-d")){
			$timeee=time();
			if($res7["test_time"]<=date("H:i:s",$timeee)){
			   array_push($tbps,"0");
			}
			else{
				//echo "db=".$res7["test_time"].",org=".date("h:i:s",$timeee);
				array_push($tbps,"1");
			}
		}
		else{
			if($res7["test_date"]<date("Y-m-d")){
				array_push($tbps,"0");
			}
			else 
			  array_push($tbps,"1");
		}
		echo json_encode($tbps);
	}
	else if($pos=="ndat"){
		$otid=$_SESSION["otid"];
		$otin=$_POST["val"];
		$_SESSION["otin"]=$otin;
		$sql444="update online_test_rec set test_name='$otin' where id=$otid";
		if(!mysqli_query($conn,$sql444)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
	}
	else if($pos=="msd"){
		$val=$_POST["val"];
		$tid=$_SESSION["otid"];
		$sql555="update online_test_rec set test_mark=$val where id=$tid";
		if(!mysqli_query($conn,$sql555)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$_SESSION["stat"]='checked';
		echo json_encode($err);
	}
?>