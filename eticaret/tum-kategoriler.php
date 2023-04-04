<?php
require_once '_inc/connection.php';
//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

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

    <section class="w100 mh500 fleft">
        <div id="content" class="mh500 fleft w1000">
            
           <?php do{ ?>
             <div class="kategoriBox">
                 <a href="index-kategori.php?KategoriID=<?= $row_rsUrunKategori->KategoriID; ?>">
                 <link href="_css/content.css" rel="stylesheet" type="text/css"/>
           
               <img src="_uploads/resim/urun-kategori/<?= $row_rsUrunKategori->KategoriResim; ?>" />
               <span><?= $row_rsUrunKategori->Kategori; ?></span>
               </a>
            </div>
           
           <?php }while($row_rsUrunKategori = mysql_fetch_object($rsUrunKategori)); ?>
        </div>
    </section>
</div>

<footer class="w1180 center h100 mTop20">
    Footer Alanı
</footer>
</body>
</html>
