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

//modül kayıt setinin oluşturulması
$query_rsModul = "SELECT * FROM modul ORDER BY ModulSira, ModulEklemeTarih DESC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);


$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$uyeBarID = $_SESSION['Uye']['UyeID'];

$query_rsModulBar = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModulBar = mysql_query($query_rsModulBar);
$row_rsModulBar = mysql_fetch_object($rsModulBar);
$num_row_rsModul = mysql_num_rows($rsModulBar);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Stok Yönetimi Modülleri</title>
     <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#ModulListe tr.listeVeri:even").addClass("evenTR");
         $("#ModulListe tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#ModulListe tr.listeVeri").hover(
                 function(){
                   $(this).toggleClass("highlightTR");  
                 },
                 function(){
                     $(this).toggleClass("highlightTR");
                 }
                );
         
      });
    </script>
    <style>
        .evenTR{
            background-color: #edf4f6;
            
        }
        .oddTR{
            background-color: #ccf0f9;
            
        }
        .highlightTR{
            background-color: #f1fde3;
            cursor: pointer;
        }
        #ModulListe tr th{
            background-color: #f00;
            color:#fff;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Stok Yönetim Modülleri</h1>
    <?php
    if(isset($_GET['Islem']))
    {
        $islem = getValues($_GET['Islem']);
        if($islem == 'ModulEkle')
        {
            echo "<p><strong>Modül Başarıyla Eklendi</p></strong>";
        }
        
          if($islem == 'ModulSil')
        {
            echo "<p><strong>Modül Başarıyla Silindi</p></strong>";
        }
        echo "<p>Modül Sayısı $num_row_rsModul</p>";
    }
    ?>
    <h1>Modüller</h1>
    <?php if($num_row_rsModul!=0):?>
    <a href="ekle.php">Modül Ekle</a>
    <table id="ModulListe">
        <tr>
            <th>Modül Adı</th>
            <th>Dizin</th>
             <th>Resim</th>
            <th>Seviye</th>
             <th>Sıra</th>
            <th>Modül Aktif</th>
<!--             <th>Ekleme Tarihi</th>-->
            <th>Düzenle</th>
        </tr>
        <?php do{?>
        <tr class="listeVeri">
            <td><?= $row_rsModul->ModulAdi;?></td>
            <td><?= $row_rsModul->ModulDizin;?></td>
             <td><img src="../../uploads/modul/<?= $row_rsModul->ModulResim;?>" width="50"/></td>
            <td><?= $row_rsModul->ModulSeviye;?></td>
             <td>
           
                 <a href="sirala.php?ModulID=<?= $row_rsModul->ModulID;?>&Islem=Artir&Sira=<?= $row_rsModul->ModulSira;?>"><img src="../../includes/img/azalt-k.png"/></a>
         
                 <?= $row_rsModul->ModulSira;?>
                 <a href="sirala.php?ModulID=<?= $row_rsModul->ModulID;?>&Islem=Azalt&Sira=<?= $row_rsModul->ModulSira;?>"><img src="../../includes/img/artir-k.png"/></a>
             
             </td>
            <td><?php if($row_rsModul->ModulAktif==1){echo "<a href='aktiflestir.php?ModulID=$row_rsModul->ModulID&Aktif=$row_rsModul->ModulAktif'><img src='../../includes/img/aktif.png'/></a>";}else{echo "<a href='aktiflestir.php?ModulID=$row_rsModul->ModulID&Aktif=$row_rsModul->ModulAkti'><img src='../../includes/img/pasif.png'/></a>";}?></td>
<!--            <td><?= date("d/m/Y H:i:s",  strtotime($row_rsModul->ModulEklemeTarih));?></td>-->
            <td>
                <a href="duzenle.php?ModulID=<?= $row_rsModul->ModulID;?>">Düzenle</a> 
                | 
                <a href="sil.php?ModulID=<?= $row_rsModul->ModulID;?>">Sil</a> 
               
            </td>
        <?php }while($row_rsModul = mysql_fetch_object($rsModul));?>
        </tr>
    </table>
    <?php else:?>
    <p>Henüz yüklenmiş bir modül yok </p><p><a href="ekle.php">Modül Eklemek için tıklayınız</a></p>
    <?php endif;?>
</body>
</html>
