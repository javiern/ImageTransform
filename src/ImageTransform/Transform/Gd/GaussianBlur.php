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
 * GaussianBlur class.
 *
 * Blurs the image using the Gaussian method.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Javier Neyra
 */
class GaussianBlur extends \ImageTransform\Transform
{

    /**
     * Apply the transform to the \ImageTransform\Image object.
     *
     * @param \ImageTransform\Image
     * @return \ImageTransform\Image
     */
    protected function transform(\ImageTransform\Image $image)
    {
        $resource = $image->getAdapter()->getHolder();

        if (function_exists('imagefilter'))
        {
            imagefilter($resource, IMG_FILTER_GAUSSIAN_BLUR);
        }
        else
        {
            throw new \ImageTransform\Image(sprintf('Cannot perform transform, GD does not support imagefilter '));
        }

        return $image;
    }

}
