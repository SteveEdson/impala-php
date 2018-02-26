<?php

use Impala\Api;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Middleware;

class ApiTest extends TestCase
{
    protected $client;
    protected $container;

    public function setUp()
    {
        $this->container = [];
        $history = Middleware::history($this->container);
        $mock = new MockHandler([
            new Response(200),
            new RequestException("Error", new Request('GET', 'test'))
        ]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);
        $this->client = new Client(['handler' => $handler]);
    }

    public function testMakesRequestWithAuthenticationKey()
    {
        $api = new Api('dummy', $this->client);

        $api->makeRequest('GET', 'test');
        $request = $this->container[0]['request'];

        $this->assertEquals($request->getHeader('Authorization'), ['Bearer dummy']);
    }

    public function testMakesRequestWithCorrectPathAndMethod()
    {
        $api = new Api('dummy', $this->client);

        $api->makeRequest('POST', 'test');
        $request = $this->container[0]['request'];

        $this->assertEquals($request->getUri()->getPath(), 'test');
        $this->assertEquals($request->getMethod(), 'POST');
    }

    public function testMakesRequestWithParams()
    {
        $api = new Api('dummy', $this->client);

        $params = [
            'query' => ['param' => 'test'],
        ];
        $api->makeRequest('GET', 'test', $params);
        $request = $this->container[0]['request'];

        $queryString = 'param=test';
        $this->assertEquals($request->getUri()->getQuery(), $queryString);
    }

    public function testExceptionIsThrownWithCorrectMessage()
    {
        $mock = new MockHandler([
            new RequestException("Error", new Request('GET', 'test')),
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $api = new Api('dummy', $client);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Could not make request to Impala API: Error');
        $api->makeRequest('GET', 'test');
    }
}
