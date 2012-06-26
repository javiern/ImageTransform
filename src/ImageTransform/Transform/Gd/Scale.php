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
 * Scale class.
 *
 * Scales a GD image.
 *
 * Scales an image by the set amount.
 *
 * @package sfImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Scale extends \ImageTransform\Transform
{

    /**
     * The amount to scale the image by.
     *
     * @var float
     */
    protected $scale = 1;

    /**
     * Construct an sfImageScale object.
     *
     * @param float
     */
    public function __construct($scale)
    {
        $this->setScale($scale);
    }

    /**
     * Set the scale factor.
     *
     * @param float
     */
    public function setScale($scale)
    {
        if (is_numeric($scale))
        {
            $this->scale = $scale;
        }
    }

    /**
     * Gets the scale factor.
     *
     * @return float
     */
    public function getScale()
    {
        return $this->scale;
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

        $x = imagesx($resource);
        $y = imagesy($resource);

        $image->resize(round($x * $this->scale), round($y * $this->scale));

        return $image;
    }

}
