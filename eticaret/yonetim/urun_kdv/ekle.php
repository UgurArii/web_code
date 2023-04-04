<?php
//mysql sunucusuna bağlanma
require_once '../../_inc/connection.php';

//form gönderildiğinde
if(isset($_POST['kdvEkleSubmit'])){
    //kdv ekle forma gönderildiğinde
    //echo "form gönderildi";
    
    //forma gelen değerlerin alınması
    $kdvTip = mysql_real_escape_string($_POST['KdvTip']);
    $kdv = mysql_real_escape_string($_POST['Kdv']);
    // değerlerinin forma yazdırılması
    if(!empty($kdvTip) && !empty($kdv)){
        $query_KdvEkle = "INSERT INTO urun_kdv (KDVTip, Kdv) VALUES('$kdvTip','$kdv')";
        $sonuc = mysql_query($query_KdvEkle);
      
        
    //kdv index sayfasına gönderilmesi
          if($sonuc){
        header("Location:index.php");
    
    
    }
     
    }else{
        header("Location:ekle.php?Hata=AlanBos");
    
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>KDV Tipi Ekle </title>
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
 <h1>
        KDV Ekle
    </h1>
<div>
    <?php if(isset($_GET['Hata'])) :?>
    <p> Lütfen Kdv Tipi ve Kdv Değerini boş bırakmayınız.</p>
        <?php endif;?>
</div>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
            <legend>KDV Bilgileri</legend>
            
            <label for="KdvTip">KDV Tipi</label>
            <input type="text" name="KdvTip" id="KdvTip" />
            
            <label for="Kdv">KDV Değeri</label>
            <input type="text" name="Kdv" id="Kdv" />
            
            <br />
            <input type="submit" name="kdvEkleSubmit" value="KDV Ekle" />
            
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
