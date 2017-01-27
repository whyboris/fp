<?php

include('metaboxfactory.php');

/**
 * Create parts of day metabox
 */

function getPartsOfDay() {
    $partsArray = array(
        'morning'=>'Morning',
        'afternoon'=>'Afternoon',
        'evening'=>'Evening',
        'night'=>'Night',
    );
    return $partsArray;
}

function bestPartOfDay($uniqueId) {
    createRadioButtons(getPartsOfDay(), $uniqueId);
}

registerMetaBox('What is your favorite part of the day?', 'timeOfDay', 'bestPartOfDay', 1);

/**
 * Create flavors metabox
 */

function getFaveFlavors() {
    $flavorsArray = array(
        'chocolate'=>'Chocolate',
        'vanilla'=>'Vanilla',
        'strawberry'=>'Strawberry',
    );
    return $flavorsArray;
}

function faveFlavors($uniqueId) {
    createCheckBoxes(getFaveFlavors(), $uniqueId);
}

registerMetaBox('Which flavor(s) do you like?', 'flavors', 'faveFlavors', 6);

/**
 * Create cars metabox
 */

function getCarTypes() {
    $carArray = array(
        'volvo' => 'Volvo',
        'saab' => 'Saab',
        'fiat' => 'Fiat',
        'audi' => 'Audi',
        'honda' => 'Honda',
    );
    return $carArray;
}

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

function getIceCream() {
    $iceCream = array(
        'chocolate' => "Chocolate Ice Cream",
        'vanilla' => "Vanilla Ice Cream",
        'cookie' => "Cookie Ice Cream",
        'pb' => "Peanut Butter Ice Cream",
    );
    return $iceCream;
}

function iceCreamDropDown($uniqueId) {
    createDropDown(getIceCream(), $uniqueId);
}

registerMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown', 20);

//echo "</center><pre>";
//print_r($allMetaBoxes);
//echo "</pre>";

?>
