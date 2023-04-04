<?php 
$db = mysql_connect("localhost","root","")
        or ("Hey loser, check your server connection");


mysql_select_db("moviesite",$db);

$query = 'SELECT
movie_name, movie_year, movie_director, movie_leadactor,
movie_type
FROM
movie
ORDER BY
movie_name ASC,
movie_year DESC';

$result = mysql_query($query, $db) or die(mysql_errno($db));

$num_movies = mysql_num_rows($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
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
        <?php 
        while ($row=  mysql_fetch_assoc($result))
        {
            extract($row);
            echo '<tr>';
            echo '<td>' . $movie_name . '</td>';
            echo '<td>' . $movie_year . '</td>';
            echo '<td>' . $movie_director . '</td>';
            echo '<td>' . $movie_leadactor . '</td>';
            echo '<td>' . $movie_type . '</td>';
            echo '</tr>';
            
        }
        ?>
        
    </table>
    <p><?php echo $num_movies; ?> Movies</p>
    
    
</div>
        
</body>
</html>
