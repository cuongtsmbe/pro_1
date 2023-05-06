
#Run build image/container(in folder wordpress): 
docker compose -f docker-compose.production.yml up -d

#Setup wordpress: http://domain.com/wp-admin/setup-config.php?step=1
Điền thông tin database,username,password,database host,...vào ô input dựa vào file mysql.env 

#Thêm theme mới tại: wordpress/wp-content/themes  


#Bước 0: thực hiện bước 1 nếu không có gì thay đổi thì quay lại bước 0
Sử dụng plugin : "Better Search Replace" để chuyển tìm các router http và chuyển sang https 

#Bước 1:Cài https: đặt vào wp-config.php để có thể sử dụng https
define('WP_HOME', 'https://greenspire.store');
define('WP_SITEURL', 'https://greenspire.store');
define('FORCE_SSL_CONTENT', true);
define('FORCE_SSL_ADMIN', true);
// in some setups HTTP_X_FORWARDED_PROTO might contain
// a comma-separated list e.g. http,https
// so check for https existence
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)
       $_SERVER['HTTPS']='on';
/* That's all, stop editing! Happy publishing. */


