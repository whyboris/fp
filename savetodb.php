<?php

session_start();

require('connection.php');

include('settingsfactory.php');



$redirect = 'index.php';

if (!empty($_POST)) {

    // either "user" or "blog" or "post"
    $origin = $_POST['origin'];

    $insertionArray = array();

    if ($origin == 'post') {
        include_once('post_contents.php');
        $sourceOfData = $allMetaBoxes;
        $theCollection = $postCollection;

        // manually enter some fields
        // TODO -- automate later
        $title = $_POST['title'];
        $content = $_POST['content'];
        $excerpt = $_POST['excerpt'];
        $author = $_SESSION['name'];

        if ($_POST['id'] != 0) {
            $redirect = 'post.php?id=' . $_POST['id'];
        } else {
            $redirect = 'index.php';
        }

        $insertionArray = array(
            'title'=>$title,
            'content'=>$content,
            'excerpt'=>$excerpt,
            'author'=>$author,
            'time'=> new MongoDate(),
        );

    } elseif ($origin == 'blog'){
        include('blog_contents.php');
        $sourceOfData = $allBlogMeta;
        $theCollection = $blogCollection;
        $redirect = 'blog.php';
        // temporary solution to a bug
        $insertionArray['blogId'] = $_POST['blogId'];
    } elseif ($origin == 'user') {
        include('user_contents.php');
        $sourceOfData = $allUserMeta;
        $theCollection = $userCollection;
        $redirect = 'user.php';
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
        // UPDATE current item
        $id = $_POST['id'];
        $query = array('_id'=> new MongoId($id));

        // Next line of code only updates fields that are in the form; doesn't update checkboxes if they are all disselected
        // $theCollection->update($query, array('$set' => $insertionArray));

        // updates entire record in the collection
        $theCollection->update($query, $insertionArray);

    } else {
        // INSERT new item
        // TODO -- fix this -- may error out with blog settings & user settings
        $theCollection->insert($insertionArray);
    }


}

// LOG STUFF
// echo "POST:";
// echo "<br>";
// showMe($_POST);
// showMe($allUserMeta);
// showMe($insertionArray);
// showMe($allBlogMeta);
// echo "SOURCE OF DATA:";
// echo "<br>";
// showMe($sourceOfData);

header('Location: ' . $redirect);
