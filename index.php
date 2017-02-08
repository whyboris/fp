<?php

$dataTables = 1;

include('header.php');

?>

<center>

    <div class="row">
        <div class="col-md-2 col-md-offset-5"><a href="post.php"><button type="button" class="btn btn-default">Post something new</button></a></div>
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

    $articles = $postCollection->find($searchQuery);
    $article_count = $articles->count();

    $tempCounter = 1;

    echo "<br>";
    echo 'You have ' . $article_count . ' articles published!<br/>';
    echo "<br>";

    if ($article_count > 0) {
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
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Time</th>
                    <th><center>Delete</center></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $post){ ?>
                    <tr>
                        <td><center><a href="post.php?id=<?php echo $post['_id']; ?>"><?php echo $tempCounter; $tempCounter++ ?></a></center></td>
<?php

    if ($isAdmin == true){
        echo "<td>";
        echo $post['author'];
        echo "</td>";
    }

?>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo substr($post['excerpt'], 0, 30) . '...'; ?></td>
                        <td><?php echo date('Y-M-d h:i:s', $post['time']->sec); ?></td>
                        <td><center><a href="postdelete.php?id=<?php echo $post['_id']; ?>">x</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
}
?>
