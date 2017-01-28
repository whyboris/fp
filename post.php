<?php

include('header.php');

$id = 0;
$title = '';
$content = '';
$excerpt = '';

if(!empty($_GET['id'])){

    require 'connection.php';

    $id = $_GET['id'];
    $query = array('_id'=> new MongoId($id));
    $post = $collection->findOne($query);

    $title = $post['title'];
    $content =  $post['content'];
    $excerpt =  $post['excerpt'];

}

?>

<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-8">

            <form class="bs-example bs-example-form" action="submit.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

                <label for="title">Title:</label>
                <input type="text"  class="form-control" name="title" value="<?php echo $title; ?>">

                <br>

                <label for="content">Content:</label>
                <textarea class="form-control" name="content" rows="10"><?php echo $content; ?></textarea>

                <br>

                <label for="excerpt">Excerpt:</label>
                <textarea class="form-control" name="excerpt" rows="3"><?php echo $excerpt; ?></textarea>

        </div>

        <div class="col-md-4">

<?php

include('metaboxes.php');

displayAllMetaBoxes();


// store all post meta-data into array!
$arrayOfSelectedOptions = array();
foreach ($allMetaBoxes as $key => $value) {
    $fieldName = $allMetaBoxes[$key][1];
    if (isset($post[$fieldName])) {
        $fieldValue = $post[$fieldName];
        $arrayOfSelectedOptions[$fieldName] = $fieldValue;
    }
}

echo "<div style='clear: both'>";
echo "<pre>";
print_r($arrayOfSelectedOptions);
echo "</pre>";

?>

                <input class="btn btn-default" type="submit" value="Save">

            </form>
        </div>
    </div>
</div>

</center>
