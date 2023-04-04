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
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

$uyeID = getValues($_GET['UyeID']);
$modulID = getValues($_GET['ModulID']);

$query = "DELETE FROM modul_uye WHERE UyeID='$uyeID' AND ModulID='$modulID'";
$result = mysql_query($query);

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
         $("#UyeListe tr.listeVeri:even").addClass("evenTR");
         $("#UyeListe tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#UyeListe tr.listeVeri").hover(
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
        #UyeListe tr th{
            background-color: #f00;
            color:#fff;
            padding: 5px;
            text-align: left;
        }
        
        #UyeListe tr td{
            padding: 5px;
        }
    </style>
</head>
<body>
    <?php
    // put your code here
    ?>
</body>
</html>
