<?php 
        $DBC="hometime";
        $conn1=mysqli_connect("localhost","root","",null,"3308");
        if(!$conn1){
             die("Could not connect to database".mysqli_connect_error());
        }
        $dbsq="CREATE DATABASE IF NOT EXISTS `$DBC`";
        if(!mysqli_query($conn1,$dbsq)){
             die("Error is".mysqli_error($conn1));
        }
 
        $conn=mysqli_connect("localhost","root","",$DBC,"3308");


         if (!$conn) {
              echo "cant connect to data base";
              }
        $chk="show tables like 'classes'";
        $get=mysqli_query($conn,$chk);
        $fifet=mysqli_fetch_assoc($get);
     //    print_r($fifet);
        if(is_null($fifet)){
          include 'dbconfig.php';
        }
        
?>