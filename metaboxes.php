<?php

include('metaboxfactory.php');

// describe all meta boxes

function getPartsOfDay() {
    $partsArray = array(
        'morning'=>'Morning',
        'afternoon'=>'Afternoon',
        'evening'=>'Evening',
        'night'=>'Night',
    );
    return $partsArray;
}

registerMetaBox('What is your favorite part of the day?', 'timeOfDay', 'bestPartOfDay', 1);

function bestPartOfDay($uniqueId) {

    createRadioButtons(getPartsOfDay(), $uniqueId);
    
}

function getFaveFlavors() {
    $flavorsArray = array(
        'chocolate'=>'Chocolate',
        'vanilla'=>'Vanilla',
        'strawberry'=>'Strawberry',
    );
    return $flavorsArray;
}

registerMetaBox('Which flavor(s) do you like?', 'flavors', 'faveFlavors', 6);

function faveFlavors($uniqueId) {

    $chosenValue = fpGetMetaValue($uniqueId);

    //print_r($chosenValue);

    foreach (getFaveFlavors() as $key => $value) {

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



// HARD CODED for testing -- REMOVE LATER

registerMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown', 20);

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

    $iceCream = getIceCream();

    $chosenValue = fpGetMetavalue($uniqueId);

    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="'. $uniqueId . '">';

    foreach ($iceCream as $key => $value) {
        $selected = '';
        if ($chosenValue == $key) {
            $selected = 'selected';
        }
        echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
    echo '</select>';
    echo '</div>';

}

//echo "</center><pre>";
//print_r($allMetaBoxes);
//echo "</pre>";

?>
