<?php 
require_once '../../_inc/connection.php';
require_once '../_inc/uyelik/functions.php';
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
}
//sipariş kayıt setinin oluşturulması
$query_rsSiparis = "
        SELECT
        uye_giris.KullaniciAdi,
        uye_giris.Eposta,
        siparis.SiparisID,
        siparis.SiparisCode,
        siparis.UyeID,
        siparis.ToplamUrun,
        siparis.ToplamFiyat,
        siparis.Odeme,
        siparis.SiparisTarih
        FROM
        siparis
        INNER JOIN uye_giris ON siparis.UyeID = uye_giris.UyeID
        WHERE siparis.Arsiv != 0
        ORDER BY
        siparis.SiparisID DESC";

$rsSiparis = mysql_query($query_rsSiparis);
$row_rsSiparis = mysql_fetch_object($rsSiparis);
$num_row_rsSiparis = mysql_num_rows($rsSiparis);



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Sipariş > Liste </title>
    <link  href="../_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="../_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <link href="../_css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css"/>
    <script src="../_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
    
      <script src="../../_inc/js/highslide/highslide-full.js" type="text/javascript"></script>
    <link href="../../_inc/js/highslide/highslide.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
    hs.graphicsDir = "../../_inc/js/highslide/graphics/";
    hs.outlineType = 'rounded-white';
    hs.wrapperClassName = 'draggable-header';
    //hs.minWidth = 1180;
    </script>
    <script type="text/javascript">


$(function() {


$( "#tabs" ).tabs();

$("tr.siparis:even").addClass("ciftSatir");
$("tr.siparis:odd").addClass("tekSatir");

$(" tr.siparis").hover(
    function(){
        $(this).toggleClass("uzerindeyken");
    }
    ,
    function (){
        $(this).toggleClass("uzerindeyken");
    }
);

});
    </script>
    
</head>
<body>
  
  <header>
     <?php require '../_inc/header.php';?>  
    </header>
    <nav>
    <?php require '../_inc/nav.php';?>   
    </nav>
<section>
     
    <h1>Sipariş > Liste</h1>
    <p><a href="index.php">Sipariş Ürünleri</a></p>
     <?php if($num_row_rsSiparis>0):?>
    <p>Toplam Sipariş Sayısı <?= $num_row_rsSiparis;?></p>
    <table id="dinamikListe">
        <tr>
            <th>Sipariş ID</th>
            <th>Sipariş Kodu</th>
             <th>Kullanıcı Adı</th>
            <th>Eposta</th>
             <th>Toplam Ürün</th>
            <th>Toplam Fiyat</th>
             <th>Ödeme Durumu</th>
            <th>Sipariş Tarih</th>
             <th>Düzenle</th>
            
        </tr>
        <?php do{ ?>
        <tr class="siparis">
            <td><?= $row_rsSiparis->SiparisID; ?></td>
            <td><?= $row_rsSiparis->SiparisCode;?></td>
            <td><?= $row_rsSiparis->KullaniciAdi;?></td>
            <td><?= $row_rsSiparis->Eposta;?></td>
            <td><?= $row_rsSiparis->ToplamUrun;?></td>
            <td><?= $row_rsSiparis->ToplamFiyat;?> TL</td>
           <td><?php if($row_rsSiparis->Odeme==1):?>
                <a href="odeme-onay.php?Islem=OdemeOnayIptal&SiparisID=<?= $row_rsSiparis->SiparisID;?>"><img src="../../img/aktif-icon.png" alt="" width="25"/></a>
                         <?php else:?>
                <a href="odeme-onay.php?Islem=OdemeOnayla&SiparisID=<?= $row_rsSiparis->SiparisID;?>">   <img src="../../img/pasif-icon.png" alt="" width="25"/></a>
                         <?php endif;?>
            </td>
            <td><?= date("d/m/Y h:m:i",  strtotime($row_rsSiparis->SiparisTarih));?></td>
            <td>
                  <a href="ayrinti.php?SiparisID=<?= $row_rsSiparis->SiparisID;?>"  onclick="return hs.htmlExpand(this, { objectType: 'iframe',align: 'center' } )" >Ayrıntı</a> |
             
                <a href="detay.php?SiparisID=<?= $row_rsSiparis->SiparisID;?>">Detay</a> |
                <a href="arsivle.php?Islem=ArsivdenCikar&SiparisID=<?= $row_rsSiparis->SiparisID;?>">Arşivden Çıkar</a>
              </td>
        </tr>
        <?php }while($row_rsSiparis = mysql_fetch_object($rsSiparis));?>
    </table>
        <?php else:?>
    <p>Henüz Arşivde Bir Sipariş Bulunmamaktadır.</p>
    <?php    endif;?>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
