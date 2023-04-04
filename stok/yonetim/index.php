<?php
//session başlatılması
session_start();
//sunucu bağlantısı ve veritabanı seçimi
require_once '../includes/connection.php';

//form fonktisonları
require_once '../includes/functions.php';

if(!GirisVarmi()){
    header("Location:../index.php?Hata=GirisYap");
}

$uyeID = $_SESSION['Uye']['UyeID'];
$modulID = 1;
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
$uyeSeviyeID = $_SESSION['Uye']['SeviyeID'];
$query_rsModul = "SELECT * FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Yönetim Paneline Hoşgeldiniz</title>
    <style>
        ul#modulListe{
            margin: 0;
            padding: 0;
        }
        #modulListe li{
            width: 105px;
            height: 115px;
            padding: 10px;
            margin: 10px;
            list-style: none;
            float:left;
            border: 1px solid #769dc5;
            border-radius: 5px;
            text-align: center;
        }
        #modulListe li a:link, #modulListe li a:visited{
            text-decoration: none;
            color: #f00;
        }
        #modulListe li a:hover{text-decoration: underline;}
        .clearBoth{
            clear:both;
        }
    </style>
</head>
<body>
    <h1>Yönetim Paneline Hoşgeldiniz</h1>
<?php
/* echo "<pre>";
  print_r($_SESSION);
  echo "</pre>"; */
if (isset($_GET['Hata'])) {
    if ($_GET['Hata'] == 'YetkisizGiris') {
        echo "<p><strong>Bu alanda çalışma yetkiniz yok</strong></p>";
    }
    
    if ($_GET['Hata'] == 'PasifModul') {
        echo "<p><strong>Bu modül aktif değildir.</strong></p>";
    } 
}
echo "<p>Hoşgeldiniz Sayın <strong>" . $_SESSION['Uye']['KullaniciAdi'] . "</strong></p>";
?>
    <h1>Mödüller</h1> 
    <?php 
    if($num_row_rsModul>0):?>
    <?php 
    echo "<p>Toplam Modül Sayısı<strong>$num_row_rsModul</strong></p>"
    ?>

    <ul id="modulListe">
        <?php do{?>
        <li><a href="<?= $row_rsModul->ModulDizin;?>/"><img src="../uploads/modul/<?= $row_rsModul->ModulResim;?>" width="100"/>
        <?= $row_rsModul->ModulAdi;?>
                
                </a></li>
        <?php }while($row_rsModul=  mysql_fetch_object($rsModul));?>
    </ul>
    <?php else:?>
    <p>Yetkili olduğunuz herhengi bir modül bulunmaktadır.</p>
    <?php endif;?>
    <p class="clearBoth"><a href="../cikis.php">Çıkış Yap</a></p>
</body>
</html>
