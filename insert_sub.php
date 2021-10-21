<?php
  session_start();
?>
<?php
     $err=array();
     $var1=$_SESSION["id"];
	 include 'connector.php';
	 $ch=count($_POST)/3;
	 $sql1="create table subjects(class_id varchar(100) NOT NULL,sub_id varchar(100) NOT NULL,sub_name varchar(100),primary key(sub_id),foreign key(class_id) references classes(id))";
	 if(!mysqli_query($conn,$sql1)){
		 array_push($err,"id=".$var1.",".mysqli_error($conn));
	 }
	 $i=1;
	 for($i;$i<=$ch;$i++){
		 $ind=$_POST["indee".$i];
		 $id="id".$ind;
		 $name="name".$ind;
	    $sql2="insert into subjects values('$var1','".$_POST[$id]."','".$_POST[$name]."');";
		if(!mysqli_query($conn,$sql2)){
		 array_push($err,"Statement $i has errr=".mysqli_error($conn));
	   }
	 }
	 echo json_encode($err);
 ?>