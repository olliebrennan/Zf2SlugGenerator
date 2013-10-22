<?php
namespace Zf2SlugGeneratorTest\Entity;

use Zf2SlugGenerator\Exception\SlugException;

class SlugExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check extends domain exception
     */
    public function testExtendsDomainException()
    {
        $exception = new SlugException();
        $this->assertTrue($exception instanceof \DomainException);
    }
}

