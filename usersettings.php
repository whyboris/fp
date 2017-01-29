<?php

include('header.php');

include('metaboxfactory.php');

require('connection.php');

// grab user's settings from database

    // later will be an ID -- at the moment just use the NAME
    $id = $_SESSION['name'];

    $query = array('name'=> $id);
    $userSettings = $userCollection->findOne($query);

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="updateuser.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

<?php

function renderUserSetting($displayName, $fieldName, $value){
    echo '<div class="form-group">';

        echo '<label class="control-label col-sm-3" for="name">'.$displayName.'</label>';

        echo '<div class="col-sm-9"><input type="text"  class="form-control" name="'.$fieldName.'" value="'.$value.'"></div>';

    echo '</div>';
}

include('usersettingscreation.php');

/**
 * Render all the user settings
 *
 * Separates into groups
 * @param  string   $groupDisplayName   Group name to display
 * @param  string   $groupDivId         Div id for jQuery to grab (not needed yet)
 * @param  string   $groupNumber        Render out only user meta for this group number
 * @return void
 */
function displayUserSettingsGroup($groupDisplayName, $groupDivId, $groupNumber) {

    metaboxPrefix($groupDisplayName, $groupDivId);

    global $allUserMeta;
    global $userSettings;

    // cycle through all the registered user meta
    foreach ($allUserMeta as $key => $value) {
        if ($value[2] == $groupNumber) {
            if (isset($userSettings[$value[1]])){
                renderUserSetting($value[0], $value[1], $userSettings[$value[1]]);
            } else {
                renderUserSetting($value[0], $value[1], '');
            }
        }
    }

    metaboxSuffix();

}

displayUserSettingsGroup('Personal', 'personalMetabox', 1);

displayUserSettingsGroup('Professional', 'professionalMetabox', 2);


echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

//echo "<pre>";
//print_r($userSettings);
//echo "</pre>";

//echo "<pre>";
//print_r($allUserMeta);
//echo "</pre>";

 ?>
