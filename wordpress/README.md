
**Run build image/container(in folder wordpress)** <br />
```Dockerfile
docker compose -f docker-compose.production.yml up -d
``` 
<br /> 

========================================

**Setup wordpress** 
<br /> 
```
At:  http://domain.com/wp-admin/setup-config.php?step=1
Điền thông tin database,username,password,database host,...vào ô input dựa vào file mysql.env 
``` 
<br /> 

======================================== 

**Sử dụng https trong wordpress** 
<br />
**Bước 0:** 
<br />
```Thực hiện bước (1) trước nếu không được thì quay lại bước 0``` 
<br />
```
Sử dụng plugin : "Better Search Replace" để chuyển tìm các router http và chuyển sang https 
và vào Settings » General and make sure that the ‘WordPress Address’ and ‘Site Address’ options have HTTPS URLs. (hoặc có thể thêm bằng code "
define('WP_HOME', 'https://domain.com');
define('WP_SITEURL', 'https://domain.com');
" ở file wp-config.php )
``` 
<br />

**Bước 1:**
<br />
```Thay domain.com và đặt code vào wp-config.php trước dòng chữ "That's all, stop editing! Happy publishing.".khi hoàn thành cần restart container <br />```
```Nginx
define('WP_HOME', 'https://domain.com');
define('WP_SITEURL', 'https://domain.com'); 
define('FORCE_SSL_CONTENT', true); 
define('FORCE_SSL_ADMIN', true); 
// in some setups HTTP_X_FORWARDED_PROTO might contain 
// a comma-separated list e.g. http,https 
// so check for https existence 
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) 
       $_SERVER['HTTPS']='on'; 
/* That's all, stop editing! Happy publishing. */ 
```

<br />

========================================

**Fix upload** <br />
```Vào "/wordpress/wp-content" thực hiện cấp quyền cho wordpress:``` <br />
```Dockerfile
chown -R www-data:www-data uploads
```

========================================

**Upload themes**

========================================

**C1: làm trên trang admin như bình thường(vì đã fix lỗi max upload themes trong php.ini)** <br />

**C2: sửa bất cú file bằng ftp(thay cách vào trực tiếp server)** <br />
```Vào plugins trong trang admin và cài "WP File Manager" sau đó vào để vào upload/delete folder/file trên server.``` <br />

========================================

**Thêm theme mới tại:** 
<br /> 
 ```
 wordpress/wp-content/themes
 ``` 
 <br />

========================================
