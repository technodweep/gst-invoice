GST Invoice billing software
============================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the following command inside the project directory:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
php composer.phar install
~~~

Create a virtual host like this assuming you are using xampp at location
~~~
C:\xampp\apache\conf\extra\httpd-vhosts
~~~

~~~
<VirtualHost *:80>
  ServerAdmin webmaster@localhost
  DocumentRoot C:/xampp/htdocs/basic/web
  ServerName gstinvoice.udev.com

  <Directory "C:/xampp/htdocs/basic/web">
    # use mod_rewrite for pretty URL support
    RewriteEngine on
    # If a directory or a file exists, use the request directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule . index.php

    # ...other settings...
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Order allow,deny
    Allow from all
  </Directory>
</VirtualHost>
~~~

The project directory in this case will be C:/xampp/htdocs/basic/

Also add the domain gstinvoice.udev.com at 
c:/windows/drivers/etc/hosts
~~~
127.0.0.1   gstinvoice.udev.com
~~~
You should be able to visit the site at the following url after you restart Apache
~~~
http://gstinvoice.udev.com
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- The program won't create the database for you, this has to be done manually before you can access it.

This project is built using PHP/Mysql and Yii2 framework.
It will be a good for somebody looking for a really simple Invicing system.
If you are new to PHP you will need to set up the environment
You can use Xampp
https://www.apachefriends.org/index.html

Demo link can be found here
https://technodweep.com/gst-billing-software/

For paid support or to create any web based project contact sandeep@technodweep.com 