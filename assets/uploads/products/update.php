<!-- register -->
<?php if(!empty($this->error)){ ?>
<script>
	window.alert("<?php echo $this->error?>");
</script>

<?php }?>
	<div class="register">
		<div class="container">
			<h2>Tài khoản của tôi</h2>
			<form method="post" enctype="multipart/form-data">
				<div class="myaccount row">
					<div class="col-md-6 col-sm-12" style="margin-top: 50px;" >
						<h3 style="padding-bottom: 30px">Sổ địa chỉ</h3>
						<p style="padding-bottom: 10px">Địa chỉ nhận hàng mặc định</p>
						<h4 style="padding-bottom: 10px"><?php echo $_SESSION['userlogin']['full_name']; ?></h4>
						<p style="padding-bottom: 10px"><?php echo $_SESSION['userlogin']['email']; ?></p>
						<p style="padding-bottom: 10px"><?php echo $_SESSION['userlogin']['address']; ?></p>
						<p style="padding-bottom: 10px"><?php echo "(+84) ".$_SESSION['userlogin']['phone']; ?></p>
						<img style="width: 200px;height: 200px;border-radius: 100px; margin-bottom: 30px" src="./assets/uploads/users/<?php echo $_SESSION['userlogin']['avatar'] ?>" alt="">
						<input type="file" name="useravatar" class="form-control-file" placeholder="" style="outline-style: none">
					</div>
					<div class="login-form-grids col-md-6 col-sm-12">
						<h5>Chỉnh sửa</h5>
						<input type="text" placeholder="Họ và tên" required=" " name="re_fullname" value="<?php echo $_SESSION['userlogin']['full_name']; ?>">
						<input type="email" placeholder="Email" required=" " name="re_email" value="<?php echo $_SESSION['userlogin']['email']; ?>">
						<input type="text" placeholder="Điện thoại" required=" " name="re_phone" value="<?php echo $_SESSION['userlogin']['phone']; ?>">
						<textarea  class="form-control" required="" name="re_address" placeholder="Địa chỉ" ><?php echo $_SESSION['userlogin']['address']; ?></textarea>
						<input type="submit" value="Cập nhật" name="update">
					</div>
				</div>
			</form>
			<div class="register-home">
				<a href="index.php">Home</a>
			</div>
		</div>
	</div>
<!-- //register -->