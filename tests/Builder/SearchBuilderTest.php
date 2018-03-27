<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 14:48
 */

namespace Finkey\LesAides\Tests\Builder;

use Finkey\LesAides\Builder\SearchBuilder;
use PHPUnit\Framework\TestCase;

class SearchBuilderTest extends TestCase
{

    public function testGetQuery()
    {
        $builder = new SearchBuilder();
        $builder->addDomaine(123);
        $this->assertEquals([ 'domaine' => [ 123 ] ], $builder->getQuery());

        $builder->removeDomaine(123);
        $this->assertEquals([ ], $builder->getQuery());

        $builder = new SearchBuilder();
        $builder->addMoyen(123);
        $this->assertEquals([ 'moyen' => [ 123 ] ], $builder->getQuery());

        $builder->removeMoyen(123);
        $this->assertEquals([ ], $builder->getQuery());

        $builder
            ->setDepartement('01')
            ->setCommune('02')
            ->setRegion('03')
            ->setApe('04')
            ->setDomaines([ 1, 2, 3 ])
            ->setFiliere('06')
            ->setMoyens([ 3, 2, 1 ])
            ->setSiren('08')
            ->setSiret('09')
        ;

        $this->assertEquals([
            'departement' => '01',
            'commune'     => '02',
            'region'      => '03',
            'ape'         => '04',
            'domaine'     => [ 1, 2, 3 ],
            'filiere'     => '06',
            'moyen'       => [ 3, 2, 1 ],
            'siren'       => '08',
            'siret'       => '09'
        ], $builder->getQuery());

    }
}
