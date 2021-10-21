<?php 
  session_start();
  include 'connector.php';
    
  if(isset($_POST["ty"])){
	   	 
	  
	  if($_POST["ty"]=="set"){
		  //echo "hello";
		  $_SESSION["gtid"]=$_POST["gtid"];
		  $_SESSION["gtnm"]=$_POST["gtnm"];
		  $sql1="select status from online_resp where id=(select max(id) from online_resp where class_id='".$_SESSION["id"]."' and test_id=".$_SESSION["gtid"]." and stud_id='".$_SESSION["pid"]."')";
		  $res1=mysqli_query($conn,$sql1);
		  //echo "sq=".$sql1."<br>error is=".mysqli_error($conn);
		 
		  $fet1=mysqli_fetch_assoc($res1);
		  //echo "its=".$_SESSION["gtid"];
		  if(!is_null($fet1["status"])){
			  
			  if($fet1["status"]=="terminated")
			    $_SESSION["ost"]="terminated";
			  else if($fet1["status"]=="submit"||$fet1["status"]=="checked")
				$_SESSION["ost"]="submitted"; 
              else if($fet1["status"]=="not"){
                		
				$gtid=$_SESSION["gtid"];
				
				$sql22="select end_date,end_time from online_test_rec where id='$gtid'";
			    $res2=mysqli_query($conn,$sql22);
				$fet2=mysqli_fetch_assoc($res2);
				$f=1;
				date_default_timezone_set('Asia/Kolkata');
				if($fet2["end_date"]>=date("Y-m-d")){
					if($fet2["end_date"]>date("Y-m-d")){
					  $f=0;	
					}
				    else if($fet2["end_date"]==date("Y-m-d")){
						if($fet2["end_time"]>date("H:i:s")){
						$f=0;		
					    }
					}	
				}
				//echo "enddd";
				//echo "one=".$fet2["end_date"].",two=".date("Y-m-d").",three=".$fet2["end_time"].",four=".date("H:i:s");
				 if($f==0){
			        $_SESSION["ost"]="give";	  
					$tcd1=date_create_from_format("Y-m-d H:i:s",$fet2["end_date"]." ".$fet2["end_time"]);
					$gcd2=date("Y-m-d H:i:s");
					$tcd2=date_create_from_format("Y-m-d H:i:s",$gcd2);
					$thd=date_diff($tcd1,$tcd2);
					$hr=$thd->format("%H");
					$min=$thd->format("%i");
					$sec=$thd->format("%s");
					$fhr=(int)$hr;
					$fmin=(int)$min;
					$fsec=(int)$sec;
					$osec=($fhr*60*60)+($fmin*60)+$fsec;
					//echo "osec=".$osec;
					$_SESSION["seconds"]=$osec;
					$_SESSION["hr"]=$fhr;
					$_SESSION["min"]=$fmin;
					$_SESSION["sec"]=$fsec;
				  
	          }			
             else{
			  $_SESSION["ost"]="cbc";
		    }
                /*$sql22="select end_date,end_time from online_test_rec where id='$gtid'";
				$res2=mysqli_query($conn,$sql22);
				$fet2=mysqli_fetch_assoc($res2);
				$f=1;
				date_default_timezone_set('Asia/Kolkata');
				if($fet2["end_date"]<=date("Y-m-d")){
					if($fet2["end_time"]<date("H:i:s")){
						$f=0;
						
					}
				}
				echo "enddd";
				echo "one=".$fet2["end_date"].",two=".date("Y-m-d").",three=".$fet2["end_time"].",four=".date("H:i:s");
				
				 /*if($f==0){
				  $_SESSION["ost"]=="give";
				  
				    $tcd1=date_create_from_format("Y-m-d H:i:s",$fet2["end_date"]." ".$fet2["end_time"]);
				    $tcd2=date("Y-m-d H:i:s");
			     	$thd=date_diff($tcd2,$tcd1);
					$hr=$thd->format("%H");
					$min=$thd->format("%i");
					$sec=$thd->format("%s");
					$fhr=(int)$hr;
					$fmin=(int)$min;
					$fsec=(int)$sec;
					$osec=($fhr*60*60)+($fmin*60)+$fsec;
					echo "osec=".$osec;
					$_SESSION["seconds"]=$osec;
					$_SESSION["hr"]=$fhr;
					$_SESSION["min"]=$fmin;
					$_SESSION["sec"]=$fsec;
				  
			     }		
                else{
				  $_SESSION["ost"]=="cbc";
			    }*/			
			  }
               
		  }
		  else{
			  
			  $gtid=$_SESSION["gtid"];
              $sql22="select end_date,end_time from online_test_rec where id='$gtid'";
				$res2=mysqli_query($conn,$sql22);
				$fet2=mysqli_fetch_assoc($res2);
				$f=1;
				date_default_timezone_set('Asia/Kolkata');
				if($fet2["end_date"]>=date("Y-m-d")){
				    if($fet2["end_date"]>date("Y-m-d")){
					  $f=0;	
					}
				    else if($fet2["end_date"]==date("Y-m-d")){
						//echo "1111";
						if($fet2["end_time"]>date("H:i:s")){
						$f=0;		
					    }
					}	
				}
				//echo "enddd";
				//echo "one=".$fet2["end_date"].",two=".date("Y-m-d").",three=".$fet2["end_time"].",four=".date("H:i:s");
				 if($f==0){
						$_SESSION["ost"]="give";
						$tcd1=date_create_from_format("Y-m-d H:i:s",$fet2["end_date"]." ".$fet2["end_time"]);
						$gcd2=date("Y-m-d H:i:s");
						$tcd2=date_create_from_format("Y-m-d H:i:s",$gcd2);
						$thd=date_diff($tcd1,$tcd2);
						$hr=$thd->format("%H");
						$min=$thd->format("%i");
						$sec=$thd->format("%s");
						$fhr=(int)$hr;
						$fmin=(int)$min;
						$fsec=(int)$sec;
						$osec=($fhr*60*60)+($fmin*60)+$fsec;
						//echo "osec=".$osec;
						$_SESSION["seconds"]=$osec;
						$_SESSION["hr"]=$fhr;
						$_SESSION["min"]=$fmin;
						$_SESSION["sec"]=$fsec;
					  
				  }			
				 else{
				      $_SESSION["ost"]="cbc";
				}
			  
		  }
		  
		  
	  echo json_encode("may be working".$_SESSION["ost"]);
    }
  }
  else if($_SESSION["ost"]=="submitted"){
	  ?>
<!doctype html>
<html>
   <head>  
      <title>Submitted</title>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
   </head>
   <script>
      $(document).ready(function(){
		  window.open("stud_test_ans_view.php","_self");
		  $(document).on("click","#b1",function(event){
			  event.preventDefault();
			  window.open("ClassmPageJoiner.php","_self");
		  });
	  });
   </script>
   <body>
       <h1 align="center">You HAve Already Submitted</h1><br><br>
	   <input align="center" id="b1" type="button" value="Go Back">
   </body>
<html>
<?php	  

  }
  else if($_SESSION["ost"]=="terminated"||$_SESSION["ost"]=="cbc"){
	  ?>
<!doctype html>
<html>
   <head>  
      <title>Submitted</title>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   </head>
   <script>
      $(document).ready(function(){
		  $(document).on("click","#b1",function(event){
			  event.preventDefault();
			  window.open("ClassmPageJoiner.php","_self");
		  });
	  });
   </script>
   <body>
       <?php if($_SESSION["ost"]=="terminated"){?><h1 align="center">You were Terminated from test for using Wrong means</h1>
	   <?php }else if($_SESSION["ost"]=="cbc"){ ?>
	        <h1 align="center">You didn't attempted the test</h1>
	   <?php } ?>
	   <br><br>
	   <input align="center" id="b1" type="button" value="Go Back">
   </body>
<html>
<?php	  

  }
  else if($_SESSION["ost"]=="give"){
?>
<!doctype html>
<html> 
    <head>
	   <title>Give Test</title>
	   		 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
			  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<script>
	    $(document).ready(function(){
		$("#b11").css({"display":"none"});
		$("#d11").css({"display":"none"});
		$("#b24").css({"display":"none"});
		$("#b23").css({"display":"none"});
		
			//var elem = document.documentElement;
			//elem.requestFullscreen();
			//alert("If You Got out of Full Screen or Switched Tab then your Test will be terminated");
			var intr=setInterval(zx,100);
			var fl=0;
			var z=0;
			
			
			//var dur=setInterval(tp,100);
			function zx(){
				if(screen.height!=window.innerHeight){
					$("#ddd").html("<h1 align='center'>Open full Screen by fn f11 or f11 to begin test</h1>")
				}
				else{
					$("#ddd").css({"display":"none"});
				   $("#b11,#d11").css({"display":"block"});
				    $(".lefd,#d90,.vhu").css("display","block");
		            $("#ree1").css({"display":"inline-block"});
					$("#qq1").css({"display":"inline-block"});
					clearInterval(intr);
					//intr=setInterval(func,100);
					f1=0;
				}	
					
			}
			
			
			$(document).on("click","#b23",function(e){
				fl=1;
				$("#b23").css({"display":"none"});
				//$("#b24").css({"display":"block"});
				e.preventDefault();
				document.documentElement.requestFullscreen();
				
			});
			var focus=0;
			var warn=0;
	       	function func(){
				//alert(screen.height+",wH="+window.innerHeight+","+screen.width+",wW"+window.innerWidth);
				if(screen.height!=window.innerHeight){
					clearInterval(intr);
					warn++;
					if(warn==1){
						aa="1st"
					}
					else if(warn==2){
						aa="2nd";
					}
					else if(warn==3){
						termin();
					}
					alert("Warn "+aa+" Your Test will be terminated after 10 Seconds if you Didn't Open in Full Screen!");
					var sec=0;
					var wwe=setInterval(funda1,1000);
					function funda1(){
						if(screen.height==window.innerHeight){
							clearInterval(wwe);
							intr=setInterval(func,100);
						}
						else{ sec++;
						    if(sec>=10){
							  clearInterval(wwe);
                              termin();							  
							}
						}
						
					}
				}
				else if(screen.width!=window.innerWidth){
					
					clearInterval(intr);
					warn++;
					if(warn==1){
						aa="1st"
					}
					else if(warn==2){
						aa="2nd";
					}
					else if(warn==3){
						termin();
					}
					alert("Warn "+aa+" Your Test will be terminated after 10 Seconds if you Didn't Close Inspect Element!");
					var sec=0;
					var wwe=setInterval(funda2,1000);
					function funda2(){
						if(screen.width==window.innerWidth){
							clearInterval(wwe);
							intr=setInterval(func,100);
						}
						else{ sec++;
						    if(sec>=10){
							  clearInterval(wwe);
                              termin();							  
							}
						}
						
					}
					
				}
				else{
					$(window).blur(function(){
						
						$(window).unbind();
						if(focus==0){
							focus=1;
						alert("clearing");
						
						clearInterval(intr);
					        warn=1;
							if(warn==1){
								aa="1st"
							}
							else if(warn==2){
								aa="2nd";
							}
							else if(warn==3){
								termin();
							}
							alert("Warn "+aa+" Your Test will be terminated after 10 Seconds if you Didn't Close Another Tab");
							var sec=0;
							var wwe=setInterval(funda5,1000);
							
							function funda5(){
								//alert("isntoo");
								var fchk=0;
								var foc="";
								
								$(window).blur(function(){
									$(window).unbind();
									foc="blur";
									fchk=1;
								});
								if(fchk==0){
									$(window).unbind();
									foc="focus";
								};
								if(foc=="focus"){
									focus=0;
									clearInterval(wwe);
									alert("we aare focused");
							        intr=setInterval(func,100);
									
								}
								else{
                                   // alert("blurred");
									sec++;
									if(sec>=10){
									  clearInterval(wwe);
									  termin();	
                                      									  
									}
								}
								
							}
						}	
					});
				}
			}
			function termin(){
				clearInterval(intr);
				
				$.ajax({
					url:"give_test_back.php",
					type:"post",
					data:{ty:"term"},
					success:function(msg){
						var xx=jQuery.parseJSON(msg);
						alert(xx)
						window.open("ClassmPageJoiner.php","_self");
					}
				});
			}
			
			var fsec=parseInt("<?php echo $_SESSION['sec']; ?>");
			var fmin=parseInt("<?php echo $_SESSION['min']; ?>");
			var fhr=parseInt("<?php echo $_SESSION['hr']; ?>");
			var thec=setInterval(thc,1000);
			var thas=parseInt("<?php echo $_SESSION['seconds'] ?>");
			thas=thas*1000;
			var jfs=setTimeout(tts,thas);
			
			function thc(){
			    fsec=fsec-1;
				if(fsec==-1){
					fsec=59;
				}
                if(fsec==59){
					fmin=fmin-1;
					if(fmin==-1){
					   fmin=59;
				    }
					if(fmin==59){
						fhr=fhr-1;
					}
				}
				$("#fhr").html(fhr);
				$("#fmin").html(fmin);
				$("#fsec").html(fsec);
			}
			
			function tts(){
				$("#b11").trigger("click");
			}
			
			
			var c=0,g=1;
			var questt={};
			var vhu={};
			vhu[0]="No";
			vhu[1]="Yes";
			vhu[2]="Doubt";
			$.ajax({
				url:"give_test_back.php",
				type:"post",
				data:{ty:"load"},
				success:function(msg){
					$(".modal-title").html("Go To Question:");
				  	var dast=jQuery.parseJSON(msg);
					for(y in dast){
						c++;
						alert("it="+dast[y].typ);
						//$("#d11").append("<form id='frm"+c+"' data-id='"+dast[y].id+"' data-iw='fresh' data-ty='"+dast[y].typ+"' class='"+dast[y].typ+"' ><h2>Question "+c+" "+dast[y].quest+"</h2><div class='mon'></div></form>");
						questt[c]={},
						questt[c]["ques"]=dast[y].quest;
						questt[c]["id"]=dast[y].id;
						questt[c]["typ"]=dast[y].typ;
						questt[c]["mark"]=dast[y].mark;
						questt[c]["ott"]="fresh";
						questt[c]["whu"]=0;
						questt[c]["ttid"]="";
						questt[c]["ans"]="";
						$(".trav,.modal-body").append("<span class='inss' id='cq"+c+"' data-toggle='"+c+"'>"+c+"</span>")
						if(dast[y].typ=="mcq"){
							questt[c]["op1"]=dast[y].op1;
							questt[c]["op2"]=dast[y].op2;
							//$("#frm"+c+"> .mon").append("<input type='radio' name='op' class='op' data-op='op1' value='op1'>"+dast[y].op1+"<br><input type='radio' name='op' class='op' data-op='op2' value='op2'>"+dast[y].op2+"<br>");
							if(dast[y].op3!=null){
								questt[c]["op3"]=dast[y].op3;
								//$("#frm"+c+"> .mon").append("<input type='radio' name='op' class='op' data-op='op3' value='op3'>"+dast[y].op3+"<br>");
							}
							if(dast[y].op4!=null){
								questt[c]["op4"]=dast[y].op4;
								//$("#frm"+c+"> .mon").append("<input type='radio' name='op' class='op' data-op='op4' value='op4'>"+dast[y].op4+"<br>");
							}
						}
						else{
							//$("#frm"+c+"> .mon").append("<textarea name='ans' class='ans'></textarea><br>");
						}
						
					}
					alert("c ="+c);
					ookkk(g);
				
				}
			});
			
			function ookkk(f){
				alert("que is="+JSON.stringify(questt[1]));
			      	$("#ree1").removeClass();
					$("#ree1").addClass(questt[f]["typ"]);
				    $("#qq1").html("<h2>Question "+g+".)"+questt[f]["ques"]+"</h2>");
					$("#ree1").attr("data-id",questt[f]["id"]);
					$("#ree1").attr("data-ty",questt[f]["typ"]);
					$("#ree1").attr("data-iw",questt[f]["ott"]);
					$("#ree1").attr("data-ttid",questt[f]["ttid"]);
					if(questt[f]["typ"]=="mcq"){
						$("#ree1").html("Select the Answer From below:-<br>");
						$("#ree1").append("<input type='radio' name='op' class='op op1' data-op='op1' value='op1'>"+questt[f]["op1"]+"<br><input type='radio' name='op' class='op op2' data-op='op2' value='op2'>"+questt[f]["op2"]+"<br>");
						if((questt[f]).hasOwnProperty('op3')){
							$("#ree1").append("<input type='radio' name='op' class='op op3' data-op='op3' value='op3'>"+questt[f].op3+"<br>");
						}
						if((questt[f]).hasOwnProperty('op4')){
							$("#ree1").append("<input type='radio' name='op' class='op op4' data-op='op4' value='op4'>"+questt[f].op4+"<br>");
						}
						alert("quesft="+questt[f]["ott"])
						if(questt[f]["ott"]=="in"){
							alert("ans is="+questt[f]["ans"]+",2nd ."+questt[f]["ans"]+",3rd="+$("#ree1").find("."+questt[f]["ans"]).attr("name"));
							
							$("#ree1").find("."+questt[f]["ans"]).attr("checked",true);
						}
					}
					else if(questt[f]["typ"]=="norm"){
						$("#ree1").html("<textarea name='ans' class='ans'></textarea>");
						
						if(questt[f]["ott"]=="in"){
							$("#ree1").find(".ans").val(questt[f]["ans"]);
						}
					}
					if(questt[f]["whu"]!=''){
						$("#d90 > #"+questt[f]["whu"]).attr("checked",true);
					}
					else{
						$("#d90 > #green,#d90 > #yellow").attr("checked",false);
					}
			}
			$(document).on("click","#prr,#nee",function(eve){
				eve.preventDefault();
				if($(this).attr("id")=="prr"&&g!=1){
					g--;
					if(g==1){
						$("#prr").css({"display":"none"});
					}
					if($("#nee").css("display")=="none"){
						$("#nee").css("display","inline-block");
					}
					
				}
				else if($(this).attr("id")=="nee"&&g!=c){
					g++;
					if(g==c){
						$("#nee").css({"display":"none"});
					}
					if($("#prr").css("display")=="none"){
						$("#prr").css("display","inline-block");
					}
				}
				ookkk(g);
			});
			
			$(document).on("click",".inss",function(ele){
				ele.preventDefault();
				$("#mood1").modal("toggle");
				var tbs=$(this).attr("data-toggle");
				ookkk(tbs);
			});
			
			$(document).on("input","#yellow,#green",function(){
				questt[g]["whu"]=$(this).val();
				alert("itg="+g+"="+$(this).val());
				$("#cq"+g).removeClass("green");
				$("#cq"+g).removeClass("yellow");
				$("#cq"+g).addClass(questt[g]["whu"]);
			});
			
			$(document).on("click",".vhu",function(ele){
				ele.preventDefault();
				$("#mood1").modal("toggle");
				/*if($(".trav").css("display")=="none"){
					$(".trav").css("display","block");
				}
			    else if($(".trav").css("display")=="block")
					$(".trav").css("display","none");
			     */
			});
			
			$(document).on("input",".op",function(event){
				event.preventDefault();
				var ty="ins";
				var ttid="";
				var val=$(this).val();
				var typ=$(this).closest(".mcq").attr("data-ty");
				var qid=$(this).closest(".mcq").attr("data-id");
				if($(this).closest(".mcq").attr("data-iw")=="in"){
					ty="upd";
					ttid=$(this).closest(".mcq").attr("data-ttid");
				}
				var ff=$(this).closest(".mcq").attr("id");
				questt[g]["ans"]=val;
				var xcc=$(this).closest(".mcq").attr("data-iw");
				alert("id="+ff+"tt="+ttid);
				$.ajax({
					url:"give_test_back.php",
					data:{ty:ty,typ:typ,qid:qid,ans:val,ttid:ttid},
					type:"post",
					success:function(msg){
						var x=jQuery.parseJSON(msg);
						alert(JSON.stringify(x));
						alert(x[0].df);
						questt[g]["ott"]="in";
						$("#"+ff).attr("data-iw","in");
						questt[g]["ttid"]=x[0].df;
						$("#"+ff).attr("data-ttid",x[0].df);
					}
				});
			});
			$(document).on("input",".norm>.ans",function(event){
				event.preventDefault();
				//alert("ooop");
				var ty="ins";
				var ttid="";
				var typ=$(this).closest(".norm").attr("data-ty");
				var qid=$(this).closest(".norm").attr("data-id");
				var sub=$(this).val();
				questt[g]["ans"]=sub;
				if($(this).closest(".norm").attr("data-iw")=="in"){
					ty="upd";
					ttid=$(this).closest(".norm").attr("data-ttid");
				}
				//alert("ti="+sub+",oop="+ttid);
				var frm=$(this).closest(".norm").attr("id");
				$.ajax({
					url:"give_test_back.php",
					data:{ty:ty,typ:typ,qid:qid,ans:sub,ttid:ttid},
					type:"post",
					success:function(msg){
						var x=jQuery.parseJSON(msg);
						//alert(x[0].df);
						questt[g]["ott"]="in";
						$("#"+frm).attr("data-iw","in");
						questt[g]["ttid"]=x[0].df;
						$("#"+frm).attr("data-ttid",x[0].df);
					}
				});
				
			});
			$(document).on("click","#b11",function(event){
				event.preventDefault();
				$.ajax({
					url:"give_test_back.php",
					data:{ty:"sub"},
					type:"post",
					success:function(msg){
					    var cc=jQuery.parseJSON(msg);
						alert(cc);
						
						window.open("ClassmPageJoiner.php","_self");
					}
				});
			});
		});
	</script>
	<style>
	  #qq1,#ree1{
		 
		  
		  border:1px solid black;
		  
	  }
	  #qq1{
		   width:47%;
	  }
	  #ree1{
		  width:50%;  
	  }
	  .vhu{
		  float:right;
	  }
	  .trav{
		  display:none;
		  z-index:3;
	  }
	  .inss{
		  border:0.5px solid grey;
		  width:10px;
		  height:10px;
	  }
	  .lefd{
		  float:right;
		  display:none;
	  }
	  .trav>span{
		  cursor:pointer;
	  }
	  .yellow{
		  background-color:yellow;
	  }
	  .green{
		  background-color:green;
	  }
	  #d90,.vhu{
		  display:none;
	  }
	  #qq1,#ree1,textarea{
		  min-height:500px;
	  }
	  textarea{
		  resize:none;
	  }
	  .inss{
		  cursor:pointer;
	  }
	  .vhu{
		  cursor:pointer;
	  }
	  .bbbb{
		  height:30px;
	  }
	</style>
	<body>
	    <input id="b23" type="button" value="Full Screen Mode"></input>
		<input id="b24" type="button" value="Show Paper"></input>
		<div id="ddd"></div>
	    <h1 align="center "> Test Name <?php echo $_SESSION["gtnm"]; ?></h1>
        <br>
		<input id="b11" type="button" class='btn btn-primary' value="submit">
		<div class='lefd'>Time Left: <span id='fhr'></span> hours <span id='fmin' ></span> minutes <span id='fsec'></span> seconds</div>
		<div><div class='vhu bg-warning text-white'>Goto Menu</div><div class='trav'></div></div><br>
		<div id='d90'>Mark question:<input style="color:green;" type='radio' value='green' id='green' name='mm'>Done</span><input type='radio' style="color:yellow;" id='yellow' value='yellow' name='mm'>doubt</span></div>
        <div id="d11">
		   <input type='button' id="prr" class='btn btn-outline-info' value='Prev'><input type='button' class='btn btn-outline-info' id="nee" value="Next">
		   <div class='bbbb'></div>
		   <div id="qq1"></div>
		   <div id="ree1"></div>
		</div>
		<div class="modal fade" id="mood1">
			<div class="modal-dialog modal-dialog-centered">
			  <div class="modal-content">
			  
				<!-- Modal Header -->
				<div class="modal-header">
				  <h4 class="modal-title"></h4>
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