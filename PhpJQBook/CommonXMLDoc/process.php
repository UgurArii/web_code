<?php

$bookId = $_GET['id'];
$action = $_GET['action'];
$strResponse;
$objXML = simplexml_load_file('SimpleXML.xml');
foreach ($objXML->book as $book)
{
    if($book['index'] == $bookId)
    {
        if($book['index'] == $bookId)
        {
            if($action == 'year')
            {
                $strResponse = 'This book was puslished in year.'.$book->name['year'];
            }
            else if($action == 'stroies')
            {
                $stories = $book->stroy;
                $strResponse = '<ul>';
                foreach ($stroies as $story)
                {
                    $strResponse.='<li>'.$story->title. '</li>';
                }
                $strResponse .= '</ul>';
            }
            else{
                $strResponse = 'Nothing to do';
            }
            break;
        }
    }
}
echo $strResponse;
?>
