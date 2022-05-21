<!doctype html>
<!-- //first join in a class -->
<html>
    <head>
	    <title>Join class</title>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	</head>
	<script>
	   $(document).ready(function(){
	       $("#frm1").submit(function(event){
			   event.preventDefault();
			   var pass=$(this).serialize();
			   
			   $.ajax({
				   url:"check_class.php",
				   data:pass,
				   type:"post",
				   success:function(msg){
					   var ar=jQuery.parseJSON(msg);
					   alert(JSON.stringify(ar));
					   if(ar.length>0){
						   alert("No Such class with id exists");
					   }
					   else
						   window.open("joinni2.php","_self");
					   
					   
				   }
			   });
		   });
	   });
	   
	</script>
	<style>
	  #dmn{
		  position:relative;
		  margin-left:auto;
		  margin-right:auto;
	      border:2px solid rgb(216,216,216);
		  padding:30px;
		  width:40%;
		  margin-top:12%;
	  }
	  #din{
		  margin-top:7%;
		  margin-left:auto;
		  margin-right:auto;
		  position:relative;
	
	  }
	  #hd{
		  color:rgb(13,165,255);
	  }
	</style>
	<body>
	  
	  <div class="container" id="dmn">
	   <h2 id="hd" align="center">Join Class</h2>
	   <div class="container" id="din">
	   <form id="frm1" class="was-validated"> 
	       <div class="form-group">
	         <label for="clss">Enter the class Id</label><br>
		      <input class="form-control" type="text" name="clss" id="clss" required>
			  <div class="valid-feedback">Valid data</div>
			  <div class="invalid-feedback">Invalid Data</div>
            </div>		
		    <input type="submit" class="btn btn-info btn-block" value="submit"/>
		</form>	  
	   </div>
	 </div>  
	</body>
</html>