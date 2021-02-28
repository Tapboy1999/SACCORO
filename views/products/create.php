

<?php if(!empty($this->error)){?>
         <div class="alert alert-warning">
   <strong>Lỗi! </strong><?php echo $this->error; ?>
</div>
<?php } ?>
<div class="form-create" >
   
   <h2 style="padding-bottom: 30px">Thêm sản phẩm</h2>
   <form action="" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
      <div class="form-group row">
         <label for="title" class="col-md-3 col-sm-3 col-sms-3">Tên sản phẩm</label>
         <div class="col-md-9 col-sm-9">
            <input type="text" name="title" class="form-control" placeholder="Tên sản phẩm" required="">
         </div>
      </div>
      <div class="form-group row">
         <label for="category_id" class="col-md-3 col-sm-3 col-sms-3">Danh mục sản phẩm</label>
         <div class="col-md-9 col-sm-9">
            <select class="form-control" style="width: 50%" name="category_id">
               <?php foreach ($categories as $category) {?>
               <option value="<?php echo $category['id']?>"><?php echo $category['name']; ?></option>
            <?php } ?>
            </select>
         </div>
      </div>
      <div class="form-group row">
         <label for="title" class="col-md-3 col-sm-3 col-sms-3">Ảnh sản phẩm</label>
         <div class="col-md-9 col-sm-9">
            <input type="file" name="avatar" class="form-control-file" placeholder="" required="" style="outline-style: none">
         </div>
      </div>
      <div class="form-group row">
         <label for="title" class="col-md-3 col-sm-3 col-sms-12">Giá bán</label>
         <div class="col-md-9 col-sm-9">
            <input type="text" name="price" class="form-control money-price" placeholder="Giá sản phẩm" required="" style="width: 50%">
         </div>
      </div>
      <div class="form-group row">
         <label for="title" class="col-md-3 col-sm-3 col-sms-12">Giá sale</label>
         <div class="col-md-9 col-sm-9">
            <input type="text" name="sales" class="form-control money-sales" placeholder="Giá khuyến mại" style="width: 50%">
         </div>
      </div>
      <div class="form-group row">
         <label for="title" class="col-md-3 col-sm-3 col-sms-12">Số lượng</label>
         <div class="col-md-9 col-sm-9">
            <input type="number" name="amount" class="form-control" placeholder="Số lượng" required="" style="width: 50%">
         </div>
      </div>
      <div class="form-group row">
         <label for="title" class="col-md-3 col-sm-3 col-sms-12">Description</label>
         <div class="col-md-9 col-sm-9">
            <textarea name="content" class="form-control" style="height: 300px"></textarea> 
         </div>
      </div>
      <div class="form-group row">
         <label for="" class="col-md-3 col-sm-3 col-sms-12"></label>
         <div class="col-md-9 col-sm-9">
            <input type="radio" name="statushot" placeholder="" value="1">Sản phẩm hot
            <!-- <label style="font-weight: unset;" for="status_hot">Sản phẩm hot</label> -->
            <input type="radio" name="statushot" placeholder="" value="0">Sản phẩm thường
            <!-- <label style="font-weight: unset;" for="status_hot">Sản phẩm thường</label> -->
         </div>
      </div>
      <div class="form-group row">
         <label for="" class="col-md-3 col-sm-3 col-sms-12"></label>
         <div class="col-md-9 col-sm-9">
            <input type="submit" class="btn btn-primary" name="addPr" value="Thêm sản phẩm">
            <input type="reset" class="btn btn-primary" name="" value="Reset">
         </div> 
      </div>
      
   </form>

</div>
<script>
   $('.money-price').simpleMoneyFormat();
   $('.money-sales').simpleMoneyFormat();
</script>