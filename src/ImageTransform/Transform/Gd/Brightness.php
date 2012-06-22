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
 * Brightness class.
 *
 * Sets the brightness of a GD image.
 *
 * @package \ImageTransform\Image
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Brightness extends \imageTransform\Transform
{

    /**
     * Constract level to be applied.
     */
    protected $brightness = 0;

    /**
     * Construct an Brightness object.
     *
     * @param integer
     */
    public function __construct($brightness)
    {
        $this->setBrightness($brightness);
    }

    /**
     * Sets the brightness
     *
     * @param integer
     * @return boolean
     */
    public function setBrightness($brightness)
    {
        if (is_numeric($brightness))
        {
            $this->brightness = (int) $brightness;

            return true;
        }

        return false;
    }

    /**
     * Gets the brightness
     *
     * @return integer
     */
    public function getBrightness()
    {
        return $this->brightness;
    }

    /**
     * Apply the transform to the \ImageTransform\Image object.
     *
     * @access protected
     * @param \ImageTransform\Image
     * @return \ImageTransform\Image
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        if (function_exists('imagefilter'))
        {
            imagefilter($resource, IMG_FILTER_BRIGHTNESS, $this->brightness);
        }
        else
        {
            throw new \ImageTransform\Exception(sprintf('Cannot perform transform, GD does not support imagefilter '));
        }

        return $image;
    }

}
