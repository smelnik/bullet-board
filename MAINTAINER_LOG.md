$ sudo nano /etc/hosts
127.0.0.1 bulletboardfront.test
127.0.0.1 bulletboardback.test

$ sudo nano /etc/apache2/ports.conf
Listen 8080

$ sudo nano /etc/apache2/sites-enabled/000-default.conf
<VirtualHost *:8080>
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

	<VirtualHost *:8080>
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
Installing yiisoft/yii2-app-advanced (2.0.14)
  - Installing yiisoft/yii2-app-advanced (2.0.14): Downloading (100%)         
Created project in bullet-board
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 63 installs, 0 updates, 0 removals
  - Installing yiisoft/yii2-composer (2.0.6): Loading from cache
  - Installing doctrine/lexer (v1.0.1): Loading from cache
  - Installing egulias/email-validator (2.1.3): Loading from cache
  - Installing swiftmailer/swiftmailer (v6.0.2): Loading from cache
  - Installing bower-asset/jquery (3.2.1): Loading from cache
  - Installing bower-asset/yii2-pjax (2.0.7.1): Loading from cache
  - Installing bower-asset/punycode (v1.3.2): Loading from cache
  - Installing cebe/markdown (1.1.2): Loading from cache
  - Installing ezyang/htmlpurifier (v4.10.0): Loading from cache
  - Installing bower-asset/inputmask (3.3.11): Loading from cache
  - Installing yiisoft/yii2 (2.0.15.1): Loading from cache
  - Installing yiisoft/yii2-swiftmailer (2.1.0): Loading from cache
  - Installing bower-asset/bootstrap (v3.3.7): Loading from cache
  - Installing yiisoft/yii2-bootstrap (2.0.8): Loading from cache
  - Installing yiisoft/yii2-debug (2.0.13): Loading from cache
  - Installing bower-asset/typeahead.js (v0.11.1): Loading from cache
  - Installing phpspec/php-diff (v1.1.0): Loading from cache
  - Installing yiisoft/yii2-gii (2.0.6): Loading from cache
  - Installing fzaninotto/faker (v1.7.1): Loading from cache
  - Installing yiisoft/yii2-faker (2.0.4): Loading from cache
  - Installing sebastian/recursion-context (3.0.0): Loading from cache
  - Installing sebastian/exporter (3.1.0): Loading from cache
  - Installing doctrine/instantiator (1.1.0): Loading from cache
  - Installing phpunit/php-text-template (1.2.1): Loading from cache
  - Installing phpunit/phpunit-mock-objects (6.0.1): Loading from cache
  - Installing codeception/stub (1.0.2): Loading from cache
  - Installing sebastian/diff (3.0.0): Loading from cache
  - Installing sebastian/comparator (2.1.3): Loading from cache
  - Installing theseer/tokenizer (1.1.0): Loading from cache
  - Installing sebastian/version (2.0.1): Loading from cache
  - Installing sebastian/environment (3.1.0): Loading from cache
  - Installing sebastian/code-unit-reverse-lookup (1.0.1): Loading from cache
  - Installing phpunit/php-token-stream (3.0.0): Loading from cache
  - Installing phpunit/php-file-iterator (1.4.5): Loading from cache
  - Installing phpunit/php-code-coverage (6.0.1): Loading from cache
  - Installing sebastian/resource-operations (1.0.0): Loading from cache
  - Installing sebastian/object-reflector (1.1.1): Loading from cache
  - Installing sebastian/object-enumerator (3.0.3): Loading from cache
  - Installing sebastian/global-state (2.0.0): Loading from cache
  - Installing phpunit/php-timer (2.0.0): Loading from cache
  - Installing webmozart/assert (1.3.0): Loading from cache
  - Installing phpdocumentor/reflection-common (1.0.1): Loading from cache
  - Installing phpdocumentor/type-resolver (0.4.0): Loading from cache
  - Installing phpdocumentor/reflection-docblock (4.3.0): Loading from cache
  - Installing phpspec/prophecy (1.7.5): Loading from cache
  - Installing phar-io/version (1.0.1): Loading from cache
  - Installing phar-io/manifest (1.0.1): Loading from cache
  - Installing myclabs/deep-copy (1.7.0): Loading from cache
  - Installing phpunit/phpunit (7.0.3): Loading from cache
  - Installing codeception/phpunit-wrapper (7.0.6): Loading from cache
  - Installing symfony/yaml (v4.0.7): Loading from cache
  - Installing behat/gherkin (v4.5.1): Loading from cache
  - Installing symfony/polyfill-mbstring (v1.7.0): Loading from cache
  - Installing symfony/dom-crawler (v4.0.7): Loading from cache
  - Installing symfony/css-selector (v4.0.7): Loading from cache
  - Installing symfony/browser-kit (v4.0.7): Loading from cache
  - Installing symfony/event-dispatcher (v4.0.7): Loading from cache
  - Installing symfony/console (v4.0.7): Loading from cache
  - Installing symfony/finder (v4.0.7): Loading from cache
  - Installing psr/http-message (1.0.1): Loading from cache
  - Installing guzzlehttp/psr7 (1.4.2): Loading from cache
  - Installing codeception/base (2.4.1): Loading from cache
  - Installing codeception/verify (0.3.3): Loading from cache
