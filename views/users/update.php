
<!-- //register -->


<div class="container">
	<div class="register">
	<div class="row">
		<h2>Quản lý tài khoản</h2>
		<form method="post" enctype="multipart/form-data">
			<div class="col-md-6 col-sm-12" style="padding-top: 50px">
				<h3 style="margin-bottom: 30px">Sổ địa chỉ</h3>
				<p style="margin-bottom: 20px">Địa chỉ nhận hàng mặc định</p>
				<h4 style="margin-bottom: 10px"><?php echo $_SESSION['userlogin']['full_name']; ?></h4>
				<p style="margin-bottom: 10px"><?php echo $_SESSION['userlogin']['address']; ?></p>
				<p><?php echo "(+84) ".$_SESSION['userlogin']['phone']; ?></p>
				<img style="width: 300px;height: 300px; border-radius: 150px;margin-bottom: 20px" src="./assets/uploads/users/<?php echo $_SESSION['userlogin']['avatar'] ?>" alt="">
				<input type="file" name="useravatar">
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="login-form-grids" style="width: 100%">
					
					<h5>Chỉnh sửa</h5>
					<input type="text"  required=" " name="re_fullname" value="<?php echo $_SESSION['userlogin']['full_name']?>">
					<input type="email"  required=" " name="re_email" value="<?php echo $_SESSION['userlogin']['email']?>">
					<input type="text"  required=" " name="re_phone" value="<?php echo "0".$_SESSION['userlogin']['phone']?>">
					<input type="text"  required="" name="re_address" value="<?php echo $_SESSION['userlogin']['address']?>">
					<input type="submit" value="cập nhật" name="update">
				</div>
			</div>
		</form>
	</div>
	<div class="register-home">
				<a href="index.php">Home</a> 
			</div>
</div>
</div>
