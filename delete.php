<?php

require 'connection.php';

if (!empty($_GET)) {
    $item = $_GET['item'];
    $id = $_GET['id'];
    $query = array('_id'=> new MongoId($id));

    switch($_GET['item']) {
        case 'post':
            $postCollection->remove($query);
            break;
        case 'user':
            $userCollection->remove($query);
            break;
        case 'blog':
            $blogCollection->remove($query);
            break;
    }
}

header('Location: index.php');
