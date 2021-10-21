<?php
   session_start();
   if(isset($_POST["inco"])){
	   $id=$_POST["inco"];
	   $_SESSION["subs"]=$id;
	   $_SESSION["sub_name"]=$_POST["name"];
	   $_POST["inco"]="";
	  
   }
   else{
?>
<!doctype html>
<html>
   <head>
       <title>Attendance Page</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <script>
      $.ajax({
		  url:"add_get_attendance.php",
		  data:{ty:"stud",ty2:"1st"},
		  type:"post",
		  success:function(msg){
			    var asfs=jQuery.parseJSON(msg);
				 $.ajax({
					  url:"add_get_attendance.php",
					  data:{ty:"stud",ty2:"2nd"},
					  type:"post",
					  success:function(msg){
						  alert("intoooo");
						  var rsss=jQuery.parseJSON(msg);
						  var tba="<thead><tr><th>Date</th><th>Presence</th></tr></thead><tbody>";
						  var ags="";
						  var tots=0;
						  for(x in rsss){
							  tots++;
							  alert(JSON.stringify(rsss[x]));
							  ags+="<tr><th>"+rsss[x].daty+"</th><td>"+asfs["a_"+rsss[x].id]+"</td></tr>";
						  }
						  tba+=ags+"</tbody>";
						  $("#show > span").html(asfs["tota_"+"<?php echo $_SESSION['subs']; ?>"]+"/"+tots);
						  $("#tab1").append(tba);
					  }		  
				   });
		  }
	  });
		  
      
   </script>
   <style>
        .table{
			width:50%;
		}
		#show{
			border:2px solid black;
			width:180px;
			position:absolute;
			top:100px;
			right:0px;
		}
   </style>
   <body>
      <h1 align="center"><?php echo $_SESSION["sub_name"]; ?> subjects's attendance</h1>
	   <div id="show">
	    total Attendance=<span></span>
	   </div>
	 <div> 
	       <form id="frm1">
		   <br><br>
	         <table id="tab1" class='table table-striped table-hover'>
	         </table><br>
	      
		  </form>	  
	 </div>
   </body>
</html>
<?php
   }
 ?>