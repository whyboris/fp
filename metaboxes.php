<?php


//global $allMetaBoxes;
$allMetaBoxes = array();

// output all metaboxes
function displayAllMetaBoxes(){

    global $allMetaBoxes;
    foreach ($allMetaBoxes as $key => $value) {
        metaboxPrefix($allMetaBoxes[$key][0],$allMetaBoxes[$key][1]);
        $allMetaBoxes[$key][2]($allMetaBoxes[$key][1]);
        metaboxSuffix();
    }

}

// FACTORY:

function createMetaBox($displayName, $uniqueId, $functionToCall) {
    global $allMetaBoxes;

    array_push($allMetaBoxes, array($displayName, $uniqueId, $functionToCall));

    //metaboxPrefix($displayName);
    //$functionToCall($uniqueId);
    //metaboxSuffix();
}

function metaboxPrefix($displayName, $uniqueId) {
    echo '<div class="" id="' . $uniqueId . '">';
    echo '<label for="' . $uniqueId . '">' . $displayName. '</label><br>';
}

function metaboxSuffix() {
    echo "</div>";
}

// describe all meta boxes

function getPartsOfDay() {
    $partsArray = array(
        'morning'=>'Morning',
        'afternoon'=>'Afternoon',
        'evening'=>'Evening',
    );
    return $partsArray;
}

createMetaBox('What is your favorite part of the day?', 'timeOfDay', 'bestPardOfDay');

function bestPardOfDay($uniqueId) {

    foreach (getPartsOfDay() as $key => $value) {
        echo '<div class="radio">';
        echo '<label><input type="radio" name="' . $uniqueId . '" value="' . $key . '">' . $value . '</label>';
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

createMetaBox('Which flavor(s) do you like?', 'flavors', 'faveFlavors');

function faveFlavors($uniqueId) {

    foreach (getFaveFlavors() as $key => $value) {
        echo '<div class="checkbox">';
        echo '<label><input type="checkbox" name="' . $uniqueId . '[]" value="'. $key . '">' . $value . '</label>';
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

createMetaBox('What is the best car?', 'bestCar', 'aDropDown');

function aDropDown($uniqueId) {

    echo '<div class="selectpicker">';
    echo '<select class="form-control" name="' . $uniqueId . '">';

    foreach (getCarTypes() as $key => $value) {
        echo '<option value="' . $key . '">' . $value . '</option>';
    }

    echo '</select>';
    echo '</div>';

}



//createMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown');

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
