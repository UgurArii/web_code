<?php 
require_once '../../_inc/connection.php';

//form gönderildiğinde

if(isset($_POST['uyeSeviyeEkleSubmit'])){
    $seviye = mysql_real_escape_string($_POST['Seviye']);
    $seviyeIcon = mysql_real_escape_string($_FILES['SeviyeIcon']['name']);
    
    
    if(!empty($seviye)){
        //seviye boş değilse işlemlere devam et
        $query_UyeSeviyeEkle = "INSERT INTO uye_seviye (Seviye, SeviyeIcon) VALUES ('$seviye','$seviyeIcon')";
        $sonuc = mysql_query($query_UyeSeviyeEkle);
        
        if($sonuc){
            if(!empty($seviyeIcon)){
                //resim yüklemesi yapılsın
                $filename = $_FILES['SeviyeIcon']['tmp_name'];
                $destination = "../../_uploads/resim/uye/seviye/$seviyeIcon";
                
                move_uploaded_file($filename, $destination);
            }
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
    <title>Üye Seviye Ekle</title>
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
    <h1>Üye Seviye Ekle</h1>
   
        <?php 
        if(isset($_GET['Hata'])) {
            echo " <div class='formHataAlanBos'>";
            echo "<p>Lütfen Seviye Adını Giriniz</p>";
            echo "</div>";

        }
        ?>
        
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Üye Seviye Bilgileri</legend>
            <label for="Seviye">Seviye</label>
            <input type="text" name="Seviye" id="Seviye"/>
            
            <label for="SeviyeIcon">Seviye İkon</label>
            <input type="file" name="SeviyeIcon" id="SeviyeIcon"/>
            
            <input type="submit" name="uyeSeviyeEkleSubmit" value="Üye Seviye Ekle"/>
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
