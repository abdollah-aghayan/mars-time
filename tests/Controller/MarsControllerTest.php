<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MarsControllerTest extends WebTestCase
{
    public function testIndexWithoutDate()
    {
        $client = static::createClient();

        $client->request('GET', '/mars-time');

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $client->getResponse()->getStatusCode());
    }

    public function testIndexWithWrongDateFormat()
    {
        $client = static::createClient();

        $client->request('GET', '/mars-time?time=2001-3-1 17:16:18');

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $client->getResponse()->getStatusCode());
    }

    public function testIndexWithDate()
    {
        $client = static::createClient();

        $client->request('GET', '/mars-time?time=2001-03-10 17:16:18');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);

        $this->assertIsArray($content);
        $this->assertArrayHasKey('MTC', $content);
    }
}
