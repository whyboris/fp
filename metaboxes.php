<?php

include('postarrays.php');
include('metaboxfactory.php');

function categoriesBox($uniqueId) {
    echo "<em>The category of post</em>";
    renderRadioButtons(getCategories(), $uniqueId, 'post');
}
registerMetaBox('Category', 'category', 'categoriesBox', 2);

function topicsBox($uniqueId) {
    renderCheckBoxes(getTopics(), $uniqueId, 'post');
    echo "<em>Select all topics that you are writing about</em>";
}
registerMetaBox('Topics', 'topics', 'topicsBox', 4);

function hashtagsBox($uniqueId) {
    renderDropDown(getHashtags(), $uniqueId, 'post');
    echo "<br><em>Hashtags help your post get more exposure</em>";
}
registerMetaBox('Hashtags', 'hashtag', 'hashtagsBox', 6);

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
