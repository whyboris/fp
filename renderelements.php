<?php

// functions to render elements: dropdowns, radio, & checkboxes


// --------------------------------------
// from METABOX FACTORY
// --------------------------------------

/**
 * Create Radio Buttons
 */

function createRadioButtons($array, $uniqueId) {

    $chosenValue = fpGetPostMeta($uniqueId);

    foreach ($array as $key => $value) {

        $selected = '';
        if ($chosenValue == $key) {
            $selected = 'checked';
        }

        echo '<div class="radio">';
        echo '<label><input type="radio" name="' . $uniqueId . '" value="' . $key . '" '.$selected.'>' . $value . '</label>';
        echo '</div>';
    }

}

/**
 * Create Dropdown
 */

function createDropDown($array, $uniqueId) {

    $chosenValue = fpGetPostMeta($uniqueId);

    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="'. $uniqueId . '">';

    foreach ($array as $key => $value) {
        $selected = '';
        if ($chosenValue == $key) {
            $selected = 'selected';
        }
        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
    echo '</select>';
    echo '</div>';

}


/**
 * Create check boxes
 */

function createCheckBoxes($array, $uniqueId) {

    $chosenValue = fpGetPostMeta($uniqueId);

    foreach ($array as $key => $value) {

        $selected = '';

        // chosen value can be an array!
        if (isset($chosenValue)) {
            foreach ($chosenValue as $key2 => $value2) {
                if ($key == $value2) {
                    $selected = 'checked';
                }
            }
        }

        echo '<div class="checkbox">';
        echo '<label><input type="checkbox" name="' . $uniqueId . '[]" value="'. $key . '" '.$selected.'>' . $value . '</label>';
        echo '</div>';
    }

}


// --------------------------------------
// from USER SETTINGS FACTORY
// --------------------------------------

function fpGetUserMeta($fieldName) {
    global $userSettings;
    if (isset($userSettings[$fieldName])) {
        return $userSettings[$fieldName];
    } else {
        return null;
    }
}

function renderDropdown($optionsArray, $fieldName) {

    $dbValue = fpGetUserMeta($fieldName);

    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="'. $fieldName . '">';

    foreach ($optionsArray as $key => $value2) {
        $selected = '';
        if ($dbValue == $key) {
            $selected = 'selected';
        }
        echo '<option value="'.$key.'" '.$selected.'>'.$value2.'</option>';
    }
    echo '</select>';
    echo '</div>';
}

function renderRadioButtons($optionsArray, $fieldName) {

    $dbValue = fpGetUserMeta($fieldName);

    foreach ($optionsArray as $key => $value2) {

        $selected = '';
        if ($dbValue == $key) {
            $selected = 'checked';
        }

        echo '<div class="radio">';
        echo '<label><input type="radio" name="' . $fieldName . '" value="' . $key . '" '.$selected.'>' . $value2 . '</label>';
        echo '</div>';
    }
}

function renderCheckboxes($optionsArray, $fieldName) {

    $dbValue = fpGetUserMeta($fieldName);

    foreach ($optionsArray as $key => $value3) {

        $selected = '';

        // chosen value can be an array!
        if (isset($dbValue) && $dbValue != '') {
            foreach ($dbValue as $key2 => $value2) {
                if ($key == $value2) {
                    $selected = 'checked';
                }
            }
        }

        echo '<div class="checkbox">';
        echo '<label><input type="checkbox" name="' . $fieldName . '[]" value="'. $key . '" '.$selected.'>' . $value3 . '</label>';
        echo '</div>';
    }
}


// specialty function just for screen options
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
