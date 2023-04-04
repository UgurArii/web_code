<?php
require_once '../../_inc/connection.php';

//parent ID alınması
$parentIDDegeri = mysql_real_escape_string($_GET['ParentID']);
$query_rsKategori="
        SELECT * FROM urun_kategori WHERE ParentID = '$parentIDDegeri'
        ";
        $rsKategori = mysql_query($query_rsKategori);
        $row_rsKategori = mysql_fetch_object($rsKategori);
        $num_row_rsKategori = mysql_num_rows($rsKategori);
        
        //parent bul fonksiyonu
        
        function parent_bul($parentID){
            //kategori tablosunda değer almak
            
            $query = "SELECT Kategori FROM urun_kategori WHERE KategoriID='$parentID'";
            $rsParent = mysql_query($query);
            $row_rsParent = mysql_fetch_object($rsParent);
            
            return $row_rsParent->Kategori;
            
        }
        
             function altkategori_bul($parentID){
            //kategori tablosunda değer almak
            
            $query = "SELECT Kategori FROM urun_kategori WHERE ParentID='$parentID'";
            $rsParent = mysql_query($query);
            $row_rsParent = mysql_fetch_object($rsParent);
            $num_row_rsParent = mysql_num_rows($rsParent);
            
            return $num_row_rsParent;
            
        }
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
  <h1>Kategoriler</h1>
    <a href="ekle.php">Kategori Ekle</a>
    <?php
    $parentAdi = parent_bul($row_rsKategori->ParentID);
    echo "<p> Bulunduğunuz Kategori : $parentAdi</p>";
   echo "<p>Toplam kategori sayısı : <strong>$num_row_rsKategori</strong></p>";
    ?>
    <table>
        <tr>
            <th>Kategori Resim</th>
            <th>Kategori Adı</th>
            <th>Alt Kategori Sayısı</th>
            <th>Alt Kategori</th>
            <th>Düzenle</th>
        </tr>
        <?php do{?>
        <tr>
            <td><img src="../../_uploads/resim/urun-kategori/<?= $row_rsKategori->KategoriResim;?>" height="30"/></td>
            <td>
                <?php
                  $altkategorSayisi = altkategori_bul($row_rsKategori->KategoriID);
                  
               
                  
                  if($altkategorSayisi !=0) : ?>
                  <a href="index-altkategori.php?ParentID=<?= $row_rsKategori->KategoriID;?>"><?= $row_rsKategori->Kategori;?></a></td>
                  <?php else: ?>
            <?= $row_rsKategori->Kategori;?>
            <?php endif ; ?>
            
            <td><?= $altkategorSayisi;?></td>

            <td><a href="ekle.php?KategoriID=<?= $row_rsKategori->KategoriID;?>"> <img src ="../../_img/icon/aktif-icon.png" width="25" /></a>  </td>
             <td>
          
                 <a href="duzenle.php?KategoriID=<?= $row_rsKategori->KategoriID;?>"> Düzenle</a>  
                  <a href="sil.php?KategoriID=<?= $row_rsKategori->KategoriID;?>"> Sil</a>  
        </tr>
        <?php }while($row_rsKategori = mysql_fetch_object($rsKategori)); ?>
    </table>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
