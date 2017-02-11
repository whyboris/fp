<?php

include('header.php');

require('connection.php');

include('settingsfactory.php');

include('user_contents.php');

// grab user's settings from database
// later will be an ID -- at the moment just use the NAME
if (isset($_GET['newUser']) && ($_GET['newUser']=='yes')){
    // don't grab anything from the database
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = array('_id'=> new MongoId($id));
    } else {
        $id = $_SESSION['name'];
        $query = array('name'=> $id);
    }
    $userSettings = $userCollection->findOne($query);
    $userId = $userSettings['_id'];
}

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="savetodb.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $userId; ?>">

                <input style="text" class="hidden" name="origin" value="user">

<?php



// Display Group 1
displayMetaSettingsGroup('Personal', 'personalMetabox', 1, 'user');

// Display Group 2
displayMetaSettingsGroup('Professional', 'professionalMetabox', 2, 'user');


echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

// showMe($userSettings);

// showMe($allUserMeta);
//

$_POST['secret'] = 'WOW';


 ?>
