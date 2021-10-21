<?php
  session_start();
  $_SESSION["designate"]="Creator";
  $_SESSION['pid']="Creator";
  $_SESSION["test_id"]="";
  $_SESSION["test_n"]="";
  unset($_SESSION["noo"]);
?>
<!doctype html>
<html>
    <head>
	  <title>class main page</title>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<script>
	    $(document).ready(function(){
			 var subss={};
		     $.ajax({
				 url:"select_sub.php",
				 type:"post",
				 data:{},
				 success:function(msg){
					 var i=1;
					  
					 var op=jQuery.parseJSON(msg);
					//alert("Dont consider this="+JSON.stringify(op));
					 for(x in op){
						 subss[op[x]["sub_id"]]={};
						 subss[op[x]["sub_id"]]["name"]=op[x]["sub_name"];
					   $("#d111").append("<input type='button' class='numb' id='"+op[x].sub_id+"' value='"+op[x].sub_name+"'>");
					   //$("#d22").prepend("<span >"+i+"="+op[x].sub_name+"</span>  ");
					   $("#d22>table>tbody").append("<tr><td>"+i+"</td><td>"+op[x].sub_id+"</td><td>"+op[x].sub_name+"</td></tr>");
					   i++;
				   }
				   loadt();
				 }
				 
			 });
			$(document).on('click','.numb',function(){
				var isp=$(this).attr("id");
				var nam=$(this).val();
				alert("n-"+nam+",i="+isp);
			     $.ajax({
					 url:"attendance_page.php",
					 data:{inco:isp,name:nam},
					 type:"post",
					 success:function(msg){
						     var uio=jQuery.parseJSON(msg);
							 alert(uio);
				      		 alert("opening .........attendance");
							 window.open("attendance_page.php","_self");
							 
					 }
				 });
			});
            $.ajax({
				url:"select_test.php",
				data:{ty:"getf"},
				type:"post",
			    success:function(msg){
					var olo=jQuery.parseJSON(msg);
					var ee=0
					for(x in olo){
						ee++;
						if(ee==1){
							$("#d13").append("<table class='table table-borderless'><thead><tr><th>S .No</th><th>Test Name</th></tr></thead><tbody></tbody></table>");
						}
						$("#d13>table>tbody").append("<tr><td>"+ee+"</td><td><input  type='button' data-stat='"+olo[x]["status"]+"' class='bbv btn btn-outline-primary' id='"+olo[x].id+"' value='"+olo[x].test_name+"'></td></tr>");
					}
					
				}
				});
			 $.ajax({
				 url:"select_test.php",
				 type:"post",
				 data:{ty:"mt"},
				 success:function(msg){
					 var np=jQuery.parseJSON(msg);
					// alert("np="+JSON.stringify(np));
					 var rr=0,rt=0;
					 for(z in np){
						 if(np[z].status=="submitted"){
							 rr++;
							 if(rr==1){
								 $("#d34").append("<table class='table table-borderless'><thead><tr><th>S. No</th><th>Test</th></tr></thead><tbody></tbody></table>");
							 }
						   $("#d34>table>tbody").append("<tr><td>"+rr+"</td><td><input type='button' data-stat='"+np[z].status+"' class='tested1 btn btn-outline-primary' id='"+np[z].id+"' name='"+np[z].test_name+"' value='"+np[z].test_name+"'></td></tr>");
						 }
					     else if(np[z].status=="published"){
							 rt++;
							 if(rt==1){
								 $("#d90").append("<table class='table table-borderless'><thead><tr><th>S. No</th><th>Test</th></tr></thead><tbody></tbody></table>")
							 }
						   $("#d90>table>tbody").append("<tr><td>"+rt+"</td><td><input type='button' data-stat='"+np[z].status+"' id='"+np[z].id+"' name='"+np[z].test_name+"' class='ulp btn btn-outline-primary' value='"+np[z].test_name+"'></td></tr>");
						 }
					 } 
				 } 
			 });
			 $(document).on("click","#d34>table>tbody>tr>td>.tested1",function(eve){
				 eve.preventDefault();
				 var stat=$(this).attr("data-stat");
				 var id=$(this).attr("id");
				 var tnm=$(this).val();
				 $.ajax({
					 url:"calculated_tests.php",
					 data:{ty:"old",tid:id,tnm:tnm,status:stat},
					 type:"post",
					 success:function(msg){
						 var tt=jQuery.parseJSON(msg);
						 alert(tt);
						 window.open("calculated_tests.php","_self");
					 }
				 });
			 });
			 $(document).on("click","#d90>table>tbody>tr>td>.ulp",function(eve){
				 eve.preventDefault();
				 var stat=$(this).attr("data-stat");
				 var id=$(this).attr("id");
				 var tnm=$(this).val();
				 $.ajax({
					 url:"ve_test_sub.php",
					 data:{ty:"mt",tid:id,tnm:tnm,stat:stat},
					 type:"post",
					 success:function(msg){
						 
						 window.open("ve_test_sub.php","_self");
					 }
				 });
			 });
			 
				$(document).on('click',"#d13>table>tbody>tr>td>.bbv",function(){
					var id=$(this).attr("id");
					
					var name=$(this).val();
					var stat=$(this).attr("data-stat")
					var ty="nt";
					 
					 alert("test id="+id+"test name="+name);
					$.ajax({
						url:"ve_test_sub.php",
						data:{tid:id,tnm:name,ty:ty,stat:stat},
						type:"post",
						success:function(msg){
							window.open("ve_test_sub.php","_self");
						}
					});
				});			
			$("#b5").click(function(){
				window.open("public_message.php","_self");
			});
			$("#b1").click(function(){
				window.open("add.php","_self");
			});
            $("#b2").click(function(){
				window.open("insert_sub_page.php","_self");
			});	
           $("#b3").click(function(){
				window.open("insert_test_page.php","_self");
			});	
            $("#b4").click(function(){
				window.open("calculated_tests.php","_self");
			});
            $("#b6").click(function(){
				window.open("up_teachers.php","_self");
			});		
            $("#b7").click(function(){
				
			      $.ajax({
					  url:"view_join.php",
					  data:{ty:"teach"},
					  type:"post",
					  success:function(){
						  window.open("view_join.php","_self");
					  }
				  });	
			});	
			$(document).on("click",".nav-link",function(){
				$(".nav-link").removeClass("active");
				$(this).addClass("active");
			});
			
			$("#b8").click(function(){
				
			      $.ajax({
					  url:"view_join.php",
					  data:{ty:"stud"},
					  type:"post",
					  success:function(){
						  window.open("view_join.php","_self");
					  }
				  });	
			});
            $.ajax({
				url:"select_students.php",
				type:"post",
			    data:{},
				success:function(msg){
					var ths=0;
					var tha=jQuery.parseJSON(msg);
					var too="<table class='table table-hover table-striped'><thead><tr><th>S. No. </th><th>Student ID</th><th>Student Name</th><th>Student Email</th><th>Status</th></tr></thead><tbody>"
					for(x in tha){
						ths++;
					    too+="<tr><td>"+ths+"</td><td>"+tha[x]["stud_id"]+"</td><td>"+tha[x]["name"]+"</td><td>"+tha[x]["email"]+"</td><td>"+tha[x]["status"]+"</td></tr>";
					}
					too+="</tbody></table>";
					if(ths>0){
						$("#d88").append(too);
					}
					else{
						$("#d88").append("No students has been added");
					}
				}
			});
			function loadt(){
				$.ajax({
					url:"select_students.php",
					type:"post",
					data:{ty:"teach"},
					success:function(msg){
						var ths=0;
						var tha=jQuery.parseJSON(msg);
						var too="<table class='table table-hover table-striped'><thead><tr><th>S. No. </th><th>Teacher ID</th><th>Teacher's Name</th><th>Teacher's Email</th><th>Subject</th><th>Status</th></tr></thead><tbody>"
						for(x in tha){
							ths++;
							too+="<tr><td>"+ths+"</td><td>"+tha[x]["tid"]+"</td><td>"+tha[x]["tnm"]+"</td><td>"+tha[x]["temail"]+"</td><td>"+subss[tha[x]["sub_id"]]["name"]+"</td><td>"+tha[x]["status"]+"</td></tr>";
						}
						too+="</tbody></table>";
						if(ths>0){
							$("#d12").append(too);
						}
						else{
							$("#d12").append("No Teacher has been added");
						}
					}
				});
			}	
			
		});
	</script>
	<style>
	   span{
		   font-size:bold;
		   font-weight:bold;
	   }
	   body{
		   margin:0px;
	   }
	   .navbar-nav{
		   width:100%;
		   
		   
	   }
	   .navbar-nav,.navbar{
		   margin:0;
	   }
	   .table{
		   width:80%;
	   }
	</style>
	<body>
	     
	   <h1 align="center"><?php echo $_SESSION["name"]; ?> Class's Dashboard</h1>
	   <br>
	   
	   <nav class="navbar navbar-expand-sm bg-light navbar-light">
		  <ul class="navbar-nav">
		    <li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link active" data-toggle="tab" href="#infor">Info</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#students">Students </a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link " data-toggle="tab" href="#teachers">Teachers</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link " data-toggle="tab" href="#sybs">Subjects</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link " data-toggle="tab" href="#">Announcements</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#tests">Tests</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			  <a class="nav-link " data-toggle="tab" href="#otest">Online Tests</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			   <a class="nav-link " data-toggle="tab" href="#attend">Attendance</a>
			</li>
			<li class="nav-item col d-flex justify-content-center">
			   <a class="nav-link" data-toggle="tab" href="#msgs">Messages</a>
			</li>
		  </ul>
		</nav>
        
	   
	   
	   
	   
	   
	   
	   <div class="container tab-content" id="tdata">
	       <div id="students" class="tab-pane container fade"> 
		      <h3 class="d-flex justify-content-center">Students of class:-</h3>
			  <div><input type="button" id="b8" class='btn btn-primary' value="Edit Students">
			       <input type="button" id="b1" class="btn btn-outline-primary" value="Add more Students">
			  </div>
			  <br>
			  <div id='d88' class='d-flex justify-content-center'>
			     
			  </div>
		   </div>
		   <div id="teachers" class="tab-pane container fade">
		      <h3>Teachers of class-</h3>
			  <div><input type="button" id="b7" class='btn btn-primary' value="Edit Teachers">
			       <input type="button" id="b6" class="btn btn-outline-primary" value="Add Teachers">
			  </div>
			  <br>
			  <div id='d12' class='d-flex justify-content-center'>
			  
			  
			  </div>
		   </div>
	       <div id="sybs" class="tab-pane container fade">
		      <h3 align='center'>Subjects Of Class</h3><br><br>
			  <div class='d-flex justify-content-end'>
			    <input type="button" id="b2" class='btn btn-primary' value="Add Subjects">
			  </div>
              <br></br>			  
			  <div id="d22" class='d-flex justify-content-center'>
			    <table class='table table-striped table-hover'>
				   <thead>
				      <tr>
					     <th>S. No.</th>
					     <th>Subject id</th>
						 <th>Subject Name</th>
					  </tr>
				   </thead>
				   <tbody>
				   
				   </tbody>
				</table>
			  </div>
			  
		   </div>
		   <div id="tests" class="tab-pane container fade">
		       <h3>Tests of Class</h3>
			   <div class='d-flex justify-content-end'>
			  <input type="button" id="b3" class='btn btn-success' value="Add More test"></div>
			  <div id="d13">
			      
			  </div><br><br>
			  
			
			  <h3>Formulated tests</h3>
			  <div class='d-flex justify-content-end'><input type="button" id="b4" class='btn btn-success' value="Make new Tests From old test"></input></div>
			  <div id="d34">
			      
			  </div>
			  <br>
			  <h3>Formulated Tests live</h3>
			  <div id='d90'>
			  </div>
			  <br>
			  
		   </div >
		   <div id="otest" class="tab-pane container fade"> 
		      <h3>Tests In class-</h3>
			  <div>
			      To be added....
			  </div>
			  <!--<input type="button" value="Make Tests">-->
		   </div>
		  
		   <div id="attend" class="tab-pane container fade">
		      <h3>Attendance Of Students Subject wise</h3>
			  <div id="d111"></div>
			  
		   </div>
		      
		   <div id="msgs" class="tab-pane container fade">
		       <h4 align='center'>Messages in this group</h4>
			   <br><br>
		 	   <!--<input id="b5" type="button" value="Messages"/>-->
		       <?php include 'select_chats.php'; ?>	   
		   </div>	   
			<div id="infor" class="tab-pane container active">
			<br></br>
			   <div class='d-flex justify-content-center'>
			        <table class="table table-borderless">
					   <tbody>
					      <tr><th>Institute</th><td><?php echo $_SESSION["institute"]; ?></td><td><i class='far fa-edit text-primary' style='font-size:36px'></i></td></tr>
					      <tr><th>Class ID</th><td><?php echo $_SESSION["id"];?></td><td></td><tr>
						  <tr><th>Class Name</th><td><?php echo $_SESSION["name"]; ?></td><td><i class='far fa-edit text-primary' style='font-size:36px'></i></td><tr>
						  <tr><th>Session</th><td><?php echo $_SESSION["sess"]; ?></td><td><i class='far fa-edit text-primary' style='font-size:36px'></i></td></tr>
						  <tr><th>Creation Date</th><td><?php echo $_SESSION["cdate"]?></td></tr>
						  <tr><th>Your ID</th><td><?php echo $_SESSION["uid"]; ?></td><td></td><tr>
						  <tr><th>Your Name</th><td><?php echo $_SESSION["u-name"]; ?></td><td></td><tr>
						  <tr><th>Your Designation</th><td><?php echo $_SESSION["designate"]; ?></td><tr>
					   </tbody>
					</table>
			        </div>
					<!--<p>Class id=<?php #echo $_SESSION["id"];?></p>
					<p>Class Name=<?php #echo $_SESSION["name"]; ?></p>
					<p>User ID=<?php #echo $_SESSION["uid"]; ?><br>
					<p>User Name=<?php #echo $_SESSION["u-name"]; ?><br>
					<p>Designation=<?php #echo $_SESSION["designate"]; ?><br>-->
					
			</div>
		</div>
	</body>
</html>