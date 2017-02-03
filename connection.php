<?php

$conn = new MongoClient('mongodb://localhost');
$db = $conn->test;
$postCollection = $db->posts;

$userCollection = $db->users;

$blogCollection = $db->blogs;

?>
