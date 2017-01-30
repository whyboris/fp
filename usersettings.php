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

function renderUserSetting($displayName, $fieldName, $value, $optionsArray, $selectionType){
    echo '<div class="form-group">';

        echo '<label class="control-label col-sm-3" for="name">'.$displayName.'</label>';

        echo '<div class="col-sm-9">';

        // convert to SWITCH / CASE
        if ($selectionType === null) {
            echo '<input type="text"  class="form-control" name="'.$fieldName.'" value="'.$value.'">';
        } elseif ($selectionType == 'dropdown') {
            echo '<div class="selectpicker">';
            echo '<select class="form-control" name="'. $fieldName . '">';
            foreach ($optionsArray as $key => $value2) {
                $selected = '';
                if ($value == $key) {
                    $selected = 'selected';
                }
                echo '<option value="'.$key.'" '.$selected.'>'.$value2.'</option>';
            }
            echo '</select>';
            echo '</div>';
        } elseif ($selectionType == 'radio') {
            foreach ($optionsArray as $key => $value2) {

                $selected = '';
                if ($value == $key) {
                    $selected = 'checked';
                }

                echo '<div class="radio">';
                echo '<label><input type="radio" name="' . $fieldName . '" value="' . $key . '" '.$selected.'>' . $value2 . '</label>';
                echo '</div>';
            }
        } elseif ($selectionType == 'checkboxes') {

            foreach ($optionsArray as $key => $value3) {

                $selected = '';

                $chosenValue = $value;

                // chosen value can be an array!
                if (isset($chosenValue)) {
                    foreach ($chosenValue as $key2 => $value2) {
                        if ($key == $value2) {
                            $selected = 'checked';
                        }
                    }
                }

                echo '<div class="checkbox">';
                echo '<label><input type="checkbox" name="' . $fieldName . '[]" value="'. $key . '" '.$selected.'>' . $value3 . '</label>';
                echo '</div>';
            }
        }


        echo '</div>';

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
                renderUserSetting($value[0], $value[1], $userSettings[$value[1]], $value[3], $value[4]);
            } else {
                renderUserSetting($value[0], $value[1], '', $value[3], $value[4]);
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

echo "<pre>";
print_r($allUserMeta);
echo "</pre>";

 ?>
