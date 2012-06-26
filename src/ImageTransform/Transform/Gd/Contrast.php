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
 * Contrast
 *
 * Sets the contrast of an GD image.
 *
 * Reduces the level of detail of an GD image.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Contrast extends \ImageTransform\Transform
{

    /**
     * Contrast level to be applied.
     */
    protected $contrast = 0;

    /**
     * Construct an Contrast object.
     *
     * @param integer
     */
    public function __construct($contrast)
    {
        $this->setContrast($contrast);
    }

    /**
     * Sets the contrast
     *
     * @param integer
     * @return boolean
     */
    public function setContrast($contrast)
    {
        if (is_numeric($contrast))
        {
            $this->contrast = (int) $contrast;

            return true;
        }

        return false;
    }

    /**
     * Gets the contrast
     *
     * @return integer
     */
    public function getContrast()
    {
        return $this->contrast;
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

        if (function_exists('imagefilter'))
        {
            imagefilter($resource, IMG_FILTER_CONTRAST, $this->contrast);
        }
        else
        {
            throw new \ImageTransform\Exception(sprintf('Cannot perform transform, GD does not support imagefilter '));
        }

        return $image;
    }

}
