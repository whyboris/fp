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

 ?>
