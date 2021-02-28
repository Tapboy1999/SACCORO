<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="products.html">SHOP NOW</a></p>
			</div>
			<div class="agile-login">
				<ul>
				<?php if(isset($_SESSION['userlogin'])){ ?>
					<li><img style="width: 50px;height: 50px;border-radius: 100px;" src="./assets/uploads/users/<?php echo $_SESSION['userlogin']['avatar'] ?>" alt=""></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['userlogin']['full_name']; ?><b class="caret"></b></a>
						<ul class="dropdown-menu multi-column columns-3">
							<div class="row">
								<div class="multi-gd-img">
									<ul class="multi-column-dropdown">
										<li><a href="quan-ly-tai-khoan.html">Quản lý tài khoản</a></li>
										<li><a href="don-hang-cua-toi.html">Đơn hàng của tôi</a></li>
										<li><a href="index.php?ctr=user&act=logout">Đăng xuất</a></li>
									</ul>
								</div>
							</div> 
						</ul>
					</li>
				<?php } else{ ?> 
					
					<li><a href="dang-ky.html"> Create Account </a></li> 
					<li><a href="dang-nhap.html">Login</a></li> 
				<?php } ?>
					<li><a href="contact.html">Help</a></li>
				</ul>
			</div>
			<div class="product_list_header">  
					<form action="#" method="post" class="last"> 
						<a class="w3view-cart" href="gio-hang-cua-ban.html" style="background: none">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                          <?php
                          $cart_total = 0;
                          if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] AS $cart) {
                              $cart_total += $cart['quantity'];
                            }
                          }
                          ?>
                            <span class="cart-amount">
                                <?php echo $cart_total; ?>
                            </span>
                        </a>
						<!-- <button class="w3view-cart" type="submit" name="submit" value=""><a href=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></button> -->
					</form> 
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : (+0123) 234 567</li>
					
				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php">Saccoro</a></h1> 
			</div>
		<div class="w3l_search">
			<form method="post" action="index.php?ctr=product&act=search">
				<input type="search" name="Search" placeholder="Search for a Product..." required="">
				<a href="name=seach"><button type="submit" name="search" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i></a>
				</button>
				<div class="clearfix"></div>
			</form>
		</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
								
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div> 
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" class="act">Trang Chủ</a></li>	
									<!-- Mega Menu -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Danh Mục Sản Phẩm<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Danh Mục</h6>
														<?php foreach ($categories as $key) { ?> 
															<li><a href="danh-muc-<?php echo $key['key_seach'];?>-<?php echo $key['id'];?>.html"> <?php echo $key['name']; ?></a></li> 
														<?php } ?> 
													</ul>
												</div>	
												
											</div>
										</ul>
									</li>
									<li class="">
										<a href="kenh-nguoi-ban.html" target="_blank">Kênh người bán</a>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Xu hướng<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Baby Care</h6>
														<li><a href="personalcare.html">Baby Soap</a></li>
														<li><a href="personalcare.html">Baby Care Accessories</a></li>
														<li><a href="personalcare.html">Baby Oil & Shampoos</a></li>
														<li><a href="personalcare.html">Baby Creams & Lotion</a></li>
														<li><a href="personalcare.html"> Baby Powder</a></li>
														<li><a href="personalcare.html">Diapers & Wipes</a></li>
													</ul>
												</div>
												
											</div>
										</ul>
									</li>
									<li class="">
										<a href="#">Chăm sóc khách hàng</a>
									</li>
									<li>
										<a href="#">Liên hệ</a>
									</li>
								</ul>
							</div>
							</nav>
			</div>
		</div>
		