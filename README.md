# NigeLib/Headlinks

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Headlinks - automatically cache bust new css and js files.

## About

Headlinks is a small class for managing Javascript and CSS links. It adds the
time stamp of the file modification to the file name as a query parameter,
causing the users browser to reload the file if it has changed.
Dependencies can be defined between files, to not only make sure that a
dependency is included as well, but also included beforehand.

## Installing

Via Composer

``` bash
$ composer require merlinblack/headlinks
```

Or use git to clone.

## Example usage

``` php
<?php
// test_headlinks.php
require( '../vendor/autoload.php' );
use NigeLib/Headlinks;

// Load dependancy information and 'virtual' files.
// Virtual files do not really exist, but when used with the addFile method,
// thier dependancies will be added.
// Virtual files are denoted by starting with a '$'
$headlinks = new Headlinks(
    array(
        '$jquery-ui' => array( 'testassets/jquery/ui/jquery-ui.js' ),
        'testassets/jquery/ui/jquery-ui.js' => array( 'testassets/jquery/jquery.js', 'testassets/jquery/themes/base/jquery-ui.css' ),
        'testassets/jquery/themes/base/jquery-ui.css' => array( 'testassets/jquery/ui/jquery-ui.js' ),
        'testassets/test.1.2.3.js' => array( 'testassets/jquery/jquery.js', 'testassets/jquery/ui/jquery-ui.js' ),
    )
);

// Add links needed for page....
$headlinks->addFile( 'testassets/moment.js' );
$headlinks->addFile( '$jquery-ui' );
$headlinks->addFile( 'testassets/style.css' );
$headlinks->addFile( 'testassets/test.1.2.3.js' );

// Render the page!
?>
<!doctype html>
<html>
 <head>
  <?php echo $headlinks->getStyles() ?>
 </head>
 <body>
  <h1>This is a test</h1>
  <a href='test_headlinks.php'>Load again</a>
 </body>
  <?php echo $headlinks->getScripts() ?>
</html>
```
