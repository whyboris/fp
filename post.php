<?php

include('header.php');

include('metaboxes.php');

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

<?php
    metaboxPrefix('Title', 'titleMetabox');

    echo '<input type="text"  class="form-control" name="title" value="' . $title . '">';

    metaboxSuffix();

    metaboxPrefix('Content', 'contentMetabox');

    echo '<textarea class="form-control" name="content" rows="14">' . $content . '</textarea>';

    metaboxSuffix();

    metaboxPrefix('Excerpt', 'excerptMetabox');

    echo '<textarea class="form-control" name="excerpt" rows="4">' . $excerpt . '</textarea>';

    metaboxSuffix();

    echo '</div>';

    echo '<div class="col-md-4">';

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


    metaboxPrefix('Save', 'publishMetabox');

    echo '<input class="btn btn-default" type="submit" value="Save">';

    metaboxSuffix();

?>

            </form>
        </div>
    </div>
</div>

</center>
