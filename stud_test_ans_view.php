<?php
   session_start();
   include 'connector.php';
   $gtid=$_SESSION["gtid"];
   $sql1="select status from online_test_rec where id=$gtid";
   $fet1=mysqli_query($conn,$sql1);
   $res1=mysqli_fetch_assoc($fet1);
   if($res1["status"]=="checked"){
     $_SESSION["testat"]="checked";
   }	 
   else{
	   $_SESSION["testat"]="unchecked";
   }
?>
<!doctype html>
<html>
    <head>
	   <title>See your Responses</title>
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>   
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	</head>
	<script>
	    $(document).ready(function(){
			var c=1,quee={};
			
			   $.ajax({
				  url:"create_test_entry.php",
				  data:{ty:"loader",gt:"gt"},
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
					  bsssd();
				  }
				  
			  });
			
			
			function bsssd(){
			$.ajax({
				url:"give_test_back.php",
				type:"post",
				data:{ty:"stusee"},
				success:function(msg){
					var ttto=jQuery.parseJSON(msg);
					for(x in ttto){
						$("#d222").append("<div id='d"+c+"'><h3>"+quee[ttto[x]["qid"]]["quest"]+"</h3><div class='mssk'></div><div class='oth'></div></div>");
						//$("#d"+c).append("");
						if(ttto[x]["qty"]=="mcq"){
							$("#d"+c+">.oth").append("<input type='radio' class='op1' name='op"+c+"'>"+quee[ttto[x]["qid"]]["op1"]+"<br><input type='radio' class='op2' name='op"+c+"'>"+quee[ttto[x]["qid"]]["op2"]+"<br>");
							if(quee[ttto[x]["qid"]]["op3"]!=null){
							  $("#d"+c+">.oth").append("<input type='radio' name='op"+c+"' class='op3'>"+quee[ttto[x]["qid"]]["op3"]+"<br>");	
							}
					        if(quee[ttto[x]["qid"]]["op4"]!=null){
							  $("#d"+c+">.oth").append("<input type='radio' name='op"+c+"' class='op4'>"+quee[ttto[x]["qid"]]["op4"]+"<br>");	
							}
							
							$("#d"+c+">.oth>."+ttto[x]["ans"]).attr("checked",true);
							$("#d"+c+">.oth").append("Correct Answer="+quee[ttto[x]["qid"]][quee[ttto[x]["qid"]]["ans"]]);
							$("#d"+c+">.oth").append("Your Answer="+quee[ttto[x]["qid"]][ttto[x].ans]);
							var tbr="";
							if(quee[ttto[x]["qid"]]["ans"]==ttto[x].ans){
								tbr="Correct";
                                $("#d"+c+">.mssk").html("Marks="+quee[ttto[x]["qid"]]["mark"]+"/"+quee[ttto[x]["qid"]]["mark"]);						
						    }
							else{
								tbr="Incorrect";
								 $("#d"+c+">.mssk").html("Marks=0/"+quee[ttto[x]["qid"]]["mark"]);						
							}
							$("#d"+c+">.oth").append("Result="+tbr);
						
						  
						}
						else{
							if("<?php echo $_SESSION['testat'] ?>"=="checked"){
								$("#d"+c+">.mssk").html("Marks="+ttto[x].mark);
							}
							$("#d"+c+">.oth").append("<div class='norm'>"+ttto[x]["ans"]+"</div>");
						}
						c++;
					}
				}
			 });
			}
		});
	</script>
	<body>
	   <h1 align='center'>Your Responses for the <?php echo $_SESSION["gtnm"] ?></h1>
	   <br><h2>Test Status:<?php echo $_SESSION["testat"];?></h2>
	   <div id='d222'>
	   
	   </div>
	</body>
</html>