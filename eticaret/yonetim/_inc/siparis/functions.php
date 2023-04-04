<?php
function sipariseGoreUyeIDBul($siparisID){
    $query = "SELECT UyeID FROM siparis WHERE SiparisID='$siparisID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    return $row->UyeID;
}
?>
