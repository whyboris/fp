<?php

include('header.php');

include('metaboxfactory.php');

require 'connection.php';

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

            <form class="bs-example bs-example-form" action="edituser.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

<?php
metaboxPrefix('Personal', 'personalMetabox');
echo '<p>First Name</p>';
echo '<input type="text"  class="form-control" name="name" value="'.$id.'" readonly>';
echo '<br>';
echo '<p>Last Name</p>';
echo '<input type="text"  class="form-control" name="lastName" value="'.$lastName.'">';
metaboxSuffix();

metaboxPrefix('Professional', 'professionalMetabox');
echo '<p>Contributor Type</p>';
echo '<input type="text"  class="form-control" name="type" value="'.$type.'">';
echo '<br>';
echo '<p>Salary</p>';
echo '<input type="text"  class="form-control" name="salary" value="'.$salary.'">';
metaboxSuffix();



echo '<div><input class="btn btn-default" type="submit" value="Save"></div>';


 ?>
