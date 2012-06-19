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
 * Colorize class.
 *
 * Colorizes a GD image.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Javier Neyra
 */
class Colorize extends \ImageTransform\Transform
{

    /**
     * Red Tint.
     */
    protected $red_tint = 0;

    /**
     * Green Tint.
     */
    protected $green_tint = 0;

    /**
     * Blue Tint.
     */
    protected $blue_tint = 0;

    /**
     * Alpha.
     */
    protected $alpha = 0;

    /**
     * Construct an Colorize object.
     *
     * @param integer
     * @param integer
     * @param integer
     * @param integer
     */
    public function __construct($red, $green, $blue, $alpha = 0)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
        $this->setAlpha($alpha);
    }

    /**
     * Sets the red
     *
     * @param integer
     * @return boolean
     */
    public function setRed($red)
    {
        if (is_numeric($red))
        {
            $this->red_tint = (int) $red;

            return true;
        }

        return false;
    }

    /**
     * Gets the red
     *
     * @return integer
     */
    public function getRed()
    {
        return $this->red_tint;
    }

    /**
     * Sets the green
     *
     * @param integer
     * @return boolean
     */
    public function setGreen($green)
    {
        if (is_numeric($green))
        {
            $this->green_tint = (int) $green;

            return true;
        }

        return false;
    }

    /**
     * Gets the green
     *
     * @return integer
     */
    public function getGreen()
    {
        return $this->green_tint;
    }

    /**
     * Sets the blue
     *
     * @param integer
     * @return boolean
     */
    public function setBlue($blue)
    {
        if (is_numeric($blue))
        {
            $this->blue_tint = (int) $blue;

            return true;
        }

        return false;
    }

    /**
     * Gets the blue
     *
     * @return integer
     */
    public function getBlue()
    {
        return $this->blue_tint;
    }

    /**
     * Sets the alpha
     *
     * @param integer
     * @return boolean
     */
    public function setAlpha($alpha)
    {
        if (is_numeric($alpha))
        {
            $this->alpha = (int) $alpha;

            return true;
        }

        return false;
    }

    /**
     * Gets the alpha
     *
     * @return integer
     */
    public function getAlpha()
    {
        return $this->alpha;
    }

    /**
     * Apply the transform to the sfImage object.
     *
     * @access protected
     * @param \ImageTransform\Image
     * @return \ImageTransform\Image
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        // Use GD's built in filter
        if (function_exists('imagefilter'))
        {
            // we have to check for the php version as alpha support was added to imagefilter/IMG_FILTER_COLORIZE in 5.2.5
            if (strnatcmp(phpversion(), '5.2.5') >= 0)
            {
                imagefilter($resource, IMG_FILTER_COLORIZE, $this->red_tint, $this->green_tint, $this->blue_tint, $this->alpha);
            }
            else
            {
                imagefilter($resource, IMG_FILTER_COLORIZE, $this->red_tint, $this->green_tint, $this->blue_tint);
            }
        }

        // Throw Exception....
        // Alpha not supported
        else
        {
            throw new \ImageTransform\Exception("Transformation not supported");
        }

        return $image;
    }

}
