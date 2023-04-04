<?php
session_start();

if(!isset($_SESSION['UyeID'])){
    //üye giriş yapılmadığında
    header("Location:giris.php");
    
}  elseif ($_SESSION['SeviyeID']>3) {
     header("Location:../uye-giris.php?Hata=YetkisizGiris");
}
require_once '../_inc/connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title> </title>
    <link  href="_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <script src="_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
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
          <img src="../_uploads/resim/uye/seviye/_kullanici.png" alt=""/><?= $_SESSION['KullaniciAdi'] ;?>           
          <img src="../_uploads/resim/uye/seviye/logout.png" alt=""/><a href="uye-cikis.php">Çıkış</a>
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
                    <td><img src="../img/layout/_ekle.png" /><a href="urun/ekle.php">Ekle</a></td> 
                    <td><img src="../img/layout/_duzenle.png" /><a href="urun/index.php">Düzenle</td>
                    <td>&nbsp;</td>
                    <td><img src="../img/layout/_ekle.png" /><a href="urun_gosterim_turu/ekle.php">Ekle</td> 
                    <td><img src="../img/layout/_duzenle.png" /><a href="urun_gosterim_turu/index.php">Düzenle</td>
                    
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
                    <td><img src="../img/layout/_ekle.png" /><a href="urun_kategori/ekle.php">Ekle</td> 
                    <td><img src="../img/layout/_duzenle.png" /><a href="urun_kategori/index.php">Düzenle</td>
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
                        <td><img src="../img/layout/_ekle.png" /><a href="urun_kdv/ekle.php">Ekle</td>
                        <td><img src="../img/layout/_duzenle.png" /><a href="urun_kdv/index.php">Düzenle</td>
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
     <?php
    // put your code here
    ?>
  <h1>E-Ticaret Yönetimine Hoşgeldiniz</h1>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>

