<?php

include('header.php');

include('metaboxfactory.php');

require('connection.php');

include('usersettingsfactory.php');

// grab user's settings from database
// later will be an ID -- at the moment just use the NAME
$id = $_SESSION['name'];
$query = array('name'=> $id);
$userSettings = $userCollection->findOne($query);

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="userupdate.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

<?php



// Display Group 1
displayUserSettingsGroup('Personal', 'personalMetabox', 1);

// Display Group 2
displayUserSettingsGroup('Professional', 'professionalMetabox', 2);


echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

// echo "<pre>";
// print_r($userSettings);
// echo "</pre>";
//
// echo "<pre>";
// print_r($allUserMeta);
// echo "</pre>";

 ?>
