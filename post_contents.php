<?php

/**
 * All arrays of all data
 */

function getCategories() {
    $categories = array(
        'ad'=>'Advertising',
        'education'=>'Education',
        'opinion'=>'Opinion',
    );
    return $categories;
}

function getTopics() {
    $topics = array(
        'vanilla'=>'Vanilla',
        'chocolate'=>'Chocolate',
        'strawberry'=>'Strawberry',
    );
    return $topics;
}

function getHashtags() {
    $hashtagArray = array(
        'test' => '#test',
        'doge' => '#doge',
        'pokemon' => '#pokemon',
        'likeaboss' => '#likeaboss',
    );
    return $hashtagArray;
}

function getFaveDrink() {
    $flavorsArray = array(
        'water'=>'Water',
        'soda'=>'Soda',
        'milk'=>'Milk',
        'water2'=>'Water2',
        'soda2'=>'Soda2',
        'milk2'=>'Milk2',
    );
    return $flavorsArray;
}

function getIceCream() {
    $iceCream = array(
        'chocolate' => "Chocolate Ice Cream",
        'vanilla' => "Vanilla Ice Cream",
        'cookie' => "Cookie Ice Cream",
        'pb' => "Peanut Butter Ice Cream",
    );
    return $iceCream;
}


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
