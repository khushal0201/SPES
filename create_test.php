<?php
  session_start();
  if(isset($_POST["ty"])){
	  if($_POST["ty"]=="old"){
		  $_SESSION["tty"]="old";
		  $_SESSION["otid"]=$_POST["otid"];
		  $_SESSION["otin"]=$_POST["otin"];
		  $_SESSION["status"]=$_POST["status"];
		  $_SESSION["tmrk"]=$_POST["tmrk"];
		  if($_SESSION["tmrk"]==''){
			  $_SESSION["tmrk"]=0;
		  }
		  
	  }
	  echo "helo khushal=".$_SESSION["tty"].",status=".$_SESSION["status"];
  }
  else{
		  if($_SESSION["tty"]=="")
			  $_SESSION["tty"]="new";
	  
	      
?>
<!doctype html>
<html>
    <head>
	   <title>Creating quiz</title>
	   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	   	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<script>
	     $(document).ready(function(){
			 var c=1,opt=2,max=c,markk=0;
			 var noq=0;
			 $(".totmark").html(markk);
			 if("<?php echo $_SESSION['tty'] ?>"=="old"){
				 //alert("it is="+"<?php echo $_SESSION['id'];?>")
				 $.ajax({
					 url:"create_test_entry.php",
					 data:{ty:"loader"},
					 type:"post",
					 success:function(msg){
						 var data=jQuery.parseJSON(msg);
						 
						 //alert("hellooooooooooo"+JSON.stringify(data));
						   $("#d12,#b1").css({"display":"block"});
						   $(".totmark,.fot").css({"display":"inline-block"});
						 for(y in data){
							 //alert("data ="+JSON.stringify(data[y]));
							 //$("#888888").html("<h1>heelooooo</h1>");
							 noq++;
							 c++;
							 if(noq==1){
								 $("#d36").css("display","block");
							 }
						 
							  $("#d12").append("<div id='xy"+(c-1)+"' class='thed'><span class='tq'>Question "+(c-1)+". </span><form class='2f was-validated' data-ott='' data-edit='' id='frm"+c+"' ><div class='d21'><span  style='font-size:36px;float:right;'><i class='far fa-trash-alt'></i></span><label class='nml'>Select the question type</label><input id='tm"+c+"' type='radio' class='qty mcq' name='qty'  value='mcq'><label for='tm"+c+"'>MCQ type</label><input type='radio' id='tn"+c+"' name='qty' class='qty norm' value='norm'><label for='tn"+c+"'>Text type</label></div><div class='d23'></div></form><br>");
							 var quest=data[y].quest;
							 var mark=data[y].mark;
							 var typp=data[y].typp;
							 if(typp=="mcq"){
								var opt="2";
							    var oooo=$("#d12 > #frm"+c+" > .d21 > .mcq").val(); 
                                 alert(oooo);
								 $("#d12 > #frm"+c+" > .d21 > .mcq").attr("checked",true);
								 $("#frm"+c+">.d23").html("<label style='font-size:20px'>Enter Question</label><textarea class='quest form-control' name='quest' required></textarea><div class='mass' style='margin-left:300px'><label >Question Mark</label><input type='number' data-omark='"+mark+"' class='marki form-control' name='mark' required></div><div class='d24'>Option 1<input class='op oop1 form-control' type='text' name='op1' required><br>Option 2<input type='text' class='op oop2 form-control' name='op2' required><br></div><input type='button' class='b2 btn btn-info' value='Add more options'><select class='ans' name='ans' required><option class='op1' value='op1'>"+data[y]["op1"]+"</option><option class='op2' value='op2'>"+data[y]["op2"]+"</option></select></div>");								 
							      $("#frm"+c+">.d23 > .quest").html(quest);
								  $("#frm"+c+">.d23 > .mass>.marki").val(mark);
								  $("#frm"+c+">.d23 > .d24 > .oop1").val(data[y].op1);
								  $("#frm"+c+">.d23 > .d24 > .oop2").val(data[y].op2);
								  if(data[y].op3!=null){
									  opt++;
								    $("#frm"+c+">.d23 > .d24").append("Option 3<input class='op oop3 form-control' type='text' name='op3' value='"+data[y].op3+"' required><br>");
								    $("#frm"+c+">.d23 >.ans").append("<option class='op3' value='op3'>"+data[y]["op3"]+"</option>");
									
								  }
								if(data[y].op4!=null){
									opt++;
								    $("#frm"+c+">.d23 > .d24").append("Option 4<input class='op oop4 form-control' type='text' name='op4' value='"+data[y].op4+"' required><br>");
								    $("#frm"+c+">.d23 >.ans").append("<option class='op4' value='op4'>"+data[y]["op4"]+"</option>");
									$("#frm"+c).find(".b2").css({"display":"none"});
								}	
                                $("#frm"+c).attr("data-opt",opt);								
								$("#frm"+c+">.d23 > .ans > ."+data[y].ans).attr("selected",true);
							}
							else{
								$("#d12 >#frm"+c+">.d21 >.norm").attr("checked",true);
								$("#frm"+c+">.d23").html("<label style='font-size:30px'>Enter Question</label><textarea class='quest' name='quest'></textarea><div class='mass' style='margin-left:300px'><label >Question Mark</label><input type='number' data-omark='"+mark+"' class='marki form-control' name='mark'></div>");
								$("#frm"+c+">.d23 > .quest").html(quest);
								$("#frm"+c+">.d23 > .mass >.marki").val(mark);
							}
							alert("c=frm"+c+",data-typ="+data[y].typp+",data id="+data[y].id);
							//$("#frm"+c+">.ed").attr("id",data[y].id);
							 //$("#frm"+c+">.ed").attr("data-frm",c);
							 alert("c=frm"+c+",data-typ="+data[y].typp+",data id="+data[y].id);
							 $("#frm"+c).attr("data-edit","true");
							 $("#frm"+c).attr("data-id",data[y].id);
							 //$("#frm"+c).html("000");
							 $("#frm"+c).attr("data-ott",data[y].typp);
							 $("#frm"+c+">.ed").css({"display":"block"});
							 $("#frm"+c+">.sub").css({"display":"none"});
							// $("#frm"+c+" :input").prop("disabled", true);
							 $("#frm"+c+">.ed").prop("disabled", false);
							 markk+=parseInt(data[y].mark);
							 //c++;
							 max=c;	
						 }	
                          $(".totmark").html(markk);						 
					 }
                   				 
				 });
			 }
			 $(document).on("change input","#mtestn",function(){
				 if($(this).attr("data-goon")!="yes"){
					 return false;
				 }
				 if($(this)[0].checkValidity()==false){
					 return false;
				 }
			      var val=$(this).val();
				  $.ajax({
					  url:"create_test_entry.php",
					  type:"post",
					  data:{ty:"ndat",val:val},
					  success:function(msg){
						  var hhh=jQuery.parseJSON(msg);
						  alert(hhh);
					  }
				  })
			 });
			 
			 $("#frm1").submit(function(event){
				 event.preventDefault();
				 if($(this)[0].checkValidity()==false){
					 return false;
				 }
				 var dats=$(this).serializeArray().reduce(function(obj, item) {
						obj[item.name] = item.value;
						return obj;
					}, {});
				 $.ajax({
					 url:"create_test_entry.php",
					  type:"post",
					 data:{ty:"maket",dats},
					 success:function(msg){
						 var tid=jQuery.parseJSON(msg);
						 alert(tid);
						 $("#tid").val(tid);
						 $("#frm1>.form-group>#mtestn").attr("data-goon","yes");
						 $(".smop").css({"display":"none"});
						 $("#d12,#b1").css({"display":"block"});
						 $(".totmark,.fot").css({"display":"inline-block"});
					 }
				 });
			 });
			 $(document).on("click","#b31",function(){
				// event.preventDefault();
				if($(".2f")[0].checkValidity()==false){
					$(".modal-title").html("Error!!");
					$(".modal-body").html("Fill it first")
					return false;
				   
				}
				
				//$("#b31").css({"display":"none"});
				$(".modal-title").html("Schedule The test");
				$(".modal-body").html("<form class='was-validated' id='d77'><label>Enter test time</label><input type='time' class='finaa' id='time' name='time' required><br><label>Enter Test Date</label><input type='date' class='finaa' id='date' name='date' required><br><label>Enter Duration of test:</label><input type='number' id='hrs' min='0' max='23' required>hr <input type='number' id='minu' min='0' max='59' required> min <input type='number' id='secs' min='0' max='59' required> sec<br><input id='b3' type='button' class='btn btn-primary' value='Schedule'></form>");
				$("#uuu").css({"display":"block"});
				$("#mood1").modal("toggle");
			 });
			 
			 $(document).on("click","#b3",function(eve){
				 if($("#d77")[0].checkValidity()==false){
					 alert("Fill all the details");
					 return false;
				 }
				 eve.preventDefault();
				 qeee();
			 });
			 
			 function qeee(){
				  var tid=$("#tid").val();
				  alert("tid="+tid);
				  var ttm=$("#time").val();
				  var ttd=$("#date").val();
				  var dh=$("#hrs").val();
				  var dm=$("#minu").val();
				  var ds=$("#secs").val();
				 $.ajax({
					 url:"create_test_entry.php",
					 type:"post",
					 data:{ty:"cht",tid:tid,ttm:ttm,ttd:ttd,hrs:dh,min:dm,sec:ds},
					 success:function(msg){
						 var data=jQuery.parseJSON(msg);
						 
						 alert("changes="+data);
						 $("#d36").html("The Test is published to students");
						 window.open("ClassmPageJoiner.php","_self");
					 }
				 });
			 }
			 
			 $("#b1").click(function(){
				 if(max>parseInt(c)){
					 c=max;
				 }
				 c++;
				 opt=2;
				 max=c;
				 noq++;
				 if(noq==1){
					 $("#d36").css("display","block");
				 }
				 $("#d12").append("id='xy"+(c-1)+"' class='thed'<span class='tq'>Question "+(c-1)+". </span><form class='2f was-validated' data-qty='' data-opt='2' data-ott='' data-edit='' id='frm"+c+"' ><div class='d21'><span  style='font-size:36px;float:right;'><i class='far fa-trash-alt'></i></span><label class='nml'>Question type</label><input type='radio' id='tm"+c+"' class='qty mcq' name='qty' value='mcq'><label for='tm"+c+"'>MCQ type</label><input id='tn"+c+"' type='radio' name='qty' class='qty norm' value='norm'><label for='tn"+c+"' >Text type</label></div><div class='d23'></div><br>");
			 });
			 $(document).on("click",".d21>.qty",function(){
				 //alert("c is="+c);
				 var idheidhe=$(this).val();
				 alert("val is....."+idheidhe);
				 console.log("chkersss");
				 //alert("val="+idheidhe);
				 var vaal=$(this).val();
				 var ott,oid;
				 var tbs="no";
				 if($(this).closest(".2f").attr("data-edit")=="true"){
					 tbs="yes";
					 ott=$(this).closest(".2f").attr("data-ott");
					 oid=$(this).closest(".2f").attr("data-id");
					 var oma=$(this).closest(".2f").find(".marki").attr("data-omark");
					 oma=parseInt(oma);
					 if(oma==null || oma==''){
						 oma=0;
					 }
					 $(this).closest(".2f").find(".marki").attr("data-omark",'');
					  markk=markk-oma;
					  $(".totmark").html(markk);
				 }
				 
				 
				 
				 var iii=$(this).closest(".2f").attr("id");
				 console.log("kinda="+iii);
				// alert("bhuuuuuuuu");
				 $.ajax({
					 url:"create_test_entry.php",
					 type:"post",
					 data:{ty:"inss",qty:vaal,tbs:tbs,ott:ott,oid:oid},
					 success:function(msg){
				        	var www=jQuery.parseJSON(msg);
							var qqid=www[0].id;
							alert("v1="+www+",v2="+qqid+$("#"+iii).attr("class"));
							$("#"+iii).attr("data-id",qqid);
							$("#"+iii).attr("data-edit","true");
							$("#"+iii).attr("data-ott",vaal);
							carl(vaal,iii);
                            							
					 }
				 });
				 
			  function carl(vaal,iii){
				 if(vaal=="mcq"){
					 alert("c="+c);
					 $("#"+iii).attr("data-opt",2);
					 $("#"+iii+">.d23").html("<label style='font-size:20px'>Enter Question</label><textarea class='quest form-control' name='quest' required></textarea><div class='mass' style='margin-left:300px'><label >Question Mark</label><input type='number' data-omark='0' class='marki form-control' name='mark' required></div><div class='d24'>Option 1<input class='op form-control' type='text' name='op1' required><br>Option 2<input type='text' class='op form-control' name='op2' required><br></div><input type='button' class='b2 btn btn-info' value='Add more options'><select class='ans' name='ans'><option class='op1' value='op1'></option><option class='op2' value='op2'></option></select></div>");
				 }
				 else{
					 $("#"+iii+">.d23").html("<label style='font-size:20px'>Enter Question</label><textarea class='quest form-control' name='quest' required></textarea><div class='mass' style='margin-left:300px'><label >Question Mark</label><input type='number' data-omark='0' class='marki form-control' name='mark'></div>");
				 }
			  } 
			 });
			 
			 $(document).on("change input",".marki",function(eve){
				 eve.preventDefault();
				 alert("hello");
				 var oma=$(this).attr("data-omark");
				 oma=parseInt(oma);
				 if(oma==null || oma==''){
					 oma=0;
				 }
				 alert("tmark="+markk);
					 markk=markk-oma;
					 markk+=parseInt($(this).val());
					 $(this).attr("data-omark",$(this).val());
					  $(".totmark").html(markk);
				$.ajax({
					url:"create_test_entry.php",
					type:"post",
					data:{ty:"msd",val:markk},
					success:function(msg){
						var cvc=jQuery.parseJSON(msg);
						
					}
				});	  
			 });
			 
			 $(document).on("input change",".d23>.quest,.marki,.d23>.d24>input,.d23>select",function(ele){
				 ele.preventDefault();
				 var qid=$(this).closest(".2f").attr("data-id");
				 var oqqq=$(this).closest(".2f").attr("id");
				 var das=$("#"+oqqq).serializeArray().reduce(function(obj, item) {
						obj[item.name] = item.value;
						return obj;
					}, {});
				 $.ajax({
					 url:"create_test_entry.php",
					 type:"post",
					 data:{ty:"updat",das,qid:qid},
					 success:function(msg){
						 var ttt=jQuery.parseJSON(msg);
					 }
					 
				 });
			 });
			 
			 $(document).on("click",".b2",function(){
				 opt=$(this).closest(".2f").attr("data-opt");
				 opt++;
				 $(this).closest(".2f").attr("data-opt",opt);
				 var iii=$(this).closest(".2f").attr("id");
				 $("#"+iii+">.d23 > .d24").append("<label>Option"+opt+"</label><input type='text' class='op form-control' name='op"+opt+"' required></input><br>");
				 $("#"+iii+">.d23 > select").append("<option class='op"+opt+"' value='op"+opt+"'></option>");
				 if(opt>=4){
					 $("#"+iii+">.d23 > .b2").css({"display":"none"});
				 }
			 });
			 
			 $(document).on("input change",".d24 > .op",function(){
				// alert("inside");
				var iii=$(this).closest(".2f").attr("id");
				 var dy=$(this).attr("name");
				 var dyv=$(this).val();
				 //alert("name="+dy+",va="+dyv+",sel="+$(".d23 > select > ."+dy).val());
				 $("#"+iii+">.d23 > select > ."+dy).html(dyv);
			 });
			 
			 $(document).on("click",".ed",function(){
			    	 var frm=$(this).attr("data-frm");
					 $("#frm"+frm+" :input").prop("disabled",false);
			 });
			 
			 $("#frm"+c).on("submit",function(event){
				event.preventDefault();
                alert("c is="+c);				
			 });
			 
			 
			 $(document).on("submit",".2f",function(event){
				 event.preventDefault();
				 var das=$(this).serializeArray().reduce(function(obj, item) {
						obj[item.name] = item.value;
						return obj;
					}, {});
					var tidi=$("#tid").val();
					var check=$(this).attr("data-edit");
					var ty="inset";
					if(check=="true"){
						ty="upd";
					}
					alert("das="+das);
					var ott=$(this).attr("data-ott");
					var oid=$($(this).attr("id")+">.ed").attr("id");
				 $.ajax({
					 url:"create_test_entry.php",
					 type:"post",
					 data:{ty:ty,tid:tidi,das,ott:ott,oid:oid},
					 success:function(msg){
						 var key=jQuery.parseJSON(msg);
						 alert(JSON.stringify(key));
						 $("#frm"+c+">.ed").attr("id",key.ids);
						 $("#frm"+c+">.ed").attr("data-frm",c);
						 $("#frm"+c).attr("data-edit","true");
						 
						 $("#frm"+c).attr("data-ott",key.ty);
						 $("#frm"+c+">.ed").css({"display":"block"});
						 $("#frm"+c+">.sub").css({"display":"none"});
						 $("#frm"+c+" :input").prop("disabled", true);
					 }
				 });
			 });
			 
		 });
	</script>
	<style>
	   .ed{
		   display:none;
	   }
	   #tnm,#b1{
		   display:none;
	   }
	   #d12{
		   display:none;
		   margin-left:auto;
		   margin-right:auto;
		   width:90%;
		   
		   
	   }
	   #d11{
		   margin-left:auto;
		   margin-right:auto;
		   padding:40px;
		  
		  
	   }
	   #d36{
		   display:none;
		   position:relative;
		   margin-left:auto;
	   }
	   .totmark,.fot{
		   display:none;
	   }
	   .fot{
		   float:right;
	   }
	   #mtestn{
		   display:inline-block;
	   }
	   #frm1{
		   display:block;
		   width:80%;

	   }
	   #frm1>.form-group,#frm1>.form-group>.form-control{
		   display:inline-block;
		   
	   }
	   #frm1>.form-group{
		   width:40%;
		   margin-left:40px;
		   display:inline-block;
	   }
	   
	   #frm1>.form-group>.form-control{
		   width:100%;
	   }
	   textarea{
		   resize:none;
	   }
	   .qty{
		   margin-left:30px;
	   }
	   .\32 f{
		   width:80%;
		   float:right;
		   border:2px solid grey;  
	   }
	   .nml{
		   font-size:25px;
	   }
	   .tq{
		   font-size:20px;
	   }
	   .quest{
		   width:60%;
	   }
	   .marki{
		   width:30%;
	   }
	   .op1,.op2,.op3,.op4,.op{
		   width:50%;
	   }
	   .thed{
		   displa:block;
	   }
	</style>
	<body>
	    <h1 align="center">Create new Online Test for Class <?php echo $_SESSION["name"]; ?></h1>
		<br><div id="d11">
	    <div id="888888"></div>
		<?php if($_SESSION["tty"]=="old"){?>
		     <form id="frm1" class='was-validated' >
			    <label style="font-size:25px;">The name of your test is:  </label>
				<div class='form-group'>
			       <input class='form-control' type="text" name="mtestn" data-goon='yes' value='<?php echo $_SESSION["otin"]; ?>' required><br>
				</div>
			 </form>
			 <div class='fot'>Total mark:<div class='totmark'><?php echo $_SESSION["tmrk"]; ?></div></div>
		<?php } else{?>
			<form  id="frm1" class='was-validated'>
				<label style="font-size:25px;">Enter the name of Test:</label>
				<div class='form-group'>
				  <input class='form-control' type="text" data-goon='no' name="mtestn" id="mtestn" required>
				</div>
				<div class='d-flex justify-content-center'><input class='smop btn btn-primary' type="submit" value="submit"></div>
				
			</form>
			<div class='fot'>Total mark:<div class='totmark'></div></div>
		<?php } ?>
		</div>
		 <div id="d36"><?php if($_SESSION["tty"]=="new"||($_SESSION["tty"]=="old" && $_SESSION["status"]!="publish")){ ?> Publish the test to students<input id="b31" class='btn btn-primary' type="button" value="Publish"><?php } else { ?>This Test was Published to Students <?php } ?></div>
		
		 
         <input type="text" id="tid" style="display:none;" <?php if($_SESSION["tty"]=="old"){ ?>  value='<?php echo $_SESSION["otid"] ?>' <?php }?> >
		 <div id='uuu'></div><br><br>
		<div id="d12">
		 <?php if($_SESSION["tty"]=="new"){ ?>
		  <!--<form class='2f' data-ott='' data-edit='' id="frm2">
		     <div class="d21">
			      <h3>Select the question type</h3>
				  <input type="radio" class="qty" name="qty" value="norm"><label>Text type</label>
				  <input type="radio" class="qty" name="qty" value="mcq"><label>MCQ type</label>
			 </div>
			 <div class='d23'>
			 </div>
			 <!--<input type='submit' value='Set Question' class="sub">
		     <input type='button' value='edit' class='ed'>
		   </form><br>--> 
		 <?php } ?> 
		 
		</div>
		<br><br><br><br>
		<input class='btn btn-info' type="button" id="b1" value="Add Question"/>
		<div id="d33">
		    
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