<?php

include('header.php');

include('metaboxfactory.php');

require('connection.php');

include('usersettingsfactory.php');

// TEMPORARY WORKFLOW:
// get user's primary blog -- show them settings for that blog
// later design better system for which blogs one can edit
// and whether a user can have many blogs they are a part of
// RESULT:
// always show settings for user's default blog id

// grab user's settings from database
// later will be an ID -- at the moment just use the NAME
$id = $_SESSION['name'];
$query = array('name'=> $id);
$userSettings = $userCollection->findOne($query);
// find user's default blog
//showMe($userSettings);
// get blog ID so they can edit edit it
$blogId = $userSettings['blogId'];

$query = array('blogId'=>$blogId);
$blogSettings = $blogCollection->findOne($query);
$blogId = $blogSettings['_id'];

//showMe($blogId);

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="savetodb.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $blogId; ?>">

                <input style="text" class="hidden" name="origin" value="blog">

<?php



// Display Group 1
displayMetaSettingsGroup('Personal', 'blogMetabox', 3, 'blog');

// Display Group 2
//displayMetaSettingsGroup('Professional', 'professionalMetabox', 2);


echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

// showMe($userSettings);

// showMe($allUserMeta);


 ?>
