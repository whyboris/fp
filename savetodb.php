<?php

session_start();

require('connection.php');

include('usersettingsfactory.php');


function showMe($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

// LOG STUFF
showMe($_POST);
//showMe($allUserMeta);
//showMe($allBlogMeta);


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

        $insertionArray = array(
            'title'=>$title,
            'content'=>$content,
            'excerpt'=>$excerpt,
            'author'=>$author,
            'time'=> new MongoDate(),
        );

        //showMe($sourceOfData);

        // REFACTOR BELOW:
        foreach ($sourceOfData as $key => $value) {
            $current = $sourceOfData[$key][1];
            //showMe($current);
            if (isset($_POST[$current]) && $_POST[$current] !='') {
                $insertionArray[$current]= $_POST[$current];
            }
        }

        if ($_POST['id'] != 0) {
            // UPDATE current article
            $id = $_POST['id'];
            $query = array('_id'=> new MongoId($id));
            $theCollection->update($query, array('$set' => $insertionArray));
        } else {
            // INSERT new article
            $theCollection->insert($insertionArray);
        }

        // REFACTOR ABOVE!

    } else {

        if ($origin == 'blog'){
            $sourceOfData = $allBlogMeta;
            $theCollection = $blogCollection;
            $redirect = 'blogsettings.php';
        } elseif ($origin == 'user') {
            $sourceOfData = $allUserMeta;
            $theCollection = $userCollection;
            $redirect = 'usersettings.php';
        }

        foreach ($sourceOfData as $key => $value) {
            $current = $_POST[$value[1]];
            if (isset($current) && $current != '') {
                $insertionArray[$value[1]] = $current;
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

}

echo "SOURCE OF DATA:";
echo "<br>";
showMe($sourceOfData);

//header('Location: ' . $redirect);
