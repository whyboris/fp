<?php

$dataTables = 1;

include('header.php');

?>

<center>

    <div class="row">
        <div class="col-md-2 col-md-offset-5"><a href="post.php"><button type="button" class="btn btn-default">Create New User</button></a></div>
    </div>

<div class="row">

<?php

    require 'connection.php';

    $isAdmin = false;

    if ($_SESSION['name'] == 'admin'){
        $isAdmin = true;
        $searchQuery = array();
    } else {
        $searchQuery = array('author'=>$_SESSION['name']);
    }

    $users = $userCollection->find($searchQuery);

    $tempCounter = 1;

    ?>
        <div class="container">

        <table id="example" class="table table-striped" >
            <thead>
                <tr>
                    <th><center>#</center></th>
<?php

    if ($isAdmin == true){
        echo "<th>Author</th>";
    }
?>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Type</th>
                    <th><center>Department</center></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user){ ?>
                    <tr>
                        <td><center><a href="post.php?id=<?php echo $user['_id']; ?>"><?php echo $tempCounter; $tempCounter++ ?></a></center></td>
<?php

    if ($isAdmin == true){
        echo "<td>";
        echo $user['name'];
        echo "</td>";
    }

?>
                        <td><?php echo $user['lastName']; ?></td>
                        <td><?php echo $user['blogId']; ?></td>
                        <td><?php echo $user['type']; ?></td>
                        <td><?php echo $user['department']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
