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
 * Scatter class.
 *
 * Scatters the image pixels.
 *
 * Gives the image a disintegrated look
 *
 * @package sfImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Scatter extends \ImageTransform\Transform
{

    /**
     * Scatter factor.
     */
    protected $scatter_factor = 4;

    /**
     * Construct an sfImageDuotone object.
     *
     * @param integer
     */
    public function __construct($scatter = 4)
    {
        $this->setScatterFactor($scatter);
    }

    /**
     * Set the scatter factor.
     *
     * @param integer
     */
    public function setScatterFactor($width)
    {
        $this->width = (int) $width;
    }

    /**
     * Gets the scatter factor
     *
     * @return integer
     */
    public function getScatterFactor()
    {
        return $this->width;
    }

    /**
     * Apply the transform to the sfImage object.
     *
     * @param \ImageTransform\Image
     * @return \ImageTransform\Image
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        $resourcex = imagesx($resource);
        $resourcey = imagesy($resource);

        for ($x = 0; $x < $resourcex; ++$x)
        {
            for ($y = 0; $y < $resourcey; ++$y)
            {
                $distx = rand(-$this->scatter_factor, $this->scatter_factor);
                $disty = rand(-$this->scatter_factor, $this->scatter_factor);

                // keep inside the image boundaries
                if ($x + $distx >= $resourcex)
                {
                    continue;
                }

                if ($x + $distx < 0)
                {
                    continue;
                }

                if ($y + $disty >= $resourcey)
                {
                    continue;
                }

                if ($y + $disty < 0)
                {
                    continue;
                }

                $oldcol = imagecolorat($resource, $x, $y);
                $newcol = imagecolorat($resource, $x + $distx, $y + $disty);
                imagesetpixel($resource, $x, $y, $newcol);
                imagesetpixel($resource, $x + $distx, $y + $disty, $oldcol);
            }
        }

        return $image;
    }

}
