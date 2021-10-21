<?php
   session_start();
   if(isset($_POST["tid"])){
	   $_SESSION["test_id"]=$_POST["tid"];
	   $_SESSION["test_n"]=$_POST["tnm"];
	   $_SESSION["test_ty"]="_";
	   if(isset($_POST["stat"])){
	      $_SESSION["stat"]=$_POST["stat"];
	   }
	   if(isset($_POST["tmr"])){
	      $_SESSION["tmr"]=$_POST["tmr"];
	   }
	   if(isset($_POST["ty"])){
		   $_SESSION["test_ty"]=$_POST["ty"];
		   }
	    if($_SESSION["test_ty"]=="nt"&&$_SESSION["designate"]=="t"){
			include 'connector.php';
			$sql3="select * from no_test_s where test_id=".$_SESSION["test_id"]." and class_id='".$_SESSION["id"]."' and sub_id='".$_SESSION["subs"]."'";
			$fet2=mysqli_query($conn,$sql3);
			$res2=mysqli_fetch_assoc($fet2);
			$_SESSION["stat"]=$res2["status"];
		}  
		
   }
   else{
 ?>
<!doctype html>
<html>
    <head>
	     <title>view ins</title>
		  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	</head>
	<script>
     $(document).ready(function(){
		 var sus,subb={};
		 $.ajax({
			 url:"select_sub.php",
			 data:{},
			 type:"post",
			 success:function(msg){
				 sus=jQuery.parseJSON(msg);
				 alert(JSON.stringify(sus));
				 for(zu in sus){
					 subb[sus[zu].sub_id]={};
					 subb[sus[zu].sub_id]["name"]=sus[zu].sub_name;
				 }
				 
			 }
			 
		 });
		 var tcol="";
		 $.ajax({
			 url:"get_test_res.php",
			 data:{wh:"cols"},
			 type:"post",
			 success:function(msg){
				 var sss=jQuery.parseJSON(msg);
				 alert("id="+sss);
				 tcol=sss;
				 make();
			 }
		 });
		 var tbc=0;
		 function make(){
		 $.ajax({
			 url:"get_test_res.php",
			 data:{wh:"get",type:"tea"},
			 type:"post",
			 success:function(msg){
				 var ctest='<?php echo $_SESSION["test_n"]; ?>';
				 var tab="<table class='table table-striped was-validated'><thead><tr><th>Students id</th><th>Students Name</th>";
				 var we=jQuery.parseJSON(msg);
				 //alert(JSON.stringify(we));
				 /*var arr1=we.slice(0,1);
				 var as=arr1.toString();
				  var arr2=we.slice(1,1+we.length);
				 ars1=as.split(",");*/
				 if("<?php echo $_SESSION['designate'] ?>"!="Creator"){
					   $("#d12").css("display","block");
					   tab+="<th>"+ctest+" Marks</th></tr></thead><tbody>";
					 /* var nwe="<?php if(isset($_SESSION['sub_name'])){echo $_SESSION['sub_name']; }?>";
					  
					  if("<?php echo $_SESSION['test_ty'] ?>"=="mt"){
						  nwe="<?php if(isset($_SESSION['sub_name'])){echo $_SESSION['subs'];} ?>";
					  }*/
					  
					 /*for(qw in ars1){
							  var assd=ars1[qw];
								 if(ars1[qw].includes(nwe)){
									
									break;
								 }	  
						 }*/
					//alert("hello ass="+assd);
					 
					 alert("we="+JSON.stringify(we));
					 for(as in we){
						 
						  tab+="<tr><td>"+we[as].stud_id+"</td><td>"+we[as].name+"</td>";
						  if("<?php echo $_SESSION['test_ty']; ?>"=="nt")
						    tab+="<td><input min='0' max='<?php if(isset($_SESSION['tmr']))echo $_SESSION['tmr'];else echo '0'; ?>' type='number' id='"+we[as].stud_id+"-"+tcol[0].id+"' name='"+we[as].stud_id+"-"+tcol[0].id+"' value='"+we[as][tcol[0].id]+"' class='dis form-control'  data-stud='"+we[as].stud_id+"' data-col='"+tcol[0].id+"' required></td></tr>";
						  else 
							tab+="<td>"+we[as][tcol[0].id]+"</td>"
						 
					 }
					 tab+="</tbody></table>";
				 }
				 else{
					 
					 for(zu in tcol){
						 if(tcol[zu]["status"]=="submitted" || "<?php echo $_SESSION['test_ty']; ?>"=='mt'){
							if($("#d12").css("display")=="none"){
								$("#d12").css("display","block");
							}
						  tab+="<td>"+subb[tcol[zu].sub_id]["name"]+"</td>";
						 }
					     else{
							 tbc++;
							 $("#d44>ul").append("<li class='list-group-item'>"+subb[tcol[zu]["sub_id"]]["name"]+"</li>")
						 }
					 }
					 if(tbc>0){
						 $("#b3").addClass("btn-info");
						 $("#d44").css("display","block");
					 }
					 else{
						 $("#b3").addClass("btn-success");
					 }
					 
					/* var cols=[];
					  for(er in sus){
						  for(qw in ars1){
							 var nwe=sus[er].sub_name;
							 if("<?php echo $_SESSION['test_ty'] ?>"=="mt")
								 nwe=sus[er].sub_id;
							// alert("nwe fr ="+nwe);
							 if(ars1[qw].includes(nwe)){
							//	 alert("true");
								tab+="<td>"+sus[er].sub_name+"</td>";
								cols.push(ars1[qw]);
								break;
							 }
						  } 
					 }*/
					 tab+="</thead></tr><tbody>";
					  for(as in we){
						   tab+="<tr><td>"+we[as].stud_id+"</td><td>"+we[as].name+"</td>";
						 for(w in tcol){
							// tab+="<td><input type='number' id='"+we[as].stud_id+"-"+tcol[w].id+"' data-stud='"+we[as].stud_id+"' data-col='"+tcol[w].id+"' name='"+we[as].stud_id+"-"+tcol[w].id+"' value='"+we[as][tcol[w].id]+"' class='dis'></td>";
                            if(tcol[w]["status"]=="submitted"|| "<?php echo $_SESSION['test_ty']; ?>"=='mt'){
								tab+="<td>"+we[as][tcol[w].id]+"</td>";
							}							
						 }
						 tab+="</tr>";
					  }	 
					 tab+="</tbody></table>";
					 
				 }
				 $("#d12").html(tab);
				 
				 
			 }
		 });
		 }
		 $("#b1").click(function(){
			 if($("#frm1")[0].checkValidity()==false){
				 $(".modal-body").html("Please Fill all values");
				 $("#mod1").modal('toggle');
				 return false;
			 }
			 $.ajax({
				 url:"get_test_res.php",
				 data:{wh:"sta"},
				 type:"post",
				 success:function(msg){
					 var aa=jQuery.parseJSON(msg);
					 alert(aa);
					 $("#b1").val("Submitted ");
					 window.open("ClassmPageJoiner.php","_self");
				 }
			 });
		 });
		 
		 $(document).on("click","#b3",function(eve){
			 eve.preventDefault();
			 if(tbc>0){
				 $(".modal-body").html(tbc+"subjects marks are pending");
				 $("#mod1").modal("toggle");
				 return false;
			 }
			 $.ajax({
				 url:"get_test_res.php",
				 data:{wh:"pubb"},
				 type:"post",
				 success:function(msg){
					 var eee=jQuery.parseJSON(msg);
					 alert(eee);
					 window.open("ClassmPageCreator.php","_self");
					 
				 }
			 });
		 });
		 $(document).on("input",".dis",function(){
			 if($(this)[0].checkValidity()==false){
				 return false;
			 }
			 var stu=$(this).attr("data-stud");
			 var col=$(this).attr("data-col");
			 var data=$(this).val();
			 $.ajax({
				 url:"get_test_res.php",
				 type:"post",
				 data:{wh:"upd",stu:stu,col:col,data:data},
				 success:function(msg){
					 var ss=jQuery.parseJSON(msg);
					 //alert(ss);
				 }
			 });
		 });
		 
		 
		 $("#frm1").submit(function(event){
			 event.preventDefault();
			 var daas=$(this).serialize();
			 alert(daas);
			 $.ajax({
				 url:"insert_test_result.php",
				 type:"post",
				 data:daas,
				 success:function(msg){
					 var pas=jQuery.parseJSON(msg);
					 alert(JSON.stringify(msg));
					 if("<?php echo $_SESSION['designate'];?>"!="Creator"){
					    window.open("ClassmPageJoiner.php","_self");}
					 else
						window.open("ClassmPageCreator.php","_self");
				 }
				 
			 });
		 });
	 });
   </script>
   <style>
     .table{
		 width:80%;
	 }

	 #d13{
		 position:absolute;
		 top:100px;
		 right:0px;
		 display:inline-block;
		 border:1px solid black;
	 }
	 input{
		 cursor:default;
	 }
	 #d12,#d44{
		 display:none;
	 }
	 .list-group{
		 width:40%;
	 }
   </style>
	 <body>
      <h1 align="center"><?php if($_SESSION["designate"]!="Creator"){echo $_SESSION["sub_name"]."'s";} ?> <?php echo $_SESSION["test_n"]; ?> test Marks</h1>
	  <br><br><br>
	  <div>
		  <?php if($_SESSION['test_ty']!="mt" && $_SESSION["designate"]=="t"){
			  if($_SESSION["stat"]!="submitted"){ ?>
		      <input type="button" class='btn btn-success' value="Submit" id="b1">
		  <?php }
          else if($_SESSION["stat"]=="submitted"){ ?>
			  <span class='bg-success p-3'>Submitted</span>
		  <?php }} 
		  else if($_SESSION["designate"]=="Creator")
			  if($_SESSION["stat"]!="published"){?>
		  <input id="b3" class='btn' type="button" value="Publish the test Results to Students">
		  <?php }
		  else {?>
			 <span class='bg-success p-3'>Published</span>
		  <?php }?>
		  
		  
	   </div>
        <br><br>	   
      <form id="frm1">
	     
	      <div id="d12" class='d-flex justify-content-center'>
	     
          </div>	
	  </form>
	 
	  <?php if($_SESSION["designate"]=="Creator"){ ?>
	     <div id="d44"> 
		    <h3>Pending mark Submission Subjects</h3>
		    <ul class='list-group'>
			</ul>
		 </div>
	  <?php } ?>
	 
       <!--<div id="d13">
	     <?php# if($_SESSION["designate"]!="Creator"){ ?>
	       <h3>TEacher ID:<?php #echo $_SESSION["pid"]; ?></h3><br>
		 <h3>Teachers Name:<?php# echo $_SESSION["pnm"]; ?></h3>
		 <?php# } else {?>
		 <h3>Your Designation=<?php# echo $_SESSION["designate"]; }?></h3>
		 
       </div>-->

      <div class='modal fade' id="mod1">
		  <div class='modal-dialog modal-dialog-centered'>
		     <div class='modal-content'>
                   <div class="modal-header">
					<h4 class="modal-title">Error</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					
				  </div>
			 
			 
			 </div>
		  </div>
		</div>	   
   </body>
</html> 
<?php 
   }
?>