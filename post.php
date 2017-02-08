<?php

include('header.php');
include('settingsfactory.php');
include('post_contents.php');

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

// store all post meta-data into array!
$arrayOfSelectedOptions = array();
foreach ($allMetaBoxes as $key => $value) {
    $fieldName = $allMetaBoxes[$key][1];
    if (isset($post[$fieldName])) {
        $fieldValue = $post[$fieldName];
        $arrayOfSelectedOptions[$fieldName] = $fieldValue;
    }
}

?>
<div class="container-fluid">

    <div class="row row-fluid">

        <div class="col-md-offset-1 col-md-6">

            <!-- Button to trigger modal -->


            <form id="thePostForm" class="bs-example bs-example-form" action="savetodb.php" method="post">

                <input style="text" class="hidden" name="id" value="<?php echo $id; ?>">

                <input style="text" class="hidden" name="origin" value="post">

<?php

// Default must-show fields:

//metaboxPrefix('Title', 'titleMetabox');

echo '<div class="">';
echo '<label for="title">Headline</label>';
echo '<input type="text"  class="form-control" name="title" value="' . $title . '">';
echo '<br>';
echo '</div>';
//metaboxSuffix();

//metaboxPrefix('Content', 'contentMetabox');
//echo '<textarea class="form-control" name="content" rows="14">' . $content . '</textarea>';
echo '<input class="hidden" id="thePostContents" value="'.$content.'" name="content">';
//metaboxSuffix();

echo '<div id="summernote"></div>';

metaboxPrefix('Excerpt', 'excerptMetabox');
echo '<textarea class="form-control" name="excerpt" rows="4">' . $excerpt . '</textarea>';
metaboxSuffix();

echo '</div>';

// Right-side meta-boxes

echo '<div class="col-md-4">';

displayAllMetaBoxes();

metaboxPrefix('Save', 'publishMetabox');
echo "<p>Please don't forget to check spelling!</p>";
echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Screen Options</button>';
echo '<div class="pull-right"><input id="thePostSubmitButton" class="btn btn-default" type="submit" value="Save"></div>';
metaboxSuffix();


//showMe($arrayOfSelectedOptions);


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

// showMe($screenOptions);

?>
      </div>
    </div>
  </div>
</div>
