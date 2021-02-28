<div class="newproducts-w3agile">
		<div class="container">
			<h3>Kết quả tìm kiếm</h3>
				<div class="agile_top_brands_grids">
				<?php 
				if(empty($this->error)){
				foreach ($products as $product) { ?>
					<div class="col-md-3 top_brand_left-1">
						<div class="hover14 column">
							<div class="agile_top_brand_left_grid">
								<div class="agile_top_brand_left_grid_pos">
									<img src="./assets/images/offer.png" alt=" " class="img-responsive"> 
								</div>
								<div class="agile_top_brand_left_grid1">
									<figure>
										<div class="snipcart-item block">
											<div class="snipcart-thumb">
												<a href="index.php?ctr=product&act=detail&id=<?php echo $product['id'];?>"><img style="width: 150px;height: 150px;padding-bottom: 20px" title=" " alt=" " src="./assets/uploads/products/<?php echo $product['avatar']; ?>"></a>	
												<div style="height: 110px;">	
													<h4 style="padding-bottom: 10px"><?php
														$length = strlen($product['title']);
														if($length > 130 ){
															echo substr($product['title'], 0,119)."...";
														}
														else{
															echo $product['title'];
														}
												 	?></h4>
												 </div>
												<div class="stars">
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star blue-star" aria-hidden="true"></i>
													<i class="fa fa-star gray-star" aria-hidden="true"></i>
													
												</div>
													<h4 style="padding-bottom:20px "><?php echo number_format($product['sales'])." vnđ"; ?></h4>
													<h4><span><?php echo number_format($product['price'])." vnđ" ?></span></h4>
											</div>
											<div class="snipcart-details top_brand_home_details">
												<form action="#" method="post">
													<fieldset>
														<input data-id="<?php echo $product['id'] ?>" type="submit" name="submit" value="Thêm vào giỏ"class="button add-to-cart">
													</fieldset>
												</form>
											</div>
										</div>
									</figure>
								</div>
							</div>
						</div>
					</div>
				<?php }}else{ ?>
					<p style="text-align: center;">Không tìm thấy sản phẩm phù hợp</p>
				<?php } ?>

					</div>

		</div>
	</div>