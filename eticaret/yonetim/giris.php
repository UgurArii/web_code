<?php 
session_start();

//mysql sunucu bağlantısı
require_once '../_inc/connection.php';
require_once '_inc/functions.php';
if(isset($_POST['yonetimGirisSubmit'])){
    //formdan gelen değerlerin alınması
    $kullaniciAdi = formDegerAl($_POST['KullaniciAdi']);
   $eposta = formDegerAl($_POST['Eposta']);
   $parola = md5(formDegerAl($_POST['Parola']));
   
   //değerlerin veritabanı kontrolü
   $query_YonetimUyeGirs = "SELECT * FROM uye_giris WHERE KullaniciAdi='$kullaniciAdi' AND Eposta='$eposta' AND Parola='$parola'";
   
   $rsYonetimUyeGiris = mysql_query($query_YonetimUyeGiris);
   $row_rsYonetimUyeGiris  =  mysql_fetch_object($rsYonetimUyeGiris);
   $num_row_rsYonetimUyeGiris = mysql_num_rows($rsYonetimUyeGiris);
   
   //giriş başarısızsa
   if($num_row_rsYonetimUyeGiris==1){
       header("Location:giris.php?Hata=GirisBasarisiz");
   }else{
       $_SESSION['UyeID'] = $row_rsYonetimUyeGiris->UyeID;
       $_SESSION['Eposta'] = $row_rsYonetimUyeGiris->Eposta;
       $_SESSION['KullaniciAdi'] = $row_rsYonetimUyeGiris->KullaniciAdi; 
       $_SESSION['SeviyeID'] = $row_rsYonetimUyeGiris->SeviyeID;
       // giriş başarılı ama yetkisiz
       if($row_rsYonetimUyeGiris->SeviyeID>3){
             header("Location:../uye-profil.php");
       }
       else{
           header("Location:index.php");
       }
       
   }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Yönetim Girişi</title>
    <link href="_css/tema/panel/layout.css" type="text/css" rel="stylesheet"/>
    <link href="_css/tema/panel/giris.css" type="text/css" rel="stylesheet"/>
</head>
<body>
    <?php
    // put your code here
    ?>
<div id="yonetimGiris">
    <h1>Üye Giriş</h1>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
    <fieldset>
        <legend>Giriş Bilgileri</legend>
        <label for="KullaniciAdi">Kullanıcı Adı</label>
        <input type="text" name="KullaniciAdi" id="KullaniciAdi"/>
        
        <label for="Eposta">Eposta</label>
        <input type="text" name="Eposta" id="Eposta"/>
        
        <label for="Parola">Parola</label>
        <input type="password" name="Parola" id="Parola"/>
        <br />
        <input type="submit" name="yonetimGirisSubmit" value="Giriş Yap"/>       
    </fieldset>
    </form>
    
</div>
</body>
</html>
