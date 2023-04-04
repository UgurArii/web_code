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
$modulID = 6;
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
if(modulAktifmi('urun-kategori')==0){
    header("Location:../index.php?Hata=PasifModul");
}

//kategoriID değerinin alınması
$kategoriID = getValues($_GET['KategoriID']);

//kategori kayıt set düzenlenecek kayıt
$query_rsKategoriDuzenle = "SELECT * FROM kategori WHERE KategoriID='$kategoriID'";
$rsKategoriDuzenle = mysql_query($query_rsKategoriDuzenle);
$row_rsKategoriDuzenle = mysql_fetch_object($rsKategoriDuzenle);

//kategori kayıt 2 set ana kategori kayıt
$query_rsParent = "SELECT * FROM kategori";
$rsParent = mysql_query($query_rsParent);
$row_rsParent = mysql_fetch_object($rsParent);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['kategoriDuzenleSubmit']))
{
//    echo "Form Gönderildi";
//    exit();
    $parentID = postValues($_POST['ParentID']);
    $kategori = postValues($_POST['Kategori']);
    $kategoriResim = $_FILES['KategoriResim']['name'];
    $resimYukleme = true;
    if(empty($kategoriResim)){
        $kategoriResim = $row_rsKategoriDuzenle->KategoriResim;
        $resimYukleme = false;
        
    }
    
    //query oluşturma
    $query_KategoriDuzenle = "UPDATE kategori SET
        ParentID='$parentID',
        Kategori='$kategori',
        KategoriResim='$kategoriResim'
        WHERE KategoriID='$kategoriID'
            ";
    $sonuc = mysql_query($query_KategoriDuzenle);
    if($sonuc){
        if($resimYukleme){
            $filename = $_FILES['KategoriResim']['tmp_name'];
            $destination = "../../uploads/urun-kategori/".$kategoriResim;
            
            $sonucYukleme = move_uploaded_file($filename, $destination);
          
           
            
            if($sonucYukleme){
               
                 //resim silinmesi
            if(!empty($row_rsKategoriDuzenle->KategoriResim))
            {
                $filenameUnlink = "../../uploads/urun-kategori/" .$row_rsKategoriDuzenle->KategoriResim;
                $unlink = unlink($filenameUnlink);
            }
               header("Location:index.php");
              // var_dump($unlink);
                
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Kategori Düzenle</title>
    <style>
        label{
            display: block;
        }
    </style>
        <link href="../../includes/css/yonetim.css" rel="stylesheet" type="text/css"/>

</head>
<body>
       <div id="yonetimToolbar">
    <ul>
        <li><a href="../index.php">Anasayfa</a></li> 
        <?php do {?>
        <li><a href="../<?= $row_rsModul->ModulDizin;?>"><img src="../../uploads/modul/<?= $row_rsModul->ModulResim;?>" width="24"/><?= $row_rsModul->ModulAdi;?></a></li> 
        <?php }while ($row_rsModul=  mysql_fetch_object ($rsModul));?>
        <li><a href="../../cikis.php">Çıkış</a></li> 
    </ul>
</div>
    <?php
    // put your code here
    ?>
    
    <form action="<?= $_SERVER['PHP_SELF'];?>/KategoriID=<?= $kategoriID ;?>" method="post" enctype="multipart/form-data"/>
    <fieldset>
        <legend>Kategori Bilgileri</legend>
        <label for="ParentID">Parent Kategori</label>
        <select id="ParentID" name="ParentID">
           <option value="0">Parent Kategorisi Yok</option>
           <?php do{ ?>
           <option value="<?= $row_rsParent->KategoriID;?>"<?php if($row_rsKategoriDuzenle->ParentID==$row_rsParent->KategoriID) echo "selected";?>><?= $row_rsParent->Kategori;?></option>
            <?php }while($row_rsParent = mysql_fetch_object($rsParent));?>
        </select>
        <label for="Kategori">Kategori</label>
        <input type="text" name="Kategori" id="Kategori" value="<?= $row_rsKategoriDuzenle->Kategori;?>" required/>
        <p><img src="../../uploads/urun-kategori/<?= $row_rsKategoriDuzenle->KategoriResim;?>"/></p>
        <label for="KategoriResim">Kategori Resim</label> 
        <input type="file" name="KategoriResim" id="KategoriResim"/>
        <br/>
        <input type="submit" name="kategoriDuzenleSubmit" value="Değişiklikleri Kaydet"/>
    </fieldset>
 
    </form>
</body>
</html>
