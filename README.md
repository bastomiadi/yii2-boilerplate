<p align="center"><img src="https://camo.githubusercontent.com/848fb9958661e6dcb4b42cded99580d7bde119e20232ed3b5ef8cff980fdc769/68747470733a2f2f7777772e7969696672616d65776f726b2e636f6d2f696d6167652f7969695f6c6f676f5f6c696768742e737667" width="200"></p>

YII 2 Application Boilerplate
=====================================
This package for Yii Framework 2 serves as a basic platform for quickly creating a back-office application. It includes profile creation and management, user management, roles, permissions and a dynamically-generated menu.

Feature
-------
* Configurable backend theme [AdminLTE 3 By hail812](https://github.com/muyuym/yii2-adminlte3)
* Ajax Crud [Ajax Crud](https://github.com/biladina/yii2-ajaxcrud)
* Role-based permissions (RBAC) and Menu [yii2 Admin by mdmsoft](https://github.com/mdmsoft/yii2-admin)
* Kartik-v Widgets [Kartik-v](https://github.com/kartik-v?tab=repositories)
* etc.

This project is still early in its development... please feel free to contribute!
------------------------------------------------------------
Screenshoot |
-------------------------------------------------------------------------------
![Dashboard](screenshot/web/dashboard.png?raw=true)

Installation
------------

**1.** Get The Repository

```bash
D:\laragon\www>git clone https://github.com/bastomiadi/yii2-boilerplate
Cloning into 'yii2-boilerplate'...
remote: Enumerating objects: 702, done.
remote: Counting objects: 100% (702/702), done.
remote: Compressing objects: 100% (399/399), done.
remote: Total 702 (delta 384), reused 574 (delta 256), pack-reused 0Receiving objects:  91% (639/702)
Receiving objects: 100% (702/702), 276.63 KiB | 3.90 MiB/s, done.
Resolving deltas: 100% (384/384), done.

```
**2.** Install required dependency with composer

```bash
D:\laragon\www\yii2-boilerplate>composer install
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 120 installs, 0 updates, 0 removals
  - Installing yiisoft/yii2-composer (2.0.10): Extracting archive
  - Installing behat/gherkin (v4.9.0): Extracting archive
  - Installing paragonie/random_compat (v9.99.100): Extracting archive
  - Installing ezyang/htmlpurifier (v4.17.0): Extracting archive
  - Installing symfony/polyfill-mbstring (v1.28.0): Extracting archive
  - Installing symfony/polyfill-ctype (v1.28.0): Extracting archive
  - Installing cebe/markdown (1.2.1): Extracting archive
  - Installing bower-asset/jquery (3.7.1): Extracting archive
  - Installing bower-asset/yii2-pjax (2.0.8): Extracting archive
  - Installing bower-asset/punycode (v1.3.2): Extracting archive
  - Installing bower-asset/inputmask (3.3.11): Extracting archive
  - Installing yiisoft/yii2 (2.0.49.3): Extracting archive
  - Installing phpspec/php-diff (v1.1.3): Extracting archive
  - Installing yiisoft/yii2-gii (2.2.6): Extracting archive
  - Installing npm-asset/bootstrap (4.6.2): Extracting archive
  - Installing yiisoft/yii2-bootstrap4 (2.0.11): Extracting archive
  - Installing setasign/fpdi (v2.6.0): Extracting archive
  - Installing psr/log (3.0.0): Extracting archive
  - Installing psr/http-message (2.0): Extracting archive
  - Installing myclabs/deep-copy (1.11.1): Extracting archive
  - Installing mpdf/psr-log-aware-trait (v3.0.0): Extracting archive
  - Installing mpdf/psr-http-message-shim (v2.0.1): Extracting archive
  - Installing mpdf/mpdf (v8.2.2): Extracting archive
  - Installing kartik-v/yii2-mpdf (v1.0.6): Extracting archive
  - Installing kartik-v/yii2-krajee-base (v3.0.5): Extracting archive
  - Installing kartik-v/yii2-dialog (v1.0.6): Extracting archive
  - Installing kartik-v/yii2-grid (v3.5.3): Extracting archive
  - Installing kartik-v/yii2-widget-activeform (v1.6.4): Extracting archive
  - Installing kartik-v/bootstrap-popover-x (v1.5.2): Extracting archive
  - Installing kartik-v/yii2-popover-x (v1.3.5): Extracting archive
  - Installing kartik-v/yii2-editable (v1.8.0): Extracting archive
  - Installing fortawesome/font-awesome (5.15.4): Extracting archive
  - Installing biladina/yii2-ajaxcrud-bs4 (v2.0.5): Extracting archive
  - Installing psr/clock (1.0.0): Extracting archive
  - Installing lcobucci/jwt (5.2.0): Extracting archive
  - Installing bizley/jwt (4.0.0): Extracting archive
  - Installing symfony/css-selector (v6.4.0): Extracting archive
  - Installing ralouphie/getallheaders (3.0.3): Extracting archive
  - Installing psr/http-factory (1.0.2): Extracting archive
  - Installing guzzlehttp/psr7 (2.6.2): Extracting archive
  - Installing codeception/lib-web (1.0.5): Extracting archive
  - Installing symfony/deprecation-contracts (v3.4.0): Extracting archive
  - Installing symfony/yaml (v6.4.0): Extracting archive
  - Installing symfony/var-dumper (v6.4.2): Extracting archive
  - Installing symfony/finder (v6.4.0): Extracting archive
  - Installing psr/event-dispatcher (1.0.0): Extracting archive
  - Installing symfony/event-dispatcher-contracts (v3.4.0): Extracting archive
  - Installing symfony/event-dispatcher (v6.4.2): Extracting archive
  - Installing symfony/polyfill-intl-normalizer (v1.28.0): Extracting archive
  - Installing symfony/polyfill-intl-grapheme (v1.28.0): Extracting archive
  - Installing symfony/string (v6.4.2): Extracting archive
  - Installing psr/container (2.0.2): Extracting archive
  - Installing symfony/service-contracts (v3.4.1): Extracting archive
  - Installing symfony/console (v6.4.2): Extracting archive
  - Installing sebastian/diff (4.0.5): Extracting archive
  - Installing sebastian/recursion-context (4.0.5): Extracting archive
  - Installing sebastian/exporter (4.0.5): Extracting archive
  - Installing sebastian/comparator (4.0.8): Extracting archive
  - Installing nikic/php-parser (v5.0.0): Extracting archive
  - Installing psy/psysh (v0.12.0): Extracting archive
  - Installing sebastian/version (3.0.2): Extracting archive
  - Installing sebastian/type (3.2.1): Extracting archive
  - Installing sebastian/resource-operations (3.0.3): Extracting archive
  - Installing sebastian/object-reflector (2.0.4): Extracting archive
  - Installing sebastian/object-enumerator (4.0.4): Extracting archive
  - Installing sebastian/global-state (5.0.6): Extracting archive
  - Installing sebastian/environment (5.1.5): Extracting archive
  - Installing sebastian/code-unit (1.0.8): Extracting archive
  - Installing sebastian/cli-parser (1.0.1): Extracting archive
  - Installing phpunit/php-timer (5.0.3): Extracting archive
  - Installing phpunit/php-text-template (2.0.4): Extracting archive
  - Installing phpunit/php-invoker (3.1.1): Extracting archive
  - Installing phpunit/php-file-iterator (3.0.6): Extracting archive
  - Installing theseer/tokenizer (1.2.2): Extracting archive
  - Installing sebastian/lines-of-code (1.0.4): Extracting archive
  - Installing sebastian/complexity (2.0.3): Extracting archive
  - Installing sebastian/code-unit-reverse-lookup (2.0.3): Extracting archive
  - Installing phpunit/php-code-coverage (9.2.30): Extracting archive
  - Installing phar-io/version (3.2.1): Extracting archive
  - Installing phar-io/manifest (2.0.3): Extracting archive
  - Installing doctrine/instantiator (2.0.0): Extracting archive
  - Installing phpunit/phpunit (9.5.28): Extracting archive
  - Installing codeception/stub (4.1.2): Extracting archive
  - Installing codeception/lib-asserts (2.1.0): Extracting archive
  - Installing codeception/codeception (5.0.13): Extracting archive
  - Installing codeception/module-asserts (3.0.0): Extracting archive
  - Installing codeception/module-filesystem (3.0.1): Extracting archive
  - Installing masterminds/html5 (2.8.1): Extracting archive
  - Installing symfony/dom-crawler (v6.4.0): Extracting archive
  - Installing symfony/browser-kit (v6.4.0): Extracting archive
  - Installing codeception/lib-innerbrowser (3.1.3): Extracting archive
  - Installing codeception/module-yii2 (1.1.10): Extracting archive
  - Installing codeception/verify (3.0.0): Extracting archive
  - Installing symfony/polyfill-php72 (v1.28.0): Extracting archive
  - Installing symfony/polyfill-intl-idn (v1.28.0): Extracting archive
  - Installing doctrine/lexer (3.0.0): Extracting archive
  - Installing egulias/email-validator (4.0.2): Extracting archive
  - Installing hail812/yii2-adminlte-widgets (v1.0.5): Extracting archive
  - Installing almasaeed2010/adminlte (v3.2.0): Extracting archive
  - Installing hail812/yii2-adminlte3 (v1.1.9): Extracting archive
  - Installing kartik-v/yii2-bootstrap4-dropdown (dev-master b65783f): Extracting archive
  - Installing kartik-v/php-date-formatter (v1.3.6): Extracting archive
  - Installing kartik-v/yii2-datecontrol (dev-master 88ac240): Extracting archive
  - Installing kartik-v/yii2-widget-datepicker (dev-master a42d8f5): Extracting archive
  - Installing select2/select2 (4.0.13): Extracting archive
  - Installing kartik-v/yii2-widget-select2 (dev-master 4b8ef7d): Extracting archive
  - Installing lcobucci/clock (3.0.0): Extracting archive
  - Installing mdmsoft/yii2-admin (dev-master 014923c): Extracting archive
  - Installing ruturajmaniyar/yii2-audit-log (dev-master 8e0087b): Extracting archive
  - Installing symfony/mime (v6.4.0): Extracting archive
  - Installing yii2tech/ar-softdelete (1.0.4): Extracting archive
  - Installing yiisoft/yii2-httpclient (2.0.15): Extracting archive
  - Installing yiisoft/yii2-authclient (2.1.8): Extracting archive
  - Installing bower-asset/bootstrap (v5.2.3): Extracting archive
  - Installing yiisoft/yii2-bootstrap5 (2.0.4): Extracting archive
  - Installing yiisoft/yii2-debug (2.1.25): Extracting archive
  - Installing fakerphp/faker (v1.23.1): Extracting archive
  - Installing yiisoft/yii2-faker (2.0.5): Extracting archive
  - Installing symfony/mailer (v6.4.2): Extracting archive
  - Installing yiisoft/yii2-symfonymailer (2.0.4): Extracting archive
Package yii2tech/ar-softdelete is abandoned, you should avoid using it. No replacement was suggested.
Generating autoload files
68 packages you are using are looking for funding.
Use the `composer fund` command to find out more!

```

**3.** Run php init 

```bash
D:\laragon\www>cd yii2-boilerplate

D:\laragon\www\yii2-boilerplate>php init
Yii Application Initialization Tool v1.0

Which environment do you want the application to be initialized in?

  [0] Development
  [1] Production

  Your choice [0-1, or "q" to quit] 0

  Initialize the application under 'Development' environment? [yes|no] yes

  Start initialization ...

   generate api/config/codeception-local.php
   generate api/config/main-local.php
   generate api/config/params-local.php
   generate api/config/test-local.php
  unchanged api/web/index-test.php
  unchanged api/web/index.php
  unchanged api/web/robots.txt
   generate backend/config/codeception-local.php
   generate backend/config/main-local.php
   generate backend/config/params-local.php
   generate backend/config/test-local.php
   generate backend/web/index-test.php
   generate backend/web/index.php
   generate backend/web/robots.txt
   generate common/config/codeception-local.php
   generate common/config/main-local.php
   generate common/config/params-local.php
   generate common/config/test-local.php
   generate console/config/main-local.php
   generate console/config/params-local.php
   generate console/config/test-local.php
   generate frontend/config/codeception-local.php
   generate frontend/config/main-local.php
   generate frontend/config/params-local.php
   generate frontend/config/test-local.php
   generate frontend/web/index-test.php
   generate frontend/web/index.php
   generate frontend/web/robots.txt
   generate yii
   generate yii_test
   generate yii_test.bat
   generate cookie validation key in backend/config/main-local.php
   generate cookie validation key in common/config/codeception-local.php
   generate cookie validation key in frontend/config/main-local.php
   generate cookie validation key in api/config/main-local.php
      chmod 0777 backend/runtime
      chmod 0777 backend/web/assets
      chmod 0777 console/runtime
      chmod 0777 frontend/runtime
      chmod 0777 frontend/web/assets
      chmod 0777 api/runtime
      chmod 0777 api/web/assets
      chmod 0755 yii
      chmod 0755 yii_test

  ... initialization completed.`
```

**4.** Set your database config in /common/config/main-local.php. If the database does not exist, create the database first.

```bash
# /common/config/main-local.php file
'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=yii2-boilerplate',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_'
        ],
```
**5.** Run migrate 
```bash
php yii migrate/fresh

Yii Migration Tool (based on Yii v2.0.49.3)

Are you sure you want to drop all tables and related constraints and start the migration from the beginning?
All data will be lost irreversibly! (yes|no) [no]:yes
Foreign key tbl_auth_assignment_ibfk_1 dropped.
Foreign key tbl_auth_assignment_ibfk_2 dropped.
Foreign key tbl_auth_item_ibfk_1 dropped.
Foreign key tbl_auth_item_child_ibfk_1 dropped.
Foreign key tbl_auth_item_child_ibfk_2 dropped.
Foreign key tbl_categories_ibfk_1 dropped.
Foreign key tbl_categories_ibfk_2 dropped.
Foreign key tbl_categories_ibfk_3 dropped.
Foreign key tbl_fk-classes-created_by dropped.
Foreign key tbl_fk-classes-deleted_by dropped.
Foreign key tbl_fk-classes-updated_by dropped.
Foreign key tbl_genders_ibfk_1 dropped.
Foreign key tbl_genders_ibfk_2 dropped.
Foreign key tbl_genders_ibfk_3 dropped.
Foreign key tbl_marital_ibfk_1 dropped.
Foreign key tbl_marital_ibfk_2 dropped.
Foreign key tbl_marital_ibfk_3 dropped.
Foreign key tbl_menu_ibfk_1 dropped.
Foreign key tbl_products_ibfk_1 dropped.
Foreign key tbl_products_ibfk_2 dropped.
Foreign key tbl_products_ibfk_3 dropped.
Foreign key tbl_products_ibfk_4 dropped.
Foreign key tbl_profiles_ibfk_1 dropped.
Foreign key tbl_profiles_ibfk_2 dropped.
Foreign key tbl_profiles_ibfk_3 dropped.
Foreign key tbl_fk-sections-classes dropped.
Foreign key tbl_fk-sections-created_by dropped.
Foreign key tbl_fk-sections-deleted_by dropped.
Foreign key tbl_fk-sections-updated_by dropped.
Foreign key tbl_fk-students-classes dropped.
Foreign key tbl_fk-students-created_by dropped.
Foreign key tbl_fk-students-deleted_by dropped.
Foreign key tbl_fk-students-sections dropped.
Foreign key tbl_fk-students-updated_by dropped.
Table tbl_audit_entry dropped.
Table tbl_auth_assignment dropped.
Table tbl_auth_item dropped.
Table tbl_auth_item_child dropped.
Table tbl_auth_rule dropped.
Table tbl_categories dropped.
Table tbl_classes dropped.
Table tbl_genders dropped.
Table tbl_marital dropped.
Table tbl_menu dropped.
Table tbl_migration dropped.
Table tbl_products dropped.
Table tbl_profiles dropped.
Table tbl_sections dropped.
Table tbl_students dropped.
Table tbl_user dropped.
Creating migration history table "tbl_migration"...Done.
Total 25 new migrations to be applied:
        m130524_201442_init
        m190124_110200_add_verification_token_column_to_user_table
        m190612_092611_tbl_audit_entry
        m240114_121619_create_classes_table
        m240114_121654_create_sections_table
        m240114_121704_create_students_table
        m240114_132529_seed_users_table
        m240114_132544_seed_classes_table
        m240114_132551_seed_sections_table
        m240114_132603_seed_students_table
        m240115_020004_auth_rule_table
        m240115_020019_auth_item_table
        m240115_020029_auth_item_child_table
        m240115_020051_auth_assignment_table
        m240115_020112_create_menu_table
        m240116_065804_create_categories_table
        m240116_065811_create_products_table
        m240116_071236_seeds_categories_table
        m240116_071247_seeds_products_table
        m240117_073235_create_marital_table
        m240117_073236_create_genders_table
        m240117_073237_create_profiles_table
        m240118_023157_seed_marital_table
        m240118_023204_seed_gender_table
        m240118_023214_seed_profile_table

Apply the above migrations? (yes|no) [no]:yes
```

**6.** Run development server:

```bash
cd yii2-boilerplate
php yii serve --docroot="backend/web/"
Server started on http://localhost:8080/

Document root is "backend/web/"
Quit the server with CTRL-C or COMMAND-C.
[Mon Jan 22 08:45:01 2024] PHP 8.1.10 Development Server (http://localhost:8080) started

```

**7.** Open in browser http://localhost:8080
```bash
Default user and password
+----+-------------+-------------+
| No |    User     |   Password  |
+----+-------------+-------------+
| 1  | superadmin  |   password  |
| 2  | member      |   password  |
+----+-------------+-------------+
```

Usage
-----
You can find how it works with the read code, controller and views etc. Finnally... Happy Coding!
..

Restful Api and Docs Work in progress.. :  [Restful Doc](https://elements.getpostman.com/redirect?entityId=2886585-9f0f4c62-619f-4c37-b5ba-7d6b50fe15ee&entityType=collection) 


Changelog
--------
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

Contributing
------------
Contributions are very welcome.

License
-------

This package is free software distributed under the terms of the [MIT license](LICENSE.md).