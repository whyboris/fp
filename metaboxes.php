<?php

include('arrays.php');
include('metaboxfactory.php');

/**
 * Create parts of day metabox
 */

function bestPartOfDay($uniqueId) {
    createRadioButtons(getPartsOfDay(), $uniqueId);
}

registerMetaBox('What is your favorite part of the day?', 'timeOfDay', 'bestPartOfDay', 1);

/**
 * Create flavors metabox
 */

function faveFlavors($uniqueId) {
    createCheckBoxes(getFaveFlavors(), $uniqueId);
}

registerMetaBox('Which flavor(s) do you like?', 'flavors', 'faveFlavors', 6);

/**
 * Create cars metabox
 */

registerMetaBox('What is the best car?', 'bestCar', 'aDropDown', 10);

function aDropDown($uniqueId) {

    $chosenValue = fpGetMetaValue($uniqueId);

    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="' . $uniqueId . '">';

    foreach (getCarTypes() as $key => $value) {
        $selected = '';
        if ($key == $chosenValue) {
            $selected = 'selected';
        }
        echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
    }

    echo '</select>';
    echo '</div>';

}

/**
 * Create cars metabox
 */

function iceCreamDropDown($uniqueId) {
    createDropDown(getIceCream(), $uniqueId);
}

registerMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown', 20);

//echo "</center><pre>";
//print_r($allMetaBoxes);
//echo "</pre>";

?>
