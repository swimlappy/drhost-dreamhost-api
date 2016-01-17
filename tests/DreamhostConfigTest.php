<?php

namespace Dreamhost\Test;

use Dreamhost\Dreamhost;
use Dreamhost\Test\TestCase;

class DreamhostConfigTest extends TestCase
{
    public function testHasApiKey()
    {
        Dreamhost::setApiKey('1234');
        $this->assertEquals(Dreamhost::apiKey(), '1234');
    }

    public function testOutputFormat()
    {
        Dreamhost::setOutputFormat('yaml');
        $this->assertEquals(Dreamhost::outputFormat(), 'yaml');
    }

    /**
     * @expectedException Dreamhost\Exceptions\InvalidOutputFormatException
     */
    public function testInvalidOutputFormatException()
    {
        Dreamhost::setOutputFormat('txt');
    }
}
