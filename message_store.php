<?php 
   session_start();
   $sid="";
   $snm="";
   $cls=$_SESSION["id"];
   $stat=$_POST["ty"];
   include 'connector.php';
   $err=array();
   
   if($stat=="ins"){
	    if($_POST["who"]=="own"){
	    $sid="o-".$_SESSION["uid"];
        $snm=$_SESSION["u-name"]; 
		   }
		   else{
			   $sid=$_POST["who"]."-".$_SESSION["pid"];
			   $snm=$_SESSION["pnm"];
		   }
	    $time=$_POST["time"];
        $date=$_POST["date"];
		$msg=$_POST["msg"];
        $sql1="create table messages(id int not null auto_increment,class_id varchar(100),join_id varchar(100),join_name varchar(100),message varchar(10000),dati date,timi time,status varchar(50) default 'yes',primary key(id))";
		if(!mysqli_query($conn,$sql1)){
			array_push($err,mysqli_error($conn));
		}
		$thec=$_SESSION["chat"];
        $sql3="insert into messages(class_id,join_id,join_name,message,dati,timi,chat_id) values('$cls','$sid','$snm','$msg','$date','$time',$thec)";
		if(!mysqli_query($conn,$sql3)){
			array_push($err,mysqli_error($conn));
		}
		$sql6="select max(id) as id  from messages where class_id='$cls' and chat_id=$thec and join_id='$sid'";
		$res2=mysqli_query($conn,$sql6);
		$fet2=mysqli_fetch_assoc($res2);
		
		echo json_encode($fet2);
   }	
   if($stat=="load"){
	   $lstm=$_POST["lsm"];
    $thec=$_SESSION["chat"];
  	
    $sql2="select * from (select * from messages where class_id='".$cls."' and chat_id='$thec' and id > $lstm order by id desc limit 20) as abs order  by id ASC";
    //echo $sql2; 
	$res=mysqli_query($conn,$sql2);
	$tbr=array();
	while($fet=mysqli_fetch_assoc($res)){
		array_push($tbr,$fet);
	}
	echo json_encode($tbr);
   }
   if($stat=="edit"){
	   $msgu=$_POST["mssg"];
	   $id=$_POST["ide"];
	   $sql4="update messages set message='$msgu' where id='$id'";
	   if(!mysqli_query($conn,$sql4)){
		   array_push($err,"err is=".mysqli_error($conn));
	   }
	   echo json_encode($err);
   }
   if($stat=="selc"){
	   $tbps=array();
	   $who=$_SESSION["designate"];
	   if($who=="Creator"){
		   $who="c";
	   }
	   $sql5="select * from chatn where class_id='$cls' and designation like '%$who%'";
	   $res1=mysqli_query($conn,$sql5);
	   while($fet1=mysqli_fetch_assoc($res1)){
		   array_push($tbps,$fet1);
	   }
	   echo json_encode($tbps);
   }
   
?>