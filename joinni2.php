<?php 
  session_start();
?>
<!doctype html>
<html>
   <head>
       <title>Write us pwd</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	   <script src="https://smtpjs.com/v3/smtp.js"></script>
	   <script src="send_email.js"></script>
   </head>
   <script>
      $(document).ready(function(){
		  $("#frm1").submit(function(event){
			  event.preventDefault();
			  var pass=$(this).serialize();
			   
			   $.ajax({
				   url:"check_stud.php",
				   data:pass,
				   type:"post",
				   success:function(msg){
					   var ar=jQuery.parseJSON(msg);
					   //alert("rec="+ar);
					   if(ar[0]=="Existance"){
						   alert("No Such Id exists");
					   }
					   else{
						   var to=ar[0];
						   var body=ar[1];
						   $("#xeeez").append(to);
						   sendEmail(to,body);
						   $("#frm1").hide();
						   $("#frm2").show();
						  
					   }
					
				   }
			   });
			  
		  });
		  $("#frm2").submit(function(event){
			   event.preventDefault();
			   var da=$(this).serialize();
               $.ajax({
				   url:"signup-user-g.php",
				   data:da,
				   type:"post",
				   success:function(msg){
					   var ar=jQuery.parseJSON(msg);
					   if(ar[0]=="Right"){
						   alert("OTP is Right");
						    
							 $.ajax({
								 url:"pre-clas-join.php",
								 type:"post",
								 data:{},
								 success:function(msg){
									 var noi=jQuery.parseJSON(msg);
									 alert("HEeelo"+noi);
									 window.open("ClassmPageJoiner.php","_self");
								 }
								 
							 });
					   }
					   else{
						   alert("OTP is Wrong");
						   
					   }
				   }
				   
			   });			   
		  });
	  });
   </script>
   <style>
      label,input{
		  font-size:20px;
	  }
	  form{
		  position:relative;
		 
		  border:3px solid black;
		  display:inline-block;
		  padding:50px;
	  }
	  #frm2{
		  display:none;
	  }
   </style>
   <body>
     <h1 align="center" class='text-info'>Enter Joiner's Information to Enter the class</h1>
	 <br><br><br>
    <div class='d-flex justify-content-center'> <form id="frm1" class="was-validated">
      
	     <h3>Joiner's -ID</h3>
	     <input type="text" class='form-control' name="stud_id" id="stud_id" required><br>
		  
		 <h3>Joiner's Designation</h3>
		 <label for="desi1" >Teacher</label><input type="radio" id="desi1" name="desi" value="Teacher" required>
         <label for="desi2" >Student</label><input type="radio" name="desi" id="desi2" value="Student">		 
		 <br>
		 <input type="submit" class='btn btn-primary' value="submit">
	  </form>
	 </div> 
	 <div class='d-flex justify-content-center'> <form id="frm2" class="was-validated">
	      <h3 id="xeeez">Enter OTP recieved on your mail id::</h3><br>
		  <input type="number" name="otp" value="" required>
		  <input type="submit" class='btn btn-primary' value="submit">
	  </form>
	 </div> 
	  <div id="d45">
	  </div>
   </body>
</html>