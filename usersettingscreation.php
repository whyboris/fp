<?php


$allUserMeta = array();

// group ID 
function registerUserMeta($displayName, $fieldName, $groupId = 1) {
    global $allUserMeta;
    array_push($allUserMeta, array($displayName, $fieldName, $groupId));
}

// Group 1
registerUserMeta('First Name', 'name', 1);
registerUserMeta('Last Name', 'lastName', 1);
registerUserMeta('Twitter', 'twitter', 1);
registerUserMeta('Facebook', 'facebook', 1);
registerUserMeta('Instagram', 'instagram', 1);

// Group 2
registerUserMeta('Contributor Type', 'type', 2);
registerUserMeta('Salary', 'salary', 2);
registerUserMeta('Department', 'department', 2);


 ?>
