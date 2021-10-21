<?php
  session_start();
?>
<!doctype html>
<html>
     <head>
	     <title>Signning UP</title>
		 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		 <meta name="google-signin-client_id" content="673014018053-ikdqfej7lll8865uv7l77qjqdo4u3f1c.apps.googleusercontent.com">
       <script src="https://apis.google.com/js/platform.js" async defer></script>
		 <script src= "https://smtpjs.com/v3/smtp.js"></script>
		 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		   
         <script src="send_email.js"></script> 
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     </head>
	 <script>
	    $(document).ready(function(){
			///login
                var  f=0;
		   $(document).on("input","#email1",function(){
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
						   
						   $(".modal-body").html("<h3>Email Doesn't Exist</h3>");
						   $("#inffo1").modal("toggle");
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
		   
			//signup
			$(document).on("input","#email",function(){
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
			$(document).on("input","#otp",function(){
				if($(this)[0].checkValidity()===false){
					$(this).closest(".form-group").children(".valid-feedback").hide();
				$(this).closest(".form-group").children(".invalid-feedback").html("OTP is incorrect").show();}
				else
					$(this).closest(".form-group").children(".invalid-feedback").html("Invalid input").hide();
			});
			
			$(document).on("input","#pass1,.fakp:nth-child(2)",function(){
				if($(this).val()!=$("#pass").val()||$(".fakp").first().val()!=$(".fakp").last().val()){
					//alert($(this).val()+","+$(".fakp").last().val()+","+$(".fakp").first().val())
					$(this)[0].setCustomValidity("invalid");
					$(this).closest(".form-group").children(".valid-feedback").hide();
					$(this).closest(".form-group").children(".invalid-feedback").html("Passwords Doesn't Match").show();
				}
				else{
					$(this)[0].setCustomValidity("");
					$(this).closest(".form-group").children(".valid-feedback").show();
				    $(this).closest(".form-group").children(".invalid-feedback").html("Invalid input").hide();
				}
			});
			$(document).on("change",".form-check-input",function(){
				console.log("chng");
				togPss();
			});
			function togPss(){
				if($(".orgp").css("display")!="none"){
				   $(".orgp").css("display","none");
				   $(".fakp").css("display","block");
				   console.log("hery");
				   $(".fakp").first().val($("#pass").val());
				   $(".fakp").last().val($("#pass1").val());
				}
				else{
					$(".orgp").css("display","block");
				   $(".fakp").css("display","none");
				}
			}
			$(document).on("input",".fakp",function(){
				$("#pass").val($(".fakp").first().val());
				$("#pass1").val($(".fakp").last().val());
			});
			
			var clr="";
			var ctd=300;
			$("#frm1").submit(function(event){
				event.preventDefault();
				if($(this)[0].checkValidity()==false){
					event.stopPropagation();
					return false;
				}
				var da=$(this).serialize();
				$.ajax({
					url:"signup-user-f.php",
					type:"post",
					data:da,
					success:function(msg){
						var xc=jQuery.parseJSON(msg);
						console.log("insider1"+JSON.stringify(xc));
						if(xc[0]=="Already-g"){
							$("#d123").show();
							$("#d123").html("Select Login With Google To Continue")
						}
						else{
						if(xc[0]=="Already-n"){
							$("#d123").show();
							$("#d123").html("Email Exists, Login To Continue .");
						}
						else{
							$(".loop").html($("#email").val());
							
							var to=xc[0];
							console.log("to"+to);
							var body=xc[1];
						    
							sendEmail(to,body);
							clr=setInterval(vset,1000);
							setTimeout(cset,300000);
							$("#d2").css("display","block");
							
							$("#d1").css("display","none");
					    }	
						}	
					}
				});
				
			});
			function vset(){
				$(".vldt").html("code valid for "+ctd+" seconds");
				ctd--;
			}
			function cset(){
			     clearInterval(clr);
			}
			$("#frm2").submit(function(event){
				event.preventDefault();
				if($(this)[0].checkValidity()==false){
					event.stopPropagation();
					return false;
				}
				var da=$(this).serialize();
				$.ajax({
					url:"signup-user-g.php",
					type:"post",
					data:da,
					success:function(msg){
						
						var po=jQuery.parseJSON(msg);
						console.log(JSON.stringify(po));
						for(x in po){
							if(po[x]=="Right"){
								alert("Email-Id VAlid");
								cset();
								$("#d3").css("display","block");
								$("#d2").css("display","none");
								break;
							}
							else{
								alert("Invalid code");
								break;
							}
						}
					}	
				});
			});
			$(document).on("change","#dp",function(){
				if($("#dp").val()==""){
					return false;
				}
				var tt=new FormData();
				$("#lp").html("Change Image");
   				tt.append('bul',$(this)[0].files[0]);
			
				tt.append("opon","wwe");
				var uu=URL.createObjectURL($(this)[0].files[0]);
				$.ajax({
					url:"signup-user-h.php",
					type:"post",
					data:tt,
					contentType:false,
					processData:false,
					success:function(msg){
						var ttt=jQuery.parseJSON(msg);
						if(ttt==1){
							$("#cp").css({"display":"none"});
							$("#cp").html("");
							$("#im1").css("display","none");
							$("#b23").css("display","inline-block");
							$("#dp")[0].setCustomValidity("invalid");
							$("#im1").attr("src","");
						
						}
					    else{
							$("#cp").css({"display":"block"});
							$("#cp").html("");
							$("#dp")[0].setCustomValidity("");
							$("#im1").attr("src",uu);
							$("#im1").css("display","inline-block");
							$("#b23").css("display","inline-block");
						}
						
					}
				});
			});
			$(document).on("click","#b23",function(){
				$("#dp").val();
				$("#dp")[0].setCustomValidity("");
				$("#im1").attr("src","");
				$("#im1,#b23").css("display","none");
				$("#cp").html("No Image Chosen");
				$("#lp").html("<i class='fas fa-cloud-upload-alt' style='font-size:24px'></i> Choose Profile Picture");
				
			});
			$("#frm3").submit(function(event){
				
				event.preventDefault();
				if($(this)[0].checkValidity()==false){
					event.stopPropagation();
					return false;
				}
				//var da=$(this).serialize();
				var da=new FormData(this);
				$.ajax({
					url:"signup-user-h.php",
					type:"post",
					data:da,
					contentType:false,
					processData:false,
					success:function(msg){
						var po=jQuery.parseJSON(msg);
						alert(JSON.stringify(po));
						  <?php $_SESSION["trav"]="2" ?>
						window.open("exx.php","_self");
					}	
				});
			});
			$("#b21").click(function(){
				$("#d2").hide();
				$("#d1").show();
				
				
			});
			$("#b22").click(function(){
				$("#d3").hide();
				$("#d1").show();
				
				
			});
			
			
		});
		function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
			var profile = googleUser.getBasicProfile();
			console.log("ID: " + profile.getId()); // Don't send this directly to your server!
			console.log('Full Name: ' + profile.getName());
			console.log('Given Name: ' + profile.getGivenName());
			console.log('Family Name: ' + profile.getFamilyName());
			console.log("Image URL: " + profile.getImageUrl());
			console.log("Email: " + profile.getEmail());
			var js={email:profile.getEmail(),name:profile.getName()}
			//alert(profile.getEmail());
		    $.ajax({
				url:"g-login.php",
				data:{email:profile.getEmail(),name:profile.getName(),img:profile.getImageUrl()},
				type:"post",
				success:function(msg){
					//alert("hello");
					var op=jQuery.parseJSON(msg);
					//alert(JSON.stringify(op));
					var abc='<?php if(isset($_SESSION["u-name"])){echo $_SESSION["u-name"];} ?>';
					//$("#oppp").html("Logged in as"+ abc);
					window.open("exx.php","_self");
				}
			});
		   }
	 </script>
	 <style>
	    #d1,#d2,#d3,#d22{
			position:relative;
			margin-top:50px ;
		}
		#d2,#d3{
			display:none;
		}
		#jumbo{
			padding:2rem 1rem;
		}
		#hh{
			margin-top:40px;
		}
		.vldt{
			align:center;
			font-size:19px;
		}
		.nav-item{
			margin-left:30px;
			margin-right:30px;
		}
		
	  .tab-content{
		  margin-top:80px;
		  border:3px solid grey;
		  width:500px;
		  margin-left:auto;
			margin-right:auto;
			padding:40px;
		
	  }
	  .nav-pills{
		  
		  margin-top:50px;
	  }
	 .orr{
		 position:relative;
		 margin-left:auto;
		 margin-right:auto;
		 color:grey;
		 font-size:13px;
		 margin-top:15px;
		 margin-bottom:20px;
	 }
	 .fakp{
		 display:none;
	 }
	 .modal-dialog{
		 animation:ero .2s linear;
	 }
	 .modal-content{
		 min-width:300px;
		 min-height:400px;
	 }
	 @keyframes ero{
		 from{transform:scale(0);}
		 to{transform:scale(1);}
	 }
	 #b23,#im1{
		 display:none;
	 }
	 #dp{
		 height:0.01px;
		 width:0.01px;
		 visibility:hidden;
	 }
	 #im1{
		 height:80px;
		 width:150px;
		 object-fit:contain;
	 }
	 #lp{
		 cursor:pointer;
		 display:inline-block;
	 }
	 
	 </style>
	 <body>
	     
		 
