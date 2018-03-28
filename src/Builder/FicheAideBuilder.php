<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 12:32
 */

namespace Finkey\LesAides\Builder;


use Finkey\LesAides\Exception\BuilderException;

class FicheAideBuilder
{
    /**
     * @var integer
     */
    private $requestId;
    /**
     * @var integer
     */
    private $dispositif;

    /**
     * FicheAideBuilder constructor.
     * @param integer|null $requestId
     * @param integer|null $dispositif
     */
    public function __construct($requestId = null, $dispositif = null)
    {
        $this->requestId = $requestId;
        $this->dispositif = $dispositif;
    }

    /**
     * @param integer $dispositif
     * @return $this
     */
    public function setDispositif($dispositif)
    {
        $this->dispositif = $dispositif;
        return $this;
    }

    /**
     * @param integer $rid
     * @return $this
     */
    public function setRequestId($rid)
    {
        $this->requestId = $rid;
        return $this;
    }

    /**
     * @return array
     * @throws BuilderException
     */
    public function getQuery()
    {
        if (empty($this->requestId) || empty($this->dispositif)) {
            throw new BuilderException('You must define both dispositif and requestId');
        }

        return [
            'requete' => $this->requestId,
            'dispositif' => $this->dispositif
        ];
    }

}