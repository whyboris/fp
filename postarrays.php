<?php

/**
 * All arrays of all data
 */

function getPartsOfDay() {
    $partsArray = array(
        'morning'=>'Morning',
        'afternoon'=>'Afternoon',
        'evening'=>'Evening',
//        'night'=>'Night',
    );
    return $partsArray;
}

function getFaveFlavors() {
    $flavorsArray = array(
        'chocolate'=>'Chocolate',
        'vanilla'=>'Vanilla',
        'strawberry'=>'Strawberry',
    );
    return $flavorsArray;
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

function getCarTypes() {
    $carArray = array(
        'volvo' => '#yolo',
        'saab' => '#pokemon',
        'fiat' => '#doge',
        'audi' => '#test',
    );
    return $carArray;
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
