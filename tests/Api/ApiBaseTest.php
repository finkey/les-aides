<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 14:56
 */

namespace Finkey\LesAides\Tests\Api;

use Finkey\LesAides\Api\Api;
use Finkey\LesAides\Builder\SearchBuilder;
use Finkey\LesAides\Exception\ApiException;
use Finkey\LesAides\Exception\InvalidCallException;
use Finkey\LesAides\Exception\InvalidResponseException;
use Finkey\LesAides\Exception\NotFoundException;
use Finkey\LesAides\Exception\UnauthorizedException;
use Finkey\LesAides\Factory\ApiFactory;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ApiBaseTest extends TestCase
{
    /**
     * @var ApiFactory
     */
    private $factory;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->factory = new ApiFactory();
    }

    public function testApiBase()
    {
        $mock = new MockHandler([
            new Response(200, ['content-type' => 'application/json'], '{"results": true}'),
            new Response(401, ['content-type' => 'text/html'], 'token missing'),
            new Response(403, ['content-type' => 'application/json'], '{"results": false}'),
            new Response(404, ['content-type' => 'application/json'], '{"results": false}'),
            new Response(500, ['content-type' => 'application/json'], '{"results": false}'),
            new Response(200, ['content-type' => 'application/json'], '{"results": '),
            new Response(200, ['content-type' => 'test/html'], 'wtf'),
        ]);

        $handler = HandlerStack::create($mock);
        $api = $this->factory->createApi('', [ 'handler' => $handler ]);

        $response = $api->getListeDepartements();
        $this->assertEquals([ 'results' => true ], $response);

        try {
            $api->getListeDepartements();
            throw new \Exception('This call must throw UnauthorizedException');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof UnauthorizedException);
        }

        try {
            $api->getListeDepartements();
            throw new \Exception('This call must throw InvalidCallException');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof InvalidCallException);
        }

        try {
            $api->getListeDepartements();
            throw new \Exception('This call must throw NotFoundException');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof NotFoundException);
        }

        try {
            $api->getListeDepartements();
            throw new \Exception('This call must throw ApiException');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof ApiException);
        }

        try {
            $api->getListeDepartements();
            throw new \Exception('This call must throw InvalidResponseException');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof InvalidResponseException);
        }

        try {
            $api->getListeDepartements();
            throw new \Exception('This call must throw InvalidResponseException');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof InvalidResponseException);
        }
    }
}
