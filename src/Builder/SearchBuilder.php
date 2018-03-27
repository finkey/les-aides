<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 12:16
 */

namespace Finkey\LesAides\Builder;


class SearchBuilder
{
    const MAPPING = [
        'siret'       => 'siret',
        'commune'     => 'commune',
        'siren'       => 'siren',
        'moyens'      => 'moyen',
        'filiere'     => 'filiere',
        'region'      => 'region',
        'departement' => 'departement',
        'domaines'    => 'domaine',
        'ape'         => 'ape'
    ];

    /**
     * @var string
     */
    private $siret;
    /**
     * @var string
     */
    private $siren;
    /**
     * @var integer[]
     */
    private $moyens = [];
    /**
     * @var string
     */
    private $filiere;
    /**
     * @var string
     */
    private $region;
    /**
     * @var string
     */
    private $departement;
    /**
     * @var string
     */
    private $commune;
    /**
     * @var integer[]
     */
    private $domaines = [];
    /**
     * @var string
     */
    private $ape;

    /**
     * @param string $siret
     * @return SearchBuilder
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
        return $this;
    }

    /**
     * @param string $siren
     * @return SearchBuilder
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
        return $this;
    }

    /**
     * @param integer[] $moyens
     * @return SearchBuilder
     */
    public function setMoyens(array $moyens = [])
    {
        $this->moyens = $moyens;
        return $this;
    }

    /**
     * @param integer $moyen
     * @return $this
     */
    public function removeMoyen($moyen)
    {
        if (($offset = array_search($moyen, $this->moyens)) !== false) {
            array_splice($this->moyens, $offset, 1);
        }
        return $this;
    }

    /**
     * @param integer $moyen
     * @return $this
     */
    public function addMoyen($moyen)
    {
        if (!in_array($moyen, $this->moyens)) {
            $this->moyens[] = $moyen;
        }
        return $this;
    }

    /**
     * @param string $filiere
     * @return SearchBuilder
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;
        return $this;
    }

    /**
     * @param string $region
     * @return SearchBuilder
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @param string $departement
     * @return SearchBuilder
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
        return $this;
    }

    /**
     * @param string $commune
     * @return SearchBuilder
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;
        return $this;
    }

    /**
     * @param integer[] $domaines
     * @return SearchBuilder
     */
    public function setDomaines(array $domaines = [])
    {
        $this->domaines = $domaines;
        return $this;
    }

    /**
     * @param integer $domaine
     * @return $this
     */
    public function removeDomaine($domaine)
    {
        if (($offset = array_search($domaine, $this->domaines)) !== false) {
            array_splice($this->domaines, $offset, 1);
        }
        return $this;
    }

    /**
     * @param integer $domaine
     * @return $this
     */
    public function addDomaine($domaine)
    {
        if (!in_array($domaine, $this->domaines)) {
            $this->domaines[] = $domaine;
        }
        return $this;
    }

    /**
     * @param string $ape
     * @return SearchBuilder
     */
    public function setApe($ape)
    {
        $this->ape = $ape;
        return $this;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        $output = [];
        foreach (self::MAPPING as $original => $new) {
            $value = $this->$original;
            if ($value !== null && (!is_array($value) || !empty($value))) {
                $output[$new] = $value;
            }
        }

        return $output;
    }

}