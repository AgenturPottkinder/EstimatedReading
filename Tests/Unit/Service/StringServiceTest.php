<?php
namespace Pottkinder\Estimatedreading\Tests\Unit\Service;

use Pottkinder\Estimatedreading\Service\StringService;

/**
 * StringServiceTest
 */
class StringServiceTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function testGetCharsWithoutSpaces()
    {
        $this->assertEquals('5', StringService::getCharsWithoutSpaces('Hallo'));
        $this->assertEquals('9', StringService::getCharsWithoutSpaces('Hallo Welt'));
        $this->assertEquals('0', StringService::getCharsWithoutSpaces(''));
        $this->assertEquals('14', StringService::getCharsWithoutSpaces(' Das ist das Haus! '));
        $this->assertEquals('5', StringService::getCharsWithoutSpaces('12345'));
    }

    /**
     * @test
     */
    public function testGetChars()
    {
        $this->assertEquals(5, StringService::getChars('Hallo'));
        $this->assertEquals(10, StringService::getChars('Hallo Welt'));
        $this->assertEquals(0, StringService::getChars(''));
        $this->assertEquals(19, StringService::getChars(' Das ist das Haus! '));
        $this->assertEquals(5, StringService::getChars('12345'));
    }

    /**
     * @test
     */
    public function testRemoveHTML()
    {
        $this->assertEquals('Hallo', StringService::removeHTML('Hallo'));
        $this->assertEquals('Hallo', StringService::removeHTML('<span>Hallo</span>'));
        $this->assertEquals('Hallo', StringService::removeHTML('<span>Hallo</span><br />'));
        $this->assertEquals('', StringService::removeHTML('<div class="Hallo"></div>'));
        $this->assertEquals('123', StringService::removeHTML('<div class="Hallo">123</div>'));
        $this->assertEquals('', StringService::removeHTML(''));
        $this->assertEquals('Hallo', StringService::removeHTML('<span><div>Hallo</div></span><br />'));
    }

    /**
     * @test
     */
    public function testGetSentences()
    {
        $this->assertEquals(1, StringService::getSentences('Hallo'));
        $this->assertEquals(1, StringService::getSentences('Hallo!'));
        $this->assertEquals(2, StringService::getSentences('Hallo! Hallo?'));
        $this->assertEquals(1, StringService::getSentences('Hallo...'));
        $this->assertEquals(3, StringService::getSentences('Hallo... Hallo? Hallo!'));
    }

    /**
     * @test
     */
    public function testGetWordCount()
    {
        $this->assertEquals(1, StringService::getWordCount('Hallo'));
        $this->assertEquals(2, StringService::getWordCount('Hallo Welt'));
        $this->assertEquals(3, StringService::getWordCount('Hallo Welt 123'));
        $this->assertEquals(1, StringService::getWordCount('Hallo_Welt'));
        $this->assertEquals(1, StringService::getWordCount('Hallo-Welt!123'));
    }
}
