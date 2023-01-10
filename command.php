#!/usr/bin/php
<?php
include_once "assets/classesandfunctions.php";

$filename=$argv[1]; //recieving the filename from

$Calculations=new calculation_of_bonus_and_payment(); //class for the calculations


$paydays = $Calculations->calculate12MonthsPaydays();

$bonusday = $Calculations->calculate12MonthsBonusdays();

$MonthNames = $Calculations->next12MonthsNames();

$list1 = array (
    $paydays,
    $bonusday,
    $MonthNames
);

$list=rotateMatrix90($list1); //making the columns


writeintoCSVfile($filename,$list);


?>
