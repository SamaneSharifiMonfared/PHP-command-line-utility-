#!/usr/bin/php
<?php
include_once "assets/classesandfunctions.php";

$filename=$argv[1]; //recieving the filename from

$Calculations=new calculation_of_bonus_and_payment(); //class for the calculations


$paydays = $Calculations->calculate12MonthsPaydays();

print_r($paydays);

writeintoCSVfile($filename,"Paydays:",$paydays);


?>
