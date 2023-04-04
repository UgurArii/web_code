<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Multipurpose Form</title>
    <style>
        td {
            vertical-align: top;
        }
    </style>
</head>
<body>
    <?php
      if($_POST['type'] == 'movie')
      {
          echo '<h1>New '.ucfirst($_POST['movie_type']) .': ';
      } else{
          echo '<h1>New '.  ucfirst($_POST['typw']) .': ';
      }
      
      echo $_POST['name'] .'</h1>';
      
      echo '<table>';
      if($_POST['type'] == 'movie')
      {
          echo '<tr>';
          echo '<td>Year</td>';
          echo '<td>' . $_POST['year'] . '</td>';
          echo '</tr><tr>';
          echo '<td>Movie Description</td>';
          
      }
      else{
          echo '<tr><td>Biography</td>';
      }
      echo 'td>' . n12br($_POST['extra']) .'</td>';
      echo '</tr>';
      echo '</table>';
      
      if(isset($_POST['debug']))
      {
          echo '<pre>';
          print_r($_POST);
          echo '</pre>';
      }
    ?>
</body>
</html>
