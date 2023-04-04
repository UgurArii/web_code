<?php
//session başlatılması
session_start();
//sunucu bağlantısı ve veritabanı seçimi
require_once 'includes/connection.php';

//form fonktisonları
require_once 'includes/functions.php';

if(isset($_POST['uyeGirisSubmit']))
{
    //formdan gelen değerle alınır
    $kullaniciAdi = postValues($_POST['KullaniciAdi']);
    $eposta = postValues($_POST['Eposta']);
    $parola = postValues($_POST['Parola']);
    $parola = md5($parola);
    
    //değerler veritabanından kontrol edilir
    $query_UyeVarmi = "SELECT * FROM uye WHERE KullaniciAdi='$kullaniciAdi' AND Eposta='$eposta' AND Parola='$parola'";
   //exit();
   $result = mysql_query($query_UyeVarmi);
   $row_rsUye = mysql_fetch_object($result);
   $row_UyeVarmi = mysql_num_rows($result);
   
   if($row_UyeVarmi==0)
   {
      header("Location:index.php?Hata=GirisBasarisiz");
   }elseif($row_UyeVarmi==1)
   {
      // echo "üye var giriş yapılacak<br>";
      $_SESSION['Uye']['KullaniciAdi'] = $kullaniciAdi;
      $_SESSION['Uye']['Eposta'] = $eposta;
      $_SESSION['Uye']['UyeID'] = $row_rsUye->UyeID;
      $_SESSION['Uye']['SeviyeID'] = $row_rsUye->SeviyeID;
     
      $uyeID = $_SERVER['Uye']['UyeID'];
      
      $girisIP = $_SERVER['REMOTE_ADDR'];
      
      $query_UyeGiris = "INSERT INTO uye_giris(UyeID, GirisIP) VALUES('$uyeID','$girisIP')";
      $sonuc = mysql_query($query_UyeGiris);
      if($sonuc){
      header("Location:yonetim/index.php");
      }
   }
   
    //kontrol başarılı ise session KullaniciAdi,Eposta,UyeID,SeviyeID
    
    //session işlemlerinden sonra ise yönetim index sayfasona geçilir.
    
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Yönetim Sayfasına Hoşgeldinizi</title>
    <link href="includes/css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="girisResim"><img src="includes/img/login.png" alt=""/>
<h1>Stok Yönetim Paneline Hoşgeldiniz</h1>
    <div id="girisBilgi">
                <?php
                if(isset($_GET['Hata']))
                {
                    $hata = getValues($_GET['Hata']);
                    if($hata == 'GirisBasarisiz')
                    {
                        echo "<p><strong>Bilgilerinizi kontrol ediniz.</strong></p>";
                    }elseif($hata=='GirisYap')
                    {
                        echo "<p><strong>Lütfen Giriş Yapınız</strong></p>";
                    }
                }
                ?>
            </div>
</div>
    
     
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
           
            
            <legend>Giriş Bilgileri</legend>
            <label for="KullaniciAdi">Kullanici Adı</label>
            <input type="text" name="KullaniciAdi" id="KullaniciAdi" required/>
            <label for="Eposta">Eposta</label>
            <input type="email" name="Eposta" id="Eposta" required/>
            <label for="Parola">Parola</label>
            <input type="password" name="Parola" id="Parola"/>
            <br>
            <input type="submit" name="uyeGirisSubmit" value="Giriş Yap"/>
        </fieldset>
    </form>
</body>
</html>
