<?php

$allUserMeta = array();

$contribTypeArray = array(
    'contributor' => 'Contributor',
    'editor' => 'Editor',
    'staff' => 'Staff',
);

$deptArray = array(
    'dev' => 'Developers',
    'art' => 'Art',
    'editorial' => 'Editorial',
);

$privilegeArray = array(
    'coffee' => 'Free coffee',
    'icecream' => 'Free ice cream',
    'cookies' => 'Free cookies',
);

// Register Fields for Group 1
registerUserMeta('First Name', 'name', 1);
registerUserMeta('Last Name', 'lastName', 1);
registerUserMeta('Twitter', 'twitter', 1);
registerUserMeta('Facebook', 'facebook', 1);
registerUserMeta('Instagram', 'instagram', 1);

// Register Fields for Group 2
registerUserMeta('Contributor Type', 'type', 2, $contribTypeArray, 'dropdown');
registerUserMeta('Salary', 'salary', 2);
registerUserMeta('Department', 'department', 2, $deptArray, 'radio');
registerUserMeta('Privileges', 'privilege', 2, $privilegeArray, 'checkboxes');

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

/**
 * Render User Settings
 * @param  string   $displayName    [description]
 * @param  string   $fieldName      [description]
 * @param  mixed    $dbValue          current value stored in a databse (string or array)
 * @param  array    $optionsArray   OPTIONAL -- array containing options for user
 * @param  string   $selectionType  can be 'dropdown', 'radio', or 'checkboxes'
 * @return void
 */
function renderUserSetting($displayName, $fieldName, $dbValue, $optionsArray, $selectionType){
    echo '<div class="form-group">';

        echo '<label class="control-label col-sm-3" for="name">'.$displayName.'</label>';

        echo '<div class="col-sm-9">';

        // convert to SWITCH / CASE
        if ($selectionType === null) {
            echo '<input type="text"  class="form-control" name="'.$fieldName.'" value="'.$dbValue.'">';
        } elseif ($selectionType == 'dropdown') {
            renderDropdown($optionsArray, $fieldName, $dbValue);
        } elseif ($selectionType == 'radio') {
            renderRadioButtons($optionsArray, $fieldName, $dbValue);
        } elseif ($selectionType == 'checkboxes') {
            renderCheckboxes($optionsArray, $fieldName, $dbValue);
        }


        echo '</div>';

    echo '</div>';
}


function renderDropdown($optionsArray, $fieldName, $dbValue) {
    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="'. $fieldName . '">';
    foreach ($optionsArray as $key => $value2) {
        $selected = '';
        if ($dbValue == $key) {
            $selected = 'selected';
        }
        echo '<option value="'.$key.'" '.$selected.'>'.$value2.'</option>';
    }
    echo '</select>';
    echo '</div>';
}

function renderRadioButtons($optionsArray, $fieldName, $dbValue) {
    foreach ($optionsArray as $key => $value2) {

        $selected = '';
        if ($dbValue == $key) {
            $selected = 'checked';
        }

        echo '<div class="radio">';
        echo '<label><input type="radio" name="' . $fieldName . '" value="' . $key . '" '.$selected.'>' . $value2 . '</label>';
        echo '</div>';
    }
}

function renderCheckboxes($optionsArray, $fieldName, $dbValue) {

    foreach ($optionsArray as $key => $value3) {

        $selected = '';

        // chosen value can be an array!
        if (isset($dbValue) && $dbValue != '') {
            foreach ($dbValue as $key2 => $value2) {
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
