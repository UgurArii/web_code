<?php 
require_once '_inc/connection.php';
$kullanici  = mysql_real_escape_string($_POST['kullaniciAdi']);

if(!empty($kullanici)){
    $query = "SELECT KullaniciAdi FROM uye_giris WHERE KullaniciAdi LIKE '$kullanici%'";
    $result = mysql_query($query);
    
    while(($row = mysql_fetch_object($result))!==false){
        echo "<li>$row->KullaniciAdi kullanıcısı seçilemez</li>";
    }
}

?>
