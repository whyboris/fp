<?php

include('arrays.php');
include('metaboxfactory.php');

function bestPartOfDay($uniqueId) {
    createRadioButtons(getPartsOfDay(), $uniqueId);
}
registerMetaBox('What is your favorite part of the day?', 'timeOfDay', 'bestPartOfDay', 2);

function faveFlavors($uniqueId) {
    createCheckBoxes(getFaveFlavors(), $uniqueId);
}
registerMetaBox('Which flavor(s) do you like?', 'flavors', 'faveFlavors', 4);

function aDropDown($uniqueId) {
    createDropDown(getCarTypes(), $uniqueId);
}
registerMetaBox('What is the best car?', 'bestCar', 'aDropDown', 6);

// DISABLED ONES

function iceCreamDropDown($uniqueId) {
    createDropDown(getIceCream(), $uniqueId);
}
//registerMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown', 8);

function favoriteDrink($uniqueId) {
    createDropDown(getFaveDrink(), $uniqueId);
}
//registerMetaBox('What is your favoriet drink?', 'faveDrink', 'favoriteDrink', 10);

//echo "</center><pre>";
//print_r($allMetaBoxes);
//echo "</pre>";

?>
