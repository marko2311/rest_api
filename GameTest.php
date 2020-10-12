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

    public function testPost_NewGame()
    {
        $gameId = uniqid();

        $response = $this->client->post('/games', [
            'json' => [
                'name'      => 'Test game 2',
                'price'     => 2.22
            ]
        ]);

        $this->assertEquals(201, $response->getStatusCode());

    }
}