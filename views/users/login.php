<div class="login">
		<div class="container">
			
			<h2>Login Form</h2>
			
			
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="POST">
					<input type="text" placeholder="Email Address" required=" " name="username">
					<input type="password" placeholder="Password" required=" " name="password">
					<div class="forgot">
						<a href="#">Forgot Password?</a>
					</div>
					<input type="submit" value="Login" name="userlogin">
				</form>
			
				<?php
					if(!empty($this->error)){
				?>
					<div class="bg-warning" style="text-align: center; padding: 10px; margin-top: 20px;">
					
					<?php
						 echo $this->error; ?>
					</div>
				<?php } ?>

			</div>

			<h4>For New People</h4>
			<p><a href="registered.html">Register Here</a> (Or) go back to <a href="index.html">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
		</div>
	</div>