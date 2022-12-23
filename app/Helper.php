<?php

function getPercentage($smallNum, $bigNum){
    return ($smallNum / $bigNum) * 100;
}

function getNumberFomPercentage($bigNum, $percentage){
    return ($bigNum / 100) * $percentage;
}