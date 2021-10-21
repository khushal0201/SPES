<?php 
    session_start();
	 if(isset($_POST["ty"])){
	  if($_POST["ty"]=="set"){
		  $_SESSION["gtid"]=$_POST["gtid"];
		  $_SESSION["gtnm"]=$_POST["gtnm"];
		  $_SESSION["stat"]=$_POST["stat"];
		  $_SESSION["chh"]=0;
	  }
	  echo json_encode("may be working");
  }
  else if($_SESSION["stat"]=="live"){
  ?>
   <!doctype html>
   <html>
      <head>
	      <title>Responses Will be Visible After Test Ends </title>
	  </head>
	  <body>
	     <br><br>
		 <h3 align='center'>Responses Will be Visible After Test Ends </h3>
	  </body>

   </html>
  <?php
  }
	  
  else if($_SESSION["stat"]=="done"||$_SESSION["stat"]=="checked"){
	
?>
<!doctype html>
<html>
    <head>
	    <title>Stud resp</title>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	</head>
	<script>
	 var stuu={}
	   $(document).ready(function(){
		   $.ajax({
			   url:"select_students.php",
			   type:"post",
			   data:{},
			   success:function(msg){
				   var ii=jQuery.parseJSON(msg);
				   var tot=0;
				   for(xx in ii){
					   
					   stuu[ii[xx].stud_id]=ii[xx].name;
				   }
			   }
		   });
		   var chh=0;
		   $.ajax({
			   url:"give_test_back.php",
			   type:"post",
		       data:{ty:"resp"},
			   success:function(msg){
				   var tt=jQuery.parseJSON(msg);
				    var tot=0;
				   for(z in tt){
					  
					   tot++;
					   $("#t1").html(tot);
					   var stt="checked"
					   if(tt[z].status=="submit"){
					     stt="unchecked";
						 chh++;
					   }
					   if(tt[z].status=="terminated")
						   stt="terminated";
					   $("#d11").append("<div data-rid='"+tt[z].id+"' data-stt='"+stt+"' data-nm='"+stuu[tt[z].stud_id]+"' class='resps'>Student Name="+stuu[tt[z].stud_id]+"<br><h3 class='"+stt+"'>Status="+stt+"</h3></div>");
				   }
				   $("#t2").html(chh);
				   updd();
			   }
		   });
		   
		   function updd(){
			   $.ajax({
				   url:"give_test_back.php",
				   type:"post",
				   data:{ty:"r12",chh:chh},
				   success:function(msg){
					   var ggg=jQuery.parseJSON(msg);
					   alert(ggg);
				   }
			   });
		   }
		   
		   $(document).on("click",".resps",function(event){
			   event.preventDefault();
			   var rid=$(this).attr("data-rid");
			   var stnm=$(this).attr("data-nm");
			   var stt=$(this).attr("data-stt");
			   $.ajax({
				   url:"see_resp_stud.php",
				   data:{ty:"vr",rid:rid,stnm:stnm,stt:stt},
				   type:"post",
				   success:function(msg){
					   var as=jQuery.parseJSON(msg);
				       alert(as);
					   window.open("see_resp_stud.php","_self");
				   }
			   });
		   });
		   $(document).on("click","#i55",function(ele){
			   ele.preventDefault();
			   var tac=parseInt(chh);
			   if(tac>0){
				   alert("Can't mark as checked!! "+tac+" are still unchecked");
			   }
			   $.ajax({
				   url:"give_test_back.php",
				   type:"post",
				   data:{ty:"mrkch"},
				   success:function(msg){
					   var ttt=jQuery.parseJSON(msg);
					   $("#d333").html("checked");
				   }
			   });
		   });
	   });
	</script>
	<style>
	    #d11{
			border:3px solid black;
		}
		.resps{
			border:1px solid black;
			cursor:pointer;
		}
		.unchecked{
			background-color:orange;
		}
		.checked{
			background-color:green;
		}
		.terminated{
			background-color:red;
		}
	</style>
	<body>
	    <h1>Scheduled test <?php echo $_SESSION["gtnm"]; ?></h1>
		<div id='d333'><?php if($_SESSION["stat"]!="checked"){ ?>Mark Test as checked :<input type='button' id='i55' value='Checked'><?php }else{ ?> Checked <?php } ?></div>
		<div id="d11">
		   <h2>Responses from Students</h2>
		   <h3>Response count:<span id="t1"></span></h3>
		   <h3>Unchecked Responses:<span id="t2"></span></h3>
		   
		</div>
		
	</body>
</html>
<?php 
  }
 ?>