<?php
/*
 * This file is part of the Image Transform Library.
 * (c) 2012 Javier Neyra 
 * 
 * Based on sfImageTransform from Stuart Lowes <stuart.lowes@gmail.com> * 
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ImageTransform;

/**
 * sfImageTransformException is thrown when an fatal error occurs while manipulating a image.
 *
 * @package  ImageTransform 
 * @author   Javier Neyra 
 */
class Exception extends \Exception
{

    /**
     * Class constructor.
     *
     * @param string error message
     * @param int error code
     */
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }

}