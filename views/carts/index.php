<?php
require_once 'helpers/Helper.php';
/**
 * views/carts/index.php
 * Trang Giỏ hàng của bạn
 */
?>

<!--Nếu tồn tại giỏ hàng, thì hiển thị ra màn hình-->
<div class="timeline-items container">

    <h2 style="margin-bottom: 10px;margin-top: 20px; text-align: center;text-transform: uppercase;">Giỏ hàng của bạn</h2>
    <?php if(!empty($this->error)){ ?>
  <div class="alert-danger" style="text-align: center;padding: 30px 30px;margin-bottom:30px"><strong><?php echo $this->error;?></strong></div>
<?php } ?>
  <?php if (isset($_SESSION['cart'])): ?>
      <form action="" method="post">
          <table class="table table-bordered">
              <tbody>
              <tr>
                  <th></th>
                  <th width="40%">Tên sản phẩm</th>
                  <th width="12%">Số lượng</th>
                  <th>Giá</th>
                  <th>Thành tiền</th>
                  <th></th>
              </tr>

              <?php
              //Khai báo biến lưu tổng giá trị đơn hàng
              $total_cart = 0;
              foreach($_SESSION['cart'] AS $product_id => $cart):
                //hàm getSlug chuyển các text ở dạng có dấu
                //về dạng ko dấu, ngăn cách các từ bởi ký tự -
                $slug = Helper::getSlug($cart['name']);
                $product_link = "chi-tiet-san-pham/$slug/$product_id";
              ?>
                <tr>
                  <td>
                    <img class="product-avatar img-responsive"
                           src="./assets/uploads/products/<?php echo $cart['avatar'] ?>"
                           width="80">
                  </td>
                  <td>
                      <div class="content-product">
                          <a href="<?php echo $product_link; ?>"
                             class="content-product-a">
                              <?php echo $cart['name']?>
                          </a>
                      </div>
                  </td>
                  <td>
                      <!-- cần khéo léo đặt name cho input số lượng,
                       để khi xử lý submit form update lại giỏ hàng
                        sẽ đơn giản hơn, cần đặt name của số lượng chính là
                            id của sản phẩm -->
                      <input type="number" min="0"
                             name="<?php echo $product_id?>"
                             class="product-amount form-control"
                             value="<?php echo $cart['quantity']; ?>">
                  </td>
                  <td>
                      <?php
                      echo number_format($cart['price'])." vnđ";
                      ?>
                  </td>
                  <td>
                      <?php
                      //Thành tiền = số lượng * giá
                      $total_item = $cart['quantity'] * $cart['price'];
                      //Cộng dồn cho tổng giá trị đơn hàng
                      $total_cart += $total_item;
                      echo number_format($total_item)." vnđ";
                      ?>
                  </td>
                  <td>
                      <a class="content-product-a"
                         href="index.php?ctr=cart&act=delete&id=<?php echo $product_id ?>">
                          Xóa
                      </a>
                  </td>
              </tr>
              <?php endforeach; ?>

              <tr>
                  <td colspan="6" style="text-align: right">
                      Tổng giá trị đơn hàng:
                      <span class="product-price">
                        <?php
                        echo number_format($total_cart)." vnđ";
                        ?>
                        </span>
                  </td>
              </tr>
              <tr>
                  <td colspan="6" class="product-payment">
                      <input type="submit" name="submit" value="Cập nhật lại giá" class="btn btn-primary">
                      <a href="thanh-toan.html" class="btn btn-success">Đến trang thanh toán</a>
                  </td>
              </tr>
              </tbody>
          </table>
      </form>
  <?php else: ?>
      <div class="alert alert-success">
        <strong>Giỏ hàng trống!</strong> vui lòng chọn thêm sản phẩm !
      </div>
      <a href="index.php" class="btn btn-primary" style="float: right; margin-bottom: 50px">
          Tiếp tục mua hàng
      </a>
  <?php endif; ?>
</div>
<!--Timeline items end -->