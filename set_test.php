<?php
   session_start();
   $_SESSION["test_id"]=$_POST["id"];
   $_SESSION["test_n"]=$_POST["name"];
   $_SESSION["test_ty"]=$_POST["ty"];
 ?>