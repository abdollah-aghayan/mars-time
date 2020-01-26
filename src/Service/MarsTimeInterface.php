<?php

namespace App\Service;

interface MarsTimeInterface
{
    /* Number of days since unix epoch */
    const NUMBER_OF_DAYS = 8.64 * 10 ** 7;
    /* fixed number for get julian date */
    const FIXED_NUMBER_JULIAN_DATE = 2440587.5;

    /* leap seconds since 1 Jan 2017 */
    const LEAP_SECONDS = 37 + 32.184;
    /* number of seconds in a day */
    const SECOND_DAY = 86400;

    /* julian date (terrestrial time) at the 12:00 on Jan. 1, 2000 (UT). */
    const JANUARY_2000_EPOCH = 2451545.0;
    /* the difference between midnight on earth and marts at 6th Jan 2000 */
    const START_POINT_DIFFERENCE = 4.5;

    /* Day ratio mars and earth */
    const DAY_RATIO = 1.02749125;

    /* midday 29th Dec 1843 */
    const MSD_POSITIVE = 44796;

    const ADJUSTMENT = 0.00096;

    public function getMarsSolDate(\DateTime $time): float;

    public function getCoordinatedMarsTime(\DateTime $time): string;
}
