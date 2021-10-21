<?php 
 session_start();
?>
<!doctype html>
<html>
   <head>
       <title>Insert Subjects</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <script>
      $(document).ready(function(){
		  var x=1,ssn=1;
		  $("#add").click(function(){
			  x++;
			  ssn++;
			   //$("#d12").append("<label>Subject Id:</label><input type='text' id='id"+x+"' name='id"+x+"' required><br><label>Subject Name</label><input type='text' id='name"+x+"' name='name"+x+"' required><br>");
		       $("#d12>table>tbody").append("<tr><td class='sss' id='ss"+ssn+"'>"+ssn+"</td><td class='omm'><input type='number' id='indee"+ssn+"' name='indee"+ssn+"' value='"+x+"'></td><td><input type='text' id='id"+x+"' name='id"+x+"' required></td><td><input type='text' id='name"+x+"' name='name"+x+"' required></td><td><i class='far fa-trash-alt tbbb' style='font-size:36px'></i></td></tr>");
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
			  event.preventDefault();
			  var oi=$(this).serialize();
			 $.ajax({
				 url:"insert_sub.php",
				 type:"post",
				 data:oi,
				 success:function(msg){
					 var rec=jQuery.parseJSON(msg);
					 alert("lenght:"+rec.length+",data="+rec);
					 window.open("ClassmPageCreator.php","_self");
				 }
			 });
		  });
	  });
	  
   </script>
   <style>
	   
	   .omm{
		   display:none;
	   }
	   .table,.fg{
		   width:80%;
	   }
	  
	</style>
   <body>
      <h1 align="center"><?php echo $_SESSION["name"];?> Class Subjects</h1>
	  <br><br><br><br>
	  <form id="frm1">
	    <div id="d12" class='d-flex justify-content-center'> 
	     <!--<h3>Enter the Subject ID:</h3>
		 <input type="text" id="id1" name="id1" required><br>
		 <h3>Enter the Subject Name:</h3>
		 <input type="text" id="name1" name="name1" required><br>
		 -->
		   <table class='table table-striped table-hover'>
		      <thead>
			     <tr> 
				    <th>S. No.</th>
					<th class='omm'></th>
					<th>Subject ID</th>
					<th>Subject Name</th>
					<th></th>
				 </tr>
			  </thead>
			  <tbody>
			      <tr>
			        <td class='sss' id="ss1">1</td>
					<td class='omm'><input type='number' id='indee1' name='indee1' value='1'></td>
					<td><input type='text' id='id1' name='id1' required></td>
					<td><input type='text' id='name1' name='name1' required></td>
					<td><i class='far fa-trash-alt tbbb' style='font-size:36px'></i></td>
				  </tr>	
			  </tbody>
		   </table>
		 
	    </div>
		<div class='d-flex justify-content-center'>
			<div class='fg d-flex justify-content-end'>
			  <input type="button" class='btn btn-info' id="add" value="Add more?">
			</div>
		</div>
        <br><br>		
		<div class='d-flex justify-content-center'>
		   <div class='fg'>
		      <input class='btn btn-success btn-block' type="submit" value="submit">
		   </div>
		</div>
	  </form>
	  
	  
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
	  
	  <div id="infor" style="width:200px;border:2px solid black;position:absolute;top:130px;right:0px;">
		    <p>Class id=<?php echo $_SESSION["id"]?></p>
		    <p>Class Name=<?php echo $_SESSION["name"] ?></p>
		</div>
   </body>
</html>