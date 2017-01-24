<?php

$conn = new MongoClient('mongodb://localhost');
$db = $conn->test;
$collection = $db->posts;

?>
