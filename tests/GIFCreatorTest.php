<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 2017/11/2
 * Time: 16:02
 */

use cdcchen\gif\GIFCreator;
use PHPUnit\Framework\TestCase;

class GIFCreatorTest extends TestCase
{
    public function testInstance()
    {
        $images = [];
        for ($i = 0; $i < 15; $i++) {
            $images[] = __DIR__ . "/create/image{$i}.jpg";
        }
        $delays = array_fill(0, 15, 10);
        $creator = new GIFCreator($images, $delays);

        $this->assertInstanceOf(GIFCreator::class, $creator);

        return $creator;
    }

    /**
     * @param GIFCreator $creator
     * @depends testInstance
     */
    public function testCreate(GIFCreator $creator)
    {
        $creator->setColor(255, 255, 255);
        $creator->create();
        file_put_contents(__DIR__ . '/create/new.gif', $creator->getGIF());

        $this->assertTrue(is_string($creator->getGIF()));
    }

    /**
     * @param GIFCreator $creator
     * @depends testInstance
     */
    public function testGetGif(GIFCreator $creator)
    {
        $creator->setColor(255, 255, 255);
        $creator->create();
        file_put_contents(__DIR__ . '/create/new.gif', $creator->getGIF());
        $this->assertTrue(is_string($creator->getGIF()));
    }

    /**
     * @param GIFCreator $creator
     * @depends testInstance
     */
    public function testToString(GIFCreator $creator)
    {
        $creator->create();
        $this->assertTrue(is_string((string)$creator));
    }
}