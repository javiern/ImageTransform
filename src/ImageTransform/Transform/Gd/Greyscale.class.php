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
 * Greyscale class.
 *
 * Greyscales a GD image.
 *
 * Reduces the level of detail of an image.
 *
 * @package ImageTransform
 * @subpackage transforms
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Javier Neyra
 */
class Greyscale extends \ImageTransform\Transform
{
  /**
   * Apply the transform to the sfImage object.
   *
   * @param sfImage
   * @return sfImage
   */
  protected function transform(\ImageTransform\Image $image)
  {
    $resource = $image->getAdapter()->getHolder();

    $resourcex = imagesx($resource);
    $resourcey = imagesy($resource);

    if (function_exists('imagefilter'))
    {
      imagefilter($resource, IMG_FILTER_GRAYSCALE);
    }

    else
    {
      throw new \ImageTransform\Exception(sprintf('Cannot perform transform, GD does not support imagefilter '));
    }

    return $image;
  }
}
