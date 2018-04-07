$ sudo nano /etc/hosts
127.0.0.1 bulletboardfront.test
127.0.0.1 bulletboardback.test

$ sudo nano /etc/apache2/ports.conf
Listen 8080

$ sudo nano /etc/apache2/sites-enabled/000-default.conf
<VirtualHost *:80>
	ServerName bulletboardfront.test
	DocumentRoot "/home/user/Repositories/2018/yii/bullet-board/bullet-board/frontend/web/"

	<Directory "/home/user/Repositories/2018/yii/bullet-board/bullet-board/frontend/web/">
	    # use mod_rewrite for pretty URL support
	    RewriteEngine on
	    # If a directory or a file exists, use the request directly
	    RewriteCond %{REQUEST_FILENAME} !-f
	    RewriteCond %{REQUEST_FILENAME} !-d
	    # Otherwise forward the request to index.php
	    RewriteRule . index.php

	    # use index.php as index file
	    DirectoryIndex index.php

	    # ...other settings...
	    # Apache 2.4
	    Require all granted

	    ## Apache 2.2
	    # Order allow,deny
	    # Allow from all
	</Directory>
	</VirtualHost>

	<VirtualHost *:80>
	ServerName bulletboardback.test
	DocumentRoot "/home/user/Repositories/2018/yii/bullet-board/bullet-board/backend/web/"

	<Directory "/home/user/Repositories/2018/yii/bullet-board/bullet-board/backend/web/">
	    # use mod_rewrite for pretty URL support
	    RewriteEngine on
	    # If a directory or a file exists, use the request directly
	    RewriteCond %{REQUEST_FILENAME} !-f
	    RewriteCond %{REQUEST_FILENAME} !-d
	    # Otherwise forward the request to index.php
	    RewriteRule . index.php

	    # use index.php as index file
	    DirectoryIndex index.php

	    # ...other settings...
	    # Apache 2.4
	    Require all granted

	    ## Apache 2.2
	    # Order allow,deny
	    # Allow from all
	</Directory>
</VirtualHost>

$ sudo apachectl restart

$ composer create-project --prefer-dist yiisoft/yii2-app-advanced bullet-board

$ cd bullet-board/

$ composer install

$ php init --env=Development --overwrite=All
  
mysql> create database bulletboard default character set utf8mb4 default collate utf8mb4_general_ci;

common\config\main-local.php
'db' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=bulletboard',
    'username' => 'your-user',
    'password' => 'your-password',
    'charset' => 'utf8mb4',
],

$ php yii migrate
Yii Migration Tool (based on Yii v2.0.15.1)

Creating migration history table "migration"...Done.
Total 1 new migration to be applied:
	m130524_201442_init

Apply the above migration? (yes|no) [no]:yes
*** applying m130524_201442_init
    > create table {{%user}} ... done (time: 0.036s)
*** applied m130524_201442_init (time: 0.045s)


1 migration was applied.

Migrated up successfully.

$ php yii migrate --migrationPath=@yii/rbac/migrations

Yii Migration Tool (based on Yii v2.0.15.1)

Total 2 new migrations to be applied:
	m140506_102106_rbac_init
	m170907_052038_rbac_add_index_on_auth_assignment_user_id

Apply the above migrations? (yes|no) [no]:yes
*** applying m140506_102106_rbac_init
    > create table {{%auth_rule}} ... done (time: 0.045s)
    > create table {{%auth_item}} ... done (time: 0.033s)
    > create index idx-auth_item-type on {{%auth_item}} (type) ... done (time: 0.016s)
    > create table {{%auth_item_child}} ... done (time: 0.054s)
    > create table {{%auth_assignment}} ... done (time: 0.021s)
*** applied m140506_102106_rbac_init (time: 0.192s)

*** applying m170907_052038_rbac_add_index_on_auth_assignment_user_id
    > create index auth_assignment_user_id_idx on {{%auth_assignment}} (user_id) ... done (time: 0.029s)
*** applied m170907_052038_rbac_add_index_on_auth_assignment_user_id (time: 0.039s)


2 migrations were applied.

Migrated up successfully.

$ php yii rbac/init
