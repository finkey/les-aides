<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 11:49
 */

namespace Finkey\LesAides\Api;


use Finkey\LesAides\Builder\FicheAideBuilder;
use Finkey\LesAides\Builder\ListeCommunesBuilder;
use Finkey\LesAides\Builder\SearchBuilder;

class Api extends ApiBase
{
    /**
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeNaf()
    {
        return $this->request('GET', '/liste/naf');
    }

    /**
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeFiliaires()
    {
        return $this->request('GET', '/liste/filieres');
    }

    /**
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeRegions()
    {
        return $this->request('GET', '/liste/regions');
    }

    /**
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeDepartements()
    {
        return $this->request('GET', '/liste/departements');
    }

    /**
     * @param ListeCommunesBuilder|null $builder
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\BuilderException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeCommunes(ListeCommunesBuilder $builder = null)
    {
        return $this->request('GET', '/liste/communes', [ 'query' => ($builder ? $builder->getQuery() : []) ]);
    }

    /**
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeDomaines()
    {
        return $this->request('GET', '/liste/domaines');
    }

    /**
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getListeMoyens()
    {
        return $this->request('GET', '/liste/moyens');
    }

    /**
     * @param SearchBuilder $builder
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function search(SearchBuilder $builder)
    {
        return $this->request('GET', '/aides', [ 'query' => $builder->getQuery() ]);
    }

    /**
     * @param FicheAideBuilder $builder
     * @return mixed|null
     * @throws \Finkey\LesAides\Exception\ApiException
     * @throws \Finkey\LesAides\Exception\BuilderException
     * @throws \Finkey\LesAides\Exception\InvalidCallException
     * @throws \Finkey\LesAides\Exception\InvalidResponseException
     * @throws \Finkey\LesAides\Exception\NotFoundException
     * @throws \Finkey\LesAides\Exception\UnauthorizedException
     */
    public function getFicheAide(FicheAideBuilder $builder)
    {
        return $this->request('GET', '/aide', [ 'query' => $builder->getQuery() ]);
    }
}

