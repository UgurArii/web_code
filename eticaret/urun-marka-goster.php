<?php
require_once '_inc/connection.php';
require_once '_inc/marka/functions.php';
//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

//markaID değerinin alınması
$markaID = mysql_real_escape_string($_GET['MarkaID']);

//profil tablosunda ürünlere bakılır
$query_rsUrunProfilMarka = "SELECT * FROM urun_profil WHERE MarkaID = '$markaID'";
$rsUrunProfilMarka = mysql_query($query_rsUrunProfilMarka);
$row_rsMarka = mysql_fetch_object($rsUrunProfilMarka);
$num_rows_rsMarka = mysql_num_rows($rsUrunProfilMarka);
//ürün kayıt setinin oluşturulması
$query_Urun = "SELECT  
    urun.UrunID,
    urun.KategoriID,
    urun.UrunAdi,
    urun.UrunFiyat,
    urun.IndirimliFiyat,
    urun.Indirim,     
    urun.UrunResim,
    urun.UrunAktif,
    urun.UrunArsiv,
    urun.UrunTarih,
    urun_profil.UrunID,
    urun_profil.MarkaID
    FROM
    urun
    INNER JOIN urun_profil ON urun.UrunID = urun_profil.UrunID
        WHERE UrunArsiv != 1 AND  UrunAktif=1 AND urun_profil.MarkaID = '$markaID' ORDER BY urun.UrunID DESC ";
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
<div id="wrapper" class="w1180 center mTop20">
    <aside id="kategori" class="w200 fleft mh500">
        <a href="tum-kategoriler.php"><img src="_img/layout/tum-kategoriler.png" /></a>
        <ul>
            <?php do { ?>
            <li><a href="index-kategori.php?KategoriID=<?= $row_rsUrunKategori->KategoriID;?>""><?= $row_rsUrunKategori->Kategori;?></a></li>
            <?php }while($row_rsUrunKategori =  mysql_fetch_object($rsUrunKategori)) ;?>
        </ul>
    </aside>
    <section class="w800 mh500 fleft">
        <div id="content" class="mh500 fleft w600">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <h1><?= markaGoster($markaID);?> ürünleri</h1> 
            
            <p><?php echo "Toplam ürün sayısı : $num_rows_rsMarka"; ?></p>
              <?php if($num_row_rsUrun!=0) :?>
            <?php do { ?>
            <div class="urunBox">
                <a href="urun-detay.php?UrunID=<?= $row_rsUrun->UrunID;?>">
                <img src="_uploads/resim/urun/<?= $row_rsUrun->UrunResim;?>" width="150" height="150"/>
                </a>
                <br />
                <span class="urunBaslik"><?= $row_rsUrun->UrunAdi; ?></span>
                
                <span class="urunFiyat"><?= $row_rsUrun->UrunFiyat;?> + KDV
                
            </div>
            <?php } while($row_rsUrun = mysql_fetch_object($rsUrun)); ?>
            <?php else : ?>
            <p class='kirmiziKutu'><strong>Seçmiş Olduğunuz Kategoride Ürün Bulunmamaktadır</strong></p>
            <?php endif;?>
        </div>
    </section>
</div>

<footer class="w1180 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>


