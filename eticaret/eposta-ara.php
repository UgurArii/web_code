<?php 
require_once '_inc/connection.php';
$eposta = mysql_real_escape_string($_POST['eposta']);

if(!empty($eposta)){
    $query = "SELECT Eposta FROM uye_giris WHERE Eposta LIKE '$eposta%'";
    $result = mysql_query($query);
    
    while(($row = mysql_fetch_object($result))!==false){
        echo "<li>$row->Eposta eposta adresi seçilemez</li>";
    }
}

?>
