<?php
require_once '_inc/connection.php';
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

//detayı istenen ürünün id si
$urunDetayID = mysql_real_escape_string($_GET['UrunID']);

//ürün kayıt setinin oluşturulması
$query_Urun = "SELECT 
    urun_kategori.KategoriID,
    urun_kategori.Kategori,
    urun_kategori.ParentID,
    urun_kategori.KategoriResim,
    urun.UrunID,
    urun.KategoriID,
    urun.KdvID,
    urun.UrunAdi,
    urun.UrunFiyat,
    urun.IndirimliFiyat,
    urun.Indirim,
    urun.UrunResim,
    urun.UrunAktif,
    urun.UrunArsiv,
    urun.UrunTarih,
    urun_kdv.KdvID,
    urun_kdv.KdvTip,
    urun_kdv.Kdv
    FROM urun
    INNER JOIN urun_kategori ON urun.KategoriID = urun_kategori.KategoriID
    INNER JOIN urun_kdv ON urun.KdvID = urun_kdv.KdvID
        WHERE urun.UrunID = '$urunDetayID' AND urun.UrunArsiv !=1 AND urun.UrunAktif=1 ";
$rsUrun = mysql_query($query_Urun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);

//ürün profil bilgisinin alınması
$query_rsUrunProfil = "SELECT * FROM urun_profil WHERE UrunID = '$urunDetayID'";
$rsUrunProfil= mysql_query($query_rsUrunProfil);
$row_rsUrunProfil = mysql_fetch_object($rsUrunProfil);
$num_row_rsUrunProfil = mysql_num_rows($rsUrunProfil);

//header search kategori kayıt setinin oluşturulması
$query_rsHeaderAramaKategori = "SELECT * FROM urun_kategori WHERE ParentID=0";
$rsHeaderAramaKategori = mysql_query($query_rsHeaderAramaKategori);
$row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title><?= $row_rsUrun->UrunAdi;?> - <?= $row_rsUrun->Kategori;?> Fiyat: <?= $row_rsUrun->UrunFiyat;?> - E-Ticaret</title>
    <link href="_css/style.css" rel="stylesheet" type="text/css"/>
    <link href="_inc/js/ui-lightness/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css"/>
    <script src="_inc/js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="_inc/js/jquery-ui-1.10.2.custom.js" type="text/javascript"></script>
    <script>
     $(function(){
         $("#tabs").tabs();
     });
    </script>
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
   
    <section class="w800 mh500 fleft">
          <div id="urunDetayKategori">
             <?php $ustKategori = ustKategoriBul($row_rsUrun->KategoriID);
             if(!empty($ustKategori)){
                 echo "$ustKategori->Kategori - ";
             }
             ?>
                  <?= $row_rsUrun->Kategori;?>
                </div>
        <div id="content" class="mh500 fleft w1000">
            <div id="urunDetay">
              
            <div id="urunDetayBaslik"><?= $row_rsUrun->UrunAdi; ?></div>
        </div>
        <div id="urunDetayResim" >
            <img src="_uploads/resim/urun/<?= $row_rsUrun->UrunResim;?>" width="300" alt="<?= $row_rsUrun->UrunAdi; ?>"></img>
        </div>
            <div id="urunBilgi">
                <img src="_img/urun-detay/kargolama.png" alt="Kargolama Bilgisi"</img>
                <div id="urunBilgiYorum">
                    <img src="_img/urun-detay/yildiz.gif"/>Yorumları Oku<span class="yorumSayisi">(222)</span><a href="#">Yorum Yap</a>
                </div>
                <div id="urunBilgiSosyalMedya">
                    <img src="_img/urun-detay/sosyalMedya.PNG" alt=""/>
                </div>
                <div id="urunDetayFiyat">
                    <ul>
                        <li><label>Fiyat : </label><?= $row_rsUrun->UrunFiyat;?> TL + KDV</li>
                        <li><label>İndirimli : </label><?= $row_rsUrun->IndirimliFiyat;?> TL
                            <img src="_img/urun-detay/indirimliFiyat.PNG"/>
                        </li>
                        <li><label>Kdv Dahil : </label>
                        <?php
                        $kdv = $row_rsUrun->Kdv;
                        $urunFiyati = $row_rsUrun->UrunFiyat;
                        $indirimliFiyat = $row_rsUrun->IndirimliFiyat;
                        if($indirimliFiyat!=0){
                        $kdvSi = ($indirimliFiyat * $kdv)/100;
                        $kdvliFiyat = $indirimliFiyat + $kdvSi;
                        echo number_format($kdvliFiyat,2);
                        }else{
                        $kdvSi = ($urunFiyati * $kdv)/100;
                        $kdvliFiyat = $urunFiyati + $kdvSi;
                        echo number_format($kdvliFiyat,2);
                        }
                        
                        ?> TL 
                        </li>
                    </ul>
                </div>
            </div>
             <div id="urunDetayNav">
                 <img src="_img/urun-detay/sepeteEkle.jpg" alt=""/>
                 <ul>
                     <li><a href="">Yorum yap, puan kazan</a></li>
                     <li><a href="">Arkadaşına öner, puan kazan</a></li>
                     <li><a href="">Görsel ekle, puan kazan</a></li>
                     <li><a href="">Fiyat Düşünce Haber Ver</a></li>
                     <li><a href="">Hepsi Olsa Listeme Ekle</a></li>
                     <li><a href="">Alışveriş Listeme Ekle</a></li>
                 </ul>
                 <?php if($num_row_rsUrunProfil>0) :?>
                 <span class="urunDetayNavPuan">Bu üründen kazanacağınız</span>
                 <span class="urunDetayNavPuanMiktar">Arı Puan: <?= $row_rsUrunProfil->UrunPuan;?></span>
                 <?php endif;?>
            </div>
        </div>
        <div id="urunDetayAciklama">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Ürün Açıklama</a></li>
               <li><a href="#tabs-2">Yorumlar</a></li>
               <li><a href="#tabs-3">Taksit</a></li>
               <li><a href="#tabs-4">Ürün Görseller</a></li>
               <li><a href="#tabs-5">Püf Noktası</a></li>
        </ul>
        <div id="tabs-1"><?= $row_rsUrunProfil->UrunAciklama;?></div>
        <div id="tabs-2"></div>
        <div id="tabs-3"></div>
        <div id="tabs-4"></div>
        <div id="tabs-5"></div>
    </div>
</div>
        <div id="buUrunleBirlikteTercihEdilenUrunler">
            <h3 class="font13 strong colorV2 mb10 mt10">Bu Ürün Tercih Edenlerin Satın Aldığı Diğer Ürünler</h3>
        </div>
        <div id="kategorideEnCokSatanlar">
            <h3 class="font13 strong colorV2 mb10 mt10"><?= $row_rsUrun->Kategori;?>Kategoride En Çok Satanlar</h3>
        </div>
        </div>

    </section>
</div>

<footer class="w1000 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>


