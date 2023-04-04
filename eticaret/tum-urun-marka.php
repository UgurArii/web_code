<?php
require_once '_inc/connection.php';
require_once '_inc/urun/urun-functions.php';
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

//ürün markaları için kayıt setinin oluşturulması
$query_rsUrunMarka = "SELECT * FROM urun_marka ORDER BY Marka ASC";
$rsUrunMarka = mysql_query($query_rsUrunMarka);
$row_rsUrunMarka = mysql_fetch_object($rsUrunMarka);
$num_row_rsUrunMarka = mysql_num_rows($rsUrunMarka);

//ürün marka harf kayıt setinin oluşturulması
$query_UrunMarkaHarf = "SELECT * FROM urun_harf ORDER BY HarfID ASC";
$rsUrunMarkaHarf = mysql_query($query_UrunMarkaHarf);
$row_rsUrunMarkaHarf = mysql_fetch_object($rsUrunMarkaHarf);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Marka | E-Ticaret</title>
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
        <div id="content" class="mh500 fleft w800">
            <p>Aradığınız markanın ilk harfine tıklayınız</p>
            <div id="urunMarkaHarf">
                <?php do{ ?>
                <a href="urun-marka.php?Harf=<?=$row_rsUrunMarkaHarf->Harf;?>"><?= $row_rsUrunMarkaHarf->Harf;?></a>
                <?php } while($row_rsUrunMarkaHarf=  mysql_fetch_object($rsUrunMarkaHarf));?>
            </div>
            
            <div class="urunMarkaWrapper">
                <?php do{ ?>
                <div class="urunMarkaBox">
                    <?php if($num_row_rsUrunMarka>0):?>
                 <?php $markaDurum = markadaUrunVarMi($row_rsUrunMarka->MarkaID);?>
                    <?php if($markaDurum==0) :?>
                       <?= $row_rsUrunMarka->Marka;?>
                    <?php else:?>
                    <a href="urun-marka-goster.php?MarkaID=<?= $row_rsUrunMarka->MarkaID;?>"><?= $row_rsUrunMarka->Marka;?></a>
                    <?php endif;?>
                    
                    <?php else :?>
                    <div class="kirmiziKutu"><p>Henüz bu harfla ilgi kategori bulunmamaktadır</p></div>
                    <?php endif;?>
                    </div>
                <?php }while($row_rsUrunMarka = mysql_fetch_object($rsUrunMarka));?>
            </div>
        </div>
       
    </section>
</div>

<footer class="w1180 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>


