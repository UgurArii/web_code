<?php
require_once '_inc/connection.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';
if(!isset($_SESSION['UyeID'])){
    //üye giriş yapılmadığında
    header("Location:uye-giris.php");
    
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
            <h1>Üye Profil</h1>
            <?php if(isset($_SESSION['UyeID'])) :?>
            
            
            <?php if($uyeAktif ==0) :?>
            <h3>Aktivasyon Yap</h3>
            <p>Aktivasyon işemini linke tıklayarak yapabilirsiniz.</p>
            <?php echo "<a href='http://localhost:8080/eticaret/uye-aktivasyon.php?Aktivasyon=$aktivasyon&UyeID=$uyeID&KullaniciAdi=$kullaniciAdi&Eposta=$eposta'>"
                                    . "Aktivasyon Yap</a>";?>
            <?php endif;?>
            <ul>
                <li>Üye ID: <?= $_SESSION['UyeID']; ?></li>
                <li>KUllanıcı Adı: <?= $_SESSION['KullaniciAdi'];?></li>
                <li>Eposta: <?= $_SESSION['Eposta'];?></li>
                <li><a href="uye-cikis.php">Çıkış</a></li>
            </ul>
            <?php endif ; ?>
          
             </div>
           </section>
   
</div>

<footer class="w1000 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>
