<?php
//mysql sunucusuna bağlanma

$server = "localhost";
$username="root";
$password="";
$database_name = "eticaret";
$connection=  mysql_connect($server,$username,$password);
//veritabanı seçimi
mysql_select_db($database_name,$connection);

//türkçe karakter sorunu
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");


if(!isset($_SESSION)){
    session_start();
}


?>
