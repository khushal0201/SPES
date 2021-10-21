<?php
  session_start();
  if(isset($_POST["ty"])){
	  $_SESSION["noo"]=$_POST["ty"];
	  if($_POST["ty"]=="old"){
		  $_SESSION["noo"]=$_POST["ty"];
		  $_SESSION["status"]=$_POST["status"];
		  $_SESSION["test_id"]=$_POST["tid"];
		  $_SESSION["test_n"]=$_POST["tnm"];
		  echo json_encode("tid=".$_SESSION["test_id"]);
	  }
	  
  }
  else if(isset($_SESSION["noo"])){
        if($_SESSION["noo"]=="old"){
?>
<!doctype html>
<html>
    <head>
	   <title>Saved/Published Test</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<script>
	 $(document).ready(function(){
		  var tst={};
	   $.ajax({
		   url:"select_test.php",
		   data:{ty:"subn"},
		   type:"post",
		   success:function(msg){
			   var wess=jQuery.parseJSON(msg);
			   for(dd in wess){
				   tst[wess[dd].id]={};
				   tst[wess[dd].id]["name"]=wess[dd].test_name;
			   }
		   }
	   });
		 
		 
		$.ajax({
			url:"madeup_test_entry.php",
			data:{ty:"olo"},
			type:"post",
			success:function(msg){
				var daaa=jQuery.parseJSON(msg);
				alert(JSON.stringify(daaa));
				$("#name").val(daaa[0]['test_name']);
				$("#mark").val(daaa[0].total);
				var marke=daaa[0].ends;
				$("#wei").append("<form class='was-validated'>")
				for(var i=1;i<daaa.length;i++){
					 $("#wei").append("<label>"+tst[daaa[i]["o_test"]]["name"]+"<label><input class='perc form-control' data-oid='"+daaa[i]["o_test"]+"' data-id='"+daaa[i]["id"]+"' value='"+daaa[i]['weightage']+"' data-na='"+tst[daaa[i]["o_test"]]["name"]+"' type='number' required>%<br>");
				}
				//$("#wei").append("<br><label>Enter Formula (if any)</label><input type='text' class='for'><input type='button' id='bb' value='submit'>")
				$("#wei").append("</form><br><input type='button' id='bb' class='btn btn-primary' value='submit'>")
			}
		});
			
	   $(document).on("input change",".perc",function(){
		   var ntid=$(this).attr("data-id");
		   var val=$(this).val();
		   var otid=$(this).attr("data-oid");
		   $.ajax({
			   url:"madeup_test_entry.php",
			   data:{ty:"upc",ntid:ntid,val:val,otid:otid},
			   type:"post",
			   success:function(msg){
				   var xxx=jQuery.parseJSON(msg);
				   alert(xxx);
			   }
		   });    
	   });
	   $(document).on("input change",".det",function(){
		   
		   if($("#ct").css("display")!="none")
			   return false;
		   alert("dogg");
		   var dty=$(this).attr("data-type");
		   var val=$(this).val();
		   
		   $.ajax({
			   url:"madeup_test_entry.php",
			   data:{ty:"upd",dty:dty,val:val},
			   type:"post",
			   success:function(msg){
				   var tt=jQuery.parseJSON(msg);
				   alert(tt);
			   }
		   });  
	   });
			 
		$(document).on("input change",".for",function(){
			var fla=$(this).val();
			$.ajax({
				url:"madeup_test_entry.php",
				data:{ty:"form",val:fla},
				type:"post",
				success:function(msg){
					var yu=jQuery.parseJSON(msg);
					alert(yu);
				}
			});
		});	 
		$(document).on("click","#bb",function(){
			$.ajax({
				url:"madeup_test_entry.php",
				type:"post",
				data:{ty:"make"},
				success:function(msg){
					var ttt=jQuery.parseJSON(msg);
					alert(ttt);
					$(".sumb").css("display","block");
				}
			});
		});
        $(document).on("click",".sumb",function(){
			$.ajax({
				url:"madeup_test_entry.php",
				data:{ty:"sumb"},
				type:"post",
				success:function(msg){
					var yyy=jQuery.parseJSON(msg);
					alert(yyy);
					window.open("ClassmPageCreator.php","_self")
				}
				
			});
		});
			
			
		});
	</script>
	<style>
	   #ct{
		   display:none;
	   }
	   .sumb{
		   display:none;
	   }
	</style>
	<body>
	    <h1><?php echo $_SESSION["test_n"];?>'s test details</h1>
		<br><br><br>
        <br>
		 <input type="button" class='sumb btn-btn-primary' value='Publish test'>
		 <div id="d1" class='d-flex justify-content-center'>
		    <form id="#frm1" class='was-validated'>
			    <label for="name">Test Name:<label>
				<input type="text" class="det" data-type="name" name="name" id="name"><br>
				<label for="mark">Marks of Test:</label>
				<input type="number" class="det" data-type="mark" name="mark" id="mark"><br>
				<div id="wei">
				</div>
				<input type="button" id="ct" class='btn btn-primary' value="Create Test">
			</form>
		 </div>
	</body>
</html>

		<?php }} else {?>
<!doctype html>
<html>
     <head>
	    <title>Calculated New Test</title>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	 </head>
	 <script>
	   $(document).ready(function(){
	   var tst={};
	   $.ajax({
		   url:"select_test.php",
		   data:{ty:"subn"},
		   type:"post",
		   success:function(msg){
			   var wess=jQuery.parseJSON(msg);
			   for(dd in wess){
				   tst[wess[dd].id]={};
				   tst[wess[dd].id]["name"]=wess[dd].test_name;
			   }
		   }
	   });
	   $(document).on("click","#ct",function(eve){
		   eve.preventDefault();
		   if($("#frm1")[0].checkValidity()==false){
			   return false;
		   }
			   
		   var name=$("#name").val();
		   var mrk=$("#mark").val();
		   $.ajax({
			 url:"madeup_test_entry.php",
			 data:{ty:"new",name:name,mrk:mrk},
			 type:"post",
			 success:function(msg){
				var daaa=jQuery.parseJSON(msg);
				
				$("#ct").css("display","none");
				$("#wei").append("<form class='was-validated'><table class='table table-borderless'><thead><tr><th>Test name</th><th>Weightage</th></tr></thead><tbody>");
					 for(ss in daaa){
						 //alert("it is="+daaa[ss]["o_test"]+",aga="+daaa[ss]["id"]);
						 $("#wei").append("<tr><td><label>"+tst[daaa[ss]["o_test"]]["name"]+"</label></td><td><input class='perc form-control' data-oid='"+daaa[ss]["o_test"]+"' data-id='"+daaa[ss]["id"]+"' data-na='"+tst[daaa[ss]["o_test"]]["name"]+"' type='number' required>%<td></tr>");
					 }
					// $("#wei").append("<br><label>Enter Formula (if any)</label><input type='text' class='for'><input type='button' id='bb' value='submit'>");
					 $("#wei").append("</tbody></form><br><input type='button' id='bb' class='btn btn-primary' value='submit'>");
                     $("#wei").css("display","block");			
			}
		 });
		   
	   });
	   $(document).on("input change",".perc",function(){
		   var ntid=$(this).attr("data-id");
		   var val=$(this).val();
		   var otid=$(this).attr("data-oid");
		   $.ajax({
			   url:"madeup_test_entry.php",
			   data:{ty:"upc",ntid:ntid,val:val,otid:otid},
			   type:"post",
			   success:function(msg){
				   var xxx=jQuery.parseJSON(msg);
				   
			   }
		   });    
	   });
	   $(document).on("input change",".det",function(){
		   
		   if($("#ct").css("display")!="none")
			   return false;
		   alert("dogg");
		   var dty=$(this).attr("data-type");
		   var val=$(this).val();
		   
		   $.ajax({
			   url:"madeup_test_entry.php",
			   data:{ty:"upd",dty:dty,val:val},
			   type:"post",
			   success:function(msg){
				   var tt=jQuery.parseJSON(msg);
				   alert(tt);
			   }
		   });  
	   });
			 
		$(document).on("input change",".for",function(){
			var fla=$(this).val();
			$.ajax({
				url:"madeup_test_entry.php",
				data:{ty:"form",val:fla},
				type:"post",
				success:function(msg){
					var yu=jQuery.parseJSON(msg);
					alert(yu);
				}
			});
		});	 
		$(document).on("click","#bb",function(){
			$.ajax({
				url:"madeup_test_entry.php",
				type:"post",
				data:{ty:"make"},
				success:function(msg){
					var ttt=jQuery.parseJSON(msg);
					alert(ttt);
					$(".sumb").css("display","block");
				}
			});
		});
        $(document).on("click",".sumb",function(){
			$.ajax({
				url:"madeup_test_entry.php",
				data:{ty:"sumb"},
				type:"post",
				success:function(msg){
					var yyy=jQuery.parseJSON(msg);
					alert(yyy);
					window.open("ClassmPageCreator.php","_self")
				}
				
			});
		});
		
			 /*$("#frm1").submit(function(event){
				 event.preventDefault();
				 var exx=$("#test").val();
				 $("#d1").hide();
				 $("#editz").html("Test Name="+exx+"<input type='button' id='ed' value='Edit'>");
			     $("#d2").show();
				 $("#testn").val(exx);
				 $("#sss").attr('disabled',false);
			 });
			  var op1="<select ";
			  var name="";
			  var op2="";
			  var cou=1;
			  
			 $("#d21").prepend(function(){
				
				$.ajax({
					url:"select_test.php",
					type:"post",
					data:{},
				success:function(msg){
				     name="name='sel"+cou+"'>";
					 cou++;
					alert(msg);
					var tem=jQuery.parseJSON(msg);
					for(x in tem){
						op2+="<option value='"+tem[x].id+"'>"+tem[x].test_name+"</option>";	
					}
					op2+="</select>";
					var op3=op1+name+op2;
					name="name='sel"+cou+"'>";
					cou++;
					var op4=op1+name+op2;
					 $("#d21").prepend(op3+"+"+op4);		
				}
				
				}); 
			 });
			  $("#addm").click(function(){
				 name="name='sel"+cou+"'>";
				 cou++;
				  $("#d21").append("+"+op1+name+op2);
			  });
			  $("#frm2").submit(function(event){
				  event.preventDefault();
				  var dats=$(this).serialize();
				  $.ajax({
					  url:"madeup_test_entry.php",
					  type:"post",
					  data:dats,
					  success:function(msg){
						  var typ=jQuery.parseJSON(msg);
						  alert("Error may be="+typ);
						  window.open("ClassmPageCreator.php","_self");
					  }
					  
				  });
			  })*/
		 });
	 </script> 
	 <style>
	     #d1,#d2{
			 position:relative;
			 top:10%;
			
		 }
		 #testn{
			 display:none;
		 }
		 #wei,.sumb{
			 display:none;
		 }
		 #frm1{
			 width:50%;
			 padding:20px;
			  border:3px solid grey;
		 }
		 #d1{
			
			 
		 }
	 </style>
	 <body>
	    <h1 align="center">Enter the New test Information</h1>
		<br><br>
	     <!--<div id="d1">
		    <form id="frm1">
			     <h3>Enter The test Name</h3>
				 <input type="text" id="test"></input><br>
				 <input type="submit" id="b1" value="submit">
			</form>
		 </div>
		 <h4 id="editz"></h4>
		 <div id="d2">
		     <form id="frm2">
			      <input type="text" name="testn" id="testn" value="">
			     <h3>Select the tests that have to be added</h3><br>
				<div id="d31"><div id="d21"></div><input type="button" id="addm" value="Add more tests"/></div><br>
				<div id="d22"><input type="text" name="form" placeholder="Enter Formula"></div><br>
				 <input type="submit" value="submit" id="sss" disabled='disabled'>
			 </form>
		 </div>-->
		 <br>
		 <input type="button" class='sumb btn-primary' value='Publish test'>
		 <div id="d1" class='d-flex justify-content-center'>
		    <form id="frm1" class='was-validated'>
			   <div class='form-group' class='was-validated'>
			    <label for="name">Test Name:</label>
				<input  type="text" class="det form-control" data-type="name" name="name" id="name" required>
               </div>
               <div class='form-group'>			   
				<label for="mark">Marks of Test:</label>
				<input  type="number" class="det form-control" data-type="mark" name="mark" id="mark" required>
			   </div>
				<input class='btn btn-primary btn-block' type="button" id="ct" value="Create Test">
			</form>
		 </div>
		 <div class='d-flex justify-content-center'>
			 <div id="wei">
			 </div>
			
         </div>	
	</body>
</html>
<?php } ?>