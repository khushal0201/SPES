<?php
   session_start();
?>
<!doctype html>
<html>
   <head>
       <title>create</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
   </head>
   <script>
      $(document).ready(function(){
		  $("#frm1").submit(function(event){
			  event.preventDefault();
			  var val=$(this).serialize();
			  $.ajax({
				  url:"dbadd1.php",
				  type:"post",
				  data:val,
				  success:function(msg){
					  
					  var rec=jQuery.parseJSON(msg);
					  if(rec[0]=="Exists"){
						  //alert("here")
						  $(".modal-title").html("<h3 class='text-danger'>Error!!</h3>");
						  $(".modal-body").html("<h3>Class ID Already Exists<br> Try Another id</h3>")
						  $("#myModal1").modal("toggle");
					  }
                      else{
						  //alert("here1");
					  window.open("ClassmPageCreator.php","_self");}
				  }
				  
			  });
		  });
		  $(document).on("input","#class_id",function(){
			  if($("#class_id")[0].checkValidity()==false&&($("#class_id").eq(0).val()!="")){
				  $(this).closest(".form-group").children(".invalid-feedback").html("Class Id cannot have Spaces or hyphen or Must be Atleast 3 char Long ");
			  }
			  else{
				  $(this).closest(".form-group").children(".invalid-feedback").html("Required Field");
			  }
		  });
	  });
   </script>
   <style>
       #d566{
		   position:relative;
		    margin-left:auto;
			margin-right:auto;
			
			
		    }
		#d455{
			width:500px;
			position:relative;
			
			border:2px solid rgb(223,223,223);
			padding-top:20px;
			padding-bottom:20px;
		}	
   </style>
   <body>
       <?php include 'tth.php' ?>;
       <div class="container" id="d455">
       <h1 class="text-info" align="center">Create Class</h1>
	   <div class="container " id="d566">
	   <form id="frm1" class="was-validated">
	       <div class="form-group">
			   <label for="class_id">Enter new class ID:</label>
			   <input class="form-control" type="text" pattern="[^-\s]{3,}" class="form-control" name="class_id" id="class_id" required></input>
			   <div class="valid-feedback">Valid data</div>
			   <div class="invalid-feedback">Invalid Data</div>
		   </div>	   
		   <div class="form-group">
			   <label for="class_name">Enter Name of the New class:</label>
			   <input class="form-control" type="text" name="class_name" id="class_name" required>
			   <div class="valid-feedback">Valid Data</div>
			   <div class="invalid-feedback">Invalid</div>
			</div>   
			<div class="form-group">
			   <label for="class_name">Enter Institute Name:</label>
			   <input class="form-control" type="text" name="insti" id="class_name" required>
			   <div class="valid-feedback">Valid Data</div>
			   <div class="invalid-feedback">Invalid</div>
			</div>   
			<div class="form-group">
			   <label for="class_name">Enter Class Session:</label>
			   <input class="form-control" type="text" name="sess" id="class_name" required>
			   <div class="valid-feedback">Valid Data</div>
			   <div class="invalid-feedback">Invalid</div>
			</div>   
			   <input class="btn btn-primary btn-block" type="submit" align="center" value="Submit">
	   </form>
	   </div> 
	   </div>
	   <span style="position:relative;right:0px;top:10%;border:3px solid black;width:60px">
	      uid=<?php echo $_SESSION["uid"]; ?>;
       </span>
	   
	   <div class="modal fade" id="myModal1">
		  <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

			  <!-- Modal Header -->
			  <div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>

			  <!-- Modal body -->
			  <div class="modal-body">
				
			  </div>

			  <!-- Modal footer -->
			 
			</div>
		  </div>
		</div>
	   
	   
	   
   </body>
</html>