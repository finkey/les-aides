<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 27/03/18
 * Time: 14:29
 */

namespace Finkey\LesAides\Tests\Builder;

use Finkey\LesAides\Builder\ListeCommunesBuilder;
use Finkey\LesAides\Exception\BuilderException;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;

class ListeCommunesBuilderTest extends TestCase
{
    public function testGetQuery()
    {
        try {
            (new ListeCommunesBuilder())
                ->setCommune('01')
                ->getQuery()
            ;
            throw new Exception('It must throw');
        } catch (\Exception $e) {
            $this->assertTrue($e instanceof BuilderException);
        }

        $builder = new ListeCommunesBuilder();

        $this->assertEquals([
            'commune' => '01',
            'departement' => '02'
        ], $builder->setCommune('01')->setDepartement('02')->getQuery());
    }
}
