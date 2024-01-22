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
![Dashboard](screenshoot/dashboard.png?raw=true)

Installation
------------

**1.** Get The Repository

```bash
git clone https://github.com/bastomiadi/yii2-boilerplate2.git
```

**2.** Run php init and set your database config in /common/config/main-local.php. If the database does not exist, create the database first.

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
**3.** Run migrate 
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

**4.** Run development server:

```bash
cd yii2-boilerplate
php yii serve --docroot="backend/web/"
Server started on http://localhost:8080/

Document root is "backend/web/"
Quit the server with CTRL-C or COMMAND-C.
[Mon Jan 22 08:45:01 2024] PHP 8.1.10 Development Server (http://localhost:8080) started

php yii serve --docroot="backend/web/"
```

**5.** Open in browser http://localhost:8080
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
..Restful Api and Docs Work in progress

Changelog
--------
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

Contributing
------------
Contributions are very welcome.

License
-------

This package is free software distributed under the terms of the [MIT license](LICENSE.md).