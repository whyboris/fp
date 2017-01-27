<?php


include('metaboxfactory.php');

// describe all meta boxes

function getPartsOfDay() {
    $partsArray = array(
        'morning'=>'Morning',
        'afternoon'=>'Afternoon',
        'evening'=>'Evening',
    );
    return $partsArray;
}

createMetaBox('What is your favorite part of the day?', 'timeOfDay', 'bestPardOfDay', 3);

function bestPardOfDay($uniqueId) {

    $chosenValue = fpGetMetaValue($uniqueId);

    foreach (getPartsOfDay() as $key => $value) {

        $selected = '';
        if ($chosenValue == $key) {
            $selected = 'checked';
        }

        echo '<div class="radio">';
        echo '<label><input type="radio" name="' . $uniqueId . '" value="' . $key . '" '.$selected.'>' . $value . '</label>';
        echo '</div>';
    }

}

function getFaveFlavors() {
    $flavorsArray = array(
        'chocolate'=>'Chocolate',
        'vanilla'=>'Vanilla',
        'strawberry'=>'Strawberry',
    );
    return $flavorsArray;
}

createMetaBox('Which flavor(s) do you like?', 'flavors', 'faveFlavors', 6);

function faveFlavors($uniqueId) {

    $chosenValue = fpGetMetaValue($uniqueId);

    //print_r($chosenValue);

    foreach (getFaveFlavors() as $key => $value) {

        $selected = '';

        foreach ($chosenValue as $key2 => $value2) {
            if ($key == $value2) {
                $selected = 'checked';
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
    );
    return $carArray;
}

createMetaBox('What is the best car?', 'bestCar', 'aDropDown', 10);

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

//createMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown', 20);

function iceCreamDropDown($uniqueId) {
?>

    <div class="selectpicker">
        <select class="form-control" name="<?php echo $uniqueId; ?>" >
            <option value="chocolate">Chocolate</option>
            <option value="vanilla">vanilla</option>
            <option value="cookie" selected>cookie</option>
            <option value="pb">PB</option>
        </select>
    </div>

<?php
}

//echo "</center><pre>";
//print_r($allMetaBoxes);
//echo "</pre>";

?>
