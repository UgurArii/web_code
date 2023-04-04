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
$modulID = 14;
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//Adres Tip Id değerinin alınması

$adresTipID = getValues($_GET['AdresTipID']);
$query_AdresTipSil = "DELETE FROM cari_adres_tip WHERE AdresTipID='$adresTipID'";
$result = mysql_query($query_AdresTipSil);

if($result)
{
    header("Location:index.php?Islem=AdresTipSil");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
      <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#dinamikTablo tr.listeVeri:even").addClass("evenTR");
         $("#dinamikTablo tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#dinamikTablo tr.listeVeri").hover(
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
        #dinamikTablo tr th{
            background-color: #f00;
            color:#fff;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
    // put your code here
    ?>
</body>
</html>
