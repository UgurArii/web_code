<?php
if ($_POST['submit'] == 'Add') {
   if($_POST['type']=='movie' && $_POST['movie_type'] == '')
   {
           header('Location:form4.php');
   }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Multipurpose</title>
    <style>
        td{vertical-align: top;}
    </style>
    
    
</head>
<body>
  <?php
    if($_POST['submit'] == 'Add')
    {
        echo '<h>Add ' .ucfirst($_POST['type']) .'</h1>';
    
  ?>
    <form action="form4b.php" method="post">
        <input type="hidden" name="type" value="<?php echo $_POST['type'];?>"/>
        <table>
            <tr>
                <td>Name</td>
                <td>
                    <?php echo $_POST['name'];?>
                    <input type="hidden" name="name" value=" <?php echo $_POST['name'];?>"/>
                </td>
            </tr>
            <?php
             if($_POST['type'] == 'movie')
             {
            ?>
            <tr>
                <td>Movie Type</td>
                <td>
                    <?php echo $_POST['movie_type']; ?>
                    <input type="hidden" name="movie_type" 
                    value="<?php echo $_POST['movie_type'];?>"/>
                </td>
                <tr>
                    <td>Year</td>
                    <td><input type="text" name="year"/></td> 
                </tr>
                <tr>
                    <td>Movie Description</td>
                    <?php 
             } else{
                 echo '<tr><td>Biographt</td>';
             }
             ?>
                    <td>
                        <textarea name="extra" rows="5" cols="60"></textarea>
                    </td>
                <tr>
                    <td colspan="2" style="text-align: center;">
                     <?php 
                       if(isset($_POST['debug']))
                       {
                           echo '<input type="hidden" name="debug" value="on"/>';
                       }
                     ?>
                        <input type="submit" name="submit" value="Add" />
                    </td>
                </tr>
        </table>
    </form>
    <?php 
    } else if ($_POST['submit'] == 'Search') {
        echo '<h1>Search for' .ucfirst($_POST['type']) . '</h1>';
        echo '<p> Searching for ' . $_POST['name'] . '... </p>' ;
    }
    if (isset($_POST['debug'])) {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    }
    ?>
</body>
</html>
