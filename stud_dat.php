<?php
// Start the session
session_start();
?>
<?php
   $err=array("0");
   $ch=count($_POST)/4;
   $classid=$_SESSION["id"];
  
     include 'connector.php';
   
    $sql1="create table class".$classid."(stud_id varchar(50),name varchar(50),email varchar(100),last_msg int)";
	if(!mysqli_query($conn,$sql1)){
		array_push($err,"id=".$classid.",".mysqli_error($conn));
	}
	$i=1;
   while($i<=$ch){
	   $tt="indee".$i;
	   $cvv=$_POST[$tt];
	   $id="id".$cvv;
	   $name="name".$cvv;
	   $email="email".$cvv;   
	  $sql2="insert into class".$classid."(stud_id,name,email) values('".$_POST[$id]."','".$_POST[$name]."','".$_POST[$email]."')";
	  if(!mysqli_query($conn,$sql2)){
		 array_push($err,"$i statement cant be executed beacuse=".mysqli_error($conn)); 
	  }
	  $i++;
   }
   
    echo json_encode($err);
?>