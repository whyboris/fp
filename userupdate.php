<?php

session_start();

require('connection.php');

include('usersettingsfactory.php');

if (!empty($_POST)) {

    //$name = $_POST['name'];

    $insertionArray = array();

    // showMe($allUserMeta);

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
    //$userCollection->insert($query);

     //showMe($_POST);

     //showMe($insertionArray);

}

//header('Location: index.php');
header('Location: usersettings.php');
