<?php 
   session_start();
   $id=$_SESSION["id"];
   
   
    $err=array();
	$tbps=array();
	$ty=$_POST["ty"];
    include 'connector.php';
	
	if($ty=="ins"){
		$test=$_POST["oi"]["name1"];
        $tot=$_POST["oi"]["mark"];
		$sql1="insert into tests(class_id,test_name,total_mark) values('".$id."','".$test."',$tot)";
		if(!mysqli_query($conn,$sql1)){
			array_push($err,"ins errr=".mysqli_error($conn));
		}
		
		$sql4="select max(id) as id from tests where class_id='".$id."'";
		$fet1=mysqli_query($conn,$sql4);
		$res1=mysqli_fetch_assoc($fet1);
		$test_id=$res1["id"];
		$_SESSION["test_id"]=$test_id;
		$_SESSION["tty"]="nt";
		array_push($tbps,$test_id);
		
		$sql5="select * from subjects where class_id='".$id."'";
		$fet2=mysqli_query($conn,$sql5);
		while($res2=mysqli_fetch_assoc($fet2)){
			$sql6="insert into no_test_s(class_id,test_id,sub_id) values('$id',$test_id,'".$res2["sub_id"]."')";
			if(!mysqli_query($conn,$sql6)){
				array_push($err,"err=".mysqli_error($conn));
			}
		}
		// print_r($err);
		echo json_encode($tbps);
	}
	else if($ty=="edit"){
		$ind=$_POST["is"];
		$dat=$_POSt["dat"];
		$sql7="update test set ".$ind."='".$dat."'";
		if(!mysqli_query($conn,$sql7)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
	}
	else if($ty=="ann"){
		$tty=$_SESSION["tty"];
		$tid=$_SESSION["test_id"];
		$value=$_POST["val"];
		$pid=$_SESSION["pid"];
		$sql8="insert into announcements(class_id,pid,data-type,data-val,value) values('$id','$pid','$tty','$tid','$value')";
		if(!mysqli_query($conn,$sql8)){
			array_push($err,"err="+mysqli_error($conn));
		}
		echo json_encode($conn);
	}
	/*array_push($err,"class$id");
	$sql2="Alter Table class$id add test_start varchar(0), add test_end varchar(0)";
	if(!mysqli_query($conn,$sql2)){
		array_push($err,"ins errr=".mysqli_error($conn));
	}
	$sql3="select sub_name from subjects where class_id='$id'";
   
   $result=mysqli_query($conn,$sql3);
   if(!$result){
	   echo "ms error".mysqli_error($conn);
   }
   $sql3="alter table class$id";
   $i=1;
   $max=mysqli_num_rows($result);
   while($subs=mysqli_fetch_assoc($result)){
	   $wert=$subs["sub_name"];
	    $sql3.=" add test_"."$wert"."_$test float(100,2) not null after test_start";
		if($max==$i){
			$sql3.=";";
		}
		else{
			$sql3.=",";
		}
		$i++;
		
   }
	
	if(!mysqli_query($conn,$sql3)){
		array_push($err,"alter error=".mysqli_error($conn));
	}
	if(count($err)){
		echo json_encode($err); 
	}
	#$sql2="update classes set tests=".$result.",".$_POST["name"]." where id='$id'";
	*/
?>