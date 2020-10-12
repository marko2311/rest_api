<?php

require('vendor/autoload.php');

class GameTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => "http://127.0.0.1:8000"
        ]);
    }

    public function testGet_ValidInput_GameObject()
    {
        $response = $this->client->get('/games', [
            'query' => [
                'id' => '1'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('price', $data);
    }
}