<?php
$connect = mysql_connect("localhost","root","")
        or ("Hey loser, check your server connection");


mysql_select_db("moviesite");

//insert data movie table
$insert = "INSERT INTO movie (movie_id, movie_name, movie_type, " .
"movie_year, movie_leadactor, movie_director)" .
"VALUES (1, 'Bruce Almighty', 5, 2003, 1, 2), " .
"(2, 'Office Space', 5, 1999, 5, 6), " .
"(3, 'Grand Canyon', 2, 1991, 4, 3)";

$results = mysql_query($insert)
or die(mysql_error());

//insert data into “movietype” table
$type = "INSERT INTO movietype (movietype_id, movietype_label) " .
"VALUES (1,'Sci Fi'), " .
"(2, 'Drama'), " .
"(3, 'Adventure'), " .
"(4, 'War'), " .
"(5, 'Comedy'), ".
"(6, 'Horror'), " .
"(7, 'Action'), " .
"(8, 'Kids')" ;
$results = mysql_query($type)
or die(mysql_error());
echo "Data inserted successfully!";
?>
