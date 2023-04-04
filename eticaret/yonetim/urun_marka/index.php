<?php 
require_once '../../_inc/connection.php';

if(isset($_GET['HarfID'])){
    
//harfId alınması
$harfID = mysql_real_escape_string($_GET['HarfID']);

//markakayıt setinin oluşturulması
$query_rsUrunMarka = "SELECT * FROM urun_marka WHERE HarfID = '$harfID'";
$rsUrunMarka = mysql_query($query_rsUrunMarka);
$row_rsUrunMarka = mysql_fetch_object($rsUrunMarka);
$num_row_rsUrunMarka = mysql_num_rows($rsUrunMarka);
}
//marka harf kayıt setinin oluşturulması
$query_rsUrunMarkaHarf = "SELECT * FROM urun_harf ORDER BY HarfID ASC";
$rsUrunMarkaHarf = mysql_query($query_rsUrunMarkaHarf);
$row_rsUrunMarkaHarf = mysql_fetch_object($rsUrunMarkaHarf);
 $num_row_rsUrunMarkaHarf = mysql_num_rows($rsUrunMarkaHarf);
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


$( "#tabs" ).tabs();




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
	<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>



<!-- ui-dialog -->
    </nav>
<section>
    <h1>Ürün Markaları</h1>
    
    <div id="urunMarkaHarf">
        <?php do{  ?>
        <a href="index.php?HarfID=<?= $row_rsUrunMarkaHarf->HarfID;?>"><?= $row_rsUrunMarkaHarf->Harf; ?></a>
        <?php  } while($row_rsUrunMarkaHarf = mysql_fetch_object($rsUrunMarkaHarf));?>
    </div>
    <?php if(isset($_GET['Islem'])) :?>
    <?php if($_GET['Islem']=='MarkaEkle') :?>
    <p>Marka Başarıyla Eklendi</p>
    <?php endif;?>
    
    <?php endif;?>
    <?php echo "<p>Ürün Marka Sayısı : $num_row_rsUrunMarka</p>" ?>
    <p><a href="ekle.php">Marka Ekle</a></p>
    <table id="dinamikListe">
        <tr>
            <th>Logo</th>
            <th>Marka</th>
            <th>Listeleme</th>
            <th>Düzenle</th>
        </tr>
        <?php do{ ?>
        <tr>
            <td width="100"><img src="../../_uploads/resim/urun-marka/<?= $row_rsUrunMarka->MarkaLogo?>" width="100"/></td>
            <td><strong><?= $row_rsUrunMarka->Marka;?></strong></td>
            <td>
                <?php if($row_rsUrunMarka->Listeleme==1):?>
                <img src="../../_img/icon/aktif-icon.png" height="25"/>
                <?php else:?>
                <img src="../../_img/icon/pasif-icon.png" height="25"/>
                <?php endif;?>
            </td>
            <td><a href="duzenle.php?MarkaID=<?= $row_rsUrunMarka->MarkaID;?>">Düzenle</a>
              <a href="sil.php?MarkaID=<?= $row_rsUrunMarka->MarkaID;?>">Sil</a>
            </td>
             </tr>
        <?php } while($row_rsUrunMarka = mysql_fetch_object($rsUrunMarka));?>
        
    </table>
    
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
