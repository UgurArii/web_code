<?php

        function get_director($director_id) {
        global $db;
        $query = 'SELECT
        people_fullname
        FROM
        people
        WHERE
        people_id = ' . $director_id;
        $result = mysql_query($query, $db) or die(mysql_error($db));
        $row = mysql_fetch_assoc($result);
        extract($row);
        return $people_fullname;
        }
        
        // take in the id of a lead actor and return his/her full name
        function get_leadactor($leadactor_id) {
        global $db;
        $query = 'SELECT
        people_fullname
        FROM
        people
        WHERE
        people_id = ' . $leadactor_id;
        $result = mysql_query($query, $db) or die(mysql_error($db));
        $row = mysql_fetch_assoc($result);
        extract($row);
        return $people_fullname;
        }
        
        // take in the id of a movie type and return the meaningful textual
        // description
        function get_movietype($type_id) {
        global $db;
        $query = 'SELECT
        movietype_label
        FROM
        movietype
        WHERE
        movietype_id = ' . $type_id;
        $result = mysql_query($query, $db) or die(mysql_error($db));
        $row = mysql_fetch_assoc($result);
        extract($row);
        return $movietype_label;
        }
        
        // function to calculate if a movie made a profit, loss or just broke even
        function calculate_differences($takings, $cost) {
        $difference = $takings - $cost;
        if ($difference < 0) {
        $color = 'red';
        $difference = '$' . abs($difference) . 'million';
        } elseif ($difference > 0) {
        $color ='green';
        $difference = '$' . $difference . 'million';
        } else {
        $color = 'blue';
        $difference = 'broke even';
        }
        return '<span style="color:' .$color. ';" >' . $difference . '</span>';
        }

        //connect to MySQL
        $db = mysql_connect("localhost","root","")
        or ("Hey loser, check your server connection");


        mysql_select_db('moviesite',$db);// retrieve information
        $query = 'SELECT
        movie_name, movie_year, movie_director, movie_leadactor,
        movie_type, movie_running_time, movie_cost, movie_takings
        FROM
        movie
        WHERE
        movie_id = ' . $_GET['movie_id'];
        $result = mysql_query($query, $db) or die(mysql_error($db));
        
        $row = mysql_fetch_assoc($result);
        
        $movie_name = $row['movie_name'];
        $movie_director = get_director($row['movie_director']);
        $movie_leadactor = get_leadactor($row['movie_leadactor']);
        $movie_year = $row['movie_year'];
        $movie_running_time = $row['movie_running_time'].' mins';
        $movie_takings = $row['movie_takings'] . ' million';
        $movie_cost = $row['movie_cost'] . ' million';
        $movie_takings = $row['movie_takings'] . ' million';
        $movie_health = calculate_differences($row['movie_takings'],
$row['movie_cost']);
        echo <<< ENDHTML
< html >
< head >
< title > Details and Reviews for: $movie_name < /title >
< /head >
< body >
< div style=”text-align: center;” >
< h2 > $movie_name < /h2 >
< h3 > < em > Details < /em > < /h3 >
< table cellpadding=”2” cellspacing=”2”
style=”width: 70%; margin-left: auto; margin-right: auto;” >
< tr >
< td > < strong > Title < /strong > < /strong > < /td >
< td > $movie_name < /td >
< td > < strong > Release Year < /strong > < /strong > < /td >
< td > $movie_year < /td >
< /tr > < tr >
< td > < strong > Movie Director < /strong > < /td >
< td > $movie_director < /td >
< td > < strong > Cost < /strong > < /td >
< td > $$movie_cost < td/ >
< /tr > < tr >
< td > < strong > Lead Actor < /strong > < /td >
< td > $movie_leadactor < /td >
<td> < strong > Takings < /strong > < /td >
<td> $$movie_takings < td/ >
</tr><tr >
<td><strong > Running Time < /strong > < /td >
<td> $movie_running_time < /td >
<td> < strong > Health < /strong > < /td >
<td> $movie_health < td/ >
</tr>
</table> < /div >
</body>
</html>
ENDHTML;

        ?>
