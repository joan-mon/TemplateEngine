Lightweight PHP template engine
===============================

Features
--------
  * Fast

  * Powerful

  * Easy
  
Installing
----------

@todo

Getting started
---------------

   * Simple template:
```
/base/path/|
           |_ simple-template.phtml
           |_ script.php
```
```html
<!-- simple-template.phtml -->
<!DOCTYPE html>
<html>
   <head>
       <title><?= \jmon\TplEngine\View::get('title') ?></title>
   </head>
   <body>
       <h1><?= \jmon\TplEngine\View::get('title') ?></h1>
   </body>
</html>
```
```php
<?php
 // script.php
use jmon\TplEngine\View;
View::setBasePath('/base/path');
View::set('title', 'hello world!');
echo View::render('simple-template.phtml');
?>
```
```html
<!-- final rendering -->
<!DOCTYPE html>
<html>
   <head>
       <title>hello world!</title>
   </head>
   <body>
       <h1>hello world!</h1>
   </body>
</html>
```
   * Template with layout:
```
/base/path/|
           |_ layout.phtml
           |_ home/index.phtml
           |_ script.php
```
```html
<!-- layout.phtml -->
<!DOCTYPE html>
<html>
   <head>
       <title><?= \jmon\TplEngine\View::get('title') ?></title>
   </head>
   <body>
   		 <!-- Place where will be rendered the content of templates that extends this one -->
       <?= \jmon\TplEngine\View::content() ?>
   </body>
</html>
```
```html
<!-- home/index.phtml -->
<?php \jmon\TplEngine\View::templateExtend('layout.phtml')?>
<h1><?= \jmon\TplEngine\View::get('title') ?></h1>
```
```php
<?php
 // script.php
use jmon\TplEngine\View;
View::setBasePath('/base/path');
View::set('title', 'hello world!');
echo View::render('/home/index.phtml');
?>
```
```html
<!-- final rendering -->
<!DOCTYPE html>
<html>
   <head>
       <title>hello world!</title>
   </head>
   <body>
       <h1>hello world!</h1>
   </body>
</html>
```
   * Use of partial:
```
/base/path/|
           |_ template.phtml
           |_ partial.phtml
           |_ script.php
```
```html
<!-- template.phtml -->
<!DOCTYPE html>
<html>
   <head>
       <title><?= \jmon\TplEngine\View::get('title') ?></title>
   </head>
   <body>
       <h1><?= \jmon\TplEngine\View::get('title') ?></h1>
       <?php \jmon\TplEngine\View::partial('partial.phtml')?>
   </body>
</html>
```
```html
<!-- partial.phtml -->
<footer><?= \jmon\TplEngine\View::get('footer-text') ?></footer>
```
```php
<?php
 // script.php
use jmon\TplEngine\View;
View::setBasePath('/base/path');
View::set('title', 'hello world!');
View::set('footer-text', 'Awesome footer!');
echo View::render('template.phtml');
?>
```
```html
<!-- final rendering -->
<!DOCTYPE html>
<html>
   <head>
       <title>hello world!</title>
   </head>
   <body>
       <h1>hello world!</h1>
       <footer>Awesome footer!</footer>
   </body>
</html>
```