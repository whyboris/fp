<?php

$allUserMeta = array();

/**
 * Register user meta field -- if no $selectionType set, defaults to text field
 * @param  string   $displayName    Name of field shown to user
 * @param  string   $fieldName      field name for database
 * @param  integer  $groupId        categorize entries into groups
 * @param  array    $optionsArray   array of options if selection type is not null
 * @param  string   $selectionType  Must be 'dropdown', 'radio', 'checkboxes'
 * @return void
 */
function registerUserMeta($displayName, $fieldName, $groupId = 1, $optionsArray = null, $selectionType = null) {
    global $allUserMeta;
    array_push($allUserMeta, array($displayName, $fieldName, $groupId, $optionsArray, $selectionType));
}

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
                if (isset($chosenValue) && $chosenValue != '') {
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





 ?>
