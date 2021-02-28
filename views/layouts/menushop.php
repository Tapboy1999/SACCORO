<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" id="cbp-spmenu-s1">
          <div class="scrollbar scrollbar1">
            <ul class="nav" id="side-menu">
              <!-- <li>
                <a href="index.html" class="active"><i class="fa fa-home nav_icon"></i>Quản lý sản phẩm</a>
              </li> -->
              <li>
                <a href="index.php?ctr=product&act=myProduct"><i class="fa fa-cogs nav_icon"></i>Quản lý sản phẩm </a>
                <!-- /nav-second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-book nav_icon"></i>Danh mục <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                  <?php foreach ($categories as $category){ ?>
                  <li>

                    <a href="<?php echo $category['key_seach'];?>/<?php echo $category['id'];?>.html"><?php echo $category['name']; ?></a>
                   <!--  danh-muc/<?php //echo $key['key_seach'];?>/<?php //echo $key['id'];?>.html -->
                  </li>
                <?php } ?>
                </ul>
                <!-- /nav-second-level -->
              </li>
              <li>
                <a href="index.php?ctr=product&act=userOrder"><i class="fa fa-th-large nav_icon"></i>Đơn hàng</a>
              </li>
            </ul>
          </div>
          <!-- //sidebar-collapse -->
        </nav>
      </div>
    </div>