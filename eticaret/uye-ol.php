<?php

require_once '_inc/connection.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';

//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

//ürün kayıt setinin oluşturulması
$query_Urun = "SELECT * FROM urun WHERE UrunArsiv != 1 AND UrunAktif=1 ORDER BY UrunID DESC LIMIT 5";
$rsUrun = mysql_query($query_Urun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);

//header search kategori kayıt setinin oluşturulması
$query_rsHeaderAramaKategori = "SELECT * FROM urun_kategori WHERE ParentID=0";
$rsHeaderAramaKategori = mysql_query($query_rsHeaderAramaKategori);
$row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori);



//üyelik başvurusu form gönderildiğinde

if(isset($_POST['uyeOlSubmit'])){
    
    //form alanlarının değerlerinin alınması
    
    $kullaniciAdi = mysql_real_escape_string($_POST['KullaniciAdi']);
    $eposta = mysql_real_escape_string($_POST['Eposta']);
    $parola = mysql_real_escape_string($_POST['Parola']);
    $parolaTekrar = mysql_real_escape_string($_POST['ParolaTekrar']);
    $kayitIP = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
    
    $kullaniciAdi = trim($kullaniciAdi);
     $eposta = trim($eposta);
  $parola = trim($parola);
    $parolaTekrar = trim($parolaTekrar);
            
            //alanlar boş mu değil mi
            
            if(empty($kullaniciAdi) || empty($eposta) || empty($parola)  || ($kullaniciAdi=='6 ile 20 karakter arası kullanıcı adı giriniz')){
                header("Location:uye-ol.php?Hata=AlanBos&Eposta=$eposta&KullaniciAdi=$kullaniciAdi&Parola=$parola");
            }else{
                //alanların uzunlukları
                if(strlen($kullaniciAdi) < 6 || strlen($kullaniciAdi)>20){
                    
                    //kullanıcı şartı sağlarsa
                    header("Location:uye-ol.php?Hata=KullaniciAdi&Eposta=$eposta&KullaniciAdi=$kullaniciAdi");
                }else if(strlen ($parola)<4 || strlen ($parola) >20){
                       header("Location:uye-ol.php?Hata=Parola&Eposta=$eposta&KullaniciAdi=$kullaniciAdi");
                }else{
                    //herşey yolunda üyelik oluştur
                    
                    //parolalar eşitmi
                    if($parola!=$parolaTekrar){
                          header("Location:uye-ol.php?Hata=ParolaTekrar&Eposta=$eposta&KullaniciAdi=$kullaniciAdi");
                    }else{
                        
                        $aktivasyon = md5(rand());
                        //parolayı şifrele
                        $parola = md5($parola);
                       //query oluşturulması
                        $query_UyeOl ="INSERT INTO uye_giris (KullaniciAdi, Eposta, Parola, KayitIP,Aktivasyon) VALUES ('$kullaniciAdi','$eposta','$parola','$kayitIP','$aktivasyon')";
                       
                       
                        $sonuc = mysql_query($query_UyeOl);
                        
                        if($sonuc){
                            //aktivasyon işlemleri
                            $aktivasyonUyeID = mysql_insert_id();
                            
                          //  ini_set("smtp_port", "587");
                            
                            //aktivasyon maili gönderme
                            $to = $eposta;
                            $from = "ariii.ugur@gmail.com";
                            $subject = "Üyeliğinizi Aktifleştirin";
                            $body="Aktifleştirmek için aşağıdaki linke tıklayınız.";
                            $body .= "<a href='http://localhost:8080/eticaret/uye-aktivasyon.php?Aktivasyon=$aktivasyon&UyeID=$aktivasyonUyeID&KullaniciAdi=$kullaniciAdi&Eposta=$eposta'>"
                                    . "Aktivasyon için tıklayınız</a>";
                            
                            $header = "FROM:$from\n";
                            $header .= "Content-type:text/html;UTF-8\r\n";
                            
                            $mailDurum = mail($body, $subject, $body,$header);
                            //Session değerlerinin oluşması
                            $_SESSION['KullaniciAdi'] = $kullaniciAdi;
                             $_SESSION['Eposta'] = $eposta;
                            $_SESSION['UyeID'] = mysql_insert_id();
                            //üye sayfasına yönlendirme
                            header("Location:uye-profil.php?Islem=KayitBasarili");
                            exit();
                        }
                       
                    }
                       
                }//alan uzunlukları kontrol sonu
                
            }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>E-Ticaret</title>
    <link href="_css/style.css" rel="stylesheet" type="text/css"/>
    <link href="_inc/js/spry/SpryValidationTextField.css" rel="stylesheet" type="text/css"/>
    <link href="_inc/js/spry/SpryValidationPassword.css" rel="stylesheet" type="text/css"/>    
    <link href="_inc/js/spry/SpryValidationConfirm.css" rel="stylesheet" type="text/css"/>
    <script src="_inc/js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="_inc/js/spry/SpryValidationConfirm.js" type="text/javascript"></script>
    <script src="_inc/js/spry/SpryValidationTextField.js" type="text/javascript"></script>
    <script src="_inc/js/spry/SpryValidationPassword.js" type="text/javascript"></script>
</head>
<body>
    <?php require_once 'views/header.php';?>
<div id="wrapper" class="w1180 center mTop20">

    <section class="w1180 mh500 fleft">
        <div id="content" class="mh500 fleft w1180">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <div id="uyelikBilgileriBaslik">Üyelik Bilgileri</div>
            <img src="img/buton/submitButon.jpg" alt=""/>
            <form id="uyeOlForm" action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                <fieldset>
                    <legend>Üye Giriş Bilgileri</legend>
                    
                    <label for="KullaniciAdi">Kullanıcı Adı</label>
                    <span id="spanKullaniciAdi">
                    <input type="text" name="KullaniciAdi" id="KullaniciAdi" class="kullaniciTamamla"
                           placeholder="6-20 karakter "/>
                    <span class="textfieldRequiredMsg">Kullanıcı Adını Yazınız</span>
                    <span class="textfieldMinCharsMsg">En az 6 karakter olmalı</span>
                    <span class="textfieldMaxCharsMsg">En çok 20 karakter olmalı</span>
                    </span>
                    <span class="varolanKullanici">
                        
                    </span>
                    <div class="dropdown">
                        <ul class="sonuc">
                            
                        </ul>
                    </div>
                    <label for="Eposta">Eposta</label>
                    <span id="Eposta">
                    <input type="email" name="Eposta" id="Eposta" class="epostaTamamla" placeholder="Eposta Giriniz"/>
                    <span class="textfieldRequiredMsg">Eposta Adresi Gereklidir</span>
                    <span class="textfieldInvalidFormatMsg">Lütfen geçerli bir eposta giriniz</span>
                    </span>
                        </span>
                    <span class="varolanEposta">
                        
                    </span>
                    <div class="dropdownEposta">
                        <ul class="sonucEposta">
                            
                        </ul>
                        </div>
                </fieldset>
                
                <fieldset>
                    <legend>Üye Giriş Parola</legend>
                   
                     
                        <label for="Parola">Parola</label>
                        <span id="spanParola">
                        <input type="password" name="Parola" id="Parola"
                               placeholder="6 - 20 arası karakter giriniz"/>
                        <span class="passwordRequiredMsg">3 harf 3 sayıda oluşan parola giriniz.</span>
                        <span class="passwordMaxCharsMsg">En az 6 karakterli parola giriniz.</span>
                        <span class="passwordMaxCharsMsg">En çok 20 karakterli parola giriniz.</span>
                        <span class="passwordInvalidStrengthMsg">3 harf 3 sayı gereklidir.</span>
                        </span>
                        <label for="ParolaTekrar">Parola Tekrar</label>
                        <span id="spanParolaTekrar">
                        <input type="password" name="ParolaTekrar" id="ParolaTekrar" placeholder="Parolanızı Tekrar Giriniz."/>
                        </span>
                        <span class="confirmRequiredMsg">Lütfen Parolanınızı Tekrar Giriniz</span>
                        <span class="confirmInvalidMsg">Parolanız Uyuşmuyor</span>
                       
                  
                </fieldset>
                 <input type="submit" name="uyeOlSubmit" value="Üye Ol"/>
            </form>
        </div>
        
    </section>
</div>

<?php require_once 'views/footer.php';?>
        <script src="_inc/js/tamamlaKullanici.js" type="text/javascript"></script>
        <script src="_inc/js/tamamlaEposta.js" type="text/javascript"></script>
<script type="text/javascript">
    var spryKullaniciAdi = new Spry.Widget.ValidationTextField("spanKullaniciAdi",'none', {validateOn:['blur'],minChars:6,maxChars:20});
    var spryParola = new Spry.Widget.ValidationPassword("spanParola",{validateOn:['blur'],minChars:6,maxChars:20,minAlphaChars:3,minNumbers:3});
    var spryParolaTekrar = new Spry.Widget.ValidationConfirm("spanParolaTekrar","spanParola",{validate:On["blur"]});
     var spryEposta = new Spry.Widget.ValidationTextField("spanEposta",'email', {validateOn:['blur'],minChars:4,maxChars:20});
</script>
</body>
</html>


