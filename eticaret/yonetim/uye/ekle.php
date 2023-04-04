<?php 
require_once '../../_inc/connection.php';

//seviye kayıt setinin oluşturulması
$query_rsUyeSeviye = "SELECT * FROM uye_seviye";
$rsUyeSeviye = mysql_query($query_rsUyeSeviye);
$row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye);

//form gönderildi

if(isset($_POST['uyeEkleSubmit'])){
    //form verilerinin alınması
    $seviyeID = mysql_real_escape_string($_POST['SeviyeID']);
    $kullaniciAdi = mysql_real_escape_string($_POST['KullaniciAdi']);
    $eposta = mysql_real_escape_string($_POST['Eposta']);
    $parola = mysql_real_escape_string($_POST['Parola']);
    $parolaTekrar = mysql_real_escape_string($_POST['ParolaTekrar']);
    
    if(isset($_POST['Aktif']))
        $aktif = 1;
    else 
        $aktif =0;
    
    $kayitIP = $_SERVER['REMOTE_ADDR'];
    
    //formda boş alan kontrolü
    if(!empty($kullaniciAdi) && !empty($eposta) && !empty($parola)){
        
        //parola farklı ise
        if($parola!=$parolaTekrar){
            header("Location:ekle.php?Hata=ParolaTekrar&KullaniciAdi=$kullaniciAdi&Eposta=$eposta");
            
        }
        else{
            //üye ekleme işi devam
            
            $parola = md5($parola);
            $query_uyeEkle = "INSERT INTO uye_giris (SeviyeID, KullaniciAdi, Eposta, Parola, Aktif, KayitIP)"
                    . "VALUES ('$seviyeID', '$kullaniciAdi', '$eposta', '$parola', '$aktif', '$kayitIP')";
            
            $sonuc = mysql_query($query_uyeEkle);
            
            if($sonuc){
                header("Location:index.php");
            }
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
    <title>Üye Ekle</title>
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
            
        </div><!-- üyelik sonu-->
</div>



<!-- ui-dialog -->
    </nav>
<section>
    <h1>Üye Ekle</h1>
    
    <?php if(isset($_GET['Hata']) && $_GET['Hata']=='AlanBos') : ?>
    <div class="formHataAlanBos">
        <p>Lütfen Tüm Alanları Doldurunuz</p>
    </div>
    <?php elseif (isset($_GET['Hata']) && $_GET['Hata']=='ParolaTekrar') :?>
    <div class="formHataAlanBos">
        <p>Lütfen Parolanın aynı olmasına dikkat ediniz.</p>
    </div>
    <?php endif ;?>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
            <legend>Üye Seviye Bilgileri</legend>
            <label for="SeviyeID">Üyenin Seviyesi</label>
            <select name="SeviyeID" id="SeviyeID">
                <?php do{?>
                <option value="<?= $row_rsUyeSeviye->SeviyeID;?>" <?php if($row_rsUyeSeviye->SeviyeID==1) echo "selected=selected";?>><?= $row_rsUyeSeviye->Seviye;?></option>              
                <?php } while($row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye)) ;?>
            </select>
        </fieldset>
        
        <fieldset>
            <legend>Giriş Bilgileri</legend>
            <label for="KullaniciAdi">Kullanıcı Adı</label>
            <input type="text" name="KullaniciAdi" id="KullaniciAdi"
                   <?php if(isset($_GET['KullaniciAdi'])){
                       echo "value=".$_GET['KullaniciAdi'];
                   }?>
                   />
            
            <label for="Eposta">E-Posta</label>
            <input type="text" name="Eposta" id="Eposta"
                     <?php if(isset($_GET['Eposta'])){
                       echo "value=".$_GET['Eposta'];
                   }?>
                   />
            
             <label for="Aktif">Aktif</label>
            <input type="checkbox" name="Aktif" id="Aktif"/>
        </fieldset>
        
          <fieldset>
            <legend>Parola</legend>
            <label for="Parola">Parola</label>
            <input type="text" name="Parola" id="Parola"/>
            
           <label for="ParolaTekrar">Parola Tekrar</label>
            <input type="text" name="ParolaTekrar" id="ParolaTekrar"/>
        </fieldset>
        <input type="submit" name="uyeEkleSubmit" value="Üye Ekle"/>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
