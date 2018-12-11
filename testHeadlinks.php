<?php
require('src/Headlinks.php');
$headlinks = new NigeLib\Headlinks(
    array(
        '$jquery-ui' => array( 'testassets/jquery/ui/jquery-ui.js' ),
        'testassets/jquery/ui/jquery-ui.js' => array( 'testassets/jquery/jquery.js', 'testassets/jquery/themes/base/jquery-ui.css' ),
        'testassets/jquery/themes/base/jquery-ui.css' => array( 'testassets/jquery/ui/jquery-ui.js' ),
        'testassets/test.1.2.3.js' => array( 'testassets/jquery/jquery.js', 'testassets/jquery/ui/jquery-ui.js' ),
    )
);
$headlinks->addFile( 'testassets/moment.js' );
$headlinks->addFile( '$jquery-ui' );
$headlinks->addFile( 'testassets/style.css' );
$headlinks->addFile( 'testassets/test.1.2.3.js' );
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
