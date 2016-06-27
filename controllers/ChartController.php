<?php

require_once("models/ChartModel.php");

class ChartController 
{
       
    public function ObtainData($reseller, $day, $month)
    {
        $day15 = $day-1;
        $day15 = $day15."/".$month;
        $day14 = $day-2;
        $day14 = $day14."/".$month;
        $day13 = $day-3;
        $day13 = $day13."/".$month;
        $day12 = $day-4;
        $day12 = $day12."/".$month;
        $day11 = $day-5;
        $day11 = $day11."/".$month;
        $day10 = $day-6;
        $day10 = $day10."/".$month;
        $day9 = $day-7;
        $day9 = $day9."/".$month;

	$day8 = $day-8;
        $day8 = $day8."/".$month;
        $day7 = $day-9;
        $day7 = $day7."/".$month;
        $day6 = $day-10;
        $day6 = $day6."/".$month;
        $day5 = $day-11;
        $day5 = $day5."/".$month;
        $day4 = $day-12;
        $day4 = $day4."/".$month;
        $day3 = $day-13;
        $day3 = $day3."/".$month;
        $day2 = $day-14;
        $day2 = $day2."/".$month;
        $day1 = $day-15;
        $day1 = $day1."/".$month;
        
        $ChartM = new ChartModel();
        $cday1 = $ChartM->Draw($reseller, $day1);
        $cday2 = $ChartM->Draw($reseller, $day2);
        $cday3 = $ChartM->Draw($reseller, $day3);
        $cday4 = $ChartM->Draw($reseller, $day4);
        $cday5 = $ChartM->Draw($reseller, $day5);
        $cday6 = $ChartM->Draw($reseller, $day6);
        $cday7 = $ChartM->Draw($reseller, $day7);
	$cday8 = $ChartM->Draw($reseller, $day8);
        $cday9 = $ChartM->Draw($reseller, $day9);
        $cday10 = $ChartM->Draw($reseller, $day10);
        $cday11 = $ChartM->Draw($reseller, $day11);
        $cday12 = $ChartM->Draw($reseller, $day12);
        $cday13 = $ChartM->Draw($reseller, $day13);
	$cday14 = $ChartM->Draw($reseller, $day14);
        $cday15 = $ChartM->Draw($reseller, $day15);
             
        return $day1.",".$cday1.",".$day2.",".$cday2.",".$day3.",".$cday3.",".$day4.",".$cday4.",".$day5.",".$cday5.",".$day6.",".$cday6.",".$day7.",".$cday7.",".$day8.",".$cday8.",".$day9.",".$cday9.",".$day10.",".$cday10.",".$day11.",".$cday11.",".$day12.",".$cday12.",".$day13.",".$cday13.",".$day14.",".$cday14.",".$day15.",".$cday15;
    }
     
}


?>