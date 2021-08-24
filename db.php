<?php
$db = new Mysqli;
$db ->connect('localhost','root','','attendance',3306);
if(!$db)
{
    echo "Error Occured";
}
?>