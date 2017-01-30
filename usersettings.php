<?php

include('header.php');

include('metaboxfactory.php');

require('connection.php');

include('usersettingsfactory.php');

// grab user's settings from database
// later will be an ID -- at the moment just use the NAME
$id = $_SESSION['name'];
$query = array('name'=> $id);
$userSettings = $userCollection->findOne($query);

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="userupdate.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

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

// Display Group 1
displayUserSettingsGroup('Personal', 'personalMetabox', 1);

// Display Group 2
displayUserSettingsGroup('Professional', 'professionalMetabox', 2);


echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

// echo "<pre>";
// print_r($userSettings);
// echo "</pre>";

// echo "<pre>";
// print_r($allUserMeta);
// echo "</pre>";

 ?>
