<?php
//session başlatılması
session_start();

//sunucu bağlantısı ve veritabanı seçimi
require_once '../../includes/connection.php';

//form fonktisonları
require_once '../../includes/functions.php';

if(!GirisVarmi()){
    header("Location:../index.php?Hata=GirisYap");
}


$uyeID = $_SESSION['Uye']['UyeID'];
$modulID = 17;
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//Üye tablosunun verilerinin alınması
$query_rsUye = "SELECT UyeID, KullaniciAdi FROM uye ORDER BY KullaniciAdi ASC";
$rsUye = mysql_query($query_rsUye);
$row_rsUye = mysql_fetch_object($rsUye);

//modül kayıt seti
$query_rsModul = "SELECT ModulID, ModulAdi FROM modul ORDER BY ModulAdi ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);

if(isset($_POST['uyeModulYetkiEkleSubmit']))
{
    $uyeID = postValues($_POST['UyeID']);
    foreach ($_POST['Modul'] as $key=>$value)
    {
        $query = "INSERT INTO modul_uye(ModulID, UyeID) VALUES('$value','$uyeID')";
        $result = mysql_query($query);
        if($result){
            header("Location:index.php?UyeID=$uyeID");
        }
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Modül Üye İlişkisi</title>
    <style>
        label{
            display: block;
            color: #769dc5;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Üye Modül Yetkilendirmesi</h1>
    <?php
    // put your code here
    ?>
    
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
            <legend>Üye Seçimi</legend>
            <label for="UyeID">Üye</label>
            <select name="UyeID" id="UyeID">
                <?php do{?>
                <option value="<?= $row_rsUye->UyeID;?>" <?php if(isset($_GET['UyeID'])&&($_GET['UyeID']==$row_rsUye->UyeID)){echo " selected";}?>><?= $row_rsUye->KullaniciAdi;?></option>
                <?php }while($row_rsUye = mysql_fetch_object($rsUye));?>
            </select>
        </fieldset>
        <fieldset>
            <legend>Modül Yetki Seçimi</legend>
            <?php do{?>
            <input type="checkbox" name="ModulID" value="<?= $row_rsModul->ModulID;?>"/><?= $row_rsModul->ModulAdi;?><br>
            <?php }while($row_rsModul=  mysql_fetch_object($rsModul));?>
            <br>
            <input type="submit" name="uyeModulYetkiEkleSubmit" value="Yetkilendir"/>
        </fieldset>
    </form>
</body>
</html>
