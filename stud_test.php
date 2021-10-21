<?php
   session_start();
 ?>
<!doctype html>
<html>
   <head>
       <title>Student Result according to test</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	  
	   
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js" integrity="sha512-w3u9q/DeneCSwUDjhiMNibTRh/1i/gScBVp2imNVAMCt6cUHIw6xzhzcPFIaL3Q1EbI2l+nu17q2aLJJLo4ZYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
   </head>
   <script>
    
     $(document).ready(function(){
		 var sus,subb={},tsst={};
		 $.ajax({
			 url:"select_sub.php",
			 data:{},
			 type:"post",
			 success:function(msg){
				 sus=jQuery.parseJSON(msg);
				 //alert(JSON.stringify(sus));
				 for(z in sus){
					 subb[sus[z].sub_id]={};
					 subb[sus[z].sub_id]["name"]=sus[z].sub_name;
				 }
			 }
			 
		 });
		 $.ajax({
			 url:"get_test_res.php",
			 type:"post",
			 data:{wh:"oltst"},
			 success:function(msg){
				 var ttt=jQuery.parseJSON(msg);
				 for(iq in ttt){
					 tsst[ttt[iq].id]={};
					 tsst[ttt[iq].id]["name"]=ttt[iq]["test_name"];
				 }
			 }
		 });
		 var euu="<?php if($_SESSION['test_ty']=='mt'){echo 'mtt';} else {echo 'cols';} ?>";
		 var tcol="";
		 $.ajax({
			 url:"get_test_res.php",
			 data:{wh:euu},
			 type:"post",
			 success:function(msg){
				 var sss=jQuery.parseJSON(msg);
				 //alert("id="+sss);
				 tcol=sss;
				 make();
				 weie();
			 }
		 });
		 
		 function weie(){
			 $.ajax({
				 url:"get_test_res.php",
				 data:{wh:"wst"},
				 type:"post",
				 success:function(msg){
					 var cw=jQuery.parseJSON(msg);
					 for(z in cw){
						 $("#d13>table>tbody").append("<tr><td>"+tsst[cw[z]["o_test"]]["name"]+"</td><td>"+cw[z]["weightage"]+"</td></tr>")
					 }
				 }
			 });
		 }
		 
		 function make(){
			 $.ajax({
				 url:"get_test_res.php",
				 data:{wh:"get"},
				 type:"post",
				 success:function(msg){
					 //alert("tcool="+JSON.stringify(tcol));
					 var ctest="<?php echo $_SESSION['test_n']; ?>";
					 var tab="<table class='table table-striped'><thead><tr><th>Subjects</th><th> Marks</th></tr></thead><tbody>";
					 var we=jQuery.parseJSON(msg);
					 //alert(JSON.stringify(we));
					 /*var arr1=we.slice(0,1);
					 var as=arr1.toString();
					 ars1=as.split(",");
					 
					 var arr2=we.slice(1,1+we.length);
					 //alert(arr2.length);
					 */
					 
					 for(zx in tcol){
						 tab+="<tr><td>"+subb[tcol[zx].sub_id]["name"]+"</td><td>"+we[0][tcol[zx].id]+"</td></tr>";
						 
					 }
					 
					 
					 
					 
					/* for(as in arr2){
						 for(qw in ars1){
							  tab+="<tr>";
							  tab+="<td>"+sus[er].sub_name+"</td>";
							  
							//  if("<?php echo $_SESSION['test_ty'] ?>"=="mt")
							  var assd=ars1[qw];
							  //alert("in ars1="+assd);
							 for(er in sus){
								 var nwe=sus[er].sub_name;
								 if("<?php echo $_SESSION['test_ty'] ?>"=="mt")
									 nwe=sus[er].sub_id;
								// alert("nwe fr ="+nwe);
								 if(ars1[qw].includes(nwe)){
								//	 alert("true");
									tab+="<td>"+sus[er].sub_name+"</td>";
									break;
								 }
								 
							 }
							 tab+="<td>"+arr2[as][assd]+"</td>";
							 //alert("last="+arr2[as][assd]);
						 }
					 }*/
					 tab+="</tbody></table>";
					 $("#d12").html(tab);
					 
					 
				 }
			 });
		 }
		 $(document).on("click","#tbff",function(){
			 var ele=document.querySelectorAll("d23");
			 //alert("ele="+ele);
			 var exe=document.getElementById("d23").innerHTML;
			 //alert("exe="+exe);
			 var opt={
				 filename:"<?php echo $_SESSION['pnm']; ?>",
				 image:{ type: 'jpeg', quality: 75.0 },
				 html2canvas:  { scale: 10},
			 };
			 html2pdf(exe,opt);
			 
			 /*var doc=new jsPDF();
			 var exe=$("#d23").html();
			 doc.html(exe);
			 doc.save("<?php echo $_SESSION['pnm']; ?>");*/
		 });
	 });
   </script>
   <style>
     
	 .table,.fg{
	 
		 width:70%;
		
	 }
	 .d23{
		 width:70%;
	 }
	 div>span{
		 font-weight:bold;
		 
	 }
	 .d44,.es{
		 font-size:20px;
	 }
	 #mn{
		font-size:37px; 
		font-weight:bold;
	 }
	 .ese{
		 font-size:17px;
	 }
   </style>
   <body>
      <h1 align="center">Test Result</h1>
	  <br><br><br>
	  
      <div id='d23'>
	       
	      <div id='mn' align='center'><span>Institute: </span><?php echo $_SESSION["institute"] ?></div>
		  <div class='d-flex justify-content-center'>
			  <div class='fg d-flex justify-content-start'>
				  <div  class='dww'>
					  <div class='d44'><span>Class Name: </span><?php echo  $_SESSION["name"]; ?></div>
					  <div class='d44'><span>Session: </span><?php echo  $_SESSION["sess"]; ?></div>
					  <div class='d44'><span>Student ID:</span><?php echo $_SESSION["pid"]; ?></div>
					  <div class='d44'><span>Student Name:</span><?php echo $_SESSION["pnm"]; ?></div>
					  <div class='d44'><span>Test Name: </span><?php echo  $_SESSION["test_n"]; ?></div>
				  </div>
			  </div>
		  </div>
		  <br>
		  <div id="d12" class='d-flex justify-content-center'>
			 
		  </div>
		  <?php if($_SESSION["test_ty"]=="mt"){?>
		  <div class='d-flex justify-content-center'>
			  <div class='fg d-flex justify-content-start'>
				  <div class='es'>Marks Were Calculated by Following:</div>
              </div>
		  </div>
		  <br>
		  <div class='d-flex justify-content-center'>
			  <div id="d13" class='fg d-flex justify-content-start'>
               			  
				  <table class='table table-borderless'>
					 <thead>
						<tr>
						   <th>Tests</th>
						   <th>weightage</th>
						</tr>
					 </thead>
					 <tbody>
					 </tbody>
				  </table>
			  </div>	
          </div>		  
		 <?php } ?>
		 <div class='d-flex justify-content-center'>
			  <div class='fg d-flex justify-content-start'>
				  <div class='ese'>The result was made through www.performers.com</div>
              </div>
		  </div>
	  </div>
	  <br><br>
     <div class='d-flex justify-content-center'><input type='button' class='btn btn-primary' id='tbff' value='Print/Download'></div>
	  <br>  
   </body>
</html>