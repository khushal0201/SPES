 <nav class="navbar navbar-expand-sm bg-dark navbar-dark pt-2 pb-3">
			   <h1 class='navbar-brand' style="font-size:40px;">Performers</h1>
			   <ul class='navbar-nav'>
				   <li class="nav-item"><a class="nav-link" href='exx.php'>Home</a></li>
				   <li class="nav-item"><a class="nav-link">About</a></li>
				   <li class="nav-item"><a class="nav-link">Contact us</a></li></ul>
				   <ul class="navbar-nav ml-auto"><li style="cursor:pointer;" class="nav-item ml-auto" id="oppp"><?php if(!isset($_SESSION["uid"])){?>
				   <a id="b13" class="nav-link btn btn-info text-white" type="button" >Log-in/Sign-Up
				   <?php } if(isset($_SESSION["uid"])){ ?><a data-toggle="modal" data-target="#logg" class="nav-link">Logged In as <?php  echo $_SESSION["u-name"]; } ?></a></li></ul>
	   </nav>
	   <br><br><br><br>
			 <div class="modal" id="logg">
				<div class="modal-dialog modal-dialog-centered">
				  <div class="modal-content">
				  
					<!-- Modal Header -->
					<div class="modal-header">
					  <h4 class="modal-title">User name= <?php  echo $_SESSION["u-name"];  ?></h4>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<!-- Modal body -->
					<div class="modal-body">
					   <h3>Your Full Name= <?php echo $_SESSION["u-name"]; ?></h3><br><br><br>
					   <h3>Your email= <?php echo $_SESSION["email"]; ?></h3>  <br>
					   
					</div>
					
					<!-- Modal footer -->
					<input type="button" class="btn btn-danger btn-sm" id="sigou" value="Sign-out">
					
				  </div>
				</div>
			  </div>