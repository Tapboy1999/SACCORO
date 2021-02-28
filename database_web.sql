#products
CREATE TABLE IF NOT EXISTS products(
id INT(11) AUTO_INCREMENT,
category_id INT(11) COMMENT "Id của danh mục mà sản phẩm thuộc về, là khóa ngoại liên kết với bảng categories",
title VARCHAR(255) COMMENT "Tên sản phẩm",
avatar VARCHAR(255) COMMENT "Tên file ảnh sản phẩm",
images VARCHAR(255) COMMENT "ảnh chi tiết sản phẩm",
price INT(11) COMMENT "Giá sản phẩm",
sales float comment "giá salse",
amount INT(11) COMMENT "Số lượng sản phẩm trong kho",
status_hot TINYINT(3) DEFAULT 0 COMMENT "Trạng thái hot: 1 - hot, 0",
content TEXT COMMENT "Mô tả chi tiết cho sản phẩm",
created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP COMMENT "Ngày tạo",
PRIMARY KEY (id),
FOREIGN KEY (category_id) REFERENCES categories(id)
);
ALTER TABLE products ADD user_id int(11) COMMENT "sản phẩm thuộc user nào";
ALTER TABLE products ADD foreign key (user_id) references users(id);
ALTER TABLE categories ADD key_seach varchar(255) COMMENT "key seach";
#categories
CREATE TABLE IF NOT EXISTS categories (
id INT(11) AUTO_INCREMENT,
name VARCHAR(255) NOT NULL COMMENT "Tên danh mục",
description TEXT COMMENT "Mô tả chi tiết cho danh mục",
status TINYINT(3) DEFAULT 0 COMMENT "Trạng thái danh mục: 0 - Inactive, 1 - Active",
created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP COMMENT "Ngày tạo danh mục",
updated_at DATETIME COMMENT "Ngày cập nhật cuối",
PRIMARY KEY (id)
);
#admin
CREATE TABLE IF NOT EXISTS admins (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(255) COMMENT "Tên đăng nhập",
password VARCHAR(255) COMMENT "Mật khẩu đăng nhập",
full_name VARCHAR(255)  COMMENT "Fist name",
lever int(1) default 1 comment"0-admin 1-user_admin",
phone  int(11) COMMENT 'SĐT user' ,
address  varchar(255) COMMENT 'Địa chỉ user' ,
email  varchar(255)   COMMENT 'Email của user' ,
avatar VARCHAR(255)  COMMENT "File ảnh đại diện",
status TINYINT(3) DEFAULT 0 COMMENT "Trạng thái danh mục: 0 - Inactive, 1 - Active",
created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP COMMENT "Ngày tạo"
);
#users
CREATE TABLE IF NOT EXISTS users (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(255) NOT NULL COMMENT "Tên đăng nhập",
password VARCHAR(255) NOT NULL COMMENT "Mật khẩu đăng nhập",
full_name VARCHAR(255) NOT NULL COMMENT "Fist name",
phone  int(11) NOT NULL COMMENT 'SĐT user' ,
address  varchar(255) COMMENT 'Địa chỉ user' ,
email  varchar(255)  NOT NULL COMMENT 'Email của user' ,
avatar VARCHAR(255)  COMMENT "File ảnh đại diện",
status TINYINT(3) DEFAULT 0 COMMENT "Trạng thái danh mục: 0 - Inactive, 1 - Active",
created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP COMMENT "Ngày tạo"
);

#orders
CREATE TABLE IF NOT EXISTS orders(
id INT(11) AUTO_INCREMENT,
user_id INT(11) DEFAULT NULL COMMENT "Id của user trong trường hợp đã login và đặt hàng, là khóa ngoại liên kết với bảng users",
fullname VARCHAR(255) COMMENT "Tên khách hàng",
address VARCHAR(255) COMMENT "Địa chỉ khách hàng",
mobile INT(11) COMMENT "SĐT khách hàng",
email VARCHAR(255) COMMENT "Email khách hàng",
note TEXT COMMENT "Ghi chú từ khách hàng",
price_total INT(11) COMMENT "Tổng giá trị đơn hàng",
payment_status TINYINT(2) COMMENT "Trạng thái đơn hàng: 0 - Chưa thành toán, 1 - Đã thành toán",
created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP COMMENT "Ngày tạo đơn",
updated_at DATETIME COMMENT "Ngày cập nhật cuối",
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES users(id)
);

#order_details
CREATE TABLE IF NOT EXISTS order_details(
order_id INT(11) COMMENT "Id của order tương ứng, là khóa ngoại liên kết với bảng orders",
product_id INT(11) COMMENT "Id của product tương ứng, là khóa ngoại liên kết với bảng products",
quantity INT(11) COMMENT "Số sản phẩm đã đặt",
FOREIGN KEY (order_id) REFERENCES orders(id),
FOREIGN KEY (product_id) REFERENCES products(id)
);

