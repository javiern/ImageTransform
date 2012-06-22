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
 * All transform classes must extend this one
 *
 * @abstract
 * @package ImageTransform
 * @subpackage Transforms 
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @author Miloslav Kmet <miloslav.kmet@gmail.com>
 * @author Javier Neyra 
 */
abstract class Transform
{

    /**
     * Apply the transform to the \ImageTransform\Image object.
     *
     * @param \ImageTransform\Image
     * @return \ImageTransform\Image
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
     * @param \ImageTransform\Image
     * @return \ImageTransform\Image
     */
    abstract protected function transform(Image $image);
}