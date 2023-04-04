<?php
//libxml_use_internal_errors(true);
//$objXML = simplexml_load_file('SimpleXML.xml');
//
//if(!$objXML)
//{
//    $errors = libxml_get_errors();
//    foreach ($errors as $error)
//    {
//        echo $error->message,'<br/>';
//    }
//}
//else{
//    foreach ($objXML->book as $book)
//    {
//        echo $book->name.'<br/>';
//    }
//}
?>

<!DOCTYPE html>
   <head>
        <meta charset="UTF-8">
    <title></title>
</head>

<script src="jquery-1.11.0.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {
        $('input:button').click(function()
        {
        if($('#bookList').val() != '')
        {
        $.get(
        'process.php',
        { id: $('#bookList').val() , action: $(this).attr('id')
        },
        function(data)
        {
        $('#result').html(data);
        });
        }
        });
        });
</script>
<body>
    <p> 
        <select id="bookList">
            <option value="">select a book</option>
            <?php 
            $objXML = simplexml_load_file('SimpleXML.xml');
            foreach ($objXML->book as $book){
                echo '<option value="'.$book['index'].'">'.$book->name.'</option>';
            }
            ?>
        </select>
    <input type="button" id="year" value="Get Year of publication"/>
        <input type="button" id="stories" value="Get story list"/>
        </p>
        <p id="result"></p>
</body>
</html>
