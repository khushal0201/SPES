<!doctype html>
<html>
    <head>
	    <title>Select Chats</title>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />		
	</head>
	<script>
	   $(document).ready(function(){
		   $.ajax({
			   url:"message_store.php",
			   type:"post",
			   data:{ty:"selc"},
			   success:function(msg){
				   var tt=jQuery.parseJSON(msg);
				   $("#chats").append("<table class='table table-striped table-hover'><thead><tr><th>Chats</th></tr></thead><tbody></tbody></table>")
				   for(x in tt){
					   $("#chats>table>tbody").append("<tr><td data-id='"+tt[x]["id"]+"' class='thec'>"+tt[x]["chat_name"]+"</td></tr>");
				   }
				  
			   }
		   });
		   
		   $(document).on("click",".thec",function(){
			   var wees=$(this).attr("data-id");
			   var pees=$(this).html();
			   $.ajax({
				   url:"public_message.php",
				   data:{chat:wees,pees:pees},
				   type:"post",
				   success:function(msg){
					   var qe=jQuery.parseJSON(msg);
					   alert(qe);
					   window.open("public_message.php","_self");
				   }
			   })
		   });
	   });
	</script>
	<style>
	   .thec{
		   border-top:1px solid grey;
		   border-bottom:1px solid grey;
	        
	   }
	   .thec:hover{
		   cursor:pointer;
	   }
	   #chats th{
		 text-align:center;
		 color:blue;
	   }
	</style>
	<body>
	    
		<div id='chats'>
		</div>
	</body>
</html>