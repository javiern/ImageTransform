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
 * Smooth class.
 *
 * Greyscales an image.
 *
 * Reduces the level of detail of an image.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Smooth extends \ImageTransform\Transform
{

    /**
     * Smoothness level to be applied.
     */
    protected $smoothness = 0;

    /**
     * Construct an sfImageSmooth object.
     *
     * @param integer
     */
    public function __construct($smoothness = 0)
    {
        $this->setSmoothness($smoothness);
    }

    /**
     * Sets the smoothness
     *
     * @param integer
     * @return boolean
     */
    public function setSmoothness($smoothness)
    {
        if (is_numeric($smoothness))
        {
            $this->smoothness = (int) $smoothness;

            return true;
        }

        return false;
    }

    /**
     * Gets the smoothness
     *
     * @return integer
     */
    public function getSmoothness()
    {
        return $this->smoothness;
    }

    /**
     * Apply the transform to the sfImage object.
     *
     * @param sfImage
     * @return sfImage
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        if (function_exists('imagefilter'))
        {
            imagefilter($resource, IMG_FILTER_SMOOTH, $this->smoothness);
        }
        else
        {
            throw new sfImageTransformException(sprintf('Cannot perform transform, GD does not support imagefilter '));
        }

        return $image;
    }

}
