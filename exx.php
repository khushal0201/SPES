<?php 
   session_start();
   if(!isset($_SESSION["trav"]))
     $_SESSION["trav"]="1";
 
?>
<!doctype html>
<html>
   <head>
       <title>Main PAge</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   
       <meta name="google-signin-client_id" content="673014018053-ikdqfej7lll8865uv7l77qjqdo4u3f1c.apps.googleusercontent.com">
       <script src="https://apis.google.com/js/platform.js" async defer></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
   <head/>
   <script>
       $(document).ready(function(){
		   $("#3333").html("Googly");
		   var tchk="<?php  if(!isset($_SESSION['uid'])){echo 'false';}else {echo 'true';} ?>";
		   //alert("travv is="+tchk);
		   if(tchk=="true"){
	       $.ajax({
			   url:"select_clss.php",
			   data:{ty:"create"},
			   type:"post",
			   success:function(msg){
				   var i=1;
				   var op=jQuery.parseJSON(msg);
				   $("#df").html("");
				  // alert("hello");
				   for(x in op){
					   $("#df").append("<div class='card bg-success text-white'><div class='card-body'><input type='button' class='clss' data-cred='"+op[x].cred+"' data-sess='"+op[x].sess+"' data-ins='"+op[x].institute+"' id='"+op[x].id+"' name='"+op[x].name+"' value='"+op[x].name+"' ></input> <div class='tbbss'><span>Creation Date:</span>"+op[x].cred+"</div><div class='tbbss' ><span>Institute: </span>"+op[x].institute+"</div></div></div><br>");
					   i++;
				   }
				   if(i>1)
					   $("#df").css("display","inline-block");
					   
			   }
		   });
		   }
		   $("#b33").click(function(){
			    if(tchk=="false"){
					return false;
				}
			   $.ajax({
				   url:"select_clss.php",
				   data:{ty:"join"},
				   type:"post",
				   success:function(msg){
					    var i=1;
				   var op=jQuery.parseJSON(msg);
				   $("#df").html("");
				  // alert("hello");
				  var desssi="";
				 
				   for(x in op){
					    if(op[x].des=="t"){
							  desssi="Teacher";
						  }
						  else{
							  desssi="Student";
						  }
					   $("#df").append("<div class='card text-white'><div class='card-body'><input type='button' data-cred='"+op[x].cred+"' data-sess='"+op[x].sess+"' data-ins='"+op[x].institute+"' data-crea='"+op[x].crm+"' data-pid='"+op[x].pid+"' data-pnm='"+op[x].pnm+"' class='clss1' id='"+op[x].des+"-"+op[x].id+"' data-subi='"+op[x].subi+"' data-subn='"+op[x].subn+"' name='"+op[x].name+"' value='"+op[x].name+"' ></input><div class='tbbss'><span> Designation :</span>"+desssi+"</div> <div class='tbbss'><span>User Id:</span>"+op[x].pid+"</div>  <div class='tbbss'><span>User Name:</span>"+op[x].pnm+"</div> <div class='tbbss'><span>Session : </span>"+op[x].sess+"</div><div class='tbbss' ><span>Institute: </span>"+op[x].institute+"</div> </div></div><br>");
					   i++;
				   }
				   if(i>1)
					   $("#df").css("display","inline-block");
					   
			       }
			   });
		   });
		   
		    $("#b32").click(function(){
				if(tchk=="false"){
					return false;
				}
			   $.ajax({
				   url:"select_clss.php",
				   data:{ty:"create"},
				   type:"post",
				   success:function(msg){
					    var i=1;
				   var op=jQuery.parseJSON(msg);
				   $("#df").html("");
				  // alert("hello");
				   for(x in op){
					   //alert("oops="+op[x].id);
					   $("#df").append("<div class='card bg-success text-white'><div class='card-body'><input type='button' class='clss' data-sess='"+op[x].sess+"' data-cred='"+op[x].cred+"' data-ins='"+op[x].institute+"' id='"+op[x].id+"' name='"+op[x].name+"' value='"+op[x].name+"' ></input> <div class='tbbss' ><span>Creation Date: </span>"+op[x].cred+"</div><div class='tbbss' ><span>Institute: </span>"+op[x].institute+"</div></div></div><br>");
					   i++;
				   }
				   if(i>1)
					   $("#df").css("display","inline-block");
					   
			       }
			   });
		   });
		   var ceep=0;
		  $(document).on("click",".card",function(){
			  if(ceep==1){
				  return false;
			  }
			  ceep=1;
			  if($(this).find(".clss1").length){
				  $(this).find(".clss1").trigger("click");
			  }
			  else if($(this).find(".clss").length){
				  $(this).find(".clss").trigger("click");
			  }
		  });
		   $(document).on("click",".clss",function(event){
			  
			   alert("hello");
			   var id=$(this).attr("id");
			   //alert("id is="+id);
			   var name=$(this).attr("name");
			   var date=$(this).attr("data-cred");
			   var ins=$(this).attr("data-ins");
			   var sess=$(this).attr("data-sess");
			   
			   $.ajax({
				   url:"set_session.php",
				   data:{name:name,id:id,ty:" ",ins:ins,date:date,sess:sess},
				   type:"post",
				   success:function(){
					   window.open("ClassmPageCreator.php","_self");
				   }
			   });
		   });
		 
           $(document).on("click",".clss1",function(event){
			  
			   //alert("hello");
			   var id=$(this).attr("id");
			   var name=$(this).attr("name");
			   var ars=id.split("-");
			   var subs=$(this).attr("data-subi");
			   var sub_name=$(this).attr("data-subn");
			   var pid=$(this).attr("data-pid");
			   var pnm=$(this).attr("data-pnm");
			   var date=$(this).attr("data-cred");
			   var ins=$(this).attr("data-ins");
			   var sess=$(this).attr("data-sess");
			   var crea=$(this).attr("data-crea");
			  // alert("des is="+ars[0]);
			   $.ajax({
				   url:"set_session.php",
				   data:{name:name,id:ars[1],ty:"nset",des:ars[0],subs:subs,sub_name:sub_name,pid:pid,pnm:pnm,date:date,ins:ins,crea:crea,sess:sess},
				   type:"post",
				   success:function(){
					   window.open("ClassmPageJoiner.php","_self");
				   }
			   });
		   });		 
		   
		   $(document).on("click","#but0",function(){
			   if(tchk=="false"){
				    alert("You need to Login or Signup First")
					return false;
				}
			   window.open("opp.php","_self");
			   
		   });
		   
		   $(document).on("click","#but1",function(){
			   if(tchk=="false"){
					return false;
				}
			   window.open("joinni1.php","_self");
		   });
		   
		   $("#b12").click(function(){
			   window.open("Login_user.php","_self");
		   });
		   $("#b13").click(function(){
			   window.open("signup-user.php","_self");
		   });
		   $(document).on("click","#sigou",function(e){
			   e.preventDefault();
			   $.ajax({
				   url:"set_session.php",
				   data:{ty:"dest",id:"",name:""},
				   type:"post",
				   success:function(msg){
					   var xyu=jQuery.parseJSON(msg);
					   alert(xyu);
					   window.open("exx.php","_self");
				   }
			   });
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
			alert(profile.getEmail());
		    $.ajax({
				url:"g-login.php",
				data:{email:profile.getEmail(),name:profile.getName()},
				type:"post",
				success:function(msg){
					alert("hello");
					var op=jQuery.parseJSON(msg);
					alert(JSON.stringify(op));
					var abc='<?php if(isset($_SESSION["u-name"])){echo $_SESSION["u-name"];} ?>';
					//$("#oppp").html("Logged in as"+ abc);
					window.open("exx.php","_self");
				}
			});
		   }
		   
   </script>
   <style>
      ul li{
		  display:inline-block;
		  margin-left:100px;
	  }
	 
	  #df{
		   display:none;
		  border:3px solid black;
		  padding:50px;
	  }
	  #df2{
		  margin-left:auto;
		  margin-right:auto;
	  }
	  #3333{
		  background-color:blue !important;  
	  }
	  .tcard,.card-body{
		  min-width:1000px;
	  }
	  .card{
		    background: linear-gradient(to right, #2c3e50, #3498db);
			cursor:pointer;
	  }
	  .modal-content{
		  padding:20px;
	  }
	  .ml-auto{
		  margin-left:auto;
		  right:0px;
	  }
	  #but0,#but1{
		  margin-left:32px;
	  }
	  .clss,.clss1{
		  background-color:transparent;
		  border-color:transparent;
		  color:white;
		  font-size:28px;
	  }
	  .tbbss{
		  margin-left:auto;
		  margin-right:0px;
		  width:30%;
	  }
	  .tbbss>span{
		  color:#2c3e50;
	  }
	  #vb{
		  height:100px;
		  width:180px;
		  object-fit:contain;
		  border:1px solid grey;
	  }
   </style>
   <body>
       <nav class="navbar navbar-expand-sm bg-dark navbar-dark pt-2 pb-3">
			   <h1 class='navbar-brand' style="font-size:40px;">Performers</h1>
			   <ul class='navbar-nav'>
				   <li class="nav-item"><a class="nav-link" href='exx.php'>Home</a></li>
				   <li class="nav-item"><a class="nav-link">About</a></li>
				   <li class="nav-item"><a class="nav-link">Contact us</a></li></ul>
				   <ul class="navbar-nav ml-auto"><li style="cursor:pointer;" class="nav-item ml-auto" id="oppp"><?php if(!isset($_SESSION["uid"])){?>
				   <a id="b13" class="nav-link btn btn-info text-white" type="button" >Log-in/Sign-Up
				   <?php } if(isset($_SESSION["uid"])){ ?><a data-toggle="modal" data-target="#logg" class="nav-link">Logged In as <?php  echo $_SESSION["u-name"]; } ?></a></li></ul>
	   </nav>
	   <br><br><br><br>
			 <div class="modal" id="logg">
				<div class="modal-dialog modal-dialog-centered">
				  <div class="modal-content">
				  
					<!-- Modal Header -->
					<div class="modal-header">
					  <h4 class="modal-title">User name= <?php  echo $_SESSION["u-name"];  ?></h4>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<!-- Modal body -->
					<div class="modal-body">
					   <h3>Your DP: <img id='vb' src="<?php echo $_SESSION["img"]; ?>"></img></h3>
					   <h3>Your Full Name= <?php echo $_SESSION["u-name"]; ?></h3><br><br><br>
					   <h3>Your email= <?php echo $_SESSION["email"]; ?></h3>  <br>
					   
					</div>
					
					<!-- Modal footer -->
					<input type="button" class="btn btn-danger btn-sm" id="sigou" value="Sign-out">
					
				  </div>
				</div>
			  </div>
	   
	  <div class="d-flex justify-content-center"> <input type="button" id="but0" class="btn btn-warning" value="Create Class">
	   <input type="button" id="but1" class="btn btn-outline-warning" value="Join Class"/></div>
	   <br><br><br><br>
	   
	   <div class="container">
		
    
			<div id="df2">
				  <ul class="nav nav-tabs justify-content-center" role="tablist">
					   <li class="nav-item" ><a class="nav-link active" data-toggle="tab" id="b32">Your Classes</a></li>
					   <li class="nav-item"><a class="nav-link" data-toggle="tab" id="b33">Joined Classes</a></li><br>
				  </ul> 
				  <br><br><br>
				   <div id="df" class='justify-content-center'>
					   
				   </div>
			</div>
	   </div>
	   <br><br><br>
	   <p style="text-align:center">2021 All Rights Reserved</p>
   </body>
</html>