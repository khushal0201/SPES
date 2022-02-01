<?php
  session_start();
  $_SESSION["tty"]="";
  if(isset($_POST["des"])){
	  $_SESSION["designate"]=$_POST["des"];
  }
  //$_SESSION["designate"]="s";
  else if($_SESSION["designate"]=="s"){
?>
<!Doctype html>
<html>
    <head>
	  <title><?php echo $_SESSION["pnm"]; ?> Student's class main page</title>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	  
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>
	</head>
	<script>
	    $(document).ready(function(){
			alert(<?php $_SESSION["pnm"]; ?>);
			var subs1={};
			var teach1={};
		     $.ajax({
				 url:"select_sub.php",
				 type:"post",
				 data:{},
				 success:function(msg){
					 var i=1;
					  
					 var op=jQuery.parseJSON(msg);
					//alert("Dont consider this="+JSON.stringify(op));
					 for(x in op){
					   subs1[op[x].sub_id]=op[x].sub_name;
					   $("#d111").append("<input type='button' class='numb' id='"+op[x].sub_id+"' value='"+op[x].sub_name+"'>");
					   //$("#d22").prepend("<span >"+i+"="+op[x].sub_name+"</span>  ");
					   i++;
				   }
				 }
				 
			 });
			 $.ajax({
				 url:"select_test.php",
				 type:"post",
				 data:{},
				 success:function(msg){
					 var np=jQuery.parseJSON(msg);
					   var ee=0;
					 for(z in np){
						  ee++;
						 if(ee==1){
							$("#d33").append("<table class='table table-borderless'><thead><tr><th>S .No</th><th>Test Name</th></tr></thead><tbody></tbody></table>");
						 }
						 $("#d33>table>tbody").append("<tr><td>"+ee+"</td><td><input type='button' class='tested btn btn-outline-primary' id='"+np[z].id+"' data-tmrk='"+np[z]["test_mark"]+"' name='"+np[z].test_name+"' value='"+np[z].test_name+"'></td></tr>");
					 }
				 }
			 });
			 $.ajax({
				 url:"select_test.php",
				 type:"post",
				 data:{ty:"mt"},
				 success:function(msg){
					 var np=jQuery.parseJSON(msg);
                      var rr=0;					
					for(z in np){
						 rr++;
						 if(rr==1){
							 $("#d34").append("<table class='table table-borderless'><thead><tr><th>S. No</th><th>Test</th></tr></thead><tbody></tbody></table>");
						 }
						 $("#d34>table>tbody").append("<tr><td>"+rr+"</td><td><input type='button' class='tested1 btn btn-outline-primary' id='"+np[z].id+"' data-tmrk='"+np[z]["test_mark"]+"' name='"+np[z].test_name+"' value='"+np[z].test_name+"'></td></tr>");
					 } 
				 } 
			 });
			  $.ajax({
				   url:"select_students.php",
				   data:{ty:"teach"},
				   type:"post",
				   success:function(msg){
					   var dats=jQuery.parseJSON(msg);
				       for(x in dats){

						   teach1[dats[x].tid]={};
						   teach1[dats[x].tid]["name"]=dats[x].tnm;
					       teach1[dats[x].tid]["sub"]=subs1[dats[x].sub_id];
					   }
					   themt();
				   }
			  }); 
			  var errs={};
			  errs["0"]="Done";
			  errs["1"]="Error: not started yet";
			  
			 function themt(){ 
				$.ajax({
					 url:"create_test_entry.php",
					 data:{ty:"fett",who:"stud"},
					 type:"post",
					 success:function(msg){
						 var ar=jQuery.parseJSON(msg);
						// alert("ar="+ar);
						 for(x in ar){
							 if(ar[x]["status"]=="publish")
							   $("#d55").append("<input class='tttt' data-id='"+ar[x].id+"' data-tnm='"+ar[x].test_name+"' type='button' value='"+ar[x].test_name+" Created By Teacher="+teach1[ar[x].teacher_id]["name"]+" of Subject="+teach1[ar[x].teacher_id]["sub"]+"'> Scheduled For: Date="+ar[x].test_date+" Time="+ar[x].test_time+" <br>");
						     else if(ar[x]["status"]=="live")
							   $("#d89").append("<input class='tttt' data-id='"+ar[x].id+"' data-tnm='"+ar[x].test_name+"' type='button' value='"+ar[x].test_name+" Created By Teacher="+teach1[ar[x].teacher_id]["name"]+" of Subject="+teach1[ar[x].teacher_id]["sub"]+"'> Scheduled For: Date="+ar[x].test_date+" Time="+ar[x].test_time+" <br>"); 
						     else if(ar[x]["status"]=="done")
							   $("#d67").append("<input class='tttt' data-id='"+ar[x].id+"' data-tnm='"+ar[x].test_name+"' type='button' value='"+ar[x].test_name+" Created By Teacher="+teach1[ar[x].teacher_id]["name"]+" of Subject="+teach1[ar[x].teacher_id]["sub"]+"'> Scheduled For: Date="+ar[x].test_date+" Time="+ar[x].test_time+" <br>"); 
						     else
							   $("#d99").append("<input class='tttt' data-id='"+ar[x].id+"' data-tnm='"+ar[x].test_name+"' type='button' value='"+ar[x].test_name+" Created By Teacher="+teach1[ar[x].teacher_id]["name"]+" of Subject="+teach1[ar[x].teacher_id]["sub"]+"'> Scheduled For: Date="+ar[x].test_date+" Time="+ar[x].test_time+" <br>"); 
						 }
					 }
				 });
			 }
			 function fuls(){
				 
				  document.documentElement.requestFullscreen();
				  return false;
			      /* if(document.fullscreenEnabled)
					alert('Full screen is available');
				else
					alert('Full screen is not available');
				    var full_screen_element = document.fullscreenElement;
	
					if(full_screen_element !== null)
						alert('FullScreen mode is activated');
					else
						alert('FullScreen mode is not activated');
					 
				  //$(document.documentElement).fullscreen();*/
			 }
			 function testg(ele){
				
                 var tidd=$(ele).attr("data-id");
				 var gtnm=$(ele).attr("data-tnm");
				 
				  alert("doug");
				  alert("gus");
                 $.ajax({
					 url:"create_test_entry.php",
					 type:"post",
					 data:{ty:"qqq",gtid:tidd},
					 success:function(msg){
						 var ttoo=jQuery.parseJSON(msg);
						 if(ttoo[0]=="0"){
							 funnn(tidd,gtnm);
						 }
						 else if(ttoo[0]=="1"){
							 alert(errs[ttoo[0]]);
							 return false;
						 }
					 } 
				 });				  
				  
				 function funnn(tidd,gtnm){
					 $.ajax({
						 url:"give_test.php",
						 data:{ty:"set",gtid:tidd,gtnm:gtnm},
						 type:"post",
						 success:function(msg){
							 var mss=jQuery.parseJSON(msg);
							 alert("it is="+mss);
							 window.open("give_test.php","_self");
						 }
					 });			
				 }					 
			 }
			 $(document).on('click','.tttt',function(e){
				 e.preventDefault();
				  //fuls();
				  testg(this);
				
			 });
			 $(document).on('click','.numb',function(){
				 var id=$(this).attr("id");
				 var nam=$(this).val();
				 $.ajax({
					 url:"attendance_page_stud.php",
					 data:{inco:id,name:nam},
					 type:"post",
					 success:function(){
				      	 alert("opening .........attendance");
						 window.open("attendance_page_stud.php","_self");
							 
					 }
				 });
			 });
			 $(document).on('click','.tested,.tested1',function(){
				 var id=$(this).attr("id");
				 var name=$(this).attr("name");
				 var ty="nt";
				 if($(this).hasClass("tested1"))
					 ty="mt";
				 $.ajax({
					 url:"set_test.php",
					 data:{name:name,id:id,ty:ty},
					 type:"post",
					 success:function(msg){
						 window.open("stud_test.php","_self");
						 
					 }
				 });
			 });
            $("#b2").click(function(){
				window.open("insert_sub_page.php","_self");
			});	
           $("#b3").click(function(){
				window.open("insert_test_page.php","_self");
			});	
           $("#b4").click(function(){
			   window.open("public_message.php","_self");
		   });	
           $(document).on("click","ul>li",function(){
			    $("ul>.active,ul>li>.active").removeClass("active");
				$(this).closest("li").addClass("active")
		   });
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
					   
					   //$("#d22").prepend("<span >"+i+"="+op[x].sub_name+"</span>  ");
					   $("#d122>table>tbody").append("<tr><td>"+i+"</td><td>"+op[x].sub_id+"</td><td>"+op[x].sub_name+"</td></tr>");
					   i++;
				   }
				   if(i==0){
					   $("#d122").html("No subject has been added");
				   }
				   loadt();
				 }
				 
			 });
			 $.ajax({
						url:"select_students.php",
						type:"post",
						data:{},
						success:function(msg){
							var ths=0;
							var tha=jQuery.parseJSON(msg);
							var too="<table class='table table-hover table-striped'><thead><tr><th>S. No. </th><th>Student Name</th><th>Status</th></tr></thead><tbody>"
							for(x in tha){
								ths++;
								too+="<tr><td>"+ths+"</td><td>"+tha[x]["name"]+"</td><td>"+tha[x]["status"]+"</td></tr>";
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
						var too="<table class='table table-hover table-striped'><thead><tr><th>S. No. </th><th>Teacher's Name</th><th>Subject</th><th>Status</th></tr></thead><tbody>"
						for(x in tha){
							ths++;
							too+="<tr><td>"+ths+"</td><td>"+tha[x]["tnm"]+"</td><td>"+subss[tha[x]["sub_id"]]["name"]+"</td><td>"+tha[x]["status"]+"</td></tr>";
						}
						too+="</tbody></table>";
						if(ths>0){
							$("#d12").append(too);
						}
						else{
							$("#d12").append("No students has been added");
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
	   .navbar-nav{
		   width:100%;
	   }
	   .table{
		   width:70%;
	   }
	</style>
	<body>
	   <h1 align="center"><?php echo $_SESSION["name"]; ?> Class's Dashboard</h1>
	   <br><br>
	   <nav class="navbar navbar-expand-sm bg-light navbar-light">
		  <ul class="navbar-nav d-flex">
		    <li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link active" data-toggle="tab" href="#infor">Info</a>
			</li>
			<li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#teachss">Teachers</a>
			</li>
			<li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#studss">Students</a>
			</li>
			<li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#subb3">Subjects Of Class</a>
			</li>
			<li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#pates">Tests</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#annu1">Announcements</a>
			</li>
			<!-- <li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#ontest">Online Tests hello</a>
			</li> -->
			<li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#attte">Attendance</a>
			</li>
			<li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link" data-toggle="tab" href="#msgg">Messages</a>
			</li>
		  </ul>
		</nav>
	   
	   
	   <div class="tab-content">
	       <!--<div> 
		      <h3>Students of class-</h3>
			  <div><input type="button" value="View Students">
			       <input type="button" id="b1" value="Add more Students">
			  </div>
		   </div>-->
	       <div class="tab-pane container" id='subb3'>
		      <h3>Subjects Of Class-</h3>
			  <br>
			  <div id="d122" class='d-flex justify-content-center'>
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
		   <div class="tab-pane container fade" id="pates">
			   <div>
				  <h3>Tests of Class-</h3>
				  <div id="d33">
				  </div>
			   </div>
			   <div>
				  <h3>Tests Made from old</h3>
				  <div id="d34">
					
				  </div>
			   </div>
			</div>  
           <div class="tab-pane container fade" id='teachss'>
		      <h3 align='center'>Teachers</h3>
			   <br>
			   <div id='d12' class='d-flex justify-content-center'>
			  
			  
			   </div>
		   </div>
           <div class="tab-pane container fade" id='studss'>
		      <h3 align='center'>Students</h3>
			   <div id='d88' class='d-flex justify-content-center'>
			     
			  </div>
		   </div>		   
		   <div class="tab-pane container fade" id='annu1'>
		      <h3 align='center'>Announcements</h3>
		   </div>
		   <div class="tab-pane container fade" id='ontest'> 
		      <h3>Upcoming Tests in the Class-</h3>
			  <div id="d55">
			  </div>
			  <h3>Ongoing Tests</h3>
			  <div id='d89'>
			  </div>
			  <h3>Tests Unchecked</h3>
			  <div id='d67'>
			  </div>
			  <h3>Tests Checked</h3>
			  <div id='d99'>
			  </div>
		   </div>
		   <div class="tab-pane container fade" id='attte'>
		      <h3>Attendance Of Students Subject wise</h3>
			  <div id="d111"></div>
			  
		   </div>
		      
		   <div class="tab-pane container fade" id='msgg'>
		       <h3>Group Messages in Class</h3>
			  <!-- <input id="b4" type="button" value="Messages"/>-->
			   <?php include 'select_chats.php'; ?>
		   </div>
		   	<div id="infor" class="tab-pane container active" ><!--style="width:200px;border:2px solid black;position:absolute;top:130px;right:0px;"-->
			     <br><br>
				<div class='d-flex justify-content-center'>
			        <table class="table table-borderless">
					   <tbody>
					      <tr><th>Institute</th><td><?php echo $_SESSION["institute"]; ?></td></tr>
					      <tr><th>Class ID</th><td><?php echo $_SESSION["id"];?></td><tr>
						  <tr><th>Class Name</th><td><?php echo $_SESSION["name"]; ?></td><tr>
						  <tr><th>Session</th><td><?php echo $_SESSION["sess"]; ?></td></tr>
						  <tr><th>Creator</th><td><?php echo $_SESSION["crea"]; ?></td></tr>
						  <tr><th>Creation Date</th><td><?php echo $_SESSION["cdate"]; ?></td></tr>
						  <tr><th>Your ID</th><td><?php echo $_SESSION["pid"]; ?></td><tr>
						  <tr><th>Your Name</th><td><?php echo $_SESSION["pnm"]; ?></td><tr>
						  <tr><th>Your Designation</th><td><?php echo $_SESSION["designate"]; ?></td><tr>
					   </tbody>
					</table>
				   </div>	
			
				<p>Class id=<?php echo $_SESSION["id"];?></p>
				<p>Class Name=<?php echo $_SESSION["name"]; ?></p>
				<p>Student id=<?php echo $_SESSION["pid"]; ?></p>
				<p>Student Name=<?php echo $_SESSION["pnm"]; ?></p>
			</div>
		</div>
	</body>
</html>
<?php
  }
  else{
?>  
<!doctype html>
<html>
   <head>
       <title><?php echo $_SESSION["pnm"]; ?>Teacher of class</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>
   </head>
   <script>
        $(document).ready(function(){
			$("#b21").click(function(){
				$.ajax({
					url:"view_join.php",
					type:"post",
					data:{ty:"stud"},
					success:function(){
						window.open("view_join.php","_self");
					}
				});
								
			});
			$.ajax({
				url:"select_test.php",
				data:{ty:"getf"},
				type:"post",
			    success:function(msg){
					var olo=jQuery.parseJSON(msg);
					var ee=0;
					for(x in olo){
						ee++;
						if(ee==1){
							$("#d13").append("<table class='table table-borderless'><thead><tr><th>S .No</th><th>Test Name</th></tr></thead><tbody></tbody></table>");
						}
						$("#d13>table>tbody").append("<tr><td>"+ee+"</td><td><input type='button' data-tmr='"+olo[x]["total_mark"]+"' class='bbv btn btn-outline-primary' id='"+olo[x].id+"' value='"+olo[x].test_name+"'></td></tr>");
					}
				}
				});
			 $.ajax({
				 url:"select_test.php",
				 type:"post",
				 data:{ty:"mt"},
				 success:function(msg){
					 var np=jQuery.parseJSON(msg);
                     var rr=0;					
					for(z in np){
						 rr++;
							 if(rr==1){
								 $("#d34").append("<table class='table table-borderless'><thead><tr><th>S. No</th><th>Test</th></tr></thead><tbody></tbody></table>");
						}
						$("#d34>table>tbody").append("<tr><td>"+rr+"</td><td><input type='button' class='tested1 btn btn-outline-primary' id='"+np[z].id+"' name='"+np[z].test_name+"' value='"+np[z].test_name+"'></td></tr>");
					 } 
				 } 
			 });
			  $.ajax({
				 url:"create_test_entry.php",
				 data:{ty:"fett"},
				 type:"post",
				 success:function(msg){
					 var ar=jQuery.parseJSON(msg);
					 for(x in ar){
						 if(ar[x].status=="draft")
						   $("#d44").append("<input class='tttt' data-mark='"+ar[x]["test_mark"]+"' data-id='"+ar[x].id+"' data-sus='"+ar[x].status+"' type='button' value='"+ar[x].test_name+"'>");
					     else if(ar[x].status=="checked")
						   $("#d48").append("<input class='tttt' data-mark='"+ar[x]["test_mark"]+"' data-id='"+ar[x].id+"' data-sus='"+ar[x].status+"' type='button' value='"+ar[x].test_name+"'>");
						 else if(ar[x].status=="live")
						   $("#d70").append("<input class='tttt' data-mark='"+ar[x]["test_mark"]+"' data-id='"+ar[x].id+"' data-sus='"+ar[x].status+"' type='button' value='"+ar[x].test_name+"'>");
					     else if(ar[x].status=="done"){
						   $("#d72").append("<input class='tttt' data-mark='"+ar[x]["test_mark"]+"' data-id='"+ar[x].id+"' data-sus='"+ar[x].status+"' type='button' value='"+ar[x].test_name+"'>"); 
						 }
						 else{
							 $("#d46").append("<input class='tttt' data-mark='"+ar[x]["test_mark"]+"' data-id='"+ar[x].id+"' data-sus='"+ar[x].status+"' type='button' value='"+ar[x].test_name+"'>");
						 }
					 }
				 }
			 });
			 $(document).on("click","#d48 >.tttt,#d72>.tttt,#d70>.tttt",function(event){
				 event.preventDefault();
				 var gtid=$(this).attr("data-id");
				 var stat=$(this).attr("data-sus");
				 var gtnm=$(this).val();
				 alert("id="+gtid);
				 $.ajax({
					 url:"see_resp.php",
					 data:{ty:"set",gtid:gtid,gtnm:gtnm,stat:stat},
					 type:"post",
					 success:function(msg){
						 var zx=jQuery.parseJSON(msg);
						 alert(zx);
						 window.open("see_resp.php","_self");
					 }
				 });
				 
			 });
			 $(document).on('click','#d46 >.tttt,#d44 > .tttt',function(){
				 var tidi=$(this).attr("data-id");
				 var tinm=$(this).val();
				 var status=$(this).attr("data-sus");
				 var tmrk=$(this).attr("data_mark");
				 if(tmrk==''){
					 tmrk=0;
				 }
				 alert("tmr="+tmrk);
				 $.ajax({
					 url:"create_test.php",
					 data:{ty:"old",otid:tidi,otin:tinm,status:status,tmrk:tmrk},
					 type:"post",
					 success:function(msg){
						 alert("msg="+msg);
						 window.open("create_test.php","_self");
					 }
				 });
			 });
				$(document).on('click',"#d13>table>tbody>tr>td>.bbv,.tested1 ",function(){
					var id=$(this).attr("id");
					
					var name=$(this).val();
					var ty="nt";
					var tmr=$(this).attr("data-tmr");
					 if($(this).hasClass("tested1"))
					    ty="mt";
					$.ajax({
						url:"ve_test_sub.php",
						data:{tid:id,tnm:name,ty:ty,tmr:tmr},
						type:"post",
						success:function(msg){
							//var tt=jQuery.parseJSON(msg);
							//alert(tt);
							window.open("ve_test_sub.php","_self");
						}
					});
				});
				$("#at1").click(function(){
					window.open("attendance_page.php","_self");
		        });
				$("#bms").click(function(){
					window.open("public_message.php","_self");
				});
				$("#b55").click(function(){
					window.open("create_test.php","_self");
				});
				$(document).on("click",".nav-link",function(){
					$(".nav-link").removeClass("active");
					$(this).addClass("active")
				});
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
						   
						   //$("#d22").prepend("<span >"+i+"="+op[x].sub_name+"</span>  ");
						   $("#d122>table>tbody").append("<tr><td>"+i+"</td><td>"+op[x].sub_id+"</td><td>"+op[x].sub_name+"</td></tr>");
						   i++;
					   }
					   if(i==0){
					   $("#d122").html("No subject has been added");
				       }
					   loadt();
					 }
					 
			      });
				  $.ajax({
						url:"select_students.php",
						type:"post",
						data:{},
						success:function(msg){
							var ths=0;
							var tha=jQuery.parseJSON(msg);
							var too="<table class='table table-hover table-striped'><thead><tr><th>S. No. </th><th>Student Name</th><th>Status</th></tr></thead><tbody>"
							for(x in tha){
								ths++;
								too+="<tr><td>"+ths+"</td><td>"+tha[x]["name"]+"</td><td>"+tha[x]["status"]+"</td></tr>";
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
							var too="<table class='table table-hover table-striped'><thead><tr><th>S. No. </th><th>Teacher's Name</th><th>Subject</th><th>Status</th></tr></thead><tbody>"
							for(x in tha){
								ths++;
								too+="<tr><td>"+ths+"</td><td>"+tha[x]["tnm"]+"</td><td>"+subss[tha[x]["sub_id"]]["name"]+"</td><td>"+tha[x]["status"]+"</td></tr>";
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
       .navbar-nav{
		   width:100%;
	   }
	   .table{
		   width:70%;
	   }
   </style>
   <body>
        <h1 align="center"><?php echo $_SESSION["name"]; ?> Class's Dashboard</h1>
		<br><br>
		<nav class="navbar navbar-expand-sm bg-light navbar-light">
		  <ul class="d-flex navbar-nav">
		     <li class="nav-item flex-fill d-flex justify-content-center">
			  <a class="nav-link active" data-toggle="tab" href="#infor">Info</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#stdd">Students</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#dts">Teachers</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#surbs">Subjects</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#mrko">Tests</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#annu">Announcements</a>
			</li>
			<!-- <li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#tsst">Online Tests</a>
			</li> -->
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#antid">Attendance</a>
			</li>
			<li class="d-flex justify-content-center nav-item flex-fill">
			  <a class="nav-link" data-toggle="tab" href="#mssd">Messages</a>
			</li>
		  </ul>
		</nav>
		
		
		<div class="tab-content">	
			<div class="tab-pane container fade" id='stdd'>
			   <h3>View Students in Class:</h3>
			   <br>
			    <div id='d88' class='d-flex justify-content-center'>
			     
			    </div>
			</div>
			<div class="tab-pane container fade" id='mrko'>
				<div >
				   <h3>Add/View marks Of tests</h3>
				   <div id="d13" class='d-flex justify-content-center'>
				   </div>
				</div>
				<div >
				   <h3>View marks of Made up test</h3>
				   <div id="d34" class='d-flex justify-content-center'>
				   </div>
				</div>
			</div>
			<div id="annu" class="tab-pane container fade">
			   <h3 align="center">Class Announcements</h3><br>
			   <input type="button" value="Make Anew Announcement">
			</div>
			<div id="dts" class="tab-pane container fade">
			   <h3 align='center'>Teachers</h3>
			   <br>
			   <div id='d12' class='d-flex justify-content-center'>
			  
			  
			   </div>
			</div>
			<div id="surbs" class="tab-pane container fade">
			      <h3 align='center'>Subjects</h3>
				  <br>
				  <div id="d122" class='d-flex justify-content-center'>
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
			<div class="tab-pane container fade" id='antid'>
				<h3>Attendance</h3>
				<input type="button" class='btn btn-primary' id="at1" value="Mark Attendance of Students">
			</div>
			<div class="tab-pane container fade" id='mssd'>
				 <h3>Messaging</h3>
				<!-- <input type="button" id="bms" value="Open Messages"/>-->
				 <?php include 'select_chats.php'; ?>
			</div>
			<div class="tab-pane container fade" id='tsst'>
				<h3>Conduct an Online test</h3>
				<h3>Tessts  Made by you</h3>
				<div id="d44">
				   
				</div><br><br>
				<h3>Tests Scheduled</h3>
				<div id="d46">
				
				</div>
				<h3>Tests Live</h3>
				<div id='d70'>
				</div>
				<h3>Tests Unchecked</h3>
				<div id='d72'>
				</div>
				<h3>Tests Checked</h3>
				<div id="d48">
				
				</div>
				<h3>Make a new test already:-</h3>
				<input type="button"  id="b55" value="Make tests">
			</div>
			 <div id="infor" class="tab-pane container active"><!--style="width:200px;border:2px solid black;position:absolute;top:130px;right:0px;"--> 
				  <br><br>
				  <div class='d-flex justify-content-center'>
			        <table class="table table-borderless">
					   <tbody>
					      <tr><th>Institute</th><td><?php echo $_SESSION["institute"]; ?></td></tr>
					      <tr><th>Class ID</th><td><?php echo $_SESSION["id"];?></td><tr>
						  <tr><th>Class Name</th><td><?php echo $_SESSION["name"]; ?></td><tr>
						  <tr><th>Session</th><td><?php echo $_SESSION["sess"]; ?></td></tr>
						  <tr><th>Creator</th><td><?php echo $_SESSION["crea"]; ?></td></tr>
						  <tr><th>Creation Date</th><td><?php echo $_SESSION["cdate"]; ?></td></tr>
						  <tr><th>Your ID</th><td><?php echo $_SESSION["pid"]; ?></td><tr>
						  <tr><th>Your Name</th><td><?php echo $_SESSION["pnm"]; ?></td><tr>
						  <tr><th>Your Designation</th><td><?php echo $_SESSION["designate"]; ?></td><tr>
						  <tr><th>Your Subject ID</th><td><?php echo $_SESSION["subs"]; ?></td><tr>
						  <tr><th>Your Subject Name</th><td><?php echo $_SESSION["sub_name"]; ?></td><tr>
					   </tbody>
					</table>
				   </div>	
				
				<p>Class id=<?php echo $_SESSION["id"];?></p>
				<p>Class Name=<?php echo $_SESSION["name"]; ?></p>
				<p>Teacher id=<?php echo $_SESSION["pid"]; ?></p>
				<p>Teacher Name=<?php echo $_SESSION["pnm"]; ?></p>
				<p>Teacher's Subject Name=<?php echo $_SESSION["sub_name"]; ?></p>
			</div>
		 </div>	
   </body>
</html>
<?php
  } 
 ?> 