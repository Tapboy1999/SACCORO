
<h2>Sản phẩm của tôi</h2>
               <a href="kenh-nguoi-ban-them-moi.html"><button style="margin-bottom: 10px; outline: none;float: right;" type="button" class="btn btn-primary">Thêm mới</button></a>
                  <table class="table">
               <thead class="thead-light"> 
                  <tr>
                     <th>STT</th>
                     <th>Danh mục</th>
                     <th>Tên sản phẩm</th>
                     <th>Ảnh</th>
                     <th>Giá gốc</th>
                     <th>Giá khuyến mại</th>
                     <th>Số lượng</th>
                     <th>Hot</th>
                     <th>Mô tả sản phẩm</th>
                     <th>Edit</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody>
               <?php
                    $i = 1;
                    foreach ($myProducts as $myProduct) {?>
                  <tr>
                     <td width="70px"><?php echo $i ?></td> 
                     <td width="300px"><?php echo $myProduct['name']; ?></td>
                     <td width="300px"><?php echo $myProduct['title'] ?></td>
                     <td width="100px"><img style="width: 100px;height: 100px" src="./assets/uploads/products/<?php echo $myProduct['avatar'] ?>" alt=""></td>
                     <td><?php echo number_format($myProduct['price'])." vnđ"; ?></td>
                     <td><?php echo number_format($myProduct['sales'])." vnđ"; ?></td>
                     <td><?php echo $myProduct['amount'] ?></td>
                     <td><?php echo $myProduct['status_hot'] ?></td>
                     <td><a href="">Xem thêm</a></td>
                     <td><a href="index.php?ctr=product&act=update&id=<?php echo $myProduct['id']; ?>"><button class="btn-success" type="submit" name="update" style="outline: none">Edit</button></a></td>
                     <td><a href="index.php?ctr=product&act=delete"><button value="<?php echo $myProduct['id']?>" class="btn-danger" type="submit" name="delete" style="outline: none">Xóa</button></a></td>
                  </tr>
               <?php $i++;} ?>
               </tbody>
            </table>
            <script>
            $(document).ready(function(){
              var submit = $("button[name='delete']");
              submit.click(function(){
                var product_id = $(this).attr('value');
                
                // + Gọi ajax, truyền vào 1 đối tượng 
                $.ajax({
                  type: 'GET',
                  // + Url theo mô hình MVC sẽ xử lý ajax
                  url: 'index.php?ctr=product&act=delete',
                  data: {
                    product_id: product_id
                  },
                });
              })
            });
            </script>