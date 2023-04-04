<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Say My Name</title> 
</head>
<body>
    <?php
    echo '<h1>Hello ' .$_POST['name'] . '!</h1>';
    ?>
    <pre>
        <strong>DEBUG</strong>
        <?php
        print_r($_POST);
        ?>
    </pre>
</body>
</html>
