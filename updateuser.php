<?php

session_start();

require('connection.php');

include('usersettingscreation.php');

if (!empty($_POST)) {

    //$name = $_POST['name'];

    $insertionArray = array();

    foreach($allUserMeta as $key => $value) {
        if (isset($_POST[$value[1]]) && $_POST[$value[1]]!='') {
            $insertionArray[$value[1]] = $_POST[$value[1]];
        }
    }

    // update
    $id = $_POST['name'];
    $query = array('name'=> $id);
    $userCollection->update($query, array('$set' => $insertionArray));

    // INSERT -- temporary until I create Register page
    //$userCollection->insert($post);

    echo "<pre>";
    print_r($_POST);
    echo "<br><br><br>";
    print_r($insertionArray);

}

//header('Location: index.php');
//header('Location: usersettings.php');
