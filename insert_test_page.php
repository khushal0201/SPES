<?php 
 session_start();
?>
<!doctype html>
<html style="height:100%;">
   <head>
       <title>Insert Test </title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <script>
      $(document).ready(function(){
          var xp,op,subs="";		 
		 $.ajax({
			  url:"select_sub.php",
			  data:{},
			  type:"post",
			  success:function(msg){
				  xp=jQuery.parseJSON(msg);
				  //alert(JSON.stringify(xp));
				
				  var i=0;
				  //alert(JSON.stringify(xp));
				  for(x in xp){
				  var ss=xp[x].sub_name;
				  //alert(ss);
			      subs+="<th>"+ss+"</th>";
			      
		          i++;
			 
		         } 
			  }
		  });
		 /* $.ajax({
			  url:"select_students.php",
			  type:"post",
			  data:{},
			  success:function(msg){
				  op=jQuery.parseJSON(msg);
				  //alert(JSON.stringify(op));
				  alert(subs);
				  var tab="<table><tr><th>Student-ID</th><th>Student Name</th>"+subs+"</tr>";
				  //var tab="<table>";
					 for(x in op){
						 var ins="";
						 var name=op[x].name;
						 var id=op[x].stud_id;
						 tab+="<tr><td>"+id+"</td><td>"+name+"</td>";
						 for(j in xp){
						   var ss=xp[j].sub_name;
						   ins+="<td><input type='number' id='"+id+"-"+ss+"' name='"+id+"-"+ss+"'></td>";
						 } 
						 tab+=ins+"</tr>";
					 }
					 tab+="</table>";
					 $("#stud_mark").html(tab);
			  }
		  });*/
		  // var subs,ins;
		  // var i=0;
		  // alert(JSON.stringify(xp));
		 // for(x in xp){
			 // var ss=xp[x].sub_name;
			 // subs+="<th>"+ss+"</th>";
			 
		     // i++;
			 
		 // } 
		 // var tab="<table><tr><th>Student-ID</th><th>Student Name</th>"+subs+"</tr>";
		 // for(x in op){
			 // var name=op[x].name;
			 // var id=op[x].id;
			 // tab+="<tr><td>"+id+"</td><td>"+name+"</td>";
			 // for(j in xp){
			   // var ss=xp[j].sub_name;
			   // ins+="<td><input type='number' id='"+id+"-"+ss+"' name='"+id+"-"+ss+"'></td>";
			 // } 
			 // tab+=ins+"</tr>";
		 // }
		 // tab+="</table>";
		 // $("#stud_mark").html(tab);
		 
		 
		  $("#frm1").submit(function(event){
			  event.preventDefault();
			 $("#evch").val($("#name1").val());
			 $("#subfrm2").prop("disabled",false);
			  var oi=$(this).serializeArray().reduce(function(obj,item){
				  obj[item.name]=item.value;
				  return obj;
			  },{});
			 
			 $.ajax({
				 url:"insert_test.php",
				 type:"post",
				 data:{ty:"ins",oi},
				 success:function(msg){
					 var rec=jQuery.parseJSON(msg);
					 alert("lenght:"+rec.length+",data="+rec);
					 window.open("ClassmPageCreator.php","_self")
					 
					 
				 }
			 });
		  });
		  
		  $(document).on("click",".seel",function(){
			  
			  if($(this).attr("data-id")=="ya"){
				  $("#d14").css("display","block"); 
                  $("#tta").val($("#name1").val());				  
			  }
			  else{
				  window.open("ClassmPageCreator.php","_self");
			  }
		  });
		  
		  $(document).on("click","#b22",function(eve){
			  event.preventDefault();
			  var val=$("#tta").val();
			  $.ajax({
				  url:"insert_test.php",
				  data:{ty:"ann",val:val},
				  type:"post",
				  success:function(msg){
					  var www=jQuery.parseJSON(msg);
					  alert(www);
				  }
				  
			  });
		  });
		  
		  /*$("#frm2").submit(function(event){
			  event.preventDefault();
			  var oi=$(this).serialize();
			 $.ajax({
				 url:"insert_test_result.php",
				 type:"post",
				 data:oi,
				 success:function(msg){
					 var rec=jQuery.parseJSON(msg);
					 alert("lenght:"+rec.length+",data="+rec);
					 window.open("ClassmPageCreator.php","_self");
				 }
			 });
		  });*/
		  
	  });
	  
   </script>
   <style>
	   #frm1{
		   position:relative;
		   
		   border:3px solid black;
		   padding:50px;
		   
	   }
	   
	   table,tr,th,td{
		   border-collapse:collapse;
		  
		   border:5px solid black;
	   }
	   table{
		    width:50%;
		
	   }
	   #frm2{
		   position:relative;
		 
		   
		   min-width:50%;
		   border:3px solid black;
		   padding:50px;
	   }
	   #d14,#d15{
		   display:none;
	   }
	</style>
   <body style="height:100%;">
      <h1 align="center"><?php echo $_SESSION["name"];?> Class Students's Tests and marks</h1>
	  <br><br><br><br>
	  <div class='d-flex justify-content-center'>
		  <form id="frm1" class='was-validated'>
			<div id="d12"> 
			 
			 <h3>Enter the Test Name:</h3>
			 <input type="text" class='form-control' id="name1" name="name1" required><br>
			 <h3>Enter Total mark of Test:</h3>
			 <input type="number" class='form-control' name="mark" required>
			</div><br>
			<input type="submit" class='btn btn-primary btn-block' value="submit">
			
		  </form>
	  </div>
	  <div id="d14">
	      <h3>Make an Announcement about test?</h3>
		  <input type='button' data-id='ya' value='Yes'>
		  <input type='button' data-id='na' value='No'>
		  <div id='d15'>
			  <textarea id='tta'>
				 
			  </textarea>
			  <input type='button' id='b22' value='Create Announcement'>
		  </div>	  
	  </div>
	  
	  <div id="infor" style="width:200px;border:2px solid black;position:absolute;top:130px;right:0px;">
		    <p>Class id=<?php echo $_SESSION["id"]?></p>
		    <p>Class Name=<?php echo $_SESSION["name"] ?></p>
		</div>
		<br><br>
    <!--<form id="frm2">	
	  <input type="text" value="tbd" id="evch" name="test" style="display:none;">
       <input type="submit" id="subfrm2" value="Save the data" disabled="disabled">	
	  <div id="stud_mark">
      </div>
     </form>-->
     <h3 align="center" style="position:bottom:10px;">2021 All Rights Reserved</h3>	 
   </body>
</html>