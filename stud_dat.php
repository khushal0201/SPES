<?php
// Start the session comming from add.php
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
	   $sql5="select stud_id as std from class$classid where stud_id=".$_POST[$id];
	   $res=mysqli_query($conn,$sql5);
	   $fet5=mysqli_fetch_assoc($res);
	   if(isset($fet2["std"])){
		   array_push($err,"$i statement student id is already there in Table ");
		   $i++;
		   continue;
	   }
       $sql8="select email from class$classid where email='".$_POST[$email]."'";
	   $res=mysqli_query($conn,$sql8);
	   $fet5=mysqli_fetch_assoc($res);
	   if(isset($fet5["email"])){
		   array_push($err,"$i statement Email is Already Registered as Student");
		   $i++;
		   continue;
	   }

	   $sql8="select temail from teachers where class_id='".$classid."' and temail='".$_POST[$email]."'";
	   $res=mysqli_query($conn,$sql8);
	   $fet5=mysqli_fetch_assoc($res);
	   if(isset($fet5["temail"])){
		   array_push($err,"$i statement Email is Already Registered for teachers");
		   $i++;
		   continue;
	   }

	  $sql2="insert into class".$classid."(stud_id,name,email) values('".$_POST[$id]."','".$_POST[$name]."','".$_POST[$email]."')";
	  if(!mysqli_query($conn,$sql2)){
		 array_push($err,"$i statement cant be executed beacuse=".mysqli_error($conn)); 
	  }
	  $i++;
   }
   
    echo json_encode($err);
?>