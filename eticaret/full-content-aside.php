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
    <nav id="main" class="w1000 h40 center mTop20">
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="#">Sepetim </a></li>
            <li><a href="urun-marka.php">Markalar</a></li>
            <li><a href="#">Çok Satanlar</a></li>
            <li><a href="#">İndirimdekiler</a></li>
            <li><a href="#">Yeniler</a></li>
            <li><a href="#">Yardım</a></li>
            <li><a href="#">Hakkında</a></li>
            <li><a href="#">İletişim</a></li>
        </ul>
    </nav>
<div id="wrapper" class="w1000 center mTop20">
    <aside id="kategori" class="w200 fleft mh500">
        <a href="tum-kategoriler.php"><img src="_img/layout/tum-kategoriler.png" /></a>
        <ul>
          
        </ul>
    </aside>
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


