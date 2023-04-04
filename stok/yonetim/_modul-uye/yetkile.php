<?php
//session başlatılması
session_start();

//sunucu bağlantısı ve veritabanı seçimi
require_once '../../includes/connection.php';

//form fonktisonları
require_once '../../includes/functions.php';

if(!GirisVarmi()){
   // header("Location:../index.php?Hata=GirisYap");
}


$uyeID = $_SESSION['Uye']['UyeID'];
$modulID = 17;
$alan = 'Yetkile';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
$uyeID = getValues($_GET['UyeID']);
$modulID = getValues($_GET['ModulID']);
$alan = getValues($_GET['Alan']);
$deger = getValues($_GET['Deger']);
$result = mysql_query($query);
$query =  "UPDATE modul_uye SET '$alan'='$deger' WHERE UyeID='$uyeID' AND ModulID='$modulID'";
if($result){
   header("Location:../_modul-uye/index.php?UyeID=$uyeID"); 
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
        #dinamikTablo tr td{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    // put your code here
    ?>
</body>
</html>
