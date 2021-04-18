## BFI Technical task

All of the programming for this task has been contained in a custom Drupal module called 'Articles', this is compressed in the root folder of the repository 'articles.zip'.

### Steps to install
1. Create a website with a fresh Drupal 9 install.
2. Enable the 'Olivero' theme and set as default.
3. Move the 'articles.zip' module from the repository root to the modules directory of your Drupal site and extract it's contents there.
4. Go to the 'Extend' admin interface of your Drupal website or `/admin/modules` url. Install the 'Articles' module.
5. Go to `/articles` url on your Drupal site and you should now see the articles pulled in via the API.

**Note: This has been built using PHP version 7.3** 

If the steps above are causing issues try the following.

### Alternative install
1. Clone the repository.
2. Create a new virtualhost I.E 'localhost' and point it to the site folder in the root of this repository.
3. Open up terminal and type `composer update` in the site folder incase any contrib modules have been ignored by git.
4. Create a new mysql database on your server and name it accordingly I.E 'bfi_test'. Import the 'bfi_test.sql.zip' file from the root of this repository into the newly created database. 
5. Go to the settings.php file located at 'bfi/site/sites/default/settings.php'. 
6. Update the following array starting at line 782, to match your server database settings.
 
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

7. You should now be able to visit your new domain I.E 'http://localhost' and see a fresh Drupal install.
8. Go to 'http://localhost/articles' to view the technical task.


