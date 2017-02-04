<?php

include('header.php');

include('metaboxfactory.php');

require('connection.php');

include('usersettingsfactory.php');

// grab user's settings from database
// later will be an ID -- at the moment just use the NAME
$id = $_SESSION['name'];
$query = array('name'=> $id);
$blogSettings = $blogCollection->findOne($query);

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="savetodb.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

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
