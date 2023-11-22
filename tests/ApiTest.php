<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    public function testLoginCheck()
    {
        $client = static::createClient();

        $client->request('GET', '/api', [], [], ['CONTENT_TYPE' => 'application/json']);

        $response = $client->getResponse();

        $this->assertSame(401, $response->getStatusCode());
    }
}