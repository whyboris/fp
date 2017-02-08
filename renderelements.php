<?php

/**
 * Retrieves post meta values from DB
 *
 * used in each metabox to retrieve saved values
 * @param  string           $uniqueId       identifies the key containing stored values
 * @param  string           $forWhatPage    either "user" or "post"
 * @return string/array                     string or array containing stored values
 */
function mpGetMeta($fieldName, $forWhatPage) {

    $arrayOfAllOptions = array();

    switch($forWhatPage) {
        case 'post':
            global $postSettings;
            $arrayOfAllOptions = $postSettings;
            break;
        case 'user':
            global $userSettings;
            $arrayOfAllOptions = $userSettings;
            break;
        case 'blog':
            global $blogSettings;
            $arrayOfAllOptions = $blogSettings;
            break;
    }

    if (isset($arrayOfAllOptions[$fieldName])) {
        return $arrayOfAllOptions[$fieldName];
    } else {
        return null;
    }

}

function renderDropdown($optionsArray, $fieldName, $forWhatPage) {

    $dbValue = mpGetMeta($fieldName, $forWhatPage);

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

    $dbValue = mpGetMeta($fieldName, $forWhatPage);

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

    //showMe($forWhatPage);

    $dbValue = mpGetMeta($fieldName, $forWhatPage);

    foreach ($optionsArray as $key3 => $value3) {

        $selected = '';

        // chosen value can be an array!
        if (isset($dbValue) && $dbValue != '') {
            foreach ($dbValue as $key4 => $value4) {
                if ($key3 == $value4) {
                    $selected = 'checked';
                }
            }
        }

        echo '<div class="checkbox">';
        echo '<label><input type="checkbox" name="' . $fieldName . '[]" value="'. $key3 . '" '.$selected.'>' . $value3 . '</label>';
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
