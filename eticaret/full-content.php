<?php
require_once '_inc/connection.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>E-Ticaret</title>
    <link href="_css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
   <?php require_once 'views/header.php';?>
<div id="wrapper" class="w1180 center mTop20">
  
    <section class="w800 mh500 fleft">
        <div id="content" class="mh500 fleft w600">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            
        </div>
        <aside id="gundem" class="w200 mh500 fleft bradius3">
            Gündem Alanı
        </aside>
    </section>
</div>

   <?php require_once 'views/footer.php';?>
</body>
</html>


