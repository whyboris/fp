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
        <div class="col-md-2 col-md-offset-5"><a href="blog.php?newBlog=yes"><button type="button" class="btn btn-default">Create New Blog</button></a></div>
    </div>

<div class="row">

<?php

    include_once('connection.php');


    $searchQuery = array();
    $blogs = $blogCollection->find($searchQuery);

    $tempCounter = 1;

    ?>
        <div class="container">

        <table id="example" class="table table-striped" >
            <thead>
                <tr>
                    <th><center>#</center></th>
                    <th>blogId</th>
                    <th>Name</th>
                    <th>Subtitle</th>
                    <th>Category</th>
                    <th><center>Primary Author</center></th>
                    <th><center>Delete</center></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($blogs as $blog){ ?>
                    <tr>
                        <td><center><a href="blog.php?id=<?php echo $blog['_id']; ?>"><?php echo $tempCounter; $tempCounter++ ?></a></center></td>

                        <td><?php echo $blog['blogId']; ?></td>
                        <td><?php echo $blog['name']; ?></td>
                        <td><?php echo $blog['subtitle']; ?></td>
                        <td><?php echo $blog['category']; ?></td>
                        <td><?php echo $blog['primaryAuthor']; ?></td>
                        <td><center><a href="delete.php?id=<?php echo $user['_id']; ?>&item=blog">x</a></center></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
