<?php

function uyeGirisVarmi(){
    if(isset($_SESSION['UyeID'])){
        return TRUE;
    }else{
        return FALSE;
    }
}


//1.fonksiyon: üye aktif mi

function uyeAktifmi($uyeID){
    $query = "SELECT Aktif FROM uye_giris WHERE UyeID='$uyeID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    return $row->Aktif;
}

//2.fonksiyon: aktifleştirme
function uyeAktivasyonYap($uyeID){
    if(uyeAktifmi($uyeID)==1){
        br();
        echo "Üye Aktifleştirildi";
    }else{
        br();
        echo "Üye Aktifleştiriliyor";
        
        $query = "UPDATE uye_giris SET Aktif=1 WHERE UyeID = '$uyeID'";
        mysql_query($query);
        
        br();
        echo "Üye Aktifleştirildi";
    }
}

?>
