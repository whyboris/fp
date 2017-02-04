<?php

include('postarrays.php');
include('metaboxfactory.php');

function bestPartOfDay($uniqueId) {
    echo "<em>Custom HTML appears above</em>";
    renderRadioButtons(getPartsOfDay(), $uniqueId, 'post');
}
registerMetaBox('Post type', 'timeOfDay', 'bestPartOfDay', 2);

function faveFlavors($uniqueId) {
    renderCheckBoxes(getFaveFlavors(), $uniqueId, 'post');
    echo "<em>Custom HTML appears below</em>";
}
registerMetaBox('Categories', 'flavors', 'faveFlavors', 4);

function theHashtags($uniqueId) {
    renderDropDown(getHashtags(), $uniqueId, 'post');
    echo "<br><em>Hashtags help your post get more exposure</em>";
}
registerMetaBox('Hashtags', 'hashtag', 'theHashtags', 6);

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
