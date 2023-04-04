<?php

$server = "localhost";
$username = "root";
$password = "";
$database_name = "phpilestokyonetimi";
$connection = mysql_connect($server, $username, $password);

if($connection)
{
    //echo "Sunucuya başarıyla bağlandı";
    
    if(mysql_select_db($database_name))
    {
       // echo "<br/> veritabanı $database_name başarıyla bağlandı";
    //türkçe karakter sorunu
        mysql_query("SETNAMES'utf8'");
mysql_query("SET CHARACTER SET'utf8'");
mysql_query("SET COLLATION_CONNECTION=utf_general_ci");
    }
}






?>
