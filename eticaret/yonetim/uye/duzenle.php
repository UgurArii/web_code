<?php 
require_once '../../_inc/connection.php';

//adres çubuğundan gelen üye id bilgisi alınır
$uyeID = mysql_real_escape_string($_GET['UyeID']);

//seviye kayıt setinin oluşturulması
$query_rsUyeSeviye = "SELECT * FROM uye_seviye";
$rsUyeSeviye = mysql_query($query_rsUyeSeviye);
$row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye);

//üye bilgilerini alınacak
$query_rsUye = "SELECT * FROM uye_giris WHERE UyeID = '$uyeID'";
$rsUye = mysql_query($query_rsUye);
$row_rsUye = mysql_fetch_object($rsUye);

//rs->result ve sorgu(set)-recordset
//query->veritabanı sorgusu
//fetch->gidip almak

if(isset($_POST['uyeDuzenleSubmit'])){
    echo "forma gönderildi";
    
    //1.adım formdan gelen değerlerin alınması
    $seviyeID = mysql_real_escape_string($_POST['SeviyeID']);
    $kullaniciAdi = mysql_real_escape_string($_POST['KullaniciAdi']);
    $eposta = mysql_real_escape_string($_POST['Eposta']);
    $parola = mysql_real_escape_string($_POST['Parola']);
    $parolaTekrar = mysql_real_escape_string($_POST['ParolaTekrar']);
    print_r($_POST);
    
    //aktiflik değerlerinin alınması
    
    if(isset($_POST['Aktif']))
        $aktif = 1;
    else 
        $aktif = 0;
    
    //form girişlerinin boş olmaması 
    if(!empty($kullaniciAdi) && !empty($eposta)){
        
        //işlemlere devam et
        //eğer yeni parole gelmediyse
        if(empty($parola)){
            
            $parola = $row_rsUye->Parola;
        }else{
            if($parola==$parolaTekrar){
                //parolalar aynıysa
                $parola = md5($parola);
            }else{
                header("Location:duzenle.php?Hata=ParolaTekrar&UyeID=$uyeID");
                exit();
            }
            
           
            }
             //veritabanında verilerin güncellenmesi
            
            $query_UyeDuzenle ="UPDATE uye_giris SET SeviyeID='$seviyeID', KullaniciAdi = '$kullaniciAdi', Eposta = '$eposta', Aktif='$aktif', Parola='$parola' WHERE UyeID = '$uyeID'";

            $sonuc = mysql_query($query_UyeDuzenle);
            if($sonuc){
                header("Location:index.php");
            }
    }else{
        //sayfayı geri dönder
         header("Location:duzenle.php?Hata=AlanBos&UyeID=$uyeID");
    }
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
    <h1>Üye Girişi Düzenle</h1>
        
    <?php if(isset($_GET['Hata']) && $_GET['Hata']=='AlanBos') : ?>
    <div class="formHataAlanBos">
        <p>Lütfen Tüm Alanları Doldurunuz</p>
    </div>
    <?php elseif (isset($_GET['Hata']) && $_GET['Hata']=='ParolaTekrar') :?>
    <div class="formHataAlanBos">
        <p>Lütfen Parolanın aynı olmasına dikkat ediniz.</p>
    </div>
    <?php endif ;?>
    <form action="duzenle.php?UyeID=<?= $uyeID;?>" method="post">
       
        <fieldset>
            <legend>Seviye Bilgileri</legend>
            <label for="SeviyeID">SeviyeID</label>
            <select name="SeviyeID" id="SeviyeID">
                <?php do{ ?>
                <option value="<?= $row_rsUyeSeviye->SeviyeID;?>"<?php if($row_rsUye->SeviyeID==$row_rsUyeSeviye->SeviyeID) echo "selected=selected";?>> <?= $row_rsUyeSeviye->Seviye;?></option>
                <?php }while($row_rsUyeSeviye=  mysql_fetch_object($rsUyeSeviye)) ;?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Giriş Bilgileri</legend>
            <label for="KullaniciAdi">Kaullanıcı Adı</label>
            <input type="text" name="KullaniciAdi" id="KullaniciAdi" value="<?= $row_rsUye->KullaniciAdi;?>"/>
            
            <label for="Eposta">Eposta</label>
            <input type="text" name="Eposta" id="Eposta" value="<?= $row_rsUye->Eposta;?>"/>
            
            <label for="Aktif">Aktif</label>
            <input type="checkbox" name="Aktif" id="Aktif" value="<?php if($row_rsUye->Aktif==1) echo "checked";?>"/>
        </fieldset>
        
        <fieldset>
            <legend>Parola</legend>
            <label for="Parola">Parola</label>
            <input type="text" name="Parola" id="Parola" />
            
            <label for="ParolaTekrar">Parola Tekrar</label>
            <input type="text" name="ParolaTekrar" id="ParolaTekrar" />
             <input type="submit" name="uyeDuzenleSubmit" value="Değişikleri Kaydet" />
        </fieldset>
       
       
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
