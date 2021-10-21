<?php 
  session_start();
  if(isset($_POST["ty"])){
	  if($_POST["ty"]=="teach"){
		  $_SESSION["v_ty"]="teach";
	  }
	  else{
		  $_SESSION["v_ty"]="stud";
	  }
  }
  else{
?>

<!doctype html>
<html>
       <head>
	       <title>View Joiners</title>
		    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	   </head>
	   <script>
	       $(document).ready(function(){
			   $('[data-toggle="tooltip"]').tooltip();
			   if("<?php echo $_SESSION['v_ty'];?>"=="teach"){
			   $.ajax({
				   url:"select_students.php",
				   data:{ty:"teach"},
				   type:"post",
				   success:function(msg){
					   var pss=jQuery.parseJSON(msg);
					   //alert(JSON.stringify(pss));
					   var tdd="";
					   $.ajax({
							url:"select_sub.php",
                            data:{},
                            type:"post",
							success:function(msg){
								tdd=jQuery.parseJSON(msg);
								alert(tdd);
							   $("#t1").append("<thead><tr><th>Teacher id</th><th>Teacher name</th><th>Subjects</th><th>Teacher Email</th><th></th></tr></thead><tbody></tbody>")
							   
							   for(x in pss){
								  var subn="";
								  for(y in tdd){
									  alert("ot="+pss[x].sub_id+",at"+tdd[y].sub_id);
									  if(pss[x].sub_id==tdd[y].sub_id){
										  subn=tdd[y].sub_name;
										  break;
									  }
								  }
								  $("#t1>tbody").append("<tr><td>"+pss[x].tid+"</td><td>"+pss[x].tnm+"</td><td>"+subn+"</td><td>"+pss[x].temail+"</td><td><a href='#' data-toggle='tooltip' data-placement='bottom' title='Edit'><span  class='cce far fa-edit' style='font-size:24px'></span></a></td></tr>"); 
					             }
							}
                               							
						});
				   }
			   });}
			   else{
				   $.ajax({
				   url:"select_students.php",
				   data:{},
				   type:"post",
				   success:function(msg){
					   var pss=jQuery.parseJSON(msg);
					   
					   $("#t1").append("<thead><tr><th>Student id</th><th>Student Name</th><th>Students Email</th><th></th></tr></thead><tbody></tbody>")
					   
					   for(x in pss){
						 
						  $("#t1>tbody").append("<tr><td>"+pss[x].stud_id+"</td><td>"+pss[x].name+"</td><td>"+pss[x].email+"</td><td><a href='#' data-toggle='tooltip' data-placement='bottom' title='Edit'><span  class='cce far fa-edit' style='font-size:24px'></span></a></td></tr>"); 
					   }
				   }
			   });
			   }
			   $(document).on("click",".cce",function(){
				   $("#mod1").modal("toggle");
			   });
		   });
	   </script>
	   <style>
	      
		  #d1{
			  position:relative;
			  margin-top:100px;
			  margin-left:auto;
			  margin-right:auto;
		  }
		  #t1{
			  width:80%;
		  }
		  
	   </style>
	   <body>
	        <h1 align="center" >View <?php if($_SESSION["v_ty"]=="teach"){echo "Teachers'";}else{echo "Students'";} ?> Details</h1> 
            <div id="d1" class='d-flex justify-content-center'>
			     <table id="t1" class="table table-striped table-hover">
				 </table>
            </div>

           <div class='modal fade' id="mod1">
		  <div class='modal-dialog modal-dialog-centered'>
		     <div class='modal-content'>
                   <div class="modal-header">
					<h4 class="modal-title">Info</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					Here editss
				  </div>
			 
			 
			 </div>
		  </div>
		</div>			
	   </body>
   
</html> 
<?php
  }
?>