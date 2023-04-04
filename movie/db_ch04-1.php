<?php

        
        //connect to MySQL
        $db = mysql_connect("localhost","root","")
        or ("Hey loser, check your server connection");


       mysql_select_db('moviesite', $db) or die(mysql_error($db));
        
        $query = 'ALTER TABLE movie ADD COLUMN (
        movie_running_time TINYINT UNSIGNED NULL,
        movie_cost DECIMAL(4,1) NULL,
        movie_takings DECIMAL(4,1) NULL)';
        mysql_query($query, $db) or die (mysql_error($db));
        //insert new data into the movie table for each movie
        $query = 'UPDATE movie SET
        movie_running_time = 101,
        movie_cost = 81,
        movie_takings = 242.6
        WHERE
        movie_id = 1';
        mysql_query($query, $db) or die(mysql_error($db));
        $query = 'UPDATE movie SET
        movie_running_time = 89,
        movie_cost = 10,
        movie_takings = 10.8
        WHERE
        movie_id = 2';
        mysql_query($query, $db) or die(mysql_error($db));
        $query = 'UPDATE movie SET
        movie_running_time = 134,
        movie_cost = NULL,
        movie_takings = 33.2
        WHERE
        movie_id = 3';
        mysql_query($query, $db) or die(mysql_error($db));
        echo 'Movie database successfully updated!';
        ?>
