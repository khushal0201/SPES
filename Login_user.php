<!doctype html>
<html>
   <head>
       <title>Login User</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   </head>
   <script>
      
       $(document).ready(function(){
		    var  f=0;
		   $(document).on("input","#in4",function(){
				if($(this)[0].checkValidity()==false){
					//alert("ok");
				 $(this).closest(".form-group").children(".valid-feedback").hide();
				 $(this).closest(".form-group").children(".invalid-feedback").html("Email is Invalid");
				 $(this).closest(".form-group").children(".invalid-feedback").css("display","block")
				 }
				else{
					$(this).closest(".form-group").children(".valid-feedback").show();
					$(this).closest(".form-group").children(".invalid-feedback").html("Invalid input").hide();
				}
			});	
			
		   $("#frm4").submit(function(event){
			   event.preventDefault();
			   var da=$(this).serialize();
			   $.ajax({
				   url:"login_user-h.php",
				   data:da,
				   type:"post",
			       success:function(msg){
					   var op=jQuery.parseJSON(msg);
					   if(op[0]=="Email"){
						   
						   alert("Email id does'nt exist");
						   if(f==0)
						   $("#d122").append("<input type='button' value='Sign up instead'>");
					       f=1;
						   
					   }
					   else if(op[0]=="Password"){
						   alert("Password doesnt match");
						    if(f==0)
						     $("#d122").append("<input type='button' value='Sign up instead'>");
					         f=1;
						   
					   }
					   else if(op[0]=="Email-g"){
						   alert("Password doesnt match");
						    if(f==0)
						     $("div").append("Try Logging with Google Account:<input type='button' value='G-Sign in'>");
					         f=1;
						   
					   }
					   else{
						   alert("Logged in successfully");
						   <?php $_SESSION["trav"]="2"; ?>
						   window.open("exx.php","_self");
						   
					   }
					   
				   }
			   });
		   });
	   });
   </script>
   <style>
      #d22{
		  position:relative;
		  margin-left:auto;
		  margin-right:auto;
	      margin-top:200px;
		  border:3px solid black;
		  width:500px;
	  }
   </style>
   <body>
      <h2 align="center">Log In Your Account</h2>
	  <div id="d22" class="container">
	      <form id="frm4" class="was-validated">
		    <div class="form-group">
		     <label for="email">Enter Your Email id:</label>
			 <input id="in4" type="email" class="form-control" name="email" id="email"><br>
			 <div class="valid-feedback">Valid</div>
			 <div class="invalid-feedback">Required</div>
			</div>
            <div class="form-group">			
			 <label for="password">Enter Your Password:</label>
			 <input type="password" class="form-control" name="password" id="password">
			 <input type="submit" value="Login">
			 
			 <div class="invalid-feedback">Required</div>
			</div> 
		  </form>
	  </div>
	  <div class="d122"></div>
   </body>
</html>