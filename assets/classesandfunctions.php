<?php

class calculation_of_bonus_and_payment{


    private $today;

    public function __construct()
    {
        $this->today = date("Y-m-d");

    }

    public function monthLastDate($datestring){

        // Converting string to date
        $date = strtotime($datestring);

        // Last date of current month.

        $lastDate = date("Y-m-t", $date );

        return $lastDate;

    }
    public function calculateMonthPayday($monthLastDate){

        $lastdatetimestamp = strtotime($monthLastDate);

        // Day of the last date
        $lastDay = date("l", $lastdatetimestamp);

        if($lastDay=="Saturday")// date-1 day
        {
            $datetime = new DateTime($monthLastDate);
            $datetime->modify('-1 days');
            $payDate= $datetime->format('Y-m-d');

        }elseif($lastDay=="Sunday"){ // date -2day
            $datetime = new DateTime($monthLastDate);
            $datetime->modify('-2 days');
            $payDate= $datetime->format('Y-m-d');

        }else{
            $payDate=$monthLastDate;
        }

        return $payDate;

    }
    public function calculate12MonthsPaydays(){
        $todayDate=$this->today;
        $payDays=[];
        $monthLastDate=$this->monthLastDate($todayDate);

        for ($i = 0; $i < 12; $i++){

            $payDays[]=$this->calculateMonthPayday($monthLastDate);
            $datetime = new DateTime($monthLastDate);
            $datetime->modify('first day of +1 month');
            $monthLastDate= $datetime->format('Y-m-t');

        }


        return $payDays;

    }


}

function writeintoCSVfile($filename,$descriptionString,$array){

    $fp = fopen($filename, 'w');
    $line[0]=$descriptionString;
    fputcsv($fp, $line);
    foreach($array as $line){

        $val = explode(",",$line);
        fputcsv($fp, $val);
    }
    fclose($fp);

}