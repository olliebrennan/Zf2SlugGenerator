<?php
namespace Zf2SlugGeneratorTest\Mapper\Exception;

use Zf2SlugGenerator\Mapper\Exception\DbTableException;
class DbTableExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check extends domain exception
     */
    public function testExtendsRuntimeException()
    {
        $exception = new DbTableException();
        $this->assertTrue($exception instanceof \RuntimeException);
    }
}

