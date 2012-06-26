<?php

namespace ImageTransform\Test;

use ImageTransform\Image;

class ImageTest extends \PHPUnit_Framework_TestCase
{   
    public function testLoad()
    {
        //load an image        
        $image = new \ImageTransform\Image(realpath(__DIR__).'/images/ball.jpg');
        
        //image is jpeg so...
        $this->assertTrue($image->getMIMEType() == 'image/jpeg','asserting than image is jpg');        
    }
    
    /**********************************************************************************************************/
    /*                            Generic Transformation tests                                                */
    /**********************************************************************************************************/
    public function testBorder()
    {
        //load an image        
        $image = new \ImageTransform\Image(realpath(__DIR__).'/images/ball.jpg');        
        
        //adding a border
        $image->border(3,'#000000');
        
        $image->saveAs(realpath(__DIR__).'/images/testOutput/test_border.jpg');
        $this->assertTrue($image->getMIMEType() == 'image/jpeg','asserting than image is jpg');        
    }
    
    public function testResize()
    {
        $image = new \ImageTransform\Image(realpath(__DIR__).'/images/ball.jpg');        
        
        $image1 = $image->copy();
        $image2 = $image->copy();
        $image3 = $image->copy();
        $image4 = $image->copy();
        
        //Resize default (inflate + proportional)        
        $image1->resize(800,600);
        //Resize default (inflate)        
        $image2->resize(800,600,true,false);
        //Resize default (proportional)        
        $image3->resize(800,600,false,true);
        //Resize default (none)        
        $image4->resize(800,600,false,false);
        
        //if inflate is set to false,  it will do nothing!
        
        $image1->saveAs(realpath(__DIR__).'/images/testOutput/test_resize_inflate_proportional.jpg');
        $image2->saveAs(realpath(__DIR__).'/images/testOutput/test_resize_inflate.jpg');
        $image3->saveAs(realpath(__DIR__).'/images/testOutput/test_resize_proportional.jpg');
        $image4->saveAs(realpath(__DIR__).'/images/testOutput/test_resize_none.jpg');
        $this->assertTrue($image->getMIMEType() == 'image/jpeg','asserting than image is jpg');                
    }
    
    public function testThumbnail()
    {
        /**
         * @todo add more method testing 
         */
        $image = new \ImageTransform\Image(realpath(__DIR__).'/images/ball.jpg');
        $background = '#FF0000';
        
        //method fit, background null        
        $image1 = $image->copy();
        $image1->thumbnail(100, 100);
        $image1->saveAs(realpath(__DIR__).'/images/testOutput/test_thumbnail_fit_null.jpg');
        //method fit, with background
        $image2 = $image->copy();
        $image2->thumbnail(400, 100, 'fit', $background);
        $image2->saveAs(realpath(__DIR__).'/images/testOutput/test_thumbnail_fit_background.jpg');
        //method scale, background null        
        $image3 = $image->copy();
        $image3->thumbnail(100, 100,'scale');
        $image3->saveAs(realpath(__DIR__).'/images/testOutput/test_thumbnail_scale_null.jpg');
        //method scale, with background
        $image4 = $image->copy();
        $image4->thumbnail(400, 800, 'scale', $background);
        $image4->saveAs(realpath(__DIR__).'/images/testOutput/test_thumbnail_scale_background.jpg');
        
        $this->assertTrue(true);
    }
    
    public function testCallback()
    {
        /**
         * @todo make this test 
         */
        $this->assertTrue(true);
    }
    
    /**********************************************************************************************************/
    /*                            Gd Transformation tests                                                     */
    /**********************************************************************************************************/
    
    public function testAlphaMask()
    {
        //load an image        
        $image = new \ImageTransform\Image(realpath(__DIR__).'/images/images.jpg');        
        //load an image as mask
        $mask = new \ImageTransform\Image(realpath(__DIR__).'/images/mask.png');        
        
        //adding a border
        $image->alphaMask($mask);
        
        $image->saveAs(realpath(__DIR__).'/images/testOutput/test_alpha.png','image/png');
        $this->assertTrue(true);        
    }
    
    public function testArc()
    {
        //load an image        
        $image = new \ImageTransform\Image(realpath(__DIR__).'/images/images.jpg');        
        
        //adding a border
        $image->arc(100, 100, 200, 200, 15, 185, 10);
        
        $image->saveAs(realpath(__DIR__).'/images/testOutput/test_arc.jpg');
        $this->assertTrue(true);        
    }
}