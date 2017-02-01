<?php

include('postarrays.php');
include('metaboxfactory.php');

function bestPartOfDay($uniqueId) {
    renderRadioButtons(getPartsOfDay(), $uniqueId, 'post');
}
registerMetaBox('Post type', 'timeOfDay', 'bestPartOfDay', 2);

function faveFlavors($uniqueId) {
    echo "<em>Custom HTML appear above</em>";
    renderCheckBoxes(getFaveFlavors(), $uniqueId, 'post');
    echo "<em>Custom HTML appear below</em>";
}
registerMetaBox('Categories', 'flavors', 'faveFlavors', 4);

function aDropDown($uniqueId) {
    renderDropDown(getCarTypes(), $uniqueId, 'post');
}
registerMetaBox('Hashtags', 'bestCar', 'aDropDown', 6);

// DISABLED ONES

function iceCreamDropDown($uniqueId) {
    renderDropDown(getIceCream(), $uniqueId, 'post');
}
//registerMetaBox('What is your favorite ice cream?', 'bestIceCream', 'iceCreamDropDown', 8);

function favoriteDrink($uniqueId) {
    renderDropDown(getFaveDrink(), $uniqueId, 'post');
}
//registerMetaBox('What is your favoriet drink?', 'faveDrink', 'favoriteDrink', 10);

// showMe($allMetaBoxes);

?>
