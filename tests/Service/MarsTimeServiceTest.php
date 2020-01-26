<?php

namespace App\Test\Service;

use App\Service\MarsTimeService;
use PHPUnit\Framework\TestCase;

class MarsTimeServiceTest extends TestCase
{
    public function testGetMarsSolDate()
    {
        $marsTimeService = new MarsTimeService();

        $date = new \DateTime('Sat, 25 Jan 2020 14:26:14'); // MSD is 51924.6265

        $mts = $marsTimeService->getMarsSolDate($date);

        $this->assertIsFloat($mts);
        $this->assertEquals(51924.6265, round($mts, 4));

        $date = new \DateTime('Sat, 25 Jan 2020 14:36:13'); // MSD is 51924.6333
        $mts  = $marsTimeService->getMarsSolDate($date);

        $this->assertIsFloat($mts);
        $this->assertEquals(51924.6333, round($mts, 4));
    }

    public function testGetCoordinatedMarsTime()
    {
        $marsTimeService = new MarsTimeService();

        $date = new \DateTime('Sat, 25 Jan 2020 14:26:14'); // MTC is 15:02:10

        $mtc = $marsTimeService->getCoordinatedMarsTime($date);

        $this->assertIsString($mtc);
        $this->assertEquals('15:02:10', $mtc);

        $date = new \DateTime('Sat, 25 Jan 2020 14:36:13'); // MTC is 15:11:53
        $mtc  = $marsTimeService->getCoordinatedMarsTime($date);

        $this->assertIsString($mtc);
        $this->assertEquals('15:11:53', $mtc);
    }
}
