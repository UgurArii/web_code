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
//modül değeri alınması
$modulID = getValues($_GET['ModulID']);


//modul kayıt seti
$query_rsModul = "SELECT * FROM modul WHERE ModulID='$modulID'";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$uyeBarID = $_SESSION['Uye']['UyeID'];

$query_rsModulBar = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModulBar = mysql_query($query_rsModulBar);
$row_rsModulBar = mysql_fetch_object($rsModulBar);
$num_row_rsModul = mysql_num_rows($rsModulBar);

if(isset($_POST['modulDuzenleSubmit']))
{
    
    $modulAdi = postValues($_POST['ModulAdi']);
    $modulDizin = postValues($_POST['ModulDizin']);
    $modulSeviye = postValues($_POST['ModulSeviye']);
    $modulSira = postValues($_POST['ModulSira']);
    $modulAktif = isset($_POST['ModulAktif'])?1:0;
    $modulResim = $_FILE['ModulResim']['name'];
    $modulResimName = empty($modulResim)?$row_rsModul->ModulResim:$modulResim;
    
    //query oluşturulması
    $query_ModulDuzenle = "UPDATE modul SET "
            . "ModulAdi='$modulAdi', ModulDizin='$modulDizin',"
            . "ModulSeviye='$modulSeviye', ModulSira='$modulSira',"
            . "ModulAktif='$modulAktif', ModulResim='$modulResimName'"
                . "WHERE Modul='$modulID'";
    
    $query_sonuc = mysql_query($query_ModulDuzenle);
    
    if($query_sonuc){
        if(!empty($_FILES['ModulResim']['name'])){
        
            $filename = $_FILES['ModulResim']['tmp_name'];
            $destination = "../../uploads/modul/".$modulResimName;
            $silinecekResim = "../../uploads/modul/".$row_rsModul->ModulResim;
            unlink($silinecekResim);
          
            move_uploaded_file($filename, $destination);
            
            header("Location:index.php?Islem=ResimDuzenle");
       
        }else{
            header("Location:index.php?Islem=ResimDuzenle");
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Modül Düzenle</title>
     <link href="../../includes/css/form.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    <?php
    // put your code here
    ?>
    
    <form action="<?= phpSelf();?>?ModulID<?= $modulID;?>" method="post" enyctype="multipart/form-data">
        <fieldset>
            <legend>Modül Bilgiler</legend> 
               <label for="ModulAdi">Modül Adı</label> 
            <input type="text" name="ModulAdi" id="ModulAdi" value="<?= $row_rsModul->ModulAdi;?>" required/>
            
            <label for="ModulDizin">Modül Dizin</label>
            <input type="text" name="ModulDizin" id="ModulDizin" value="<?= $row_rsModul->ModulDizin;?>" required/>
            <p><img src="../../uploads/modul/<?= $row_rsModul->ModulResim;?>" heigh="75"/></p>
            <label for="ModulResim">Yeni Modül Resim</label>
            <input type="file" name="ModulResim" id="ModulResim"/>
       
        </fieldset>
        <fieldset>
            <legend>Sıra Aktiflik ve Seviye</legend>
            <label for="ModulSeviye">Modül Seviye</label>
            <input type="text" name="ModulSeviye" id="ModulSeviye" value="<?= $row_rsModul->ModulSeviye;?>"
           
            <label for="ModulSira">Modül Sira</label>
            <input type="text" name="ModulSira" id="ModulSira" value="<?= $row_rsModul->ModulSira;?>"
                
            <label for="ModulAktif">Modül Aktif</label>
            <input type="text" name="ModulAktif" id="ModulAktif" <?= $row_rsModul->ModulAktif==1?' checked':'';?>
                  
        </fieldset>
        
        
       
        <input type="submit" name="modulDuzenleSubmit" value="Değişikleri Kaydet"/>
            
    </form>
</body>
</html>
