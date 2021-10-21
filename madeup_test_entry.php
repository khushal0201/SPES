<?php
    session_start();
   // $new=$_POST;
	//print_r($_POST);
	$err=array();
	include 'connector.php';
	$cls=$_SESSION["id"];
	$ty=$_POST["ty"];
	$tbps=array();
	if($ty=="new"){
		$mtnm=$_POST["name"];
		$mrk=$_POST["mrk"];
		$sql1="insert into madeup_test(class_id,test_name,total) values('$cls','$mtnm',$mrk)";
		$_SESSION["status"]="draft";
		if(!mysqli_query($conn,$sql1)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$sql2="select max(id) as id from madeup_test where class_id='$cls'";
		$fet1=mysqli_query($conn,$sql2);
		$res1=mysqli_fetch_assoc($fet1);
		$testid=$res1["id"];
		$_SESSION["test_id"]=$testid;
		$sql3="select * from tests where class_id='$cls' and status='published'";
		$fet2=mysqli_query($conn,$sql3);
		while($res2=mysqli_fetch_assoc($fet2)){
			$tes=$res2["id"];
			$sql4="insert into ma_test_t(class_id,o_test,test_id) values('$cls',$tes,$testid)";
			if(!mysqli_query($conn,$sql4)){
				array_push($err,"err=".mysqli_error($conn));
			}
		}
		$sql4="select * from ma_test_t where test_id=$testid and class_id='$cls'";
		$fet3=mysqli_query($conn,$sql4);
		while($res3=mysqli_fetch_assoc($fet3)){
			$ftid=$res3["id"];
			array_push($tbps,$res3);
			
		}
		//echo "err=".mysqli_error($conn);
		
			echo json_encode($tbps);
	}
	else if($ty=="upc"){
		$cid=$_POST["ntid"];
		$val=$_POST["val"];
		$otid=$_POST["otid"];
		
		$sql6="update ma_test_t set weightage=$val where id=$cid";
		if(!mysqli_query($conn,$sql6)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
		
	}
	else if($ty=="upd"){
		$dty=$_POST["dty"];
		$val=$_POST["val"];
		$tid=$_SESSION["test_id"];
		$sql8="";
		if($dty=="name"){
            $sql8="update madeup_test set test_name='$val' where id=$tid";			
		}
		else{
			 $sql8="update madeup_test set total=$val where id=$tid";			
		}
		if(!mysqli_query($conn,$sql8)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
	}
	else if($ty=="form"){
		$val=$_POST["fla"];
		$tid=$_SESSION["test_id"];
		$sql9="update madeup_test set ends=$val where id=$tid";
		if(!mysqli_query($conn,$sql9)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
	}
	else if($ty=="make"){
		$tid=$_SESSION["test_id"];
		$sql10="select total,ends from madeup_test where id=$tid";
		$fet7=mysqli_query($conn,$sql10);
		$res6=mysqli_fetch_assoc($fet7);
		$fmrk=$res6["total"];
		$flam=$res6["ends"];
		$sql11="select * from subjects where class_id='$cls'";
		$fet8=mysqli_query($conn,$sql11);
		while($res7=mysqli_fetch_assoc($fet8)){
			$subid=$res7["sub_id"];
			$sql12="select * from ma_test_t where class_id='$cls' and test_id=$tid";
			$fet9=mysqli_query($conn,$sql12);
			$altup=array();
			while($res8=mysqli_fetch_assoc($fet9)){
				$otst=$res8["o_test"];
				$wei=$res8["weightage"];
				$rat=($wei/100)*$fmrk;///frm1
				$sql12="select * from tests where id=$otst";
				$fet10=mysqli_query($conn,$sql12);
				$res11=mysqli_fetch_assoc($fet10);
				$nmrk=$res11["total_mark"];
				$rat2=$rat/$nmrk;///frm2
				$sql13="select * from no_test_s where test_id=$otst and sub_id='$subid'";
				$fet11=mysqli_query($conn,$sql13);
				$res12=mysqli_fetch_assoc($fet11);
				$colis="t_".$res12["id"];
				array_push($altup,"(".$colis."* $rat2)");
				//$sql888="insert into ma_test_bt(sub_id,test_id,class_id,o_test) values()";
				//$sql333="alter table class$cls add default 0";
				//$sql444="update class$cls set=(".$colis."* $rat2)";
			}
			if($_SESSION["status"]!="submitted"){
				$sql14="insert into ma_test_s(class_id,m_test_id,sub_id) values('$cls',$tid,'$subid')";
				if(!mysqli_query($conn,$sql14)){
					array_push($err,"err=".mysqli_error($conn));
				}
			}	
			$sql15="select * from ma_test_s where class_id='$cls' and sub_id='$subid' and m_test_id=$tid";
			$fet12=mysqli_query($conn,$sql15);
			$res13=mysqli_fetch_assoc($fet12);
			$ncol="mt_".$res13["id"];
			$tbbc=implode("+",$altup);
			
			$sql16="alter table class$cls add $ncol float(18)";
			if(!mysqli_query($conn,$sql16)){
				array_push($err,"err=".mysqli_error($conn));
			}
			$sql17="update class$cls set $ncol=($tbbc)";
			if(!mysqli_query($conn,$sql17)){
				array_push($err,"err=".mysqli_query($conn));
			}
		}
		$sql109="update madeup_test set status='submitted' where id=$tid";
		if(!mysqli_query($conn,$sql109)){
			array_push($err,"err=".mysqli_query($conn));
		}
		$_SESSION["status"]=="submitted";
		echo json_encode($err);
	}
	else if($ty=="sumb"){
		$tid=$_SESSION["test_id"];
		$sql18="update madeup_test set status='published' where id=$tid";
		if(!mysqli_query($conn,$sql18)){
			array_push($err,"err=",mysqli_error($conn));
		}
		echo json_encode($err);
	}
	else if($ty=="olo"){
		$tid=$_SESSION["test_id"];
		$sql19="select * from madeup_test where id=$tid";
		$fet13=mysqli_query($conn,$sql19);
		$res14=mysqli_fetch_assoc($fet13);
		array_push($tbps,$res14);
		$sql20="select * from ma_test_t where test_id=$tid";
		$fet14=mysqli_query($conn,$sql20);
		while($res15=mysqli_fetch_assoc($fet14)){
			array_push($tbps,$res15);
		}
	    echo json_encode($tbps);
	}
	
	/*$sql6="select ends,mark from madeup_test where id=".$_SESSION["test_id"];
		$fet4=mysqli_query($conn,$sql6);
		$res4=mysqli_fetch_assoc($fet4);
		$form=$res4["form"];
		$tmrk=$res4["mark"];
		$freme=($tmrk*$val)/100;
		$sql7="select mark from tests where id=".$otid;
		$fet5=mysqli_query($conn,$sql7);
		$res5=mysqli_fetch_assoc($fet5);
		$imrk=$res5["mark"];
		$sql8="update class$cls set $cid=$cid/"
	
	
	
	
	
	
	
	
    $err=array("hello=");	
    $arr1=array_pop($new);
	$arrs=array_shift($new);
	$list=implode(',',$new);
	$ses=$_SESSION["id"];
	$id=$_SESSION["id"];
	
	//print_r($new);
	//echo $list;
	$sql1="create table madeup_test(id int not null auto_increment,test_name varchar(200),adds varchar(200),ends varchar(100),total int,primary key(id));";
	 if(!mysqli_query($conn,$sql1)){
		  array_push($err,"errr1=".mysqli_error($conn));
	  }
	$sql10="select total_mark from tests where class_id='$ses'";
    $res5=mysqli_query($conn,$sql10);
	$pus=0;
	while($fet5=mysqli_fetch_assoc($res5)){
		$pus+=$fet5["total_mark"];
	}
    $sql2="insert into madeup_test(test_name,adds,ends,total,class_id) values('$arrs','$list','$arr1',$pus,'$id')";
	 if(!mysqli_query($conn,$sql2)){
		  array_push($err,"errr2=".mysqli_error($conn));
	  }
	$sql3="select max(id) as ons from madeup_test";
	$res=mysqli_query($conn,$sql3);
	$fet=mysqli_fetch_assoc($res);
	//print_r($res);
	$sql4="select sub_name,sub_id from subjects where class_id='$ses'";
	$res2=mysqli_query($conn,$sql4);
	
	$col_new=array();
	$anoths1=array();
	$anoths2=array();
	while($fet2=mysqli_fetch_assoc($res2)){
	   $newws="mtest_s".$fet2["sub_id"]."_t".$fet["ons"]." float(100,2)";
	   array_push($col_new,"add ".$newws);
	   array_push($anoths1,$fet2["sub_name"]);
	   array_push($anoths2,$fet2["sub_id"]);
	}
	$sender=implode(",",$col_new);
	
	$sql5="alter table class$ses ".$sender;
	
	 if(!mysqli_query($conn,$sql5)){
		  array_push($err,"errr3=".mysqli_error($conn));
	  }
	
	$i=0;
	
	for($i;$i<count($anoths1);$i++){
		$whatupd="mtest_s".$anoths2[$i]."_t".$fet["ons"]."=(";
		for($j=1;$j<=count($new);$j++){
			$key="sel".$j;
			$oops=$new[$key];
			$sqll="select test_name from tests where id=$oops";
			$ress=mysqli_query($conn,$sqll);
			$fett=mysqli_fetch_assoc($ress);
			$whatupd.="test_".$anoths1[$i]."_".$fett["test_name"];
			if($j!=count($new))
				$whatupd.="+";
		}
		$whatupd.=")".$_POST["form"];
		$newv=$whatupd;
		array_push($err,"form=".$newv);
	  $sql7="update class$ses set ".$whatupd;
	  if(!mysqli_query($conn,$sql7)){
		  array_push($err,"errr4=".mysqli_error($conn));
	  }
	}
	echo json_encode($err);*/
 ?>