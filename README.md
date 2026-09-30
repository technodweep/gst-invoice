# GST Invoice — Open-source GST billing software

[![GitHub stars](https://img.shields.io/github/stars/technodweep/gst-invoice?style=flat&color=gold)](https://github.com/technodweep/gst-invoice/stargazers)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

Simple GST invoicing built with **PHP, MySQL and Yii2**. Explore the code, customise it, or host it yourself. Thank you to everyone who has helped this project reach **60+ GitHub stars**!

## Need a desktop app for your business? Try InvoiceGST Pro

**Create GST invoices, manage stock and track payments in one app that works offline.**

InvoiceGST Pro is the desktop edition from Technodweep, the creator of this project. Download it, add your business details and start billing without setting up PHP, MySQL or a web server.

**Free for 30 days. No card required. Then ₹2,499 once for a lifetime desktop license. No monthly subscription.**

[![Get InvoiceGST Pro for Windows from Microsoft Store](https://img.shields.io/badge/Get_InvoiceGST_Pro_for_Windows-Microsoft_Store-2563eb?style=for-the-badge)](https://apps.microsoft.com/detail/9pmx77lrjd8m?hl=en-US&gl=IN)

**[Get the Windows app from Microsoft Store](https://apps.microsoft.com/detail/9pmx77lrjd8m?hl=en-US&gl=IN)** · [Download for Linux](https://invoicegstpro.technodweep.com/#download) · [See the app in action](https://invoicegstpro.technodweep.com/#screenshots) · [View pricing](https://invoicegstpro.technodweep.com/#pricing)

Available for **Windows and Linux**. Get the signed Windows app from Microsoft Store; Linux downloads are on the InvoiceGST Pro website.

### More of your daily work, in one place

- **Create invoices you can send straight to customers.** Calculate CGST/SGST or IGST automatically, add your logo, and print or export PDFs in Classic, Modern or Compact layouts.
- **Turn enquiries into sales.** Create quotations and delivery challans, convert them to invoices, and use recurring invoice templates for repeat billing.
- **Know what is in stock.** Manage products, purchases and suppliers, track stock across godowns, and spot low-stock items from the dashboard.
- **Keep track of money owed.** Record receipts, payments and expenses; check customer balances, party ledgers and overdue amounts.
- **Prepare files for your accountant.** Export sales and purchases as CSV, Tally XML, and GSTR-1 B2B and HSN data.
- **Keep your records on your computer.** Daily billing works offline, with local data storage and a database backup option.

[Explore all Pro features and screenshots →](https://invoicegstpro.technodweep.com/)

### Try it with your own business

1. **[Get InvoiceGST Pro for Windows from Microsoft Store](https://apps.microsoft.com/detail/9pmx77lrjd8m?hl=en-US&gl=IN)** or **[download it for Linux](https://invoicegstpro.technodweep.com/#download)** and install it. Your 30-day trial starts on first launch.
2. **Add your business, customers and products.** Create your first invoice, try the PDF layouts and explore stock and payment tracking.
3. **Keep using it for ₹2,499 once.** [Buy a lifetime license](https://invoicegstpro.technodweep.com/buy/) when you are ready and activate it with the key delivered by email.

You get the complete app during the trial. After 30 days, you can still view your existing data; a license is required to continue creating documents, printing and exporting PDFs.

**Price: ₹2,499 one-time (approximately US$26).** The USD amount is an estimate based on [Wise's USD/INR rate](https://wise.com/in/currency-converter/usd-to-inr-rate/history), checked on 11 September 2026. The listed price is in INR; the final amount and currency appear at checkout, and bank conversion rates or fees may vary. Payments are processed through Razorpay.

### Choose the edition that fits you

| | GST Invoice — this repository | InvoiceGST Pro |
| --- | --- | --- |
| Best for | Developers learning, customising or self-hosting a simple invoicing app | Businesses wanting a desktop app for billing, stock and payments |
| Setup | Configure PHP, MySQL and a web server | Download and install on Windows or Linux |
| Workflow | Simple GST invoicing with source code you can modify | Billing, purchases, inventory, ledgers and reports in one app |
| Price | Free and open source under the [MIT license](LICENSE) | Free for 30 days, then ₹2,499 for a lifetime license |
| Get started | [Open-source installation](#open-source-installation) | [Windows: Microsoft Store](https://apps.microsoft.com/detail/9pmx77lrjd8m?hl=en-US&gl=IN) / [Linux: download](https://invoicegstpro.technodweep.com/#download) |

**This repository remains free and open source.** Pro is a separate desktop product with its own license. You can continue using and contributing to this PHP project without purchasing Pro.

## Open-source installation

The instructions below are for the PHP/Yii2 project in this repository.

### Requirements

- PHP and a web server. The original project declares PHP 5.4.0 as its minimum in `composer.json`; this is a legacy dependency baseline.
- MySQL.
- [Composer](https://getcomposer.org/).

[XAMPP](https://www.apachefriends.org/index.html) can provide a local PHP/MySQL development environment.

### Install dependencies

If you do not have Composer, follow the [Composer installation instructions](https://getcomposer.org/doc/00-intro.md#installation-nix).

Run the following commands inside the project directory:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
php composer.phar install
~~~

### Configure Apache

Create a virtual host like this, assuming you are using XAMPP at the following location:
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

The project directory in this example is `C:/xampp/htdocs/basic/`. Adjust both paths in the virtual host to match your checkout.

Also add the domain `gstinvoice.udev.com` to `C:/Windows/System32/drivers/etc/hosts`:
~~~
127.0.0.1   gstinvoice.udev.com
~~~
After configuring the database below and restarting Apache, visit:
~~~
http://gstinvoice.udev.com
~~~

### Database

Create a MySQL database and import the supplied [SQL file](sqlfile/yii2_indiana.sql). Edit `config/db.php` with your database name and credentials, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => 'your-database-password',
    'charset' => 'utf8',
];
```

The application does not create the database automatically.

## Contributing and support

Found a bug or have an improvement for the open-source edition? [Open an issue](https://github.com/technodweep/gst-invoice/issues) or submit a pull request. If the project is useful to you, a GitHub star helps others discover it.

- [Open-source project background and demo information](https://technodweep.com/gst-billing-software/)
- [InvoiceGST Pro documentation](https://invoicegstpro.technodweep.com/docs/)
- [InvoiceGST Pro support](https://invoicegstpro.technodweep.com/support/)
- Paid support and custom web development: [kuriensandeep@gmail.com](mailto:kuriensandeep@gmail.com)

**Ready to try Pro? [Get the Windows app from Microsoft Store](https://apps.microsoft.com/detail/9pmx77lrjd8m?hl=en-US&gl=IN) or [download for Linux](https://invoicegstpro.technodweep.com/#download).**
