<?php
session_unset();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Please Log In</title>
</head>
<body>
    <form method="post" action="movie1.php">
        <p>Enter your username:
        <input type="text" name="user"/> 
        </p>
        <p>Enter your password:
        <input type="text" name="pass"/> 
        </p>
        <p>Enter your username:
        <input type="submit" name="submit" value="Submit"/>
        </p>
    </form>
    
    
</body>
</html>
