<?php

session_start();

require 'connection.php';

if (!empty($_POST)) {

    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $type = $_POST['type'];
    $salary = $_POST['salary'];

    $post = array(
        'name'=>$name,
        'lastName'=>$lastName,
        'type'=>$type,
        'salary'=>$salary,
    );

    // update
    $id = $_POST['name'];
    $query = array('name'=> $id);
    $userCollection->update($query, $post);

    // INSERT -- temporary until I create Register page
    //$userCollection->insert($post);

}

header('Location: index.php');
