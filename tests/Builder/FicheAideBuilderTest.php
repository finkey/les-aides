<?php

namespace Finkey\LesAides\Tests\Builder;

use Finkey\LesAides\Builder\FicheAideBuilder;
use Finkey\LesAides\Exception\BuilderException;
use PHPUnit\Framework\TestCase;

class FicheAideBuilderTest extends TestCase
{
    public function testGetQuery()
    {
        try {
            (new FicheAideBuilder())->getQuery();
        } catch(\Exception $e) {
            $this->assertTrue($e instanceof BuilderException);
        }
        try {
            (new FicheAideBuilder())->setDispositif(1)->getQuery();
        } catch(\Exception $e) {
            $this->assertTrue($e instanceof BuilderException);
        }
        try {
            (new FicheAideBuilder())->setRequestId(1)->getQuery();
        } catch(\Exception $e) {
            $this->assertTrue($e instanceof BuilderException);
        }

        $this->assertEquals([
            'rid' => 1,
            'dispositif' => 2
        ], (new FicheAideBuilder())->setRequestId(1)->setDispositif(2)->getQuery());

    }

}
