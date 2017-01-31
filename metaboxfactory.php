<?php

//global $allMetaBoxes initialize empty array;
$allMetaBoxes = array();

// Register meta boxes
// stores all that was registered into an array for later retrieval
function registerMetaBox($displayName, $uniqueId, $functionToCall, $order = 5) {
    global $allMetaBoxes;
    array_push($allMetaBoxes, array($displayName, $uniqueId, $functionToCall, $order));
}


// output metabox HTML
function displayAllMetaBoxes(){

    global $allMetaBoxes;

    // custom sort the metaboxes according to their order (4th element in array)
    function compareOrder($a, $b) {
        return $a['3'] - $b['3'];
    }
    usort($allMetaBoxes, 'compareOrder');

    foreach ($allMetaBoxes as $key => $value) {
        metaboxPrefix($allMetaBoxes[$key][0],$allMetaBoxes[$key][1]);
        // execute the function registered with its metabox
        $allMetaBoxes[$key][2]($allMetaBoxes[$key][1]);
        metaboxSuffix();
    }

}

// metabox top HTML
function metaboxPrefix($displayName, $uniqueId) {
    echo '<div class="panel panel-default" id="' . $uniqueId . '">';
    //echo '<label for="' . $uniqueId . '">' . $displayName. '</label><br>';
    echo '<div class="panel-heading">' . $displayName;
    // toggle icon div
    //echo '<div class="pull-right"><a href="#'. $uniqueId .'Panel" data-toggle="collapse" class="text-right btn btn-xs">&#x25BE;</a></div>';

    echo '<div class="pull-right"><span class="arrow-toggle" data-toggle="collapse" data-target="#'. $uniqueId .'Panel" id="collapseP"><span class="icon-arrow-down"><btn class="btn btn-default btn-circle">&uarr;</button></span><span class="icon-arrow-up"><btn class="btn btn-default btn-circle">&darr;</button></span></span></div>';

    echo '</div>';
    echo '<div id="'.$uniqueId.'Panel" class="panel-collapse collapse in">';
    echo '<div class="panel-body">';
}

// metabox bottom HTML
function metaboxSuffix() {
    echo '</div>';
    echo '</div>';
    echo '</div>';
}


include_once('renderelements.php');



?>
