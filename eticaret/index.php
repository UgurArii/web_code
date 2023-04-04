<?php
require_once '_inc/connection.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';
//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

//ürün kayıt setinin oluşturulması
$query_Urun = "SELECT * FROM urun WHERE UrunArsiv != 1 AND UrunAktif=1 ORDER BY UrunID DESC LIMIT 24";
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
        <link href="_inc/js/urun-listeleme/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css"/>
        <!--<link href="css/itemsilider.css" rel="stylesheet" type="text/css"/>-->
    <script src="_inc/js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="_inc/js/jquery-ui-1.10.2.custom.js" type="text/javascript"></script>
    <script src="js/modernizr.custom.63321.js"></script>
    <script src="js/jquery.catslider.js"></script>

    <script>
     $(function(){
         $("#tabs").tabs();
         $( '#mi-slider' ).catslider();

     });
    </script>
 		
		
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
    <section class="w980 mh500 fleft">
        <div id="content" class="mh500 fleft w780">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
         
				<div id="mi-slider" class="mi-slider">
<!--					
                                            <?php itemSliderGoster(1); ?>
					
					<?php itemSliderGoster(12); ?>	
					<?php itemSliderGoster(4); ?>	
                                    <?php itemSliderGoster(4); ?>	
					
					<nav>
						<a href="#">Elektronik</a>
						<a href="#">Kitap</a>
						<a href="#">Bilgisayar</a>
						<a href="#">Telefon</a>
					</nav>-->
				</div>
			
		
            <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Yeni Ürünler</a></li>
               <li><a href="#tabs-2">Çok Satanlar</a></li>
               <li><a href="#tabs-3">Beğenilenler</a></li>
               <li><a href="#tabs-4">İndirimdekiler</a></li>
        </ul>
                <div id="tabs-1" style="overflow: hidden ">
                     <?php if($num_row_rsUrun!=0) :?>
            <?php do { ?>
            <div class="urunBox">
                <a href="urun-detay.php?UrunID=<?= $row_rsUrun->UrunID;?>">
                <img src="_uploads/resim/urun/<?= $row_rsUrun->UrunResim;?>" width="150" height="150"/>
                </a>
                <br />
                
                <span class="urunBaslik"><?= $row_rsUrun->UrunAdi; ?></span>
                
                <span class="urunFiyat"><?= $row_rsUrun->UrunFiyat;?> + KDV</span>
                    <span class="sepeteEkle"><a href="sepetim.php?Islem=SepeteEkle&UrunID=<?= $row_rsUrun->UrunID;?>">Sepete Ekle</a></span>
                
            </div>
            <?php } while($row_rsUrun = mysql_fetch_object($rsUrun)); ?>
            <?php else : ?>
            <p class='kirmiziKutu'><strong>Seçmiş Olduğunuz Kategoride Ürün Bulunmamaktadır</strong></p>
            <?php endif;?>
                </div>
        <div id="tabs-2"></div>
        <div id="tabs-3"></div>
        <div id="tabs-4"></div>
        </div>
        
           
        </div>
        <aside id="gundem" class="w200 mh500 fleft bradius3">
            
            <h1>Gündem Alanı</h1>
		
        </aside>
    </section>
</div>

<footer class="w1180 center h100 mTop20">


		
		
</footer>
</body>
</html>


