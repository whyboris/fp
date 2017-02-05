<?php

$allUserMeta = array();
$allBlogMeta = array();

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
registerMeta('First Name', 'name', 'user', 1);
registerMeta('Last Name', 'lastName', 'user', 1);
registerMeta('Blog ID', 'blogId', 'user', 1);
registerMeta('Twitter', 'twitter', 'user', 1);
registerMeta('Facebook', 'facebook', 'user', 1);
registerMeta('Instagram', 'instagram', 'user', 1);

// Register Fields for Group 2
registerMeta('Contributor Type', 'type', 'user', 2, $contribTypeArray, 'dropdown');
registerMeta('Salary', 'salary', 'user', 2);
registerMeta('Department', 'department', 'user', 2, $deptArray, 'radio');
registerMeta('Privileges', 'privilege', 'user', 2, $privilegeArray, 'checkboxes');

// for BLOG SETTINGS
registerMeta('DO NOT CHANGE', 'name', 'blog', 3);
registerMeta('Category', 'category', 'blog', 3);
registerMeta('Subtitle', 'subtitle', 'blog', 3);
registerMeta('Primary Author', 'primaryAuthor', 'blog', 3);

/**
 * Register user meta field -- if no $selectionType set, defaults to text field
 * @param  string   $displayName    Name of field shown to user
 * @param  string   $fieldName      field name for database
 * @param  string   $whoFor         either 'user', or 'blog'
 * @param  integer  $groupId        categorize entries into groups
 * @param  array    $optionsArray   array of options if selection type is not null
 * @param  string   $selectionType  Must be 'dropdown', 'radio', 'checkboxes'
 * @return void
 */
function registerMeta($displayName, $fieldName, $whoFor, $groupId = 1, $optionsArray = null, $selectionType = null) {
    global $allUserMeta;
    global $allBlogMeta;
    if ($whoFor == 'user') {
        array_push($allUserMeta, array($displayName, $fieldName, $groupId, $optionsArray, $selectionType));
    } elseif ($whoFor == 'blog') {
        array_push($allBlogMeta, array($displayName, $fieldName, $groupId, $optionsArray, $selectionType));
    }

}

/**
 * Render User Settings
 * @param  string   $displayName    [description]
 * @param  string   $fieldName      [description]
 * @param  mixed    $dbValue        current value stored in a databse (string or array)
 * @param  array    $optionsArray   OPTIONAL -- array containing options for user
 * @param  string   $selectionType  can be 'dropdown', 'radio', or 'checkboxes'
 * @return void
 */
function renderUserSetting($displayName, $fieldName, $dbValue, $optionsArray, $selectionType){
    echo '<div class="form-group">';

        echo '<label class="control-label col-sm-3" for="name">'.$displayName.'</label>';

        echo '<div class="col-sm-9">';

        switch ($selectionType) {
            case null:
                echo '<input type="text"  class="form-control" name="'.$fieldName.'" value="'.$dbValue.'">';
                break;
            case 'dropdown':
                renderDropdown($optionsArray, $fieldName, 'user');
                break;
            case 'radio':
                renderRadioButtons($optionsArray, $fieldName, 'user');
                break;
            case 'checkboxes':
                renderCheckboxes($optionsArray, $fieldName, 'user');
                break;
        }

        echo '</div>';

    echo '</div>';
}

include_once('renderelements.php');

/**
 * Render all the user settings
 *
 * Separates into groups
 * @param  string   $groupDisplayName   Group name to display
 * @param  string   $groupDivId         Div id for jQuery to grab (not needed yet)
 * @param  string   $groupNumber        Render out only user meta for this group number
 * @param  string   $whichMeta          Can be 'blog' or 'user'
 * @return void
 */
function displayMetaSettingsGroup($groupDisplayName, $groupDivId, $groupNumber, $whichMeta) {

    $theUserMeta = array();

    if ($whichMeta == 'blog') {
        global $blogSettings;
        global $allBlogMeta;
        $theUserMeta = $allBlogMeta;
        $metaSettings = $blogSettings;
    } elseif ($whichMeta == 'user'){
        global $allUserMeta;
        global $userSettings;
        $theUserMeta = $allUserMeta;
        $metaSettings = $userSettings;
    }

    metaboxPrefix($groupDisplayName, $groupDivId);


    // cycle through all the registered meta
    foreach ($theUserMeta as $key => $value) {
        if ($value[2] == $groupNumber) {
            if (isset($metaSettings[$value[1]])){
                renderUserSetting($value[0], $value[1], $metaSettings[$value[1]], $value[3], $value[4]);
            } else {
                renderUserSetting($value[0], $value[1], '', $value[3], $value[4]);
            }
        }
    }

    metaboxSuffix();

}


 ?>
