<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 11:22
 */

namespace Finkey\LesAides\Api;


use Finkey\LesAides\Exception\ApiException;
use Finkey\LesAides\Exception\InvalidCallException;
use Finkey\LesAides\Exception\InvalidResponseException;
use Finkey\LesAides\Exception\NotFoundException;
use Finkey\LesAides\Exception\UnauthorizedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class ApiBase
{
    const BASE_URI = 'https://api.les-aides.fr';

    /**
     * @var string
     */
    private $authToken;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $clientOptions;

    /**
     * ApiBase constructor.
     * @param string $baseUri
     * @param string $authToken
     */
    public function __construct($authToken, $clientOptions = [], $baseUri = self::BASE_URI)
    {
        $this->baseUri = $baseUri;
        $this->authToken = $authToken;
        $this->clientOptions = $clientOptions;
    }

    /**
     * @param $method
     * @param $urn
     * @param array $options
     * @return mixed|null
     * @throws ApiException
     * @throws InvalidCallException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws InvalidResponseException
     */
    protected function request($method, $urn, array $options = [])
    {
        if (!isset($options['headers'])) {
            $options['headers'] = [];
        }

        $options['headers']['X-IDC'] = $this->authToken;
        $options['headers']['accept'] = 'application/json';

        try {
            $response = ($this->getClient()->request($method, $urn, array_merge([
                'http_errors' => true
            ], $options)));
            return $this->processResponse($response);
        } catch (ClientException $e) {
            $this->processException($e);
        } catch (RequestException $e) {
            throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param Response $response
     * @return mixed|null
     * @throws InvalidResponseException
     */
    private function processResponse(Response $response)
    {
        $contentType = $response->getHeaderLine('content-type');
        if (preg_match('/^application\/([a-z]*\-)?json/i', $contentType, $matches)) {
            $output = json_decode($response->getBody()->getContents(), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $output;
            }
        }
        throw new InvalidResponseException($response);
    }

    /**
     * @param ClientException $e
     * @throws ApiException
     * @throws InvalidCallException
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    private function processException(ClientException $e)
    {
        switch ($e->getResponse()->getStatusCode()) {
            case 401:
                throw new UnauthorizedException($e->getMessage(), $e->getCode(), $e);
                break;
            case 403:
                throw new InvalidCallException($e->getMessage(), $e->getCode(), $e);
                break;
            case 404:
                throw new NotFoundException($e->getMessage(), $e->getCode(), $e);
                break;
            default:
                throw new ApiException($e->getMessage(), $e->getCode(), $e);
        }
    }


    /**
     * @return Client
     */
    protected function getClient()
    {
        if ($this->client === null) {
            $this->client = new Client(array_merge($this->clientOptions, [
                'base_uri' => $this->baseUri
            ]));
        }
        return $this->client;
    }
}