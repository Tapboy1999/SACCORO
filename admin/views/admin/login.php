<div class="login-bg">
	<div class="login-body">
		<?php if(!empty($this->error)){ ?>
			<div class="alert alert-warning" style="margin: 0;text-align: center">  
				<?php echo $this->error; ?>
			</div>
		<?php } ?>
	
		<div class="login-heading">
			<h1>Login</h1>
		</div>
		<div class="login-infor">
			<form action="" method="post">
				<input type="text" name="username" id="username" placeholder="Username" required="">
				<input type="password" name="password" id="password" placeholder="Password" required="">
				<div class="forgot-top-gird">
					<div class="remember">
						<input type="checkbox" id="brand1">
						<label for="brand1"><span>Nhớ mật khẩu</span></label>
					</div>
					<div class="forgot">
						<a href="">Quên mật khẩu?</a>
					</div>
				</div>
				<input type="submit" name="submit" value="Login">
				<div class="signup-text">
					<span>Bạn chưa có tài khoản? <a href="" class=""> Đăng ký ngay</a></span>
				</div>
			</form>
		</div>
		
	</div>
</div>