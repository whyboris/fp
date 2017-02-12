<?php

$dataTables = 1;

include('header.php');

$userType = $userCollection->findOne(array('name'=>$userName))['type'];

if ($_SESSION['name'] == 'admin' || $userType == 'admin'){
    // allow to view this page
} else {
    header('location: index.php');
}

?>

<center>

    <div class="row">
        <div class="col-md-2 col-md-offset-5"><a href="user.php?newUser=yes"><button type="button" class="btn btn-default">Create New User</button></a></div>
    </div>

<div class="row">

<?php

    $searchQuery = array();

    $users = $userCollection->find($searchQuery);

    $tempCounter = 1;

    ?>
        <div class="container">

        <table id="example" class="table table-striped" >
            <thead>
                <tr>
                    <th><center>#</center></th>
                    <th>Username</th>
                    <th>Last Name</th>
                    <th>Blog</th>
                    <th>Type</th>
                    <th><center>Department</center></th>
                    <th><center>Delete</center></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user){ ?>
                    <tr>
                        <td><center><a href="user.php?id=<?php echo $user['_id']; ?>"><?php echo $tempCounter; $tempCounter++ ?></a></center></td>

                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['lastName']; ?></td>
                        <td><?php echo $user['blogId']; ?></td>
                        <td><?php echo $user['type']; ?></td>
                        <td><?php echo $user['department']; ?></td>
                        <td><center><a href="delete.php?id=<?php echo $user['_id']; ?>&item=user">x</a></center></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
