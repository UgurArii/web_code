<?php

$connect = mysql_connect("localhost","root","")
        or ("Hey loser, check your server connection");


mysql_select_db("moviesite");

$query = "SELECT movie_name, movie_type " .
        "FROM movie " .
        "WHERE movie_year > 1990 " . 
        "ORDER BY movie_type";

$results = mysql_query($query) or die(mysql_errno());

//while($row = mysql_fetch_array($results))
//{
//    extract($row);
//    echo $movie_name;
//    echo " - ";
//    echo $movie_type;
//    echo "<br>";
//}

//while ($row = mysql_fetch_assoc($results)) {
//foreach ($row as $val1) {
//echo $val1;
//echo " ";
//}
//echo "<br>";
//}

echo "<table border=\"1\">\n";
while ($row = mysql_fetch_assoc($results)) {
echo "<tr>\n";
foreach($row as $value) {
echo "<td>\n";
echo $value;
echo "</td>\n";
}
echo "</tr>\n";
}
echo "</table>\n";
?>
