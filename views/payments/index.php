<?php
require_once 'helpers/Helper.php';
?>
<div class="container" style="margin-bottom: 30px">
    <h2 style="margin: 30px 30px; text-transform: uppercase;text-align: center">Thanh toán</h2>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3 class="center-align" style="margin-bottom: 50px">Thông tin khách hàng</h3>
                <div class="form-group row">
                    <label class="col-md-3 col-sm-12">Họ tên khách hàng</label>
                    <div class="col-md-9 col-sm-12">
                        <input type="text" name="fullname" class="form-control" placeholder="Họ và tên" value="<?php echo $_SESSION['userlogin']['full_name']?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-sm-12">Địa chỉ</label>
                    <div class="col-md-9 col-sm-12">
                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ" required="" value="<?php echo $_SESSION['userlogin']['address']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-sm-12">SĐT</label>
                    <div class="col-md-9 col-sm-12">
                        <input type="number" min="0" name="mobile" value="<?php echo "0".$_SESSION['userlogin']['phone']?>" class="form-control" placeholder="Số điện thoại" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3 col-sm-12">Email:</label>
                    <div class="col-md-9 col-sm-12">
                        <input type="email" min="0" class="form-control" id="email" placeholder="Nhập email" name="email" value="<?php echo $_SESSION['userlogin']['email']?>">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label>Email</label>
                    <input type="email" min="0" name="email" value="" class="form-control" placeholder="">
                </div> -->
                <div class="form-group row"> 
                    <label class="col-md-3 col-sm-12">Ghi chú thêm</label>
                    <div class="col-md-9 col-sm-12">
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Chọn phương thức thanh toán</label> <br />
                    <input type="radio" name="method" value="0" /> Thanh toán trực tuyến <br />
                    <input type="radio" name="method" checked value="1" /> COD (dựa vào địa chỉ của bạn) <br />
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h3 class="center-align" style="margin-bottom: 50px;">Thông tin đơn hàng của bạn</h3>
                <?php
                //biến lưu tổng giá trị đơn hàng
                $total = 0;
                if (isset($_SESSION['cart'])):
                    ?>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th width="40%">Tên sản phẩm</th>
                            <th width="12%">Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                        <?php foreach ($_SESSION['cart'] AS $product_id => $cart):
                            $product_link = 'san-pham/' . Helper::getSlug($cart['name']) . "/$product_id";
                            ?>
                            <tr>
                                <td>
                                    <?php if (!empty($cart['avatar'])): ?>
                                    <?php endif; ?>
                                    <div class="content-product">
                                            <h5><?php echo $cart['name']; ?></h5>
                                    </div>
                                </td>
                                <td>
                              <span class="product-amount">
                                  <?php echo $cart['quantity']; ?>
                              </span>
                                </td>
                                <td>
                              <span class="product-price-payment">
                                 <?php echo number_format($cart['price'], 0, '.', '.') ?> vnđ
                              </span>
                                </td>
                                <td>
                              <span class="product-price-payment">
                                  <?php
                                  $price_total = $cart['price'] * $cart['quantity'];
                                  $total += $price_total;
                                  ?>
                                  <?php echo number_format($price_total, 0, '.', '.') ?> vnđ
                              </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5" class="product-total">
                                Tổng giá trị đơn hàng:
                                <span class="product-price">
                                <?php echo number_format($total, 0, '.', '.') ?> vnđ
                            </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </div>
        <input type="submit" name="submit" value="Thanh toán" class="btn btn-primary">
        <a href="gio-hang-cua-ban.html" class="btn btn-secondary">Về trang giỏ hàng</a>
    </form>
</div>

