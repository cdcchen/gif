<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 2017/11/2
 * Time: 15:13
 */

use cdcchen\gif\GIFExtractor;
use PHPUnit\Framework\TestCase;

class GIFExtractorTest extends TestCase
{
    public function testIsAnimatedGif()
    {
        $gif = __DIR__ . '/extract/timg.gif';

        $this->assertTrue(GIFExtractor::isAnimatedGif($gif));
    }

    public function testExtract()
    {
        $gif = __DIR__ . '/extract/timg.gif';
        $extractor = new GIFExtractor();
        $images = $extractor->extract($gif);

        $this->assertTrue(is_array($images));

        foreach ($images as $index => ['duration' => $duration, 'image' => $image]) {
            file_put_contents(__DIR__ . "/extract/image{$index}.jpg", $image);
        }

        return $images;
    }

    /**
     * @param $images
     * @depends testExtract
     */
    public function testExtractFramesCount($images)
    {
        $this->assertGreaterThan(1, count($images));
    }

    /**
     * @param $images
     * @depends testExtract
     */
    public function testExtractFrameHasDuration($images)
    {
        $this->assertArrayHasKey('duration', $images[0]);
    }

    /**
     * @param $images
     * @depends testExtract
     */
    public function testExtractFrameHasImage($images)
    {
        $this->assertArrayHasKey('image', $images[0]);
    }
}