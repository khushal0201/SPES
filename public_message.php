<?php
   session_start();
   if(isset($_POST["chat"])){
	   $_SESSION["chat"]=$_POST["chat"];
	   $_SESSION["chaton"]=$_POST["pees"];
	   echo json_encode("done, seesi".$_SESSION["chat"]);
   }
   else{
?>
<!doctype html>
<html style="height:100%;" >
     <head>
	     <title>Group Messaging</title>
		 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	 </head>
	 <script>
	     var lssst=1,xy=0;
	     var cdas=new Date();
		 var cd=cdas.getDate();
		 var cm=cdas.getMonth()+1;
		 var cy=cdas.getFullYear();
		 Notification.requestPermission();
	     $(document).ready(function(){
			 $("#s1").click(function(){
				 var dast=new Date();
				 var hr=dast.getHours();
				 var mn=dast.getMinutes();
				 var ss=dast.getSeconds();
				 var ms="AM";
				 if(hr>=12){
					 ms="PM"
				 }
				 if(hr>12){
				     hr=hr-12;
					
					 } 
				if(hr==0){
					hr=12;
				}
				 var tts=hr+":"+mn+" "+ms;
				 var tims=dast.getHours()+":"+dast.getMinutes()+":"+dast.getSeconds();
				 var daty=dast.getFullYear()+"-"+(dast.getMonth()+1)+"-"+dast.getDate();
				 dchk(dast.getDate(),dast.getMonth()+1,dast.getFullYear());
				 var dats=$("#sen").val();
				 lssst++;
				 
				 $("#sen").val("");
				 var dsc="<?php echo $_SESSION['designate']; ?>";
				 var dscs="";
				 if(dsc=="Creator"){
					 dscs="own";
				 }
				 else{
					
					 dscs=dsc;
				 }
				 $.ajax({
					 url:"message_store.php",
					 type:"post",
					 data:{ty:"ins",msg:dats,date:daty,time:tims,who:dscs},
					 success:function(msg){
						 var dc=jQuery.parseJSON(msg);
						 lssst=dc["id"];
						 alert("id got="+dc["id"]);
						 $("#d3").append("<div id='"+lssst+"' class='own'><span class='sp1'>You</span><br><span class='tmsg'>"+dats+"</span><br><span class='timsi'>"+tts+"</span></div><br>");
					 }
				 });
			 });
			 
			 $("#sen").keypress(function(e){
				 if(e.which==13){
					 if($("#sen").val()==""){
						 return false;
					 }
					 $("#s1").click();
				 }
			 });
			 function dchk(a,b,c){
				 var f=0;
				 if(cd!=a||cm!=b||cy!=c){
					 f=1;
					 cd=a;
					 cm=b;
					 cy=c;
				 }
				 if(f==1)
				   $("#d3").append("<div style='font-size:20px;width:100%;text-align:center'><span style='border:3px solid black;'>"+cd+"/"+cm+"/"+cy+"</span></div>");
				
					 
			 }
			 var tbe="";
			 $(document).on("dblclick contextmenu","#d3 > .own",function(event){
				 event.preventDefault();
				 var x=event.clientX+"px";
				 var y=event.clientY+"px";
				 alert("x="+x+"y="+y);
				 var fass=$(this).attr("id");
				 tbe=fass;
				 $("#emss").remove();
				 $(this).prepend("<div id='emss'>Edit Message</div>");
				 $("#emss").css({"display":"block","position":"realtive","z-index":"3","border":"3 px solifd black","background-color":"white","color":"black"});
			 });
			 
			 $(document).click(function(event) { 
				  var $target = $(event.target);
				  if(!$target.closest('#emss').length && $('#emss').is(":visible")) {
					 $("#emss").remove();
				  }        
				});
				
			$(document).on("click","#emss",function(){
				alert("finally inside="+tbe);
		       	$("#"+tbe+">.tmsg").html("<input type='text' value='"+$("#"+tbe+">.tmsg").html()+"'></input><button class='editz'>Edit</button>");
			    $("#emss").remove();
			});
			$(document).on("click",".editz",function(){
				var tbs=$(this).closest("div").attr("id");
				var umsg=$("#"+tbs+">.tmsg>input").val();
			    $.ajax({
					url:"message_store.php",
					type:"post",
					data:{ty:"edit",ide:tbs,mssg:umsg},
					success:function(msg){
						var tbbbb=jQuery.parseJSON(msg);
						alert("errr="+JSON.stringify(tbbbb));
						$("#"+tbs+">.tmsg").html(umsg);
						 
						
					}
				});
			});
	
			 
			 setInterval(repp,2000);
			 function repp(){
			 $.ajax({
				 url:"message_store.php",
				 data:{ty:"load",lsm:lssst},
				 type:"post",
				 success:function(msg){
					 var tob=jQuery.parseJSON(msg);
					//alert("boom-"+JSON.stringify(tob));
					var lssst1=lssst;
					//alert("it is="+lssst);
					if(tob.length > 0){
					 for(x in tob){
						// alert(tob[x]);
						 var sp=tob[x].join_id;
						 //alert("sp="+sp);
						 var idtb=sp.split("-");
						// alert("idt="+idtb);
						if(lssst1!=1){
							new Notification(tob[x].join_name,{
								  body: tob[x].message,
							
								});
						}
						//alert("lsst="+lssst1);
						 var clss="";
						 if(idtb[0]=="o"){
							  var ussd="<?php echo $_SESSION['uid']; ?>";
							 if(ussd==idtb[1]){
							 clss="own";
							 nmm="You";
							 }
							 else{
								 clss="oth";
								 nmm=tob[x].join_name+".....Creator";
							 }
						 }
						 else{
							 var desc="<?php echo $_SESSION['designate']; ?>";
							 if(desc=="Creator"){
								 clss="oth";
								 nmm=tob[x].join_name;
								 if(idtb[0]=="s")
									 nmm+="...............Student";
								 else
									 nmm+="...............Teacher";
							 }
							 else{
							 var ussd="<?php echo $_SESSION['pid']; ?>";
							 if(ussd==idtb[1]){
								 clss="own";
								 nmm="You";
							 }
							 else{
								 clss="oth";
								 nmm=tob[x].join_name;
								 if(idtb[0]=="s")
									 nmm+="...............Student";
								 else
									 nmm+="...............Teacher";
							 }}
						 }
						   var dast=(tob[x].dati).split("-");
						   var timis=tob[x].timi;
						   var all=timis.split(":");
						   var tbh=all[0];
						   var amm="AM";
						   if(parseInt(all[0])>12){
						   tbh=all[0]-12;
						   amm="PM";
						   }
						   if(parseInt(tbh)==0){
							   tbh=12;
						   }
						   //alert("ktb="+tob[x].id);
						   lssst=parseInt(tob[x].id); 
						   if(xy==1){
                           alert("ktb="+tob[x].id);						   
                           alert("real lsst="+lssst);}						   
						  dchk(dast[2],dast[1],dast[0]); 
					     $("#d3").append("<div id='"+tob[x].id+"' class='"+clss+"'><span class='sp1' id='"+tob[x].join_id+"'>"+nmm+"</span><br><span class='tmsg'>"+tob[x].message+"</span><br><span class='timsi'>"+tbh+":"+all[1]+" "+amm+"</span></div><br>");
  					              
					 }
					 xy=1; 
				 }
				 } 
			 });
			 }
		 });
	 </script>
	 <style>
	    #d1{
			top:0px;
			position:fixed;
			text-align:center;
			width:100%;
		}
		#d2{
			position:fixed;
			background-color:white;
			color:white;
			bottom:0px;
			padding-bottom:20px;
			width:100%;
			
		}
		#d2>input{
			font-size:30px;
			width:90vw;
			 vertical-align:middle;
		}
		
		.own{
			background-color:green;
			max-width:350px;
			position:relative;
			color:white;
			margin-left:auto;
			margin-right:0;
			font-size:20px;
		    border:2px solid blue;
			display:block;
		}
		.oth{
			background-color:blue;
			max-width:350px;
		    color:white;
			margin-left:0px;
			font-size:20px;
		}
		#s1{
			background-color:blue;
			border-radius:50%;
			width:40px;
			height:40px;
			color:white;
			position:relative;
			display:inline-block;
			 vertical-align:middle;
		}
		#d3{
			margin-top:8%;
			margin-bottom:12%;
			position:fixed;
			overflow:scroll;
		    height:76%;
			width:100%;
		}
		.timsi{
			position:relative;
			right:0px;
		}
	 </style>
     <body style="height:100%;">
	     <h1 id="d1" align="center">Class's <?php echo $_SESSION["chaton"]; ?></h1>
		 <div id="d3">
		    
		 </div>
		 
		 <div id="d2"><input id="sen" type="text" placeholder="type your messages here"><span id="s1" style="">Send</span></div>
	 </body>
</html>
   <?php } ?>