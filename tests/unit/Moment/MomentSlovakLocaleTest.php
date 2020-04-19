<?php

namespace Moment;

use PHPUnit\Framework\TestCase;

class MomentSlovakLocaleTest extends TestCase
{
    public function setUp()
    {
        Moment::setLocale('sk_SK');
    }

    public function testWeekdayNames()
    {
        $startingDate = '2016-01-29T00:00:00+0000';

        $moment = new Moment($startingDate);

        $weekdayNames = array(
            1 => array('po', 'pondelok'),
            2 => array('ut', 'utorok'),
            3 => array('st', 'streda'),
            4 => array('št', 'štvrtok'),
            5 => array('pi', 'piatok'),
            6 => array('so', 'sobota'),
            7 => array('ne', 'nedeľa'),
        );

        for ($d = 1; $d < 7; $d++) {
            self::assertEquals($weekdayNames[$moment->getWeekday()][0], $moment->getWeekdayNameShort(), 'weekday short name failed');
            self::assertEquals($weekdayNames[$moment->getWeekday()][1], $moment->getWeekdayNameLong(), 'weekday long name failed');

            $moment->addDays(1);
        }
    }

    public function testDayMonthFormat001()
    {
        $string = '2015-06-14 20:46:22';
        $moment = new Moment($string, 'Europe/Berlin');
        self::assertEquals('14 jún', $moment->format('j F'));

        $string = '2015-03-08T15:14:53-0500';
        $moment = new Moment($string, 'Europe/Berlin');
        self::assertEquals('8 marec', $moment->format('j F'));
    }

    public function testDayMonthFormat002()
    {
        $moment = new Moment('2016-01-03 16:17:07', 'Europe/Berlin');
        self::assertEquals('3 december', $moment->subtractMonths(1)->format('j F'));
    }

    public function testMonthFormatFN()
    {
        $startingDate = '2016-01-01T00:00:00+0000';

        $moment = new Moment($startingDate);

        $monthsNominative = array(
            1 => 'január',
            2 => 'február',
            3 => 'marec',
            4 => 'apríl',
            5 => 'máj',
            6 => 'jún',
            7 => 'júl',
            8 => 'august',
            9 => 'september',
            10 => 'október',
            11 => 'november',
            12 => 'december'
        );

        for ($d = 1; $d < 12; $d++) {
            self::assertEquals($monthsNominative[$moment->format('n')], $moment->format('f'), 'month nominative failed');

            $moment->addMonths(1);
        }
    }


    public function testMinutes()
    {
        $past = new Moment('2016-01-03 16:17:07', 'Europe/Berlin');

        $relative = $past->from('2016-01-03 16:34:07');
        self::assertEquals('pred 17 minútami', $relative->getRelative());

        $relative = $past->from('2016-01-03 16:40:07');
        self::assertEquals('pred 23 minútami', $relative->getRelative());

        $relative = $past->from('2016-01-03 16:30:07');
        self::assertEquals('pred 13 minútami', $relative->getRelative());
    }

    public function testLastWeekWeekend()
    {
        $past = new Moment('2016-04-10');
        self::assertEquals('minulá nedeľa', $past->calendar(false, new Moment('2016-04-12')));

        $past = new Moment('2016-04-11');
        self::assertEquals('minulý pondelok', $past->calendar(false, new Moment('2016-04-17')));

        $past = new Moment('2016-04-12');
        self::assertEquals('minulý utorok', $past->calendar(false, new Moment('2016-04-17')));

        $past = new Moment('2016-04-13');
        self::assertEquals('minulá streda', $past->calendar(false, new Moment('2016-04-17')));

        $past = new Moment('2016-04-14');
        self::assertEquals('minulý štvrtok', $past->calendar(false, new Moment('2016-04-17')));

        $past = new Moment('2016-04-15');
        self::assertEquals('minulý piatok', $past->calendar(false, new Moment('2016-04-17')));

        $past = new Moment('2016-04-16');
        self::assertEquals('včera', $past->calendar(false, new Moment('2016-04-17')));

        $past = new Moment('2016-04-16');
        self::assertEquals('minulá sobota', $past->calendar(false, new Moment('2016-04-18')));
    }
}
