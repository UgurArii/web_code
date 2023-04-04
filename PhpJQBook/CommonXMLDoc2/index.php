<?php
$objXML = new DOMDocument('1.0', 'utf-8'); 
$books = $objXML->createElement('books');
$book = $objXML->createElement('book');
$attrIndex = new DOMAttr("index", "4");
$book->appendChild($attrIndex);
$bookName = $objXML->createElement('name','The case book of
sherlock holmes');
$attrYear = new DOMAttr("year", "1894");
$bookName->appendChild($attrYear);
$book->appendChild($bookName);
$story = $objXML->createElement('story');
$title = $objXML->createElement('title', 'Tha case of ....');
$quote = $objXML->createElement('quote', 'Yet another quote');
$story->appendChild($title);
$story->appendChild($quote);
$book->appendChild($story);
$books->appendChild($book);
$objXML->appendChild($books);
if($objXML->save('new.xml') != FALSE)
{
echo 'XML file generated successfully.';
}
else
{
echo 'An error occured.';
}

$bookId = $_POST['bookId'];
$title = $_POST['storyTitle'];
$quote = $_POST['quote'];
$objXML = new DOMDocument();
$objXML->load('SimpleXML.xml', LIBXML_NOBLANKS);
$books = $objXML->getElementsByTagName('book');
foreach($books as $book)
{
if($book->attributes->item(0)->value == $bookId)
{
$story = $objXML->createElement('story');
$title = $objXML->createElement('title', $title);
$quote = $objXML->createElement('quote', $quote);
$story->appendChild($title);
$story->appendChild($quote);
$book->appendChild($story);
break;
}
}
if($objXML->save('../common.xml') != FALSE)
{
echo 'New story added successfully.';
}
else
{
echo 'An error occured.';
}
?>
<!DOCTYPE html>
   <head>
        <meta charset="UTF-8">
    <title>Modiftying xml with</title>
</head>

<script src="jquery-1.11.0.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function ()
{
        $('#add').click(function()
        {
            $.post(
        'process.php',
        { bookId: $('#bookList').val() , storyTitle:
        $('#storyName').val(), quote: $('#quote').val() },
        function(data)
        {
        $('#add').after(data);
        });
        });
        });

    
    </script>
<style type="text/css">
    ul{
        border: 1px solid black;
        padding: 5px;
        list-style: none;
    }
    label{
        float:left;
        width: 100px;
        list-style: none;
    }
</style>
<body>
    <ul>
        <li>
            <label for="bookList">Book</label>
            <select id="bookList">
                <option value="">Select A Book</option>
                <?php 
                $objXML = new DOMDocument();
                $objXML->load('SimpleXML.xml', LIBXML_NOBLANKS);
                $books = $objXML->getElementsByTagName('book');
                foreach ($books as $book)
                {
                    echo '<option value="'.$book->attributes->item(0)->value.'">'.$book->firstChild->nodeName.'</option>';
                }
                ?>
            </select>
        </li>
        <li>
        <label for="storyName">Story Name</label>
        <input type="text" id="storyName" value=""/>
        </li>
        <li>
        <label for="quote">Quote</label>
        <textarea id="quote"></textarea>
        </li>
        <li>
        <input type="button" id="add" value="Add new story"/>
        </li>
    </ul>
</body>
</html>
