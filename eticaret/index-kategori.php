<?php
require_once '_inc/connection.php';
require_once '_inc/urun/urun-functions.php';
require_once '_inc/sepet/functions.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';



//url parametresinin alınması
$kategoriID = $_GET['KategoriID'];
//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

//ürün kayıt setinin oluşturulması
$query_Urun = "SELECT * FROM urun WHERE KategoriID = '$kategoriID' AND UrunArsiv != 1 AND UrunAktif=1 ORDER BY UrunID DESC LIMIT 5";
$rsUrun = mysql_query($query_Urun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);

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
        <a href="tum-kategoriler.php"><img src="_img/layout/tum-kategoriler.png" /></a>
        <ul>
            <?php do { ?>
            <li><a href="index-kategori.php?KategoriID=<?= $row_rsUrunKategori->KategoriID;?>"><?= $row_rsUrunKategori->Kategori;?></a></li>
            <?php }while($row_rsUrunKategori =  mysql_fetch_object($rsUrunKategori)) ;?>
        </ul>
    </aside>
    <section class="w980 mh500 fleft">
        <div id="content" class="mh500 fleft w780">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <?php if($num_row_rsUrun!=0) :?>
            <?php do { ?>
            <div class="urunBox">
                <img src="_uploads/resim/urun/<?= $row_rsUrun->UrunResim;?>" width="150" height="150"/>
                <br />
                <?= $row_rsUrun->UrunAdi; ?>
                <br />
                <?= $row_rsUrun->UrunFiyat;?> + KDV
                
            </div>
            <?php } while($row_rsUrun = mysql_fetch_object($rsUrun)); ?>
            <?php else : ?>
            <p class='kirmiziKutu'><strong>Seçmiş Olduğunuz Kategoride Ürün Bulunmamaktadır</strong></p>
            <?php endif;?>
        </div>
        <aside id="gundem" class="w200 mh500 fleft bradius3">
            Gündem Alanı
        </aside>
    </section>
</div>

<?php require_once 'views/footer.php';?>
</body>
</html>


