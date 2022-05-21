<?php 
   session_start();
?>
<!doctype html>
<html>
     <head>
	     <title>Add TEachers</title>
		 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 </head>
	 <script>
	     $(document).ready(function(){
			 var ssn=1,j=1,loo,stst=0;
			 var asub={};
			 $.ajax({
				 url:"select_sub.php",
				 type:"post",
				 data:{ty:"tea"},
				 success:function(msg){
					 var app=jQuery.parseJSON(msg);
					 //alert(JSON.stringify(app));
					 loo=app;
					 for(x in app){
					   asub[app[x].sub_id]={};
					   asub[app[x].sub_id]["name"]=app[x].sub_name;
					   asub[app[x].sub_id]["stat"]="y";
					   if(asub[app[x].sub_id]["stat"]=="y"){
                        $("#sub"+j).append("<option class='"+app[x].sub_id+"' value="+app[x].sub_id+">"+asub[app[x].sub_id]["name"]+"</option>");					   
					    stst++;
					   }
					}
				 }
			 });
			 $("#tbh").click(function(){
				 j++;
				 ssn++;
				// $("#d3").append("<label>Enter Teachers id</label><input id='id"+j+"' name='id"+j+"' type='text'></input><br><label>Enter Teachers' name</label><input type='text' id='name"+j+"' name='name"+j+"'><br><label>Enter Teacher's Email:-</label><input type='email' name='email"+j+"' id='email"+j+"'><br><label>Enter Teachers Subject</label><select id='sub"+j+"' name='sub"+j+"'></select><br>");
				 
				 
				 $("#d3>table>tbody").append("<tr><td class='sss' id='ss"+ssn+"'>"+ssn+"</td><td class='omm'><input type='number' id='indee"+ssn+"' name='indee"+ssn+"' value='"+j+"'></td><td><input class='form-control' id='id"+j+"' name='id"+j+"' type='text' required></input></td><td><input class='form-control' type='text' id='name"+j+"' name='name"+j+"' required /></td><td><input class='form-control' type='email' name='email"+j+"' id='email"+j+"' required /></td><td><select class='seel' data-old='' name='sub"+j+"' id='sub"+j+"' required><option value=''>Select</option></select></td><td><i class='far fa-trash-alt tbbb' style='font-size:36px'></i></td></tr>");
			      for(x in asub){
					   //i++;
					   alert("x="+x);
					   if(asub[x]["stat"]=="y")
                          $("#sub"+j).append("<option class='"+x+"' value="+x+">"+asub[x]["name"]+"</option>");					   
				 }
				 
				 
			 });
			 
		 $(document).on("click",".tbbb",function(){
			 var cv=$(this).closest("tr").children(".sss").html();
			 alert("cv="+cv);
			 cv=parseInt(cv);
			 
			 
			 if($(this).closest("tr").find("select").val()!=""){
				  var tba=$(this).closest("tr").find("select").attr("data-old");
				  asub[tba]["stat"]="y";
				  stst++;
				  $(".seel").append("<option class='"+tba+"' value='"+tba+"' >"+asub[tba]["name"]+"</option>");
				  
				  if(stst<=0){
					 $("#tbh").css("display","none");
				 }
				 else if($("#tbh").css("display")=="none"){
					  $("#tbh").css("display","block");
				 }
				 
			 }
			 
			 
			 $("#ss"+cv).closest("tr").fadeOut();
			 $("#ss"+cv).closest("tr").remove();
			 cv++;
			 
			 for(var iu=cv;iu<=ssn;iu++){
				 $("#ss"+iu).html(iu-1);
				 alert("its is=indee"+iu+$("#indee"+iu).val());
				 $("#indee"+iu).attr({"id":"indee"+parseInt(iu-1),"name":"indee"+parseInt(iu-1)});
				 $("#ss"+iu).attr("id","ss"+parseInt(iu-1));
			 }
			 ssn--;
			 $("#mod1").modal("toggle");
			
			 
		 });
			 
			 $("#frm1").submit(function(event){
				 event.preventDefault();
				 var tbs=$(this).serialize();
				 $.ajax({
					 url:"db_teach.php",
					 data:tbs,
					 type:"post",
					 success:function(msg){
						 var mmm=jQuery.parseJSON(msg);
						 alert(mmm);
						 window.open("ClassmPageCreator.php","_self");
					 }
				 });
			 });
			 $(document).on("input",".seel",function(){//On selecting from the dropdown menu
				 var tba="nott";
				 //Adding or removing old data
				 if($(this).closest("select").attr("data-old")!=""){
					 tba=$(this).closest("select").attr("data-old");
				 }
				 
				 var tbr=$(this).closest("select").val();
				  $(this).closest("select").removeClass("seel");
				 if(tbr!=""){
					  $(".seel").children("."+tbr).remove();	
                      asub[tbr]["stat"]="n";	
                      stst--;					  
				 }
				 //alert("tba="+tba);
				
				 
				 if($(this).closest("select").attr("data-old")!=""){
					 asub[tba]["stat"]="y";
					 stst++;
					$(".seel").append("<option class='"+tba+"' value='"+tba+"' >"+asub[tba]["name"]+"</option>");
				 }
				 if(stst<=0){
					 $("#tbh").css("display","none");
				 }
				 else if($("#tbh").css("display")=="none"){
					  $("#tbh").css("display","block");
				 }
				 $(this).closest("select").attr("data-old",tbr);
				 $(this).closest("select").addClass("seel");
				 
			 });
		 });
	 </script>
	 <style>
	    
		.omm{
			display:none;
		}
		.table{
			width:80%;
		}
	 </style>
	 <body>
	    <h1 align="center"><?php echo $_SESSION["name"]; ?> Class teachers</h1>
		<br><br><br>
		<div id="d1" >
		    <form id="frm1" class="was-validated">
			    <div id="d3" class='d-flex justify-content-center'>
					<!--<label>Enter Teachers id</label>
					<input id="id1" name="id1" type='text'></input><br>
					<label>Enter Teachers' name</label>
					<input type='text' id='name1' name='name1'><br>
					<label>Enter Teacher's Email:-</label>
					<input type="email" name="email1" id="email1"><br>
					<label>Enter Teachers Subject</label>
					
					<select name="sub1" id="sub1">
					
					</select><br>-->
					<table class='table table-striped table-hover'>
					   <thead>
					      <tr>
					       <th>S. No.</th>
						   <th class='omm'></th>
					       <th>Teacher's ID</th>
						   <th>Teacher's Name</th>
						   <th>Teacher's Email</th>
						   <th>Teacher's Subject</th>
						   <th></th>
						  </tr> 
					   </thead>
					   <tbody>
					      <tr>
					       <td class='sss' id="ss1">1</td>
					       <td class='omm'><input type='number' id='indee1' name='indee1' value='1'></td>
						   <td><input class='form-control' id='id1' name='id1' type='text' required></input></td>
						   <td><input class='form-control' type='text' id='name1' name='name1' required /></td>
						   <td><input class='form-control' type='email' name='email1' id='email1' required /></td>
						   <td><select data-old='' class="seel" name="sub1" id="sub1" required>
						         <option value=''>Select</option>
							   </select></td>
						   <td><i class='far fa-trash-alt tbbb' style='font-size:36px'></i></td>
					      </tr>
					   </tbody>
					</table>
			   </div>	
				<input class='btn btn-success btn-block'  type="submit" value="submit">
				<input class="btn btn-primary" type="button" id="tbh" value="Add more teachers">
			</form>
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
					Deleted
				  </div>
			 
			 
			 </div>
		  </div>
		</div>
	 </body>
	 
</html>