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
 * Mirror class.
 *
 * Mirrors a GD image.
 *
 * Creates a mirror image of the original image.
 *
 * @package sfImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Mirror extends \ImageTransform\Transform
{

    /**
     * Apply the transform to the sfImage object.
     *
     * @param integer
     * @return sfImage
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        $x = imagesx($resource);
        $y = imagesy($resource);

        imagealphablending($resource, true);

        $dest_resource = $image->getAdapter()->getTransparentImage($x, $y);
        imagealphablending($dest_resource, true);

        for ($w = 0; $w < $x; $w++)
        {
            imagecopy($dest_resource, $resource, $w, 0, $x - $w - 1, 0, 1, $y);
        }

        // Tidy up
        imagedestroy($resource);

        // Replace old image with flipped version
        $image->getAdapter()->setHolder($dest_resource);

        return $image;
    }

}
