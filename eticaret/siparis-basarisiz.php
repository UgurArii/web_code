<?php
require_once '_inc/connection.php';
require_once '_inc/siparis/functions.php';
require_once '_inc/urun/urun-functions.php';
require_once '_inc/sepet/functions.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';
//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

//ürün kayıt setinin oluşturulması
$query_Urun = "SELECT * FROM urun WHERE UrunArsiv != 1 AND UrunAktif=1 ORDER BY UrunID DESC LIMIT 5";
$rsUrun = mysql_query($query_Urun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);

//header search kategori kayıt setinin oluşturulması
$query_rsHeaderAramaKategori = "SELECT * FROM urun_kategori WHERE ParentID=0";
$rsHeaderAramaKategori = mysql_query($query_rsHeaderAramaKategori);
$row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori);
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

<div id="wrapper" class="w1000 center mTop20">
  
    <section class="w800 mh500 fleft">
        <div id="content" class="mh500 fleft w600">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <p>Siparişiniz Başarısızı</p>
        </div>
        <aside id="gundem" class="w200 mh500 fleft bradius3">
            Gündem Alanı
        </aside>
    </section>
</div>

<footer class="w1000 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>


