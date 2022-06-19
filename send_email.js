
      function sendEmail(to,body) {
		  alert("ema="+to);
      Email.send({
        Host : "smtp.gmail.com",
        Username:"xcv",
        Password: "xcy",
        
        To: to,
        From: "Performers.com <khil@gmail.com>",
        Subject: "Email Verification",
        Body:body,
      }).then(message=>console.log("emailVerification done:"+message))
      .catch(error=>console.log("emailVerification err:"+error));
      console.log("emailVerification out")
	  }

   
	  
	 
  
