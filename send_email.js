
      function sendEmail(to,body) {
		  alert("ema="+to);
      Email.send({
        Host: "smtp.gmail.com",
        Username: "khumonar@gmail.com",
        Password: "Khushal@1408",
        To: to,
        From: "khumonar@gmail.com",
        Subject: "Email Verification",
        Body:body,
      });
	  }
	  
	 
  