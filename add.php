<?php
   session_start();
?>
<!doctype html>
<html>
    <head>
	    <title>uploading or adding</title>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<script>
	   var x=1,ssn=1;
	  $(document).ready(function(){
		 $("#pree").click(function(){
			
			 x++;
			 ssn++;
			 //$("#frm1").append("hello");
			 //$("#d12>table>tbody").append("<label>Student Id:</label><input type='text'  id='id"+x+"' name='id"+x+"' required><br><label>Student Name</label><input type='text' id='name"+x+"' name='name"+x+"' required><br><label>Student Email Address</label><input type='email' id='email"+x+"' name='email"+x+"' required><br>");
			 
			  $("#d12>table>tbody").append("<tr><td class='sss' id='ss"+ssn+"'>"+ssn+"</td><td class='omm'><input type='number' id='indee"+ssn+"' name='indee"+ssn+"' value='"+x+"'></td><td><input class='form-control' type='text' pattern='[0-9]{1,5}' id='id"+x+"' name='id"+x+"' required></td><td><input class='form-control' type='text' id='name"+x+"' name='name"+x+"' required></td><td><input type='email' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' class='form-control' id='email"+x+"' name='email"+x+"' required></td><td><i class='far fa-trash-alt tbbb' style='font-size:36px'></i></td></tr>")
			 
		 }); 
		 $(document).on("click",".tbbb",function(){
			 var cv=$(this).closest("tr").children(".sss").html();
			 alert("cv="+cv);
			 cv=parseInt(cv);
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
			 console.log("to the submission")
			 event.preventDefault();
			 if($("#frm1")[0].checkValidity()==false){
				 
				 return false;
			 }
			 var oi=$(this).serialize();
			 $.ajax({
				 url:"stud_dat.php",
				 type:"post",
				 data:oi,
				 success:function(msg){
					 console.log("Returning")
					 var rec=jQuery.parseJSON(msg);
					 alert("lenght:"+rec.length+",data="+rec);
					 window.open("ClassmPageCreator.php","_self");
				 }
			 });
		 });		 
	  });
	</script>
	<style>
	   .table{
		   width:80% !important;
	   }
	   .omm{
		   display:none;
	   }
	   .fg{
		   width:80%;
	   }
	</style>
	<body>
	    <h1 align="center">Add Students in the Class</h1>
		<br><br><br>
		
		<form id="frm1"  class="was-validated">
		  <div id="d12" class='d-flex justify-content-center'>
		    <!--<label>Student Id:</label>
			<input type="text" id="id1" name="id1" required><br>
			<label>Student Name</label>
			<input type="text" id="name1" name="name1" required><br>
			<label>Student Email Address</label>
			<input type="email" id="email1" name="email1" required><br>-->
			<table class='table table-striped table-hover'>
			    <thead>
				   <th>S.No.</th>
				   <th class='omm'></th>
				   <th>Student ID</th>
				   <th>Student Name</th>
				   <th>Student Email Address</th>
				   <th></th>
				</thead>
				<tbody>
				   <tr>
					   <td class='sss' id="ss1">1</td>
					   <td class='omm'><input type='number' id='indee1' name='indee1' value='1'></td>
					   <td><input class="form-control" pattern='[0-9]{1,5}' type='text' id='id1' name='id1' required></td>
					   <td><input class="form-control" type='text' id='name1' name='name1' required></td>
					   <td><input class="form-control"  pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' type='email' id='email1' name='email1' required></td>
					   <td><i class='far fa-trash-alt tbbb' style='font-size:36px'></i></td>
				   </tr>
				</tbody>
			</table>
			
		  </div>
		  <div class="d-flex justify-content-center">
		    <div class='fg d-flex justify-content-end'>
			   <button  class="btn btn-info" type="button"  id="pree">Add more</button>
			</div>
		  </div>
		  <br><br>
		  <div class="d-flex justify-content-center">
			<div class='fg'>
				<input type="submit" class="btn btn-primary btn-block" value="Submit">
				
		    </div>
		  </div>	
		</form>
		<div id="infor" style="width:200px;border:2px solid black;position:absolute;top:130px;right:0px;">
		    <p>Class id=<?php echo $_SESSION["id"]?></p>
		    <p>Class Name=<?php echo $_SESSION["name"] ?></p>
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