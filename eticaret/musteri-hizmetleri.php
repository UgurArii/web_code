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
    <aside id="kategori" class="w200 fleft mh500">
   
        <ul>
            <li><a href="#">Liste 1 </a></li>
            <li><a href="#">Liste 2</a></li>
        </ul>
    </aside>
    <section class="w980 mh500 fleft">
        <div id="content" class="mh500 fleft w980">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <h1>Müşteri Hizmetlerine Hoşgeldiniz</h1>
        </div>
      
    </section>
</div>

<?php require_once 'views/footer.php';?>
</body>
</html>


