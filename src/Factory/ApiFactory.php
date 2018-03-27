<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 11:52
 */

namespace Finkey\LesAides\Factory;


use Finkey\LesAides\Api\Api;
use Finkey\LesAides\Api\ApiBase;

class ApiFactory
{
    /**
     * @param string $authToken
     * @param array $clientOptions
     * @param string $baseUri
     * @return Api
     */
    public function createApi($authToken, array $clientOptions = [], $baseUri = ApiBase::BASE_URI)
    {
        return new Api($authToken, $clientOptions, $baseUri);
    }
}