<div class="container d-flex justify-content-center">
  
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#logg">Log-in</a>
    </li>
	
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#sing">Sign-Up</a>
    </li>
   
  </ul>
</div>		 
		 
	<div class="tab-content">
        <div id="logg" class="tab-pane container active">
             <h2 align="center">Login to your Account</h2>
			  <div id="d22" class="container" >
				  <form id="frm4" class="was-validated" >
					<div class="form-group">
					 <label for="email1">Enter Your Email id:</label>
					 <input  type="email" class="form-control" name="email" id="email1" required><br>
					 <div class="valid-feedback">Valid</div>
					 <div class="invalid-feedback">Required</div>
					</div>
					<div class="form-group">			
					 <label for="password">Enter Your Password:</label>
					 <input type="password" class="form-control" name="password" id="password" required>
					
					 <div class="invalid-feedback">Required</div>
					</div> 
					<input type="submit" class="btn btn-info btn-block"value="Login">
				  </form>
				  <div class="orr d-flex justify-content-center">Or Log-in With Google</div>
				  <div id="3333" class="g-signin2 d-flex justify-content-center" data-onsuccess="onSignIn" data-theme="dark"></div>
	  </div>
	  <div class="d122"></div>
		</div>		
		
		
		
		
	    <div id="sing" class="tab-pane container fade">
		  <h2 align="center">Create A Free Account</h2>
	     <div id="d1" class='container'>
		   <form id="frm1" class='was-validated' >
		   <div class="form-group">
				<label for="email">Enter Your Email id</label>
				<input type="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" id="email" placeholder="Enter email" class="form-control" required>
				<div class="valid-feedback">Valid.</div>
				<div class="invalid-feedback">Please fill out this field.</div>
			
			</div>	
			<input type="submit" value="submit" class="btn btn-warning btn-block">
			
		  </form>
		  <div class="orr d-flex justify-content-center">Or Sign Up With Google</div>
		  <div id="3333" class="g-signin2 d-flex justify-content-center" data-onsuccess="onSignIn" data-theme="dark"></div>
         </div>
		 <div id="d123"></div>
		 <div id="d2" class="container">
		     <form id="frm2" class="was-validated" >
			     Email-id=<span class="loop"></span><input type="button" id="b21" value="Edit"><br><br><br>
				 <div class="form-group">
					 <label for="otp">Enter OTP recieved through mail </label>
					 <input class="form-control" pattern='[0-9]{1,}'  type="text" name="otp" id="otp" required/>
					 <div class="valid-feedback">Valid.</div>
				     <div class="invalid-feedback">Please fill out this field.</div>
				 </div>
				 <div class="vldt"></div>
				 <input type="submit" value="Verify Otp" class="btn btn-warning btn-block">
			 </form>
		 </div>
		 <div id="d3">
		     <form id="frm3" class="was-validated" >
			  Email-id=<span class="loop"></span><input type="button" id="b22" value="Edit"><br><br><br>
			  <div class="form-group">
			     <label for="name">Enter Your NAme:</label>
				 <input type="text" class="form-control" id="name" name="name" required><br>
				 <div class="valid-feedback">Valid.</div>
				 <div class="invalid-feedback">Please fill out this field.</div>
			  </div>
			  <div class="form-group">
			      <label id='sp' >Profile Picture:</label><br>
			      
				  <span id='cp'>No Image Chosen</span><img id='im1'></img>
				  <input type="file" id="dp" class='form-control' name='dp'>
				  <label class='btn btn-secondary' id='lp' for='dp'><i class='fas fa-cloud-upload-alt' style='font-size:24px'></i> Choose Profile Picture</label>
				  <label class='btn btn-default' id='b23'><i class='fas fa-trash-alt' style='font-size:36px;color:red'></i> Remove Picture</label>
				  <div class="invalid-feedback">Item not image (.jpg,.jpeg,.png)</div>
			  </div>
			  <div class="form-group">
				 <label for="pass">Enter your Password</label>
				 <input type="password"  class="form-control orgp" name="pass" id="pass" required><br>
				 <input type="text"  class="form-control fakp">
				 <div class="invalid-feedback">Please fill out this field.</div>
			  </div>
			  <div class="form-group">
				 <label for="pass1">Retype your Password</label>
				 <input type="password"  class="form-control orgp" name="pass1" id="pass1" required><br>
				 <input type="text"  class="form-control fakp">
				 <div class="invalid-feedback">Please fill out this field.</div>
			   </div>
			  
				 <input type="submit" value="Submit" class="btn btn-warning btn-block">
			 </form>
		  </div>
		 </div>
	   </div>	
	   <div class="modal" id="inffo1">
		  <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
		
                <div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				 </div>
				 
				 <div class="modal-body">

				  </div>
			  

			</div>
		  </div>
		</div>
      	   
	 </body>
</html>