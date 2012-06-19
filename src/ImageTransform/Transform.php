<?php

/**
 * This file is part of the Image Transform Library.
 * (c) 2012 Javier Neyra 
 * 
 * Based on sfImageTransform from Stuart Lowes <stuart.lowes@gmail.com> and Miloslav Kmet <miloslav.kmet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ImageTransform;

/**
 *
 * \ImageTransform\Transform class.
 *
 * Abstract class.
 *
 * Abstract class all sfImageTranform transform classes are extended from.
 *
 * @abstract
 * @package ImageTransform
 * @subpackage Transforms 
 * @author Javier Neyra 
 */
abstract class Transform
{

    /**
     * Apply the transform to the sfImage object.
     *
     * @param sfImage
     * @return sfImage
     */
    public function execute(Image $image)
    {

        // Check we have a valid image holder
        if (false === $image->getAdapter()->hasHolder())
        {
            throw new Exception(sprintf('Cannot perform transform: %s invalid image resource', get_class($this)));
        }
        return $this->transform($image);
    }

    /**
     * Abstract method that performs the image manipulation.
     *
     * @param sfImage
     * @ignore
     * @return sfImage
     */
    abstract protected function transform(Image $image);
}