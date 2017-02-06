<?php

session_start();

require('connection.php');

include('usersettingsfactory.php');

$redirect = 'index.php';

if (!empty($_POST)) {

    // either "user" or "blog" or "post"
    $origin = $_POST['origin'];

    $insertionArray = array();

    if ($origin == 'post') {
        include('metaboxes.php');
        $sourceOfData = $allMetaBoxes;
        $theCollection = $postCollection;

        // manually enter some fields
        // TODO -- automate later
        $title = $_POST['title'];
        $content = $_POST['content'];
        $excerpt = $_POST['excerpt'];
        $author = $_SESSION['name'];

        $redirect = 'post.php?id=' . $_POST['id'];

        $insertionArray = array(
            'title'=>$title,
            'content'=>$content,
            'excerpt'=>$excerpt,
            'author'=>$author,
            'time'=> new MongoDate(),
        );

    } elseif ($origin == 'blog'){
        $sourceOfData = $allBlogMeta;
        $theCollection = $blogCollection;
        $redirect = 'blogsettings.php';
    } elseif ($origin == 'user') {
        $sourceOfData = $allUserMeta;
        $theCollection = $userCollection;
        $redirect = 'usersettings.php';
    }

    // prepare the array to insert into DB
    // TODO -- allow all checkboxes to be unchecked -- currently they don't update if all unchecked!
    foreach ($sourceOfData as $key => $value) {
        $current = $sourceOfData[$key][1];
        //showMe($current);
        if (isset($_POST[$current])) {
            $insertionArray[$current]= $_POST[$current];
        }
    }

    if ($_POST['id'] != 0) {
        // UPDATE current article
        $id = $_POST['id'];
        $query = array('_id'=> new MongoId($id));
        // only updates fields that are in the form; doesn't update checkboxes if they are all disselected
        // $theCollection->update($query, array('$set' => $insertionArray));
        $theCollection->update($query, $insertionArray);

    } else {
        // INSERT new article
        // TODO -- fix this -- may error out with blog settings & user settings
        $theCollection->insert($insertionArray);
    }


}

// LOG STUFF
// echo "POST:";
// echo "<br>";
// showMe($_POST);
// showMe($allUserMeta);
// showMe($allBlogMeta);
// showMe($insertionArray);
// echo "SOURCE OF DATA:";
// echo "<br>";
// showMe($sourceOfData);

header('Location: ' . $redirect);
