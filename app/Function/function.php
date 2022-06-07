<?php

/**
* change english number to bangla number
*
* @param $num
* @param $anti false
*/

function convertNumber($num, $anti = false){
  	$eng = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
	$bang = array("০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");

	if($anti == true)
		return str_replace($bang, $eng, $num);
	else
		return str_replace($eng, $bang, $num);
}

/**
* change English month to Bangla month
*
* @param $FullMonthName
*/

function convert_text($FullMonthName){
  	$eng = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$bang = array("জানুয়ারি", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর");

	return convertNumber(str_replace($eng, $bang, $FullMonthName), false);
}

/* Percent Calculation */
function percentCal($number, $percent = 7){
	return ($number * $percent) / 100;
}

/**
* change single current year
*
* @param $singleDate
*/
function caseYear($singleDate){

        $app_year = date("Y", strtotime($singleDate));
        $month = date("n", strtotime($singleDate));

        $case_year = ($month >= 7) ? ($app_year + 1) : $app_year;
        return $case_year;
}

/* Date Formation Functions */
function dateFormat($oldDate)
{
  return date("j M Y", strtotime($oldDate));
}

function date_format_custom($dateTime, $format = 'j M Y h i A')
{
	return date($format, strtotime($dateTime));
}

function date_time_format($oldDateTime)
{
  return date("j M Y h:i a", strtotime($oldDateTime));
}


function send_sms($state_message, $mobile_number){

	$params = array(
    'message'  => $state_message,
    'number'   => $mobile_number,
    'sender'   => "8801736380158",
    'username' => "Nazrul",
    'password' => "TE6XYPCG",
    'type'     => 0
	);

	// $url = 'http://66.45.237.70/api.php?'.http_build_query($params);
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, $url);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// curl_setopt($ch, CURLOPT_HEADER, true);
	// curl_setopt($ch, CURLOPT_NOBODY, true);
	// $output = curl_exec($ch);
	// curl_close($ch);
}