<?php


//global $allMetaBoxes;
$allMetaBoxes = array();

// output all metaboxes
function displayAllMetaBoxes(){

    global $allMetaBoxes;
    foreach ($allMetaBoxes as $key => $value) {
        metaboxPrefix($allMetaBoxes[$key][0]);
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

function metaboxPrefix($displayName) {
    echo '<label for="excerpt">' . $displayName. '</label><br>';
}

function metaboxSuffix() {
    echo "<br>";
}

// describe all meta boxes

createMetaBox('What is your favorite part of the day?', 'timeOfDay', 'manyRadioButtons');

function manyRadioButtons($uniqueId) {
?>

    <div class="radio">
      <label><input type="radio" name="<?php echo $uniqueId; ?>" value="morning">Morning</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="<?php echo $uniqueId; ?>" value="afternoon">Afternoon</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="<?php echo $uniqueId; ?>" value="evening">Evening</label>
    </div>

<?php

}

createMetaBox('Which flavor(s) do you like?', 'flavors', 'manyCheckBoxes');

function manyCheckBoxes($uniqueId) {
?>

    <div class="checkbox">
      <label><input type="checkbox" name="<?php echo $uniqueId; ?>[]" value="chocolate">chocolate</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="<?php echo $uniqueId; ?>[]" value="vanilla">vanilla</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="<?php echo $uniqueId; ?>[]" value="strawberry">strawberry</label>
    </div>

<?php
}

createMetaBox('What is the best car?', 'bestCar', 'aDropDown');

function aDropDown($uniqueId) {
?>

    <div class="selectpicker">
        <select class="form-control" name="<?php echo $uniqueId; ?>" >
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="fiat">Fiat</option>
            <option value="audi">Audi</option>
        </select>
    </div>

<?php
}



createMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown');

function iceCreamDropDown($uniqueId) {
?>

    <div class="selectpicker">
        <select class="form-control" name="<?php echo $uniqueId; ?>" >
            <option value="chocolate">Chocolate</option>
            <option value="vanilla">vanilla</option>
            <option value="cookie">cookie</option>
            <option value="pb">PB</option>
        </select>
    </div>

<?php
}

//echo "</center><pre>";
//print_r($allMetaBoxes);
//echo "</pre>";

?>
