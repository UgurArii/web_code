<?php
require_once '_inc/connection.php';

//form gönderildiğinde

if(isset($_POST['uyeGirisSubmit'])){
    
    echo "form gönderildi";
    
    //formdan değeri alınır
    $kullaniciAdi = mysql_real_escape_string($_POST['KullaniciAdi']);
    $eposta= mysql_real_escape_string($_POST['Eposta']);
    $parola = mysql_real_escape_string($_POST['Parola']);
    
    //boşlukların silinmesi
    $kullaniciAdi = trim($kullaniciAdi);
    $eposta = trim($eposta);
    $parola = trim($parola);
    
    //parola şifrelenmesi
    $parola = md5($parola);
    
    if(empty($kullaniciAdi) || empty($eposta) || empty($parola)){
        header("Location:uye-giris.php?Hata=AlanBos");
    }else{
        //query oluşturmak
        $query_UyeGiris = "SELECT * FROM uye_giris WHERE KullaniciAdi='$kullaniciAdi' AND Eposta='$eposta' AND Parola='$parola'";
        $rsUyeGiris = mysql_query($query_UyeGiris);
        
        $row_UyeGiris = mysql_fetch_object($rsUyeGiris);
        $num_row_UyeGiris = mysql_num_rows($rsUyeGiris);
        
        if($num_row_UyeGiris==1){
            
            //giriş başarılı
            
            //session değerleri atanıyor
            $_SESSION['UyeID'] = $row_UyeGiris->UyeID;
            $_SESSION['Eposta'] = $row_UyeGiris->Eposta;
            $_SESSION['KullaniciAdi'] = $row_UyeGiris->KullaniciAdi;
            $_SESSION['SeviyeID'] = $row_UyeGiris->SeviyeID;
            
            //yönlendirme yapılıyor
            header("Location:uye-profil.php");
            exit();
        }elseif ($num_row_UyeGiris==0) {
            //giriş başarısız
            header("Location:uye-giris.php?Hata=GirisBasarisiz");
            
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>E-Ticaret</title>
    <link href="_css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
     <?php require_once 'views/header.php';?>
<div id="wrapper" class="w1180 center mTop20">

    <section class="w1180 mh500 fleft">
        <div id="content" class="mh500 fleft w1180">
            <h1>Üye Girişi</h1>
            <form action="<?= $_SERVER['PHP_SELF'] ;?>" method="post">
                <fieldset>
                    <legend>Üye Giriş Bilgileri</legend>
                    <label for="KullaniciAdi">Kullanıcı Adı</label>
                    <input type="text" name="KullaniciAdi" id="KullaniciAdi" />
                    
                    <label for="Eposta">Eposta</label>
                    <input type="text" name="Eposta" id="Eposta" />
                    
                    <label for="Parola">Parola</label>
                    <input type="password" name="Parola" id="Parola" />
                    
                    <br/>
                    <input type="submit" name="uyeGirisSubmit" value="Giriş Yap" />
                    
                    
                    
                </fieldset>
            
            </form>
        </div>
    </section>
   
</div>

<footer class="w1000 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>
