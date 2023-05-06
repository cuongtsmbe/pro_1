
**Run build image/container(in folder wordpress)** <br />
```docker compose -f docker-compose.production.yml up -d ``` <br />

**Setup wordpress** <br />
```At:  http://domain.com/wp-admin/setup-config.php?step=1``` <br />
```Điền thông tin database,username,password,database host,...vào ô input dựa vào file mysql.env ``` <br />

**Thêm theme mới tại:** <br />
 ```wordpress/wp-content/themes``` <br />

**Sử dụng https trong wordpress** <br />
**Bước 0:** <br />
``` thực hiện bước 1 trước nếu không có gì thay đổi thì quay lại bước 0``` <br />
```Sử dụng plugin : "Better Search Replace" để chuyển tìm các router http và chuyển sang https ``` <br />

**Bước 1:** <br />
```Cài https: đặt vào wp-config.php ``` <br />
```define('WP_HOME', 'https://greenspire.store');``` <br />
```define('WP_SITEURL', 'https://greenspire.store');``` <br />
```define('FORCE_SSL_CONTENT', true);``` <br />
```define('FORCE_SSL_ADMIN', true);``` <br />
```// in some setups HTTP_X_FORWARDED_PROTO might contain``` <br />
```// a comma-separated list e.g. http,https``` <br />
```// so check for https existence``` <br />
```if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)``` <br />
```       $_SERVER['HTTPS']='on';``` <br />
```/* That's all, stop editing! Happy publishing. */``` <br />


