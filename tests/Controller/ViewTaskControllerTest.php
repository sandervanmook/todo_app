<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ViewTaskControllerTest extends WebTestCase
{
    public function testItCantFindTask()
    {
        $client = static::createClient();
        $client->request('GET', '/task/view/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Task with id 1 not found', $client->getResponse()->getContent());
    }
}
