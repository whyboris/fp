<?php

// functions to render elements: dropdowns, radio, & checkboxes


// specialty just for screen options
// dbSavedAarray will be implemented later
function renderScreenOptionsCheckBoxes($optionsArray, $dbSavedArray, $fieldName) {

    // echo "<pre>";
    // print_r($dbSavedArray);
    // echo "</pre>";

    foreach ($optionsArray as $key => $displayName) {

        $selected = '';

//        if (isset($dbSavedArray) && $dbSavedArray != '') {
//            foreach ($dbSavedArray as $key2 => $value2) {
//                if ($key == $value2) {
                    $selected = 'checked';
//                }
//            }
//        }

        echo '<div class="checkbox">';
        echo '<label><input type="checkbox" id="'.$key.'ScreenOptions" data-target="'.$key.'" name="' . $key . '" value="'. $key . '" '.$selected.'>' . $displayName . '</label>';
        echo '</div>';
    }

}


 ?>
