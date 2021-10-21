<?php 
   if(isset($_POST["thv"])){
	   if ( isset( $_FILES["file"] ) ){
           $dir = 'some/dir/';
           $blob = file_get_contents($_FILES["file"]['tmp_name']);
          file_put_contents($dir.$_FILES["file"]["name"], $blob);
          }
   }
   else {
?><!doctype html>
<html>
   <head>  
      <title>Test record</title>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   </head>
   <script>
      $(document).ready(function(){
		    var preview = document.getElementById("preview");
			var recording = document.getElementById("recording");
			var startButton = document.getElementById("start");
		var stopButton = document.getElementById("stop");
			//var downloadButton = document.getElementById("downloadButton");
			//var logElement = document.getElementById("log");

		  
		  
		  
		  function startRecording(stream) {
		  var recorder = new MediaRecorder(stream);
		  var data = [];

		  recorder.ondataavailable = event => data.push(event.data);
		  recorder.start();
		

		  

		  return Promise.all([
			recorded
		  ])
		  .then(() => data);
}


       startButton.addEventListener("click", function() {
  navigator.mediaDevices.getUserMedia({
    video: true,
    audio: true
  }).then(stream => {
    preview.srcObject = stream;
   
    preview.captureStream = preview.captureStream || preview.mozCaptureStream;
    return new Promise(resolve => preview.onplaying = resolve);
  }).then(() => startRecording(preview.captureStream()))
  .then (recordedChunks => {
    let recordedBlob = new Blob(recordedChunks, { type: "video/mp4" });
    recording.src = URL.createObjectURL(recordedBlob);
    downloadButton.href = recording.src;
    downloadButton.download = "RecordedVideo.webm";

    alert("Successfully recorded ")
  })
  .catch();
}, false);
      
	  $("#stop").click(function(){
		  var io=preview.srcObject;
		  io.stream.getTracks().forEach(track => track.stop());
	  });

	  });
	  
   </script>
   <body>
     <h1>I am goin going to take a test recording</h1>
	 <input type='button' id='start' ><input type='button' id='Stop'>
	 <video id='preview' muted> </video>
   </body>
   
</html>
   <?php } ?>