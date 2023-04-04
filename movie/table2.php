<?php //
    function  get_director($director_id) 
    {
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

        $db = mysql_connect("localhost","root","")
                or ("Hey loser, check your server connection");


        mysql_select_db('moviesite',$db);

        $query = 'SELECT
        movie_name, movie_year, movie_director, movie_leadactor,
        movie_type
        FROM
        movie
        ORDER BY
        movie_name ASC,
        movie_year DESC';

        $result = mysql_query($query, $db) or die(mysql_errno($db));

        // determine number of rows in returned result
        $num_movies = mysql_num_rows($result);
        
        $table = <<<ENDHTML
    <div style="text-align: center;">
    <h2>Movie Review Database</h2> 
    <table border="1" cellpadding="2" cellspacing="2"
           style="width: 70%; margin-left: auto; margin-right: auto;">
        <tr>
            <th>Movie Title</th>    
            <th>Year of Release</th>
            <th>Movie Director</th>    
            <th>Movie Lead</th> 
            <th>Movie Type</th>
        </tr>
        ENDHTML;
        
        while ($row = mysql_fetch_assoc($result)) {
        extract($row);
        $director = get_director($movie_director);
        $leadactor = get_leadactor($movie_leadactor);
        $movietype = get_movietype($movie_type);
        $table .= <<< ENDHTML
        <tr>
        <td> $movie_name </td>
        <td> $movie_year </td>
        <td> $director </td>
        <td> $leadactor </td>
        <td> $movietype </td>
        </tr>
        ENDHTML;
        }
        $table .= <<< ENDHTML
        </table >
        <p> $num_movies Movies </p>
        </div >
        ENDHTML;
        echo $table;
?>
