<?php

/**
 * Retrieves post meta values from DB
 *
 * used in each metabox to retrieve saved values
 * @param  string           $uniqueId       identifies the key containing stored values
 * @param  string           $forWhatPage    either "user" or "post"
 * @return string/array                     string or array containing stored values
 */
function fpGetMeta($fieldName, $forWhatPage) {

    $arrayOfAllOptions = array();

    if ($forWhatPage == 'post') {
        global $arrayOfSelectedOptions;
        $arrayOfAllOptions = $arrayOfSelectedOptions;
    } elseif ($forWhatPage == 'user') {
        global $userSettings;
        $arrayOfAllOptions = $userSettings;
    }

    if (isset($arrayOfAllOptions[$fieldName])) {
        return $arrayOfAllOptions[$fieldName];
    } else {
        return null;
    }

}

function renderDropdown($optionsArray, $fieldName, $forWhatPage) {

    $dbValue = fpGetMeta($fieldName, $forWhatPage);

    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="'. $fieldName . '">';

    foreach ($optionsArray as $key => $value) {
        $selected = '';
        if ($dbValue == $key) {
            $selected = 'selected';
        }
        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
    echo '</select>';
    echo '</div>';
}


function renderRadioButtons($optionsArray, $fieldName, $forWhatPage) {

    $dbValue = fpGetMeta($fieldName, $forWhatPage);

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

function renderCheckboxes($optionsArray, $fieldName, $forWhatPage) {

    $dbValue = fpGetMeta($fieldName, $forWhatPage);

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

    // showMe($dbSavedArray);

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
