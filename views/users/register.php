<!-- register -->
<?php if(!empty($this->error)){ ?>
<script type="text/javascript">
	window.alert("<?php echo $this->error; ?>");
</script>
<?php } ?>
	<div class="register">
		<div class="container">
			<h2>Đăng ký ngay</h2>
			<div class="login-form-grids">
				<h5>Đăng ký</h5>
				<form method="post">
					<input type="text" placeholder="Tên đăng nhập" required="" name="re_username">
					<input type="password" placeholder="Mật khẩu" required="" name="re_password">
					<input type="password" placeholder="Nhập lại mật khẩu" required=" " name="re_confirmpass">
					<input type="text" placeholder="Họ và tên" required=" " name="re_fullname">
					<input type="email" placeholder="Email" required=" " name="re_email" >
					<input type="text" placeholder="Điện thoại" required=" " name="re_phone">
					<input type="text" placeholder="Địa chỉ" required="" name="re_address">
					<div class="register-check-box">
						<div class="check">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>Tôi đồng ý với các điều khoản</label>
						</div>
					</div>
					<input type="submit" value="Register" name="register">
				</form>
			</div>
			<div class="register-home">
				<a href="index.php">Home</a> 
			</div>
		</div>
	</div>
<!-- //register -->