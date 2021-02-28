<div class="container">
<?php if(empty($userOrders)){ ?>
   <div class="alert-success" style="padding-top: 30px;padding-bottom: 30px;text-align: center;margin-top: 20px;margin-bottom: 20px">
      <strong>Bạn chưa có đơn hàng</strong>
   </div>

<?php }else{ ?>
<table class="table">
   <thead class="thead-light"> 
      <tr>
         <th>STT</th>
         <th>Tên sản phẩm</th>
         <th>Số lượng</th>
         <th>Thông tin nhận hàng</th>
         <th>Tổng cộng</th>
      </tr>
   </thead>
   <tbody>
   <?php $i = 1;
      foreach ($userOrders as $userOrder) {?>
      <tr>
         <td><?php echo $i ?></td>
         <td width="400px"><?php echo $userOrder['title']; ?></td>
         <td><?php echo $userOrder['quantity'] ?></td>
         <td>
            <ul style="list-style: none">
               <li><strong><?php echo $userOrder['fullname'] ?></strong></li>
               <li><p><?php echo $userOrder['address'] ?></p></li>
               <li><p><?php echo "(+84) ".$userOrder['mobile'] ?></p></li>
               <li><p><?php echo $userOrder['email'] ?></p></li>
            </ul>
         </td>
         <td><?php echo number_format($userOrder['price_total'])." vnđ" ?></td>
      </tr>
   <?php $i++;} ?>
   </tbody>
</table>
<?php } ?>

</div>
