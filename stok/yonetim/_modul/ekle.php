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

if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],2)){
    header("Location:../index.php?Hata=YetkisizGiris");
}

//seviye kayıt seti
$query_rsSeviye = "SELECT SeviyeID FROM uye_seviye";
$rsSeviye = mysql_query($query_rsSeviye);
$row_rsSeviye = mysql_fetch_object($rsSeviye);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$uyeBarID = $_SESSION['Uye']['UyeID'];

$query_rsModulBar = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModulBar = mysql_query($query_rsModulBar);
$row_rsModulBar = mysql_fetch_object($rsModulBar);
$num_row_rsModul = mysql_num_rows($rsModulBar);

//form gönderildi
if(isset($_POST['modulEkleSubmit']))
{
    /*echo "Form Gönderildi";
    exit();*/
    
    //formdan değerlerin alınması
    $modulAdi = postValues($_POST['ModulAdi']);
    $modulDizin = postValues($_POST['ModulDizin']);
    $modulSeviye = postValues($_POST['ModulSeviye']);
    $modulSira = postValues($_POST['ModulSira']);
    
    $modulAktif = isset($_POST['ModulAktif'])?1:0;
    
    //resim bilgisinin alınması
    $modulResim = postValues($_FILES['ModulResim']['name']);
    $modulTmpName = $_FILES['ModulResim']['tmp_name'];
    
    //query oluşturma
    $query_ModukEkle = "INSERT INTO modul"
            . "(ModulAdi, ModulDizin, ModulResim, ModulSeviye,ModulSira, ModulAktif)"
            . "VALUES('$modulAdi', '$modulDizin','$modulResim','$modulSeviye', $modulSira','$modulAktif')";
       
    $sonuc = mysql_query($query_ModukEkle);
    if($sonuc)
    {
     /*   echo "Veritabanına başarıyla giriş yapıldı";
        exit();*/
        $filename = $modulTmpName;
        $destination = "../../uploads/".$modulResim;
        $resimSonuc = move_uploaded_file($destination, $query_ModukEkle);
        
        if($resimSonuc)
        {
            header("Location:index.php?Islem=ModulEkle");
        }
    }//veritabanı başarıyla veri girildi
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Modül Ekle</title>
     <link href="../../includes/css/form.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    <?php
    // put your code here
    ?>
    <h1>Modül Ekle</h1>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Modül Bilgi</legend>
            <label for="ModulAdi">Modül Adı</label>
            <input type="text" name="ModulAdi" id="ModulAdi" required/>
            <label for="ModulDizin">Modül Dizin</label>
            <input type="text" name="ModulDizin" id="ModulDizin" required/>
            <label for="ModulResim">Modül Resim</label>
            <input type="file" name="ModulResim" id="ModulResim" />
            
        </fieldset>
        <fieldset>
            <legend>Modül Seviye ve Aktiflik</legend>
            <label for="ModulSeviye">Modül Seviye</label>
            <select id="ModulSeviye" name="ModulSeviye">
                <?php do{?>
                <option value="<?= $row_rsSeviye->SeviyeID;?>"<?php if($row_rsSeviye->SeviyeID==5) echo "selected";?>><?= $row_rsSeviye->SeviyeID;?></option>
                <?php }while($row_rsSeviye = mysql_fetch_object($rsSeviye));?>
            </select>
            <label for="ModulSira">Modül Sıra</label>
            <input type="text" name="ModulSira" id="ModulSira" required/>
            <label for="ModulAktif">Modül Aktif</label>
            <input type="checkbox" name="ModulAktif" id="ModulAktif"/>
            <br>
            <input type="submit" name="modulEkleSubmit" value="Modül Ekle"/>
        </fieldset>
    </form>
</body>
</html>
