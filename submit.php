<?php

session_start();

require 'connection.php';

if (!empty($_POST)) {

    $posts = $collection->find();


    $title = $_POST['title'];
    $content = $_POST['content'];
    $excerpt = $_POST['excerpt'];
    $author = $_SESSION['name'];

    $post = array(
        'title'=>$title,
        'content'=>$content,
        'excerpt'=>$excerpt,
        'author'=>$author,
        'time'=> new MongoDate(),
    );

    include('metaboxes.php');
    foreach ($allMetaBoxes as $key => $value) {
        $current = $allMetaBoxes[$key][1];
        $post[$current]= $_POST[$current];
    }




    if ($_POST['id'] != 0) {
        // UPDATE
        $id = $_POST['id'];
        $query = array('_id'=> new MongoId($id));
        $collection->update($query,$post);
    } else {
        // INSERT
        $collection->insert($post);
    }


}

header('Location: index.php');
