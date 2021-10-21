<?php
     session_start();
		 if(isset($_POST["ty"])){
	            if($_POST["ty"]=="vr"){		 
			 $_SESSION["rid"]=$_POST["rid"];
			 $_SESSION["stnm"]=$_POST["stnm"];
			 $_SESSION["stt"]=$_POST["stt"];
			 echo json_encode("Ya redirecting");
				}			 
	}
	else{
 ?>
 <!doctype html>
 <html>
    <head>
       <title><?php echo $_SESSION["stnm"] ?> Responses</title>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />	   
   </head>
   <script>
   var quee={} 
      $(document).ready(function(){
		  var dis=0;
		   var c=0,cn=0;
		  $.ajax({
			  url:"create_test_entry.php",
			  data:{ty:"loader",gt:"yes"},
			  type:"post",
			  success:function(msg){
				  var ww=jQuery.parseJSON(msg);
				  for(z in ww){
					  quee[ww[z].id]={};
					  quee[ww[z].id]["quest"]=ww[z].quest;
					  quee[ww[z].id]["mark"]=ww[z].mark;
					  if(ww[z].typp=="mcq"){
						  quee[ww[z].id]["ans"]=ww[z].ans;
						  quee[ww[z].id]["op1"]=ww[z].op1;
						  quee[ww[z].id]["op2"]=ww[z].op2;
						  quee[ww[z].id]["op3"]=ww[z].op3;
						  quee[ww[z].id]["op4"]=ww[z].op4;
					  }
				  }
			  }
			  
		  });
		  $.ajax({
			  url:"give_test_back.php",
			  data:{ty:"stf"},
			  type:"post",
			  success:function(msg){
				  var daa=jQuery.parseJSON(msg);
				 
				  for(x in daa){
					  c++;
					  $("#d11").append("<div data-id='"+daa[x].id+"' id='"+daa[x].qid+"' class='qui'><h3>Question."+c+" "+quee[daa[x].qid]["quest"]+"</h3><div class='mrk' style='position:relative;float:right;'><h4 style='display:inline-block;'>Total mark of question="+quee[daa[x].qid]["mark"]+"</h4></div><div class='typ' > </div></div><br><br>")
				      if(daa[x].qty=="mcq"){
						  $("#"+daa[x].qid+" > .typ").append("<input type='radio' value='op1' class='op1' disabled>"+quee[daa[x].qid]["op1"]+"<br><input type='radio' value='op2' class='op2' disabled>"+quee[daa[x].qid]["op2"]+"<br>");
						  if(quee[daa[x].qid]["op3"]!=null){
							 $("#"+daa[x].qid+" > .typ").append("<input type='radio' value='op3' class='op3' disabled>"+quee[daa[x].qid]["op3"]+"<br>");							 
						  }
						  if(quee[daa[x].qid]["op4"]!=null){
							 $("#"+daa[x].qid+" > .typ").append("<input type='radio' value='op4' class='op4' disabled>"+quee[daa[x].qid]["op4"]+"<br>"); 
						  }
						  alert("u have="+daa[x].ans);
						  $("#"+daa[x].qid+" > .typ >."+daa[x].ans).attr("checked",true);
						 // $("#"+daa[x].qid+" > .typ >."+daa[x].ans).addClass("uans");
						  $("#"+daa[x].qid+" > .typ >."+daa[x].ans).addClass("uans");
						  $("#"+daa[x].qid+" > .typ >."+quee[daa[x].qid]["ans"]).addClass("oans");
					      $("#"+daa[x].qid+">.mrk").append("<h3>Mark Recieved ="+daa[x].mark+"</h3>")
						  var out="";
						  if(daa[x].ans==quee[daa[x].qid]["ans"]){
							  out="Correct";
						  }
						  else
							  out="Incorrect"
						  $("#"+daa[x].qid).append("<br><h3>Outcome: "+out+"</h3>");
					  }
					  else if(daa[x].qty=="norm"){
						  cn++;
						  $("#"+daa[x].qid+" > .typ").append("<div class='normn'>Answer From Student="+daa[x].ans+"</div>");
					      $("#"+daa[x].qid+">.mrk").append("<h3>Assign mark:</h3><input min='0' max='"+daa[x]["lmrk"]+"' type='number' class='gmrk'>");
						  if(daa[x].mark>-1){
							  dis++;
							 $("#"+daa[x].qid+">.mrk>.gmrk").addClass("dch");
                             $("#"+daa[x].qid+">.mrk>.gmrk").val(daa[x].mark);							 
						  }
					  }
				  }
				  if((cn-dis)!=0)
				    $("#d44").html((cn-dis)+" questions are left unchecked");
				  else if(cn==0){
					$("#d44").html("<h3>Mark checked:</h3><input id='i2' type='button' value='Checked'>");
				  }
			  }
		  });
		  
		  $(document).on("blur",".gmrk",function(event){
			  event.preventDefault();
			  if($(this)[0].checkValidity()==false){
				  return false;
			  }
			  var mark=$(this).val();
			  var id=$(this).closest(".qui").attr("data-id");
			  var eid=$(this).closest(".qui").attr("id");
			  alert("mark is="+mark);
			  $.ajax({
				  url:"give_test_back.php",
				  type:"post",
				  data:{ty:"ima",mark:mark,vid:id},
				  success:function(msg){
				      var uu=jQuery.parseJSON(msg);
                      alert("oo="+uu);	
                      if(!$("#"+eid+">.mrk>.gmrk").hasClass("dch")){
					    dis++;
                        $("#"+eid+">.mrk>.gmrk").addClass("dch");						
					  }
					  if(dis!=cn)
                         $("#d44").html((cn-dis)+" questions are left unchecked");				  
				      else if("<?php echo $_SESSION['stt']; ?>"!="checked"){
						  $("#d44").html("<h3>Mark checked:</h3><input id='i2' type='button' value='Checked'>");
					  }
				  }
				});
			  
		  });
		  $(document).on("click","#i2",function(event){
			  event.preventDefault();
			  $.ajax({
				  url:"give_test_back.php",
				  data:{ty:"chk"},
				  type:"post",
				  success:function(msg){
					  var dss=jQuery.parseJSON(msg);
					  alert(dss);
					  window.open("see_resp.php","_self");
				  }
			  });
		  });
	  });
   </script>
   <style>
      #d44{
		  display: block;
		  float:right;
		  position:relative;
	  }
	  
	  .qui{
		  width:70%;
		  display: block;
		  margin-left:auto;
		  margin-right:auto;
	  }
   </style>
	<body>
	    <h1 align="center"><?php echo $_SESSION["stnm"] ?>'s responses for <?php echo $_SESSION["gtnm"]; ?> test</h1>
		<div id="d44"><?php if($_SESSION["stt"]=="checked"){ echo "Test was checked";} ?></div><br><br><br>
		<div id="d11">
		      
		   
		</div>
	</body>
 </html>
 
 <?php
	}
?>	