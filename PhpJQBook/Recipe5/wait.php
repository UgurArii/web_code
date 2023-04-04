<?php
    sleep(3);
if($_GET['what'] == 'good')
{
$names = array('Sherlock Holmes', 'John Watson', 'Hercule Poirot', 'Jane Marple');
echo getHTML($names);
}
else if($_GET['what'] == 'bad')
{
$names = array('Professor Moriarty', 'Sebastian Moran',
'Charles Milverton', 'Von Bork', 'Count Sylvius');
echo getHTML($names);
}
else if($_GET['what'] == 'select1'){
    echo "You do not selected nothing";
}
function getHTML($names)
{
$strResult = '<ul>';
for($i=0; $i<count($names); $i++)
{
$strResult.= '<li>'.$names[$i].'</li>';
}
$strResult.= '</ul>';
return $strResult;
}
?>
