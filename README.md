# reply3
1、运行composer update<br/>

2、项目根目录下新建或更新.env，添加或完善以下配置<br/>
DB_CONNECTION=mysql<br/>
DB_HOST=localhost<br/>
DB_PORT=3306<br/>
DB_DATABASE=#数据库名，确保是存在的数据库<br/>
DB_USERNAME=#用户名<br/>
DB_PASSWORD=#数据库密码<br/>

MAIL_DRIVER=smtp<br/>
MAIL_HOST=smtp.163.com<br/>
MAIL_PORT=465<br/>
MAIL_FROM_ADDRESS=#请使用163邮箱，如：xxx@163.com<br/>
MAIL_FROM_NAME=系统管理员<br/>
MAIL_USERNAME=#xxx@163.com<br/>
MAIL_PASSWORD=#xxx@163.com的密码<br/>
MAIL_ENCRYPTION=ssl<br/>

3、使用php artisan migrate命令进行数据库迁移<br/>