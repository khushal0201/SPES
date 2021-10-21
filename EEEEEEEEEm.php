<!doctype html>
<html>
   <head>
       <title></title>
	   <script src="https://smtpjs.com/v3/smtp.js"></script>
	  
    <meta name="google-signin-client_id" content="673014018053-ikdqfej7lll8865uv7l77qjqdo4u3f1c.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	
  </head>
   </head>
   <script type="text/javascript">
        var x="";
		function helle(){
		x=document.getElementById("v1");
		alert(x.value);
		sendEmail();
		}
		
       function sendEmail(){
		   
		   Email.send({
			   Host:"smtp.gmail.com",
			   Username:"khumonar@gmail.com",
			   Password:"Khushal@1408",
			   To:"khusbablu34@gmail.com",
			   From:"khumonar@gmail.com",
			   Subject:"This is temp",
			   Body:x.value,
			   }).then(function(msg){
				   alert("mail sent in success manner"+msg);
			   });
			   
	   }
	    function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
		alert(JSON.stringify(profile));
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
		alert(profile.getImageUrl());
		document.getElementById("e24").setAttribute("src",profile.getImageUrl());
      }
   </script>
   <body>
       <h1 align="center">Khushal Makhija</h1>
	    <div class="g-signin2" data-onsuccess="onSignIn" ></div>
	   <div style="border:3px solid black;width:300px;">
	   Enter your MSg:<input type="text" placeholder="Enter your message" id="v1" name="v1"><br><br><br>
	   <input type="button" onclick="helle()" value="send">
	   </div>
	   <div >
	      <img id="e24" src=""/>
	   </div>
   </body>
   

</html>