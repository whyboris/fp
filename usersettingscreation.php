<?php


$allUserMeta = array();

function registerUserMeta($displayName, $fieldName, $groupId = 1) {
    global $allUserMeta;
    array_push($allUserMeta, array($displayName, $fieldName, $groupId));
}

registerUserMeta('First Name', 'name', 1);
registerUserMeta('Last Name', 'lastName', 1);
registerUserMeta('Twitter', 'twitter', 1);
registerUserMeta('Facebook', 'facebook', 1);

registerUserMeta('Contributor Type', 'type', 2);
registerUserMeta('Salary', 'salary', 2);
registerUserMeta('Department', 'department', 2);


 ?>
