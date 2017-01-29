<?php

include('header.php');

include('metaboxfactory.php');

require('connection.php');

// grab user's settings from database

    // later will be an ID -- at the moment just use the NAME
    $id = $_SESSION['name'];

    $query = array('name'=> $id);
    $userSettings = $userCollection->findOne($query);

    $lastName = $userSettings['lastName'];
    $type = $userSettings['type'];
    $salary = $userSettings['salary'];

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <form class="form-horizontal" action="edituser.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

<?php

function renderUserSetting($displayName, $fieldName, $value){
    echo '<div class="form-group">';

        echo '<label class="control-label col-sm-3" for="name">'.$displayName.'</label>';

        echo '<div class="col-sm-9"><input type="text"  class="form-control" name="'.$fieldName.'" value="'.$value.'"></div>';

    echo '</div>';
}

include('usersettingscreation.php');

metaboxPrefix('Personal', 'personalMetabox');

foreach ($allUserMeta as $key => $value) {
    if ($value[2] == 1) {
        renderUserSetting($value[0], $value[1], $userSettings[$value[1]]);
    }
}
//renderUserSetting('First Name', 'name', $id);
//renderUserSetting('Last Name', 'lastName', $lastName);
//renderUserSetting('Twitter', 'twitter', $twitter);

metaboxSuffix();

metaboxPrefix('Professional', 'professionalMetabox');

foreach ($allUserMeta as $key => $value) {
    if ($value[2] == 2) {
        renderUserSetting($value[0], $value[1], $userSettings[$value[1]]);
    }
}

//renderUserSetting('Contributor Type', 'type', $type);
//renderUserSetting('Salary', 'salary', $salary);

metaboxSuffix();

echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';

//echo "<pre>";
//print_r($userSettings);
//echo "</pre>";

//echo "<pre>";
//print_r($allUserMeta);
//echo "</pre>";

 ?>
