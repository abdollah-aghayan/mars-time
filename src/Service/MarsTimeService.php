<?php

namespace App\Service;

class MarsTimeService implements MarsTimeInterface
{
    /**
     * Calculate MSD.
     *
     * @param \DateTime $time
     *
     * @return float
     */
    public function getMarsSolDate(\DateTime $time): float
    {
        /* Convert time to seconds */
        $millisecond = $time->getTimestamp() * 1000;

        // Unix epoch 00:00:00 on Jan. 1, 1970
        /* To get Julian date at Unix epoch instead of converting Gregorian date we just divide millisecond to 86400000 then add  2440587.5 */
        $julianDateUT = MarsTimeInterface::FIXED_NUMBER_JULIAN_DATE + ($millisecond / MarsTimeInterface::NUMBER_OF_DAYS);

        /* we need to convert Julian date to second by by adding leap second and divide to the number of seconds in a day */
        $julianDateTT = $julianDateUT + MarsTimeInterface::LEAP_SECONDS / MarsTimeInterface::SECONDS_IN_A_DAY;

        /* Time offset since  12:00 on Jan. 1, 2000 (UT) */
        $january2000Time = $julianDateTT - MarsTimeInterface::JANUARY_2000_EPOCH;

        /* Find start point which is equal in earth and mars subsequently we need to subtract 4.5 from j2000 */
        $startPoint = $january2000Time - MarsTimeInterface::START_POINT_DIFFERENCE;

        // ratio is day scale in mars and ears
        // msd positive is a number to make start point positive
        // because midnight is not completely aligned this is the adjustment to that
        return ($startPoint / MarsTimeInterface::MARS_DAY_RATIO) + MarsTimeInterface::MSD_POSITIVE - MarsTimeInterface::ADJUSTMENT;
    }

    /**
     * Calculate MTC by MSD.
     *
     * @param \DateTime $time
     *
     * @return string
     */
    public function getCoordinatedMarsTime(\DateTime $time): string
    {
        $marsSolDate = $this->getMarsSolDate($time);

        // Convert Mars Sol Date days to second to get human readable time form that
        $marsSoleDateSecond = $marsSolDate * MarsTimeInterface::SECONDS_IN_A_DAY;

        return date('H:i:s', $marsSoleDateSecond);
    }
}
