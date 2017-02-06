<?php

$conn = new MongoClient('mongodb://localhost');
$db = $conn->test;
$postCollection = $db->posts;

$userCollection = $db->users;

$blogCollection = $db->blogs;

// for debug:
function showMe($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

?>
