<?php
   session_start();
   if(isset($_POST["inco"])){
	   $id=$_POST["inco"];
	   $_SESSION["subs"]=$id;
	   $_SESSION["sub_name"]=$_POST["name"];
	   $_POST["inco"]="";
	   $dogs="hello";
	   echo json_encode($dogs);
   }
   else{
?>
<!doctype html>
<html>
    <head>
	    <title>Attendance Page</title>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<script>
	    $(document).ready(function(){
			alert("thats="+"<?php echo $_SESSION['sub_name'];?>")
			var forfut1="";
            var forfut2="";			
			$.ajax({
				url:"select_students.php",
				data:{},
				type:"post",
				success:function(msg){
					var oops=jQuery.parseJSON(msg);
					forfut1=oops;
					$.ajax({
						url:"add_get_attendance.php",
						data:{ty:"get"},
						type:"post",
						success:function(msg1){
							var aga=jQuery.parseJSON(msg1);
							alert("rror="+aga);
							forfut2=aga;
							var maybe="<thead><tr id='mines'><th>Student ID</th><th>Student Name</th><th>Total</th>";
							for(y in aga){
								maybe+="<th><input type='date' name='"+aga[y].id+"' value='"+aga[y].daty+"'/></th>";
							}
							maybe+="</tr></thead><tbody>";
							var t3="<tr><td>Total</td></tr>";
							t2="";
							var datas="";
						  for(x in oops){

							var sid=oops[x].stud_id;
							var snm=oops[x].name;
							datas+="<tr id='t-"+sid+"'>";
							datas+="<th>"+sid+"</th><td>"+snm+"</td>";
							var to=0;
							var tdatas="";
							for(y in aga){
								var cons="";
								//alert("x is="+x);
								var cool=aga[y].id;
								
								//alert(oops[x]["a_"+cool.toString()]);
								if(oops[x]["a_"+cool.toString()]==1){
									cons="checked";
								}
								else
									cons="";
								tdatas+="<td><input type='checkbox' class='"+aga[y].id+"' name='"+sid+"-"+aga[y].id+"' "+cons+" disabled></td>";
								to++;
							}
							if(to==0){
							    t2="<td class='tot-"+sid+"'>0</td>";
								
							}
						    else{
							   t2="<td class='tot-"+sid+"'>"+oops[x]["tota_"+"<?php echo $_SESSION['subs']; ?>"]+"</td>";	
							}
							t3+="<tr>"+t2+"</tr>";
							tdatas+="</tr>";
							datas+=t2+tdatas;
							
					       }
						   maybe+=datas+"</tbody>";
						   $("#tab1").append(maybe);
						   $("#tab2").append(t3);
						}
					});
					
				}
			});
			$("#b1").click(function(){
				
				$.ajax({
					url:"add_get_attendance.php",
					data:{ty:"set"},
					type:"post",
					success:function(msg){
						var oks=jQuery.parseJSON(msg);
						
						$("#mines").append("<th><input type='date' name='"+oks.id+"' class='ds' value='"+oks.daty+"'>");
						
						//alert(JSON.stringify(forfut1));
						for(i in forfut1){
							var sid=forfut1[i].stud_id;
							$("#t-"+sid).append("<td><input type='checkbox' class='sens' name='"+sid+"-"+oks.id+"'></td>");
						}  
					}
				});
				
			});
			$(document).on('change','.ds',function(){
				var seer=$(this).serialize();
				
				$.ajax({
					url:"update_date_att.php",
					data:seer,
					type:"post",
					success:function(msg){
						var asd=jQuery.parseJSON(msg);
						alert(asd);
					}
				});
			});
			$(document).on('change','.sens',function(){
				var aps=$(this).attr("name");
				var sp=aps.split("-");
				var ps=parseInt($(".tot-"+sp[0]).html());
			    if($(this).prop('checked')==true){
					$(".tot-"+sp[0]).html(ps+1);
				}
				else{
					$(".tot-"+sp[0]).html(ps-1);
				}
					
			});
			
			
			$("#frm1").submit(function(event){
				event.preventDefault();
				var senns=$("input:checked.sens").serialize();
				alert(senns);
				$.ajax({
					url:"submit_attendance_try.php",
					data:senns,
					type:"post",
					success:function(msg){
						var jst=jQuery.parseJSON(msg);
						alert(msg);
						<?php if($_SESSION["designate"]=="t"){?>
						window.open("ClassmPageJoiner.php","_self");
						<?php } else {?>
						window.open("ClassmPageCreator.php","_self");
						<?php } ?>
					}
				});
				
			});
		});
	</script>
	<style>
	    
		.table{
			width:60%;
			
		}
	</style>
	<body>
	    <h1 align="center"><?php echo $_SESSION["sub_name"]; ?> subject's attendance</h1>
		<div>
		   <span><h3>Add days?</h3></span><input id="b1" type="button" class='btn btn-info' value="add"><br>
		   <form id="frm1">
		      <table id="tab1" class='table table-striped table-hover'>
		      </table><br>
			  
			  <input  type="submit" class='btn btn-primary' value="submit"> 
		   </form>	  
		</div>
		
	</body>
</html>
<?php 
   }
?> 