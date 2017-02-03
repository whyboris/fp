<?php

session_start();

require('connection.php');

include('usersettingsfactory.php');


function showMe($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}


if (!empty($_POST)) {

    //$name = $_POST['name'];

    $insertionArray = array();

    //showMe($allUserMeta);
    //showMe($allBlogMeta);

    // either "user" or "blog"
    $origin = $_POST['origin'];

    if ($origin == 'blog'){
        $sourceOfData = $allBlogMeta;
        $theCollection = $blogCollection;
        $redirect = 'blogsettings.php';
    } elseif ($origin == 'user') {
        $sourceOfData = $allUserMeta;
        $theCollection = $userCollection;
        $redirect = 'usersettings.php';
    }

    foreach($sourceOfData as $key => $value) {
        if (isset($_POST[$value[1]]) && $_POST[$value[1]]!='') {
            $insertionArray[$value[1]] = $_POST[$value[1]];
        }
    }

    // update
    $id = $_POST['name'];
    $query = array('name'=> $id);
    $theCollection->update($query, array('$set' => $insertionArray));

    // INSERT -- temporary until I create Register page
    //$userCollection->insert($query);

     //showMe($_POST);

     //showMe($insertionArray);

}

header('Location: ' . $redirect);
