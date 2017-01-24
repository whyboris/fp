<?php

require 'connection.php';

if (!empty($_GET)) {

    $id = $_GET['id'];
    $query = array('_id'=> new MongoId($id));
    $collection->remove($query);

}

header('Location: index.php');
