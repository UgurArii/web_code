<?php 
require_once '../../_inc/connection.php';

//üye kayıt setinin yapılması

$rsUye = "SELECT uye_giris.UyeID, uye_seviye.SeviyeIcon, uye_seviye.Seviye, uye_giris.KullaniciAdi, uye_giris.Eposta, uye_giris.KayitIP, uye_giris.Aktif, uye_giris.KayitTarih"
        . " FROM uye_giris INNER JOIN uye_seviye ON uye_giris.SeviyeID = uye_seviye.SeviyeID  ORDER BY uye_giris.UyeID DESC";

$rsUye = mysql_query($rsUye);

//var_dump($rsUye);

$row_rsUye = mysql_fetch_object($rsUye);
$num_row_rsUye = mysql_num_rows($rsUye);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title> </title>
    <link  href="../_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="../_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <script src="../_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript">


$(function() {


$( "#tabs" ).tabs({selected:2});




});
    </script>
</head>
<body>
  
    <header>
        <h1>Panel</h1>
        <div id="kullaniciLogin">            
          <img src="../../_uploads/resim/uye/seviye/_kullanici.png" alt=""/> Kullanıcı Adı            
          <img src="../../_uploads/resim/uye/seviye/logout.png" alt=""/>Çıkış
        </div>
    </header>
    <nav>
     
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Ürün Temel</a></li>
		<li><a href="#tabs-2">Ürün Detay</a></li>
		<li><a href="#tabs-3">Üyelik</a></li>
	</ul>
	<div id="tabs-1">
            <table>
                <tr>
                    <td><h3>Ürün</h3></td>
                    <td></td>
                     <td></td>
                    <td><h3>Gösterim Türü</h3></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../urun/ekle.php">Ekle</a></td> 
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../urun/index.php">Düzenle</td>
                    <td>&nbsp;</td>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../urun_gosterim_turu/ekle.php">Ekle</td> 
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../urun_gosterim_turu/index.php">Düzenle</td>
                    
                    <td></td>
                 </tr>
                 <tr>
                     <td><h3>Ürün Kategori</h3></td>
                     <td></td>
                     <td></td>
                     <td>    </td>
                     <td></td>
                     <td></td>
                 </tr>
                <tr>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../urun_kategori/ekle.php">Ekle</td> 
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../urun_kategori/index.php">Düzenle</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                   <tr>
                       <td><h3>Ürün KDV</h3></td>
                       <td></td>
                       <td></td>
                       <td>    </td>
                       <td></td>
                       <td></td>
                   </tr>
                    <tr>
                        <td><img src="../../img/layout/_ekle.png" /><a href="../urun_kdv/ekle.php">Ekle</td>
                        <td><img src="../../img/layout/_duzenle.png" /><a href="../urun_kdv/index.php">Düzenle</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
            </table>
                                
                 .</div>
	<div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
        <div id="tabs-3">
             <table class="uyeTabs">
                <tr>
                    <td>Üye Seviye</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../uye_seviye/ekle.php">Ekle</a></td>
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../uye_seviye/index.php">Düzenle</a></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Üyeler</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../uye/ekle.php">Ekle</a></td>
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../uye/duzenle.php">Düzenle</a></td>
                    <td><a href="../uye/musteriler.php">Müşteriler</a></td>
                    <td><a href="../uye/arsiv.php">Üye Arşiv</a></td>
                </tr>
            </table>
        </div>
</div>



<!-- ui-dialog -->
    </nav>
<section>
    
    <h1>Üyeler</h1>
    <p>Toplam Üye Sayısı <?=$num_row_rsUye?></p>
    <p> <a href="ekle.php">Üye Ekle</a>
    <a href="musteriler.php">Müşterileri Göster</a>
    <a href="arsiv.php">Arşivi Göster</a>
    <a href="index.php">Tüm Üyeleri Göster</a></p>
    <table id="dinamikListe">
        <tr>
            <th>Seviye</th>
            <th>Kullanıcı Adı</th>
             <th>Eposta</th>
            <th>Kayıt IP</th>
             <th>Aktif</th>
            <th>Kayıt Tarihi </th>
            <th>Düzenle</th>
        </tr>
        <?php do{ ?>
        <tr>
            <td><img src="../../_uploads/resim/uye/seviye/<?= $row_rsUye->SeviyeIcon ;?>" width="30"  /><br><?= $row_rsUye->Seviye; ?></td>
            <td><strong><?= $row_rsUye->KullaniciAdi; ?></strong></td>
              <td><?= $row_rsUye->Eposta; ?></td>
            <td><?= $row_rsUye->KayitIP; ?></td>
              <td>
             <?php if($row_rsUye->Aktif==1): ?>
                  <img src="../../img/aktif-icon.png" width="25" />
                  <?php else:?>
                   <img src="../../img/pasif-icon.png" width="25" />
                   <?php endif;?>
              </td>
            <td><?= date("d/m/Y ", strtotime ($row_rsUye->KayitTarih)); ?></td>
            <td>
                <a href="duzenle.php?UyeID=<?= $row_rsUye->UyeID ;?>">Düzenle</a>
                 <a href="arsivle.php?UyeID=<?= $row_rsUye->UyeID ;?>">Arşivle</a>    
            </td>
        </tr>
        <?php } while($row_rsUye = mysql_fetch_object($rsUye)) ;?>
    </table>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
