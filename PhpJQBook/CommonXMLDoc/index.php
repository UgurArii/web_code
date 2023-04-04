<?php

?>

<!DOCTYPE html>
   <head>
        <meta charset="UTF-8">
    <title>Usind DOM</title>
</head>

<script src="jquery-1.11.0.js" type="text/javascript"></script>
<script type="text/javascript">
      $(document).ready(function ()
{
$('h1').click(function()
{
$(this).next('ul').toggle('slow');
});
});
</script>
<style type="text/css">
    h1{
        cursor: pointer;
        font-size: 20px;
    }
    ul{
        display: none;
        list-style: none;
        margin: 0pt;
        padding: 0pt;
    }
</style>
<body>
<?php
$objXML = new DOMDocument();
$objXML->load('SimpleXML.xml', LIBXML_NOBLANKS);
$books = $objXML->getElementsByTagName('book');
foreach($books as $book)
{
echo '<h1>'.$book->firstChild->nodeValue.'
('.$book->firstChild->attributes->item(0)->value.')</h1>';
$stories = $book->getElementsByTagName('story');
echo '<ul>';
foreach($stories as $story)
{
echo '<li>'.$story->firstChild->nodeValue.'</li>';
}
echo '</ul>';
}
?>

</body>
</html>
