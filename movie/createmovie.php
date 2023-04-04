<?php

$connect = mysql_connect("localhost","root","")
        or ("Hey loser, check your server connection");

$create = mysql_query("CREATE DATABASE IF NOT EXISTS moviesite")
or die(mysql_error());

mysql_select_db("moviesite");

$movie = "CREATE TABLE movie (
movie_id int(11) NOT NULL auto_increment,
movie_name varchar(255) NOT NULL,
movie_type tinyint(2) NOT NULL default 0,
movie_year int(4) NOT NULL default 0,
movie_leadactor int(11) NOT NULL default 0,
movie_director int(11) NOT NULL default 0,
PRIMARY KEY (movie_id),
KEY movie_type (movie_type,movie_year)
)";

$results = mysql_query($movie) or die(mysql_errno());

//create “movietype” table
$movietype = "CREATE TABLE movietype (
movietype_id int(11) NOT NULL auto_increment,
movietype_label varchar(100) NOT NULL,
PRIMARY KEY (movietype_id)
)";
$results = mysql_query($movietype)
or die(mysql_error());

//create “people” table
$people = "CREATE TABLE people (
people_id int(11) NOT NULL auto_increment,
people_fullname varchar(255) NOT NULL,
people_isactor tinyint(1) NOT NULL default 0,
people_isdirector tinyint(1) NOT NULL default 0,
PRIMARY KEY (people_id)
)";


$results = mysql_query($people)
or die(mysql_error());
echo "Movie Database successfully created!";

?>
