
      function sendEmail(to,body) {
		  alert("ema="+to);
      Email.send({
        Host : "smtp.gmail.com",
        Username:"khumonar@gmail.com",
        Password: "hviwwibrltcfqrcp",
        
        To: to,
        From: "Performers.com <khil@gmail.com>",
        Subject: "Email Verification",
        Body:body,
      }).then(message=>console.log("emailVerification done:"+message))
      .catch(error=>console.log("emailVerification err:"+error));
      console.log("emailVerification out")
	  }

    // Some other Details
    // Host : "smtp.elasticemail.com",
    // password: 62141FB633437E7E777D45CEB6586945C25E
    // Username:khumonar@gmail.com
	  
	 
  