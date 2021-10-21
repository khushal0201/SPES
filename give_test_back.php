<?php
    session_start();
	include 'connector.php';
	$ty=$_POST["ty"];
	$clas=$_SESSION["id"];
	$err=array();
	$tbps=array();
	if($ty=="load"){
		$tid=$_SESSION["gtid"];
		$sql1="select id,quest,op1,op2,op3,op4,mark from online_mcq where test_id=$tid and class_id='$clas'";
		$res1=mysqli_query($conn,$sql1);
		while($fet1=mysqli_fetch_assoc($res1)){
			$fet1["typ"]="mcq";
			array_push($tbps,$fet1);
		}
		array_push($err,"err=".mysqli_error($conn));
		$sql2="select id,quest,mark from online_norm where test_id=$tid and class_id='$clas'";
		$res2=mysqli_query($conn,$sql2);
		while($fet2=mysqli_fetch_assoc($res2)){
			$fet2["typ"]="norm";
			array_push($tbps,$fet2);
		}
		array_push($err,"err=".mysqli_error($conn));
		$stu=$_SESSION["pid"];
		$sql3="create table online_resp(id int not null auto_increment,test_id int,stud_id varchar(100),class_id varchar(100),status varchar(100) default 'not',primary key(id))";
		if(!mysqli_query($conn,$sql3)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$sql11="select id from online_resp where stud_id='$stu' and class_id='$clas'";
		$sql6="insert into online_resp(test_id,stud_id,class_id) values ($tid,'$stu','$clas')";
		if(!mysqli_query($conn,$sql6)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$sql7="select max(id) as ids from online_resp where stud_id='$stu' and class_id='$clas'";
		$res3=mysqli_query($conn,$sql7);
		$fet3=mysqli_fetch_assoc($res3);
		$_SESSION["rid"]=$fet3["ids"];
		array_push($err,"err=".mysqli_error($conn));
		//echo "sql1=".$sql1.",sql2=".$sql2;
		//print_r($tbps);
		echo json_encode($tbps);
	}
	else if($ty=="ins"){
		$rid=$_SESSION["rid"];
		$qid=$_POST["qid"];
		$typ=$_POST["typ"];
		$ans=$_POST["ans"];
		
		
		$sql4="create table online_ans_resp(id int not null auto_increment,rid int,qid int,qty varchar(50),ans varchar(6000),mark int default 0,primary key(id))";
		if(!mysqli_query($conn,$sql4)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$tid=$_SESSION["gtid"];
		$mrk="";
		$tmrk="";
		if($typ=="mcq"){
			$sql13="select ans,mark from online_mcq where id=$qid and test_id=$tid";
			$res6=mysqli_query($conn,$sql13);
			$fet6=mysqli_fetch_assoc($res6);
			$tmrk=",mark";
			if($fet6["ans"]==$ans){	
				$mrk=",".$fet6["mark"];
			}
			else
				$mrk=",0";
		}
		$sql5="insert into online_ans_resp(rid,qid,qty,ans$tmrk) values($rid,$qid,'$typ','$ans'$mrk)";
		if(!mysqli_query($conn,$sql5)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$sql8="select max(id) as df from online_ans_resp where rid=$rid";
		//echo $sql5;
		$res4=mysqli_query($conn,$sql8);
		$fet4=mysqli_fetch_assoc($res4);
		//print_r($err);
		array_push($err,"err=".mysqli_error($conn));
		array_push($tbps,$fet4);
		echo json_encode($tbps);
	}
	else if($ty=="upd"){
		$ttid=$_POST["ttid"];
		$ans=$_POST["ans"];
		$typ=$_POST["typ"];
		$qid=$_POST["qid"];
		$tid=$_SESSION["gtid"];
		$mrk="";
		$tmrk="";
		if($typ=="mcq"){
			$sql13="select ans,mark from online_mcq where id=$qid and test_id=$tid";
			$res6=mysqli_query($conn,$sql13);
			$fet6=mysqli_fetch_assoc($res6);
			$tmrk=",mark=";
			if($fet6["ans"]==$ans){	
				$mrk=$fet6["mark"];
			}
			else
				$mrk="0";
		}
		$sql9="update online_ans_resp set ans='$ans',mark=$mrk where id=$ttid";
		if(!mysqli_query($conn,$sql9)){
			array_push($err,"err=".mysqli_error($conn));
		}
		$jh=array();
		$jh["df"]=$ttid;
		array_push($tbps,$jh);
		echo json_encode($tbps);
	}
	else if($ty=="sub"){
	    $rid=$_SESSION["rid"];
		$sql10="update online_resp set status='submit' where id=$rid";
		if(!mysqli_query($conn,$sql10)){
			array_push($err,"err=".mysqli_error($conn));
		}
		else{
			array_push($err,"Successfullly submitted");
		}
		echo json_encode($err);
	}
	else if($ty=="resp"){
		$tid=$_SESSION["gtid"];
		//echo "Tid=".$tid;
		$sql12="select * from online_resp where class_id='$clas' and test_id=$tid and (status='submit' or status='checked' or status='terminated')";
		//echo "sq=".$sql12."<br>";
		$res5=mysqli_query($conn,$sql12);
		while($fet5=mysqli_fetch_assoc($res5)){
			array_push($tbps,$fet5);
		}
		echo json_encode($tbps);
	}
	else if($ty=="stf"){
		$rid=$_SESSION["rid"];
		$sql14="select * from online_ans_resp where rid=$rid";
		$res7=mysqli_query($conn,$sql14);
		while($fet7=mysqli_fetch_assoc($res7)){
			$sql67="select mark from online_".$fet7["qty"]." where id=".$fet7["qid"];
			$res10=mysqli_query($conn,$sql67);
			$fet10=mysqli_fetch_assoc($res10);
			$fet7["lmrk"]=$fet10["mark"];
			array_push($tbps,$fet7);
		}
		array_push($err,"err=".mysqli_error($conn));
		echo json_encode($tbps);
	}
	else if($ty=="ima"){
		$mark=$_POST["mark"];
		$vid=$_POST["vid"];
		$rid=$_SESSION["rid"];
		if($mark==''){
			$mark=0;
		}
		$sql444="select mark from online_ans_resp where id=$vid";
		$res40=mysqli_query($conn,$sql444);
		$fet90=mysqli_fetch_assoc($res40);
		$omrk=$fet90["mark"];
		$sql444="update online_resp set mark=(mark-$omrk)+$mark where id=$rid";
        if(!mysqli_query($conn,$sql444)){
			array_push($err,"err=".mysqli_error($conn));
		}		
		
		$sql15="update online_ans_resp set mark=$mark where id=$vid";
		if(!mysqli_query($conn,$sql15)){
			array_push($err,"errr is=".mysqli_error($conn));
		}
		else{
			array_push($err,"working....");
		}
		echo json_encode($err);
	}
	else if($ty=="chk"){
		$rid=$_SESSION["rid"];
		$sql16="update online_resp set status='checked' where id=$rid";
		if(!mysqli_query($conn,$sql16)){
			array_push($err,"err=".mysqli_error($conn));
		}
		else{
			array_push($err,"done chk");
		}
		echo json_encode($err);
	}
	else if($ty=="term"){
		$rid=$_SESSION["rid"];
		$sql17="update online_resp set status='terminated' where id=$rid";
		if(!mysqli_query($conn,$sql17)){
			array_push($err,"err=".mysqli_error($conn));
		}
	    else{
			array_push($err,"You were Terminated From the test");
		}
		echo json_encode($err);
	}
	else if($ty=="stusee"){
		$std=$_SESSION["pid"];
		$gtid=$_SESSION["gtid"];
		$sql18="select max(id) as id from online_resp where test_id=$gtid and stud_id='$std'";
		$fet8=mysqli_query($conn,$sql18);
		$res8=mysqli_fetch_assoc($fet8);
		$rid=$res8["id"];
		$sql19="select * from online_ans_resp where rid=$rid";
		$fet9=mysqli_query($conn,$sql19);
		while($res9=mysqli_fetch_assoc($fet9)){
			array_push($tbps,$res9);
		}
		echo json_encode($tbps);
		
	}
	else if($ty=="mrkch"){
		$tst=$_SESSION["gtid"];
		$sql20="update online_test_rec set status='checked' where id=$tst";
		if(!mysqli_query($conn,$sql20)){
			array_push($err,"err=".mysqli_error($conn));
		}
		echo json_encode($err);
	}
	else if($ty=="r12"){
		$_SESSION["chh"]=$_POST["chh"];
		echo json_encode($_SESSION["chh"]);
	}
?>