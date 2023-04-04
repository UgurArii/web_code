<?php

function br(){
    echo "<br/>";
}

function pre(){
    echo "<pre>";
}

function post(){
    print_r($_POST);
}

function get(){
    print_r($_GET);
}

function set(){
    print_r($_SET);
}

function files(){
    print_r($_FILES);
}

function session(){
    print_r($_SESSION);
}

function server(){
    print_r($_SERVER);
}

function cookie(){
    print_r($_COOKIE);
}



//bu fonksiyon URL parametresi ile gelen parametreleri temizler
function getValues($urlParametre){
    $urlParametre = trim($urlParametre);
    
    $urlParametre = mysql_real_escape_string($urlParametre);
    
    return $urlParametre;
}

function postValues($urlParametre){
    $urlParametre = trim($urlParametre);
    
    $urlParametre = mysql_real_escape_string($urlParametre);
    
    return $urlParametre;
}

function ustKategoriBul($kategoriID){
    $query = "SELECT ParentID FROM urun_kategori WHERE KategoriID = '$kategoriID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
      $queryParent = "SELECT Kategori FROM urun_kategori WHERE KategoriID = '$row->ParentID'";
    $resultParent = mysql_query($queryParent);
    $rowParent = mysql_fetch_object($resultParent);
    $numRowParent = mysql_num_rows($resultParent);
    if($numRowParent>0){
    return $rowParent;
    }else{
        return 0;
    }
}

function itemSliderGoster($kategoriID){
    $query = "SELECT * FROM urun WHERE KategoriID = '$kategoriID' AND UrunAktif=1 AND UrunArsiv !=1 ORDER BY RAND() LIMIT 3";
           
    
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    echo "<ul>";
    do{
        echo "<li><a href='urun-detay.php?UrunID=$row->UrunID.'><img src='_uploads/resim/urun/".$row->UrunResim ."'/><h4>".$row->UrunAdi."</h4></a></li>";
    }while($row = mysql_fetch_object($result));
    echo "</ul>";
}





?>
