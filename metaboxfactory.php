<?php

//global $allMetaBoxes initialize empty array;
$allMetaBoxes = array();

// Register meta boxes
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
        $allMetaBoxes[$key][2]($allMetaBoxes[$key][1]);
        metaboxSuffix();
    }

}

// metabox top HTML
function metaboxPrefix($displayName, $uniqueId) {
    echo '<div class="" id="' . $uniqueId . '">';
    echo '<label for="' . $uniqueId . '">' . $displayName. '</label><br>';
}

// metabox bottom HTML
function metaboxSuffix() {
    echo "</div>";
}

/**
 * Retrieves stored values
 *
 * used in each metabox to retrieve saved values
 * @param  string           $uniqueId       identifies the key containing stored values
 * @return string/array                     string or array containing stored values
 */
function fpGetMetaValue($uniqueId) {
    global $allMetaBoxes;

    global $post;

    foreach ($allMetaBoxes as $key => $value) {
        if ($allMetaBoxes[$key][1] == $uniqueId) {
            //echo $allMetaBoxes[$key][1];
            $fieldName = $allMetaBoxes[$key][1];
            // sometimes the value hasn't yet been saved
            if (isset($post[$fieldName])){
                return $post[$fieldName];
            }
        }
    }
}

?>
