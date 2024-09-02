<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
class HomeTest extends TestCase
{
    private ?Client $http;

    protected function setUp(): void
    {
        $this->http = new Client(['base_url' => 'http://localhost:8080/']);
    }

    protected function tearDown(): void
    {
        $this->http = null;
    }

    public function testHomePage()
    {
        $response = $this->http->request('GET', 'http://192.168.18.8:8080/');

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertStringContainsString('alguma coisa', $response->getBody()->getContents());
    }
}