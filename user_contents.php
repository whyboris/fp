<?php

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
registerMeta('Department', 'department', 'user', 2, $deptArray, 'radio');
registerMeta('Privileges', 'privilege', 'user', 2, $privilegeArray, 'checkboxes');
registerMeta('Salary', 'salary', 'user', 2);



 ?>
