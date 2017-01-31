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
    $post = $postCollection->findOne($query);

    $title = $post['title'];
    $content =  $post['content'];
    $excerpt =  $post['excerpt'];

}

?>
<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                Screen Options
            </button>

            <br><br>

            <form class="bs-example bs-example-form" action="postsubmit.php" method="post">

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

metaboxPrefix('Save', 'publishMetabox');
echo "<p>Please don't forget to check spelling!</p>";
echo '<div class="pull-right"><input class="btn btn-default" type="submit" value="Save"></div>';
metaboxSuffix();


echo "<div style='clear: both'>";
echo "<pre>";
print_r($arrayOfSelectedOptions);
echo "</pre>";

?>

            </form>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel">Screen Options</h5>
      </div>
      <div class="modal-body">
<?php

include_once('renderelements.php');

$screenOptions = array();

foreach($allMetaBoxes as $key => $value) {
    $screenOptions[$value[1]] =  $value[0];
}

echo "<div id='allOptions'>";
renderScreenOptionsCheckBoxes($screenOptions, $screenOptions, 'screenOptions');
echo "</div>";

// echo "<pre>";
// print_r($screenOptions);
// echo "</pre>";

?>
      </div>
    </div>
  </div>
</div>
