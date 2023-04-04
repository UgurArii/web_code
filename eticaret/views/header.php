<?php

require_once '_inc/connection.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';
//header search kategori kayıt setinin oluşturulması
$query_rsHeaderAramaKategori = "SELECT * FROM urun_kategori WHERE ParentID=0";
$rsHeaderAramaKategori = mysql_query($query_rsHeaderAramaKategori);
$row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori);
?>
    <header class="w1180 h100 center ">
        <div id="headerSlogan" class="w200 h40 fleft">
            <img width="19" height="18" alt="Mağaza" src="img/layout/header/memnuniyet.png"/>Müşteri Memnuniyeti
        </div>
        
        <div id="headerUyePuan" class="w200 h40 fleft">
            <img width="19" height="18" alt="Mağaza" src="img/layout/header/hediye.png" />
            Üye Puanı | Hediye Çeki
        </div>
        
        <div id="headerTopNav" class="w540 h40 fright">
            <ul>
                
                <?php if(!isset($_SESSION['UyeID'])) :?>
                <li><a href="uye-ol.php">Yeni Üye</a> | </li>
                 <li><a href="uye-giris.php">Yeni Giriş</a>  </li>
                 <?php else:?>
                <li><a href="uye-profil.php?Panel=Hesap">Hesabım</a> | </li>
                <li><a href="uye-profil.php?Panel=Siparis">Sipariş Takip</a> | </li>
                <li><a href="uye-profil.php?Panel=Listem">Listem</a> | </li>
                <li><a href="musteri-hizmetleri.php">Müşteri Hizmetleri</a>  </li>
                <li><a href="uye-cikis.php">Çıkış Yap</a>  </li>
                <?php                endif;?>
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
             <a href="sepetim.php"><img src="img/layout/header/sepetim.png"/></a>
        </div>
    </header>
    <nav id="main" class="w1180 h40 center mTop20">
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
