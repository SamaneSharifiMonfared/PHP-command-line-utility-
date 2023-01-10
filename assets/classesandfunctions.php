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

            //going to the next month first day
            $datetime = new DateTime($monthLastDate);
            $datetime->modify('first day of +1 month');
            $monthLastDate= $datetime->format('Y-m-t');

        }


        return $payDays;

    }

    public function calculateMonthBonusday($monthFirstDay){

        $datetime = new DateTime($monthFirstDay);
        $datetime->modify('+14 days');
        $month15thDay= $datetime->format('Y-m-d');

        $month15thDaytimestamp = strtotime($month15thDay);

        $month15thDayName = date("l", $month15thDaytimestamp);

        if($month15thDayName=="Saturday")// date-1 day
        {
            $datetime = new DateTime($month15thDay);
            $datetime->modify('+4 days');
            $BonusDate= $datetime->format('Y-m-d');

        }elseif($month15thDayName=="Sunday"){ // date -2day
            $datetime = new DateTime($month15thDay);
            $datetime->modify('+3 days');
            $BonusDate= $datetime->format('Y-m-d');

        }else{

            $BonusDate=$month15thDay;
        }

        return $BonusDate;



    }

    public function calculate12MonthsBonusdays(){

        $bonusDays=[];

        $monthFirstDate=date('Y-m-01'); //this month first date

        for ($i = 0; $i < 12; $i++){

            $bonusDays[]=$this->calculateMonthBonusday($monthFirstDate);
            //next month first day
            $datetime = new DateTime($monthFirstDate);
            $datetime->modify('first day of +1 month');
            $monthFirstDate= $datetime->format('Y-m-01');

        }


        return $bonusDays;

    }
    public function next12MonthsNames(){

        $monthsNames=[];

        $monthFirstDate=date('Y-m-01'); //this month first date

        for ($i = 0; $i < 12; $i++){

            $monthsNames[]=$monthFirstDate;
            $datetime = new DateTime($monthFirstDate);
            $datetime->modify('first day of +1 month');
            $monthFirstDate= $datetime->format('Y-m-01');

        }

        return $monthsNames;

    }


}

function writeintoCSVfile($filename,$array){

    $file = fopen($filename,"w");
    $header=array("MonthNames", "Bonusdays","Paydays");
    fputcsv($file, $header);

    foreach ($array as $line) {
        fputcsv($file, $line);
    }

    fclose($file);

}

function rotateMatrix90( $matrix )
{
    $matrix = array_values( $matrix );
    $matrix90 = array();

    // make each new row = reversed old column
    foreach( array_keys( $matrix[0] ) as $column ){
        $matrix90[] = array_reverse( array_column( $matrix, $column ) );
    }

    return $matrix90;
}