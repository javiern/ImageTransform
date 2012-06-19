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
 * Flip class.
 *
 * Flips image.
 *
 * Flips the image vertically.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Javier Neyra
 * @version SVN: $Id$
 */
class Flip extends \ImageTransform\Image
{

    /**
     * Apply the transform to the \ImageTransfor\Image object.
     *
     * @param integer
     * @return \ImageTransform\Image
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        $x = imagesx($resource);
        $y = imagesy($resource);

        $dest_resource = $image->getAdapter()->getTransparentImage($x, $y);

        for ($h = 0; $h < $y; $h++)
        {
            imagecopy($dest_resource, $resource, 0, $h, 0, $y - $h - 1, $x, 1);
        }
        // Tidy up
        imagedestroy($resource);

        // Replace old image with flipped version
        $image->getAdapter()->setHolder($dest_resource);

        return $image;
    }

}
