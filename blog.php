<?php

include('header.php');

include('settingsfactory.php');

require('connection.php');

include('blog_contents.php');

// TEMPORARY WORKFLOW:
// get user's primary blog -- show them settings for that blog
// later design better system for which blogs one can edit
// and whether a user can have many blogs they are a part of
// RESULT:
// always show settings for user's default blog id

// grab user's settings from database
// later will be an ID -- at the moment just use the NAME
if (isset($_GET['newBlog']) && ($_GET['newBlog']=='yes')){
    // don't grab anything from the database
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = array('_id'=> new MongoId($id));

    } else {

        $id = $_SESSION['name'];
        $query = array('name'=> $id);
        $userSettings = $userCollection->findOne($query);
        // find user's default blog
        //showMe($userSettings);
        // get blog ID so they can edit edit it
        $blogId = $userSettings['blogId'];
        $query = array('blogId'=>$blogId);
    }

    $blogSettings = $blogCollection->findOne($query);
    $mongoBlogId = $blogSettings['_id'];

    $blogId = $blogSettings['blogId'];
}

//showMe($blogId);

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="savetodb.php" method="post">

                <!--<input style="text" class="hidden" name="blogId" value="<?php echo $blogId; ?>">-->

                <input style="text" class="hidden" name="id" value="<?php echo $mongoBlogId; ?>">

                <input style="text" class="hidden" name="origin" value="blog">

<?php



// Display Group 1
displayMetaSettingsGroup('Main settings', 'blogMetabox', 3, 'blog');

// Display Group 2
displayMetaSettingsGroup('Other settings', 'blogOtherMetabox', 4, 'blog');


echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

// showMe($userSettings);

// showMe($allUserMeta);


 ?>