phpunit/phpunit-mock-objects suggests installing ext-soap (*)
sebastian/global-state suggests installing ext-uopz (*)
phpunit/phpunit suggests installing phpunit/php-invoker (^2.0)
symfony/browser-kit suggests installing symfony/process ()
symfony/event-dispatcher suggests installing symfony/dependency-injection ()
symfony/event-dispatcher suggests installing symfony/http-kernel ()
symfony/console suggests installing symfony/lock ()
symfony/console suggests installing symfony/process ()
symfony/console suggests installing psr/log (For using the console logger)
codeception/base suggests installing aws/aws-sdk-php (For using AWS Auth in REST module and Queue module)
codeception/base suggests installing codeception/phpbuiltinserver (Start and stop PHP built-in web server for your tests)
codeception/base suggests installing codeception/specify (BDD-style code blocks)
codeception/base suggests installing flow/jsonpath (For using JSONPath in REST module)
codeception/base suggests installing league/factory-muffin (For DataFactory module)
codeception/base suggests installing league/factory-muffin-faker (For Faker support in DataFactory module)
codeception/base suggests installing phpseclib/phpseclib (for SFTP option in FTP Module)
codeception/base suggests installing stecman/symfony-console-completion (For BASH autocompletion)
codeception/base suggests installing symfony/phpunit-bridge (For phpunit-bridge support)
Writing lock file
Generating autoload files

$ cd bullet-board/

$ php init
Yii Application Initialization Tool v1.0

Which environment do you want the application to be initialized in?

  [0] Development
  [1] Production

  Your choice [0-1, or "q" to quit] 0

  Initialize the application under 'Development' environment? [yes|no] yes

  Start initialization ...

   generate common/config/params-local.php
   generate common/config/test-local.php
   generate common/config/main-local.php
   generate backend/config/params-local.php
   generate backend/config/test-local.php
   generate backend/config/main-local.php
   generate backend/web/index.php
   generate backend/web/index-test.php
   generate backend/web/robots.txt
   generate console/config/params-local.php
   generate console/config/main-local.php
   generate frontend/config/params-local.php
   generate frontend/config/test-local.php
   generate frontend/config/main-local.php
   generate frontend/web/index.php
   generate frontend/web/index-test.php
   generate frontend/web/robots.txt
   generate yii
   generate yii_test
   generate yii_test.bat
   generate cookie validation key in backend/config/main-local.php
   generate cookie validation key in frontend/config/main-local.php
      chmod 0777 backend/runtime
      chmod 0777 backend/web/assets
      chmod 0777 frontend/runtime
      chmod 0777 frontend/web/assets
      chmod 0755 yii
      chmod 0755 yii_test

  ... initialization completed.

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
