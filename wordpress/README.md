
**Run build image/container(in folder wordpress)** <br />
```Dockerfile
docker compose -f docker-compose.production.yml up -d
``` 
<br /> 

**Setup wordpress** 
<br /> 
```
At:  http://domain.com/wp-admin/setup-config.php?step=1
Điền thông tin database,username,password,database host,...vào ô input dựa vào file mysql.env 
``` 
<br /> 

**Thêm theme mới tại:** 
<br /> 
 ```
 wordpress/wp-content/themes
 ``` 
 <br /> 

**Sử dụng https trong wordpress** 
<br />
**Bước 0:** 
<br />
```Thực hiện bước 1 trước nếu không có gì thay đổi thì quay lại bước 0``` 
<br />
```Sử dụng plugin : "Better Search Replace" để chuyển tìm các router http và chuyển sang https ``` 
<br />

**Bước 1:**
<br />
```Thay domain.com và đặt code vào wp-config.php trước dòng chữ "That's all, stop editing! Happy publishing." <br />```
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

