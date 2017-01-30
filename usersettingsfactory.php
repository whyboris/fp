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

// Group 1
registerUserMeta('First Name', 'name', 1);
registerUserMeta('Last Name', 'lastName', 1);
registerUserMeta('Twitter', 'twitter', 1);
registerUserMeta('Facebook', 'facebook', 1);
registerUserMeta('Instagram', 'instagram', 1);

// Group 2
registerUserMeta('Contributor Type', 'type', 2, $contribTypeArray, 'dropdown');
registerUserMeta('Salary', 'salary', 2);
registerUserMeta('Department', 'department', 2, $deptArray, 'radio');
registerUserMeta('Privileges', 'privilege', 2, $privilegeArray, 'checkboxes')


 ?>