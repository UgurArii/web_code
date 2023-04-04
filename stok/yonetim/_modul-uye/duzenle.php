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
$modulID = 13;
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//tüm modüllerin alınması
$query_rsModul = "SELECT ModulID, ModulAdi FROM modul ORDER BY ModulAdi ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);

$uyeID = getValues($_GET['UyeID']);

//modül yetki
function modulYetkiVarmi($modulID, $uyeID){
    
    $query = "SELECT UyeID FROM modul_uye WHERE ModulID='$modulID' AND UyeID='$uyeID'";
    $result = mysql_query($query);
    $num_result = mysql_num_rows($result);
    
    return $num_result;
}



if(isset($_POST['uyeModulYetkiDuzenleSubmit'])){
   
    function yetkiİncele($modulID, $uyeID)
    {
        $query_UyeYetki = "SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID' AND ModulID='$modulID'";
        $rsUyeYetki = mysql_query($query_UyeYetki);
        $row_rsUyeYetki = mysql_fetch_object($rsUyeYetki);
        $num_row_rsUyeYetki = mysql_num_rows($rsUyeYetki);
        
        return $num_row_rsUyeYetki;
        
    }
        $query_UyeYetki = "SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID'";
        $rsUyeYetki = mysql_query($query_UyeYetki);
        $row_rsUyeYetki = mysql_fetch_object($rsUyeYetki);
    
        
        $silinecek = array();
        do{
            array_push($silinecek, $row_UyeYetki->ModulID);
        }while($row_rsUyeYetki=  mysql_fetch_object($rsUyeYetki));
    
        $silinecekYetkiler = array_diff($silinecek,$_POST['Modul']);
    
        foreach ($silinecekYetkiler as $key=>$value){
            $query_YetkiSil = "DELETE FROM modul_uye WHERE ModulID'$value' AND UyeID='$uyeID'";
            mysql_query($query_YetkiSil);
            
        }
        
    if(!empty($_POST['Modul'])){
        
        
        foreach ($_POST['Modul'] as $key=> $value){
            $num_row_rsUyeYetki= yetkiİncele($value, $uyeID);
            if($num_row_rsUyeYetki==0){
                 $query = "INSERT INTO modul_uye(ModulID, UyeID) VALUES('$value','$uyeID')";
        $result = mysql_query($query);
        if($result){
            header("Location:../_modul-uye/index.php?UyeID=$uyeID");
        }
            }
        }
        
   
       
    
}else{
    $query = "DELETE FROM modul_uye WHERE UyeID='$uyeID'";
    mysql_query($query);
        header("Location:../_modul-uye/index.php?UyeID=$uyeID");
}        
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Üye Modül Yetki Düzenle</title>
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
    <h1>Üye Modül Yetki Düzenle</h1>
    <?php
    // put your code here
    ?>
    <form action="<?= phpSelf();?>?UyeID=<?=$uyeID;?>" method="post">
        <legend>Modüller</legend>
        <?php do{?>
        <input type="checkbox" name="Modul[]" value="<?= $row_rsModul->ModulID ;?>" <?php $modul = modulYetkiVarmi($row_rsModul->ModulID, $uyeID); if($modul==1){echo " checked";}?> /><?=$row_rsModul->ModulAdi;?><br>
        <?php }while($row_rsModul=  mysql_fetch_object($rsModul));?>
        <input type="submit" name="uyeModulYetkiDuzenleSubmit" value="Değişiklikleri Kaydet"/>
    </form>
    
</body>
</html>
