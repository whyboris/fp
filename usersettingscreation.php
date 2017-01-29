<?php


$allUserMeta = array();

function registerUserMeta($displayName, $fieldName, $groupId = 1) {
    global $allUserMeta;
    array_push($allUserMeta, array($displayName, $fieldName, $groupId));
}

registerUserMeta('First Name', 'name', 1);
registerUserMeta('Last Name', 'lastName', 1);
registerUserMeta('Twitter', 'twitter');
registerUserMeta('Contributor Type', 'type', 2);
registerUserMeta('Salary', 'salary', 2);


 ?>
