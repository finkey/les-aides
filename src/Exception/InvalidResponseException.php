<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 12:00
 */

namespace Finkey\LesAides\Exception;


use GuzzleHttp\Psr7\Response;
use Throwable;

class InvalidResponseException extends ApiException
{
    /**
     * @var Response
     */
    private $response;

    public function __construct(Response $response, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}