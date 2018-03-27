<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 12:08
 */

namespace Finkey\LesAides\Builder;

use Finkey\LesAides\Exception\BuilderException;

class ListeCommunesBuilder
{
    /**
     * @var string
     */
    private $departement;

    /**
     * @var string
     */
    private $commune;

    /**
     * ListeCommunesBuilder constructor.
     * @param null|string $commune
     * @param null|string $departement
     */
    public function __construct($commune = null, $departement = null)
    {
        $this
            ->setCommune($commune)
            ->setDepartement($departement)
        ;
    }

    /**
     * @param string $departement
     * @return $this
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
        return $this;
    }

    /**
     * @param string $commune
     * @return $this
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;
        return $this;
    }

    /**
     * @return array
     * @throws BuilderException
     */
    public function getQuery()
    {
        if (!empty($this->commune) && strlen($this->commune) <= 3 && empty($this->departement)) {
            throw new BuilderException(sprintf(
                'Pour remplir uniquement le champ commune, vous devez utilisez le code INSEE (%s) ou définir le departement',
                'http://www.insee.fr/fr/methodes/nomenclatures/cog/default.asp'
            ));
        }

        $query = [];
        if (!empty($this->commune)) {
            $query['commune'] = $this->commune;
        }
        if (!empty($this->departement)) {
            $query['departement'] = $this->departement;
        }

        return $query;
    }

}