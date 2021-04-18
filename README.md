## BFI Technical task

All of the programming for this task has been contained in a custom Drupal module called 'Articles' located within the bfi.zip file.

### Steps to install
1. Create a website with a fresh Drupal 9 install.
2. Install and enable the 'Olivero' theme.
3. Download and extract the 'bfi.zip' file.
4. Move the custom 'Articles' module from 'bfi/modules/custom/articles' to the modules directory of your Drupal site.
5. Go to the 'Extend' admin interface of your Drupal website or `/admin/modules` url. Install the 'Articles module'.
6. Go to `/articles` url on your Drupal site and you should now see the fetched articles.

**Note: This has been built using PHP version 7.3** 

If the steps above are causing issues try the following.

### Alternative install
1. Download and extract both the bfi_test.sql.zip and bfi.zip file.
2. Create a new virtualhost I.E 'localhost' and point it to the bfi folder extracted from 'bfi.zip', this contains the root of the Drupal site.
3. Create a new mysql database on your server and name it accordingly I.E 'bfi_test'. Import the extracted 'bfi_test.sql' file into the newly created database. 
4. Go to the settings.php file located at '/bfi/sites/default/settings.php'. 
5. Update the following array starting at line 782, to match your server database settings.
 
```php
$databases['default']['default'] = array (
  'database' => 'bfi_test',
  'username' => 'root',
  'password' => 'mysql',
  'prefix' => '',
  'host' => '127.0.0.1',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
```

6. You should now be able to visit your new domain I.E 'http://localhost' and see a fresh Drupal install.
7. Go to 'http://localhost/articles' to view the technical task.


