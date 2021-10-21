<!doctype html>
<html>
   <head>
      <title>Click create</title>
   </head>
   <script>
     window.onload=function(){
       var a=document.getElementById('in1');
	   a.onclick=function(){
		   window.open("add.php","_self");
	   }
	   var b=document.getElementById('in2');
	   b.onclick=function(){
		   window.open("add.php","_self");
	 }}
   </script>
   <style>
      #opbn{
		  position:fixed;
		  top:40%;
		  left:40%;
	  }
	  label{
		  font-size:30px;
	  }
   </style>
   <body>
      <h1 align="center">Upload an excel sheet of Students name or enter Manually.</h1>
	  <div id="opbn">
	  <label >Select the mode to feed the data?</label><br><br>
	  <input type="file" value="Upload the file here" id="in1"/><br>
	  <h3>OR</h3><br>
	  <input type="button" value="Enter data Manually" id="in2">
	  </div>
   </body>
</html>