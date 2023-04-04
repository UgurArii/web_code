<?php
require_once '_inc/connection.php';
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
    <header class="w1000 h100 center ">
        <div id="headerSlogan" class="w200 h40 fleft">
            <img width="19" height="18" alt="Mağaza" src="img/layout/header/memnuniyet.png"/>Müşteri Memnuniyeti
        </div>
        
        <div id="headerUyePuan" class="w200 h40 fleft">
            <img width="19" height="18" alt="Mağaza" src="img/layout/header/hediye.png" />
            Üye Puanı | Hediye Çeki
        </div>
        
        <div id="headerTopNav" class="w540 h40 fright">
            <ul>
                <li><a href="uye-ol.php">Yeni Üye</a> | </li>
                <li><a href="#">Hesabım</a> | </li>
                <li><a href="#">Sipariş Takip</a> | </li>
                <li><a href="#">Listem</a> | </li>
                <li><a href="#">Müşteri Hizmetleri</a></li>
            </ul>
        </div>
        
        <div id="headerLogo" class="w200 h40 fleft">
          <img src="img/layout/header/headerLogo.png"/>            
        </div>
        
        <div id="headerSearchContainer" class="w540 h40 fleft">
            <div id="headerSearch" class="h30 w600">
                <form id="headerSearchForm" method="get" action="arama.php">
                <select id="KategoriID" name="KategoriID">
                    <option value="0">Tüm Departmanlar</option>
                    <?php do {?>
                    <option value="<?= $row_rsHeaderAramaKategori->KategoriID;?>"><?= $row_rsHeaderAramaKategori->Kategori;?></option>
                    <?php }while($row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori)); ?>
                </select>
                <input id="SearchAramaKelime" type="text" onfocus="this.value=''" value="Aradığınız Kelimeyi Yazınız" name="SearchAramaKelime"/>
                <input id="SearchFormSubmit" type="submit" value="" name="SearchFormaSubmit"/>
                </form>
            </div>
        </div>
        
        <div id="headerCartButton" class="h40 fright" style="width:152px;"/>
             <a href="#"><img src="img/layout/header/sepetim.png"/></a>
        </div>
    </header>
    <nav id="main" class="w1000 h40 center mTop20">
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="sepetim.php">Sepetim </a></li>
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
            <?php do { ?>
            <li><a href="index-kategori.php?KategoriID=<?= $row_rsUrunKategori->KategoriID;?>""><?= $row_rsUrunKategori->Kategori;?></a></li>
            <?php }while($row_rsUrunKategori =  mysql_fetch_object($rsUrunKategori)) ;?>
        </ul>
    </aside>
    <section class="w800 mh500 fleft">
        <div id="content" class="mh500 fleft w600">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <?php if($num_row_rsUrun!=0) :?>
            <?php do { ?>
            <div class="urunBox">
                <img src="_uploads/resim/urun/<?= $row_rsUrun->UrunResim;?>" width="150" height="150"/>
                <br />
                <span class="urunBaslik"><?= $row_rsUrun->UrunAdi; ?></span>
                
                <span class="urunFiyat"><?= $row_rsUrun->UrunFiyat;?> + KDV
                
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

<footer class="w1000 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>


