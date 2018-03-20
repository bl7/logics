<?php


/*
A hardcoded dates
$first_date = new DateTime("2012-11-30 17:03:30");
$second_date = new DateTime("2012-12-21 00:00:00");
*/
/*
This gives of object of class DateInterval which cannot be converted to string,
you can check by var_dump($difference) to see what actually it echos out as well
if you wanna 
echo out the diffrence we need to format the DateInterval
*/
$difference = $first_date->diff($second_date);


/**
 * Format an interval to show all existing components.
 * If the interval doesn't have a time component (years, months, etc)
 * That component won't be displayed.
 *
 * @param DateInterval $interval The interval
 *
 * @return string Formatted interval string.
 */
function format_interval(DateInterval $interval) {
    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }
    return $result;
}
echo "<p>Difference Between Last Login and Current time"."<br/>".format_interval($difference)."</p>";
?>