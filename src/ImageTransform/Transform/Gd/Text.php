<?php

/**
 * This file is part of the Image Transform Library.
 * (c) 2012 Javier Neyra 
 * 
 * Based on sfImageTransform from Stuart Lowes <stuart.lowes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ImageTransform\Transform\Gd;

/**
 *
 * Text class.
 *
 * Adds text to the image.
 *
 * @package sfImageTransform
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @version SVN: $Id$
 */
class Text extends \ImageTransform\Transform
{

    /**
     * Font face.
     */
    protected $font = 'Arial';

    /**
     * Font size.
     */
    protected $size = 10;

    /**
     * Text.
     */
    protected $text = '';

    /**
     * Angel of the text.
     */
    protected $angle = 0;

    /**
     * X coordinate.
     */
    protected $x = 0;

    /**
     * Y coordinate.
     */
    protected $y = 0;

    /**
     * Font Color.
     */
    protected $color = '#000000';

    /**
     * Path to font.
     */
    protected $font_dir = '';

    /**
     * Construct an sfImageText object.
     *
     * @param array integer
     */
    public function __construct($text, $x = 0, $y = 0, $size = 10, $font = 'Arial',$color = '#000000', $angle = 0)
    {
        /**
         * @todo FIXME!! see how can in import fonts.... 
         */
        //$this->font_dir = sfConfig::get('app_sfImageTransformPlugin_font_dir','/usr/share/fonts/truetype/msttcorefonts');
        $this->setText($text);
        $this->setX($x);
        $this->setY($y);
        $this->setSize($size);
        $this->setFont($font);
        $this->setColor($color);
        $this->setAngle($angle);
    }

    /**
     * Sets the text.
     *
     * @param string
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Gets the text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets X coordinate.
     *
     * @param integer
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * Gets X coordinate.
     *
     * @return integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Sets Y coordinate.
     *
     * @param integer
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * Gets Y coordinate.
     *
     * @return integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Sets text size.
     *
     * @param integer
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * Gets text size.
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets text font.
     *
     * @param string
     */
    public function setFont($font)
    {
        $this->font = str_replace(' ', '_', $font);
    }

    /**
     * Gets text font.
     *
     * @return string
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Sets text color.
     *
     * @param string
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * Gets text color.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets text angle.
     *
     * @param string
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;
    }

    /**
     * Gets text angle.
     *
     * @return string
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * Apply the transform to the sfImage object.
     *
     * @access protected
     * @param sfImage
     * @return sfImage
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        /**
         *@todo fixme: for now, font must be full font path.... 
         */
        //$this->font = $this->font_dir . DIRECTORY_SEPARATOR . $this->font . '.ttf';
        

        $box = imageTTFBbox($this->size, $this->angle, $this->font, $this->text);

        $textwidth = abs($box[4] - $box[0]) - 4;
        $textheight = abs($box[5] - $box[1]) - 4;

        $rgb = sscanf($this->color, '#%2x%2x%2x');

        $color = imagecolorallocate($resource, $rgb[0], $rgb[1], $rgb[2]);

        // disable alpha handling to enable font rendering
        imagealphablending($resource, true);

        imagettftext($resource, $this->size, $this->angle, $this->x, $this->y + $textheight, $color, $this->font, $this->text);

        return $image;
    }

}
