<?php

use Moment\Moment;

/**
 * @param string $direction
 * @param string $trueString
 * @param string $falseString
 *
 * @return string
 */
$ifPast = function ($direction, $trueString, $falseString)
{
    return $direction === 'past' ? $trueString : $falseString;
};

/**
 * @param int    $count
 * @param int    $countSmallerThan
 * @param string $trueString
 * @param string $falseString
 *
 * @return string
 */
$ifCountSmaller = function ($count, $countSmallerThan, $trueString, $falseString)
{
    return $count < $countSmallerThan ? $trueString : $falseString;
};

/**
 * @param int    $count
 * @param int    $countSmallerThan
 * @param string $trueString
 * @param string $falseString
 *
 * @return string
 */
$ifFeminineGender = function ($count, $countSmallerThan, $trueString, $falseString)
{
    return $count < $countSmallerThan ? $trueString : $falseString;
};

return array(
    "months"        => explode('_', 'január_február_marec_apríl_máj_jún_júl_august_september_október_november_december'),
    "monthsShort"   => explode('_', 'Jan_Feb_Mar_Apr_Máj_Jún_Júl_Aug_Sep_Okt_Nov_Dec'),
    "weekdays"      => explode('_', 'pondelok_utorok_streda_štvrtok_piatok_sobota_nedeľa'),
    "weekdaysShort" => explode('_', 'po_ut_st_št_pi_so_ne'),
    "calendar"      => array(
        "sameDay"  => '[dnes]',
        "nextDay"  => '[zajtra]',
        "lastDay"  => '[včera]',
        "lastWeek" => function ($count, $direction, Moment $moment) {
            switch ($moment->getDay()) {
                case 1:
                case 2:
                case 4:
                case 5:
                    return '[minulý] l';
                default:
                    return '[minulá] l';
            }
        },
        "sameElse" => 'l',
        "withTime" => '[v] H:i',
        "default"  => 'd.m.Y',
    ),
    "relativeTime"  => array(
        "future" => 'o %s',
        "past"   => 'pred %s',
        "s"      => function ($count, $direction, Moment $moment) use ($ifPast)
        {
            return $ifPast($direction, 'okamihom', 'okamih');
        },
        "ss"      => function ($count, $direction, Moment $moment) use ($ifPast)
        {
            return $ifPast($direction, 'okamihom', 'okamih');
        },
        "m"      => function ($count, $direction, Moment $moment) use ($ifPast)
        {
            return $ifPast($direction, 'minútou', 'minútu');
        },
        "mm"     => function ($count, $direction, Moment $moment) use ($ifPast, $ifCountSmaller)
        {
            return $ifPast($direction, '%d minútami', $ifCountSmaller($count, 5, '%d minúty', '%d minút'));
        },
        "h"      => function ($count, $direction, Moment $moment) use ($ifPast, $ifCountSmaller)
        {
            return $ifPast($direction, 'hodinou', 'hodinu');
        },
        "hh"     => function ($count, $direction, Moment $moment) use ($ifPast, $ifCountSmaller)
        {
            return $ifPast($direction, '%d hodinami', $ifCountSmaller($count, 5, '%d hodiny', '%d hodín'));
        },
        "d"      => function ($count, $direction, Moment $moment) use ($ifPast)
        {
            return $ifPast($direction, 'dňom', 'deň');
        },
        "dd"     => function ($count, $direction, Moment $moment) use ($ifPast, $ifCountSmaller)
        {
            return $ifPast($direction, '%d dňami', $ifCountSmaller($count, 5, '%d dni', '%d dní'));
        },
        "M"      => function ($count, $direction, Moment $moment) use ($ifPast)
        {
            return $ifPast($direction, 'mesiacom', 'mesiac');
        },
        "MM"     => function ($count, $direction, Moment $moment) use ($ifPast, $ifCountSmaller)
        {
            return $ifPast($direction, '%d mesiacmi', $ifCountSmaller($count, 5, '%d mesiace', '%d mesiacov'));
        },
        "y"      => function ($count, $direction, Moment $moment) use ($ifPast)
        {
            return $ifPast($direction, 'rokom', 'rok');
        },
        "yy"     => function ($count, $direction, Moment $moment) use ($ifPast, $ifCountSmaller)
        {
            return $ifPast($direction, '%d rokmi', $ifCountSmaller($count, 5, '%d roky', '%d rokov'));
        },
    ),
    "ordinal"       => function ($number)
    {
        return $number . '.';
    },
    "week"          => array(
        "dow" => 1, // Monday is the first day of the week.
        "doy" => 4  // The week that contains Jan 4th is the first week of the year.
    ),
);
