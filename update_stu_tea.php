<?php
       session_start();
       include 'connector.php';
       $name=$_POST["name"];
       $email=$_POST["mail"];
    //    print_r($_POST);
       $id=$_POST["id"];
       $wh=$_SESSION["v_ty"];
       $sql="";
       if($wh=="teach"){
              $sql="update teachers set tnm='$name',temail='$email' where tid='$id' and class_id='".$_SESSION["id"]."'";
       }
       else{
           $sql="update class".$_SESSION["id"]." set email='$email',name='$name'  where stud_id='$id'";
       }
       $arr=array();
       if(!mysqli_query($conn,$sql)){
               array_push($arr,0,mysqli_error($conn));
       }
       else{

           array_push($arr,1,"Saved Success fully".mysqli_error($conn).$sql);
       }
       echo json_encode($arr)
?